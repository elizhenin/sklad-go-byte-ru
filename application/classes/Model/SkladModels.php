<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladModels extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager


    public function ModelAdd($post)
    {
        $categories = $this->CategoryFullNames(false);
        $category = $post['id_categorys'];


        $post['name'] = trim(htmlspecialchars($post['name']));
        $post['sku'] = trim(htmlspecialchars($post['sku']));

        if (empty($post['alias'])) {
            $post['alias'] = Goodies::textToAlias($post['name']);
        } else {
            $post['alias'] = trim(htmlspecialchars($post['alias']));
        }

        $post['title'] = trim(htmlspecialchars($post['title']));
        if (empty($post['title'])) $post['title'] = $post['name'];
        $post['short_text'] = trim(htmlspecialchars($post['short_text']));
        $post['text'] = trim(htmlspecialchars($post['text']));
        $post['complete'] = trim(htmlspecialchars($post['complete']));
        $post['description'] = trim(htmlspecialchars($post['description']));
        $post['keywords'] = trim(htmlspecialchars($post['keywords']));
        $post['created'] = DB::expr('NOW()');
        $post['modificated'] = DB::expr('NOW()');
        unset($post['operation']);
        unset($post['id']);
        $model = DB::insert('models', array_keys($post))
            ->values($post)
            ->execute();

        $model = $model[0];
        if (!empty($categories[$category]['includes'])) {
            $cat = DB::insert('models_categorys', array('id_models', 'id_categorys'));
            foreach ($categories[$category]['includes'] as $one) {
                $cat->values(array($model, $one));
            }
            $cat->execute();
        }
    }

    public function ModelUpdate($post)
    {
        $model = $this->ModelGetById($post['id']);

        if ($model) {
            $categories = $this->CategoryFullNames(false);

            if (!empty($categories[$post['id_categorys']]['includes'])) {
                $cat = DB::insert('models_categorys', array('id_models', 'id_categorys'));
                foreach ($categories[$post['id_categorys']]['includes'] as $one) {
                    $cat->values(array($post['id'], $one));
                }

                DB::delete('models_categorys')
                    ->where('id_models', '=', $post['id'])
                    ->execute();

                $cat->execute();
            }

            $post['name'] = trim(htmlspecialchars($post['name']));
            $post['sku'] = trim(htmlspecialchars($post['sku']));

            $post['title'] = trim(htmlspecialchars($post['title']));
            if (empty($post['title'])) $post['title'] = $post['name'];
            $post['short_text'] = trim(htmlspecialchars($post['short_text']));
            $post['text'] = trim(htmlspecialchars($post['text']));
            $post['complete'] = trim(htmlspecialchars($post['complete']));
            $post['description'] = trim(htmlspecialchars($post['description']));
            $post['keywords'] = trim(htmlspecialchars($post['keywords']));
            $post['modificated'] = DB::expr('NOW()');

            unset($post['id']);
            unset($post['operation']);

            DB::update('models')
                ->set($post)
                ->where('id', '=', $model['id'])
                ->execute();

        }
    }


    public function ModelGetById($id)
    {
        $select = DB::select()
            ->from('models')
            ->where('models.id', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function ModelGetAll()
    {
        $select = DB::select()
            ->from('models')
            ->order_by('modificated','DESC')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ModelGetByCategory($category)
    {
        if (empty($category)) {
            $select = $this->ModelGetAll();
        } else {
            $select = DB::select(
                array('models.id', 'id'),
                array('models.sku', 'sku'),
                array('models.name', 'name'),
                array('models.id_categorys', 'id_categorys'),
                array('models.price', 'price'),
                array('models.in_price', 'in_price'),
                array('models.modificated', 'modificated'),
                array('models.deleted', 'deleted')
            )
                ->from('models')
                ->join('models_categorys')
                ->on('models.id', '=', 'models_categorys.id_models')
                ->where('models_categorys.id_categorys', '=', $category)
                ->order_by('models.modificated','DESC')
                ->execute()
                ->as_array();
        }
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ModelSetDeletedById($id, $deleted)
    {
        DB::update('models')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    public function ModelGetCategories()
    {
        $select = DB::select(
            array('id', 'id'),
            array('name', 'name')
        )
            ->from('categorys')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function CategoryCheckPath($alias)
    {
        $check = true;
        $path = explode('/', $alias);
        $parent = 0;
        if (!empty($alias)) {
            foreach ($path as $try) {
                $item = DB::select()
                    ->from('categorys')
                    ->where('alias', '=', $try)
                    ->where('id_parent', '=', $parent)
                    ->execute()
                    ->as_array();
                if (empty($item[0])) {
                    $check = false;
                } else {
                    $parent = $item[0]['id'];
                }

                if (!$check) break;
            }
        } else {
            $item[0]['id'] = '0';
        }
        if ($check) {
            return $item[0];
        } else
            return false;

    }

    public function CategoryFullNames($sort = true)
    {
        $cache = Cache::instance();
        if ($result = $cache->get('CategoriesFullName', false)) {
            if ($sort) {
                $result = Goodies::array_orderby($result, 'name', SORT_ASC);
            }
            return $result;
        } else {
            $tmp = DB::select()
                ->from('categorys')
                ->execute()
                ->as_array();
            $categories = array();
            foreach ($tmp as $one) {
                $categories[$one['id']] = $one;
                $categories[$one['id']]['includes'][$one['id']] = $one['id'];
                $categories[$one['id']]['allowed'][$one['id']] = true;
            }
            unset($tmp);
            $categories_before = $categories;
            foreach ($categories as $category) {
                $parent = $category['id_parent'];
                while ($parent != 0) {
                    $categories[$category['id']]['name'] = $categories_before[$parent]['name'] . ' / ' . $categories[$category['id']]['name'];
                    $categories[$category['id']]['includes'][$categories_before[$parent]['id']] = $categories_before[$parent]['id'];
                    $categories[$parent]['allowed'] = false;
                    $parent = $categories[$parent]['id_parent'];
                }
            }
            unset($categories_before);


            $cache->set('CategoriesFullName', $categories, 1800);
            if ($sort) {
                $categories = Goodies::array_orderby($categories, 'name', SORT_ASC);
            }
            return $categories;
        }
    }

    public function CategoryFullNameAllowed($sort = true)
    {
        $categories = $this->CategoryFullNames($sort);
        foreach ($categories as $key => $cat) {
            if (!$cat['allowed']) {
                unset($categories[$key]);
            }
        }
        return $categories;
    }

    public function CategoryGetSub($item)
    {

        $records = DB::select()
            ->from('categorys')
            ->where('id_parent', '=', $item['id'])
            ->execute()
            ->as_array();
        return $records;
    }

    public function CategoryGetById($id)
    {
        $records = DB::select()
            ->from('categorys')
            ->where('id', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();
        if (empty($records[0])) {
            return false;
        } else {
            return $records[0];
        }
    }

    public function CategoryAdd($item, $id_parent)
    {
        $item['name'] = trim(htmlspecialchars($item['name']));
        $item['alias'] = Goodies::textToAlias($item['name']);
        $item['menu'] = trim(htmlspecialchars($item['menu']));
        if (empty($item['menu'])) $item['menu'] = $item['name'];
        $item['title'] = trim(htmlspecialchars($item['title']));
        if (empty($item['title'])) $item['title'] = $item['name'];
        $item['text'] = trim(htmlspecialchars($item['text']));
        $item['description'] = trim(htmlspecialchars($item['description']));

        $item['id_parent'] = $id_parent;
        $item['created'] = DB::expr('NOW()');
        $item['modificated'] = DB::expr('NOW()');
        unset($item['operation']);
        DB::insert('categorys', array_keys($item))
            ->values($item)
            ->execute();
        $cache = Cache::instance();
        $cache->delete('CategoriesFullName');
    }


    public function CategoryUpdate($item)
    {

        $id = $item['id'];

        $models = DB::select()
            ->from('models')
            ->where('id_categorys', '=', $id)
            ->execute()
            ->as_array();

        $item['name'] = trim(htmlspecialchars($item['name']));
        $item['menu'] = trim(htmlspecialchars($item['menu']));
        if (empty($item['menu'])) $item['menu'] = $item['name'];
        $item['title'] = trim(htmlspecialchars($item['title']));
        if (empty($item['title'])) $item['title'] = $item['name'];
        $item['text'] = trim(htmlspecialchars($item['text']));
        $item['description'] = trim(htmlspecialchars($item['description']));
        $item['modificated'] = DB::expr('NOW()');
        unset($item['id']);
        unset($item['operation']);
        DB::update('categorys')
            ->set($item)
            ->where('id', '=', $id)
            ->execute();
        $cache = Cache::instance();
        $cache->delete('CategoriesFullName');
        if (!empty($models)) {
            foreach ($models as $model) {
                $categories = $this->CategoryFullNames(false);

                if (!empty($categories[$model['id_categorys']]['includes'])) {
                    $cat = DB::insert('models_categorys', array('id_models', 'id_categorys'));
                    foreach ($categories[$model['id_categorys']]['includes'] as $one) {
                        $cat->values(array($model['id'], $one));
                    }

                    DB::delete('models_categorys')
                        ->where('id_models', '=', $model['id'])
                        ->execute();

                    $cat->execute();
                }
            }

        }

    }

    public function CategorySetDeletedById($id, $deleted)
    {
        DB::update('categorys')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    public function SpecificationsGetAll()
    {

        $records = DB::select()
            ->from('specifications')
            ->order_by('deleted')
            ->execute()
            ->as_array();
        return $records;
    }

    public function SpecificationsGetVisible()
    {

        $records = DB::select()
            ->from('specifications')
            ->where('deleted', '=', '0')
            ->execute()
            ->as_array();
        return $records;
    }

    public function SpecificationsAdd($post)
    {
        $item = $records = DB::insert('specifications', array('name'))
            ->values(array(trim(htmlspecialchars($post['name']))))
            ->execute();
        return $item[0];
    }

    public function SpecificationsRename($post)
    {
        DB::update('specifications')
            ->set(array('name' => trim(htmlspecialchars($post['name']))))
            ->where('id', '=', $post['id'])
            ->execute();
    }

    public function SpecificationsSetDeletedById($id, $deleted)
    {
        DB::update('specifications')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    public function SpecificationsModelGetAll($model)
    {
        $items = DB::select(
            array('specifications_models.id', 'id'),
            array('specifications_models.id_specifications', 'id_specifications'),
            array('specifications_models.id_models', 'id_models'),
            array('specifications_models.value', 'value'),
            array('specifications_models.important', 'important'),
            array('specifications_models.manual', 'manual'),
            array('specifications_models.id', 'created'),
            array('specifications_models.modificated', 'modificated'),
            array('specifications_models.deleted', 'deleted'),
            array('specifications.name', 'specification')
        )
            ->from('specifications_models')
            ->join('specifications')
            ->on('specifications_models.id_specifications', '=', 'specifications.id')
            ->where('specifications_models.id_models', '=', $model)
            ->execute()
            ->as_array();

        if ($items) return $items; else return false;
    }

    public function SpecificationsModelAdd($post)
    {
        $specification = array();
        if ($post['id_specifications'] == '0') {
            $post['id_specifications'] = $this->SpecificationsAdd($post);
        }
        $specification['id_specifications'] = $post['id_specifications'];
        $specification['id_models'] = $post['id_models'];
        $specification['value'] = 'N/A';
        $specification['important'] = '0';
        $specification['manual'] = '0';
        $specification['created'] = DB::expr('NOW()');
        $specification['modificated'] = DB::expr('NOW()');

        $id = DB::insert('specifications_models', array_keys($specification))
            ->values($specification)
            ->execute();
        if ($id) return $id[0]; else return false;
    }

    public function SpecificationsModelDelete($id)
    {

        $id = DB::delete('specifications_models')
            ->where('specifications_models.id', '=', $id)
            ->execute();
        if ($id) return $id[0]; else return false;
    }

    public function SpecificationsModelUpdate($post)
    {
        $current_specifications = $this->SpecificationsModelGetAll($post['id_models']);

        foreach($current_specifications as $one){
            if(!empty($post['delete_'.$one['id']])){
                DB::delete('specifications_models')
                    ->where('specifications_models.id', '=', $one['id'])
                    ->execute();
            }
            else
            {
                $new = array();
                if(!empty($post['value_'.$one['id']])) $new['value'] = trim(htmlspecialchars($post['value_'.$one['id']]));
                if(!empty($post['important_'.$one['id']])) $new['important'] = '1';else $new['important'] = '0';
                if(!empty($post['manual_'.$one['id']])) $new['manual'] = '1';else $new['manual'] = '0';
                $new['modificated'] = DB::expr('NOW()');
                DB::update('specifications_models')
                    ->set($new)
                    ->where('id', '=', $one['id'])
                    ->execute();
            }
        }
    }
}
