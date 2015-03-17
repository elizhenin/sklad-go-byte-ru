<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladModels extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager

    private function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    public function NewModel($post)
    {
        $post['name'] = trim(htmlspecialchars($post['name']));
        $post['sku'] = trim(htmlspecialchars($post['sku']));

        if (empty($post['alias'])) {
            $post['alias'] = Alias::textToAlias($post['name']);
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
        DB::insert('models', array_keys($post))
            ->values($post)
            ->execute();
    }

    public function UpdateModel($post)
    {
        $model = $this->GetById($post['id']);

        if ($model) {
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


    public function GetById($id)
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

    public function GetAll()
    {
        $select = DB::select(
            array('models.id', 'id'),
            array('models.sku', 'sku'),
            array('models.name', 'name'),
            array('models.alias', 'alias'),
            array('categorys.name', 'category'),
            array('models.modificated', 'modificated'),
            array('models.price', 'price'),
            array('models.in_price', 'in_price'),
            array('models.deleted', 'deleted')
        )
            ->from('models')
            ->join('categorys')
            ->on('categorys.id', '=', 'models.id_categorys')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function SetDeletedById($id, $deleted)
    {
        DB::update('models')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    public function GetCategories()
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

    public function CategoriesCheckPath($alias)
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

    public function CategoriesFullName()
    {
        $tmp =  DB::select(
        )
            ->from('categorys')
            ->execute()
            ->as_array();
        $categories = array();
        foreach($tmp as $one)
        {
            $categories[$one['id']] = $one;
        }
        unset($tmp);
        $categories_before = $categories;
        foreach($categories as $category)
        {
            $parent = $category['id_parent'];
            while($parent != 0){
                $categories[$category['id']]['name']=$categories_before[$parent]['name'].' / '. $categories[$category['id']]['name'];
                $parent = $categories[$parent]['id_parent'];
            }
        }
        unset($categories_before);
        $categories = $this->array_orderby($categories,'name',SORT_ASC);
        return $categories;
    }

    public function CategoriesGetCurrent($item)
    {

        $records = DB::select()
            ->from('categorys')
            ->where('id_parent', '=', $item['id'])
            ->execute()
            ->as_array();
        return $records;
    }

    public function CategoriesGetById($id)
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

    public function AddCategory($item, $id_parent)
    {
        $item['name'] = trim(htmlspecialchars($item['name']));
        $item['alias'] = Alias::textToAlias($item['name']);
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
    }


    public function CategoriesUpdateRecord($item)
    {
        $id = $item['id'];
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
    }

}
