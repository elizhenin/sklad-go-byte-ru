<?php defined('SYSPATH') or die('No direct script access.');

class Model_Catalog extends Model
{
    private $city = false;

    public function __construct($city)
    {
        $this->city = $city;
    }

    private function AddSubMenuRecursive($id_parent, $items)
    {
        $tmp = array();
        if (!empty($items)) {
            foreach ($items as $key => $one) {
                if ($one['id_parent'] == $id_parent) {
                    $tmp[$one['id']] = $one;
                    unset($items[$key]);
                    $tmp[$one['id']]['sub'] = $this->AddSubMenuRecursive($one['id'], $items);
                }
            }
            return $tmp;
        } else return false;
    }

    public function CategoryGetMenu()
    {
        $cache = Cache::instance();
        if ($result = $cache->get('CatalogMenu', false)) {
            return $result;
        } else {
            $tmp = DB::select('id', 'menu', 'alias', 'id_parent')
                ->from('categorys')
                ->where('deleted', '=', '0')
                ->execute()
                ->as_array();
            if (!empty($tmp)) {
                $result = $this->AddSubMenuRecursive(0, $tmp);
                $cache->set('CatalogMenu', $result, 1800);
            } else $result = false;
            return $result;
        }
    }

//    public function CategoryCheckPath($alias)
//    {
//        $check = true;
//        $path = explode('/', $alias);
//        $parent = 0;
//        if (!empty($alias)) {
//            foreach ($path as $try) {
//                $item = DB::select()
//                    ->from('categorys')
//                    ->where('alias', '=', $try)
//                    ->where('id_parent', '=', $parent)
//                    ->execute()
//                    ->as_array();
//                if (empty($item[0])) {
//                    $check = false;
//                } else {
//                    $parent = $item[0]['id'];
//                }
//
//                if (!$check) break;
//            }
//        } else {
//            $item[0]['id'] = '0';
//        }
//        if ($check) {
//            return $item[0];
//        } else
//            return false;
//
//    }

    public function CategoryCheckPathID($id, $alias)
    {
        $check = false;
        if (!empty($alias) && (!empty($id))) {
            $item = DB::select()
                ->from('categorys')
                ->where('alias', '=', $alias)
                ->where('id', '=', $id)
                ->where('deleted', '=', '0')
                ->execute()
                ->as_array();
            if (!empty($item[0])) $check = $item[0];
        } else {
            $check['id'] = '0';
        }
        return $check;
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

    public function ModelGetByCategory($category)
    {
        $storages_settings = DB::select(
            array('from_storage.id_citys', 'from_id')
        )
            ->from('storages_settings')
            ->join(array('storages', 'from_storage'))
            ->on('from_storage.id', '=', 'storages_settings.from')
            ->join(array('storages', 'to_storage'))
            ->on('to_storage.id', '=', 'storages_settings.to')
            ->where('to_storage.id_citys', '=', $this->city['id'])
            ->where('storages_settings.deleted', '=', '0')
            ->execute()
            ->as_array();
        $citys = array();
        $citys[] = $this->city['id'];
        if (!empty($storages_settings)) {
            foreach ($storages_settings as $setting)
                $citys[] = $setting['from_id'];
            unset($storages_settings);
        }

        $select = DB::select(
            array('models.id', 'id'),
            array('models.name', 'name'),
            array('models.price', 'price'),
            array('models.other_price', 'other_price'),
            array('models.alias', 'alias'),
            array('categorys.alias', 'categorys_alias'),
            array('categorys.id', 'categorys_id'),
            array('storages.id_citys', 'id_citys')

        )
            ->from('models')
            ->join('categorys')
            ->on('models.id_categorys', '=', 'categorys.id');
        if (!empty($category))
            $select->join('models_categorys')
                ->on('models.id', '=', 'models_categorys.id_models');

        $select = $select
            ->join('products')
            ->on('products.id_models', '=', 'models.id')
            ->join('storages')
            ->on('products.id_storage', '=', 'storages.id')
            ->where('storages.id_citys', 'IN', $citys);

        if (!empty($category))
            $select->where('models_categorys.id_categorys', '=', $category);

        $select = $select
            ->where('products.out', '=', '0')
            ->where('products.deleted', '=', 0)
            ->where('models.deleted', '=', 0)
            ->where('storages.deleted', '=', 0)
            ->distinct(true)
            ->order_by('models.modificated', 'ASC')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            $return = array();
            foreach ($select as $key => $product) {
                $id = $product['id'];
                if (empty($return[$id]['product'])) {
                    $return[$id]['product'] = $product;
                } else {
                    if ($product['id_citys'] == $this->city['id']) $return[$id]['product'] = $product;
                }
                $return[$id]['specifications'] =
                    DB::select(
                        array('specifications_models.id', 'id'),
                        array('specifications_models.value', 'value'),
                        array('specifications_models.manual', 'manual'),
                        array('specifications.name', 'name')
                    )
                        ->from('specifications_models')
                        ->join('specifications')
                        ->on('specifications_models.id_specifications', '=', 'specifications.id')
                        ->where('specifications_models.id_models', '=', $id)
                        ->where('specifications_models.important', '=', '1')
                        ->execute()
                        ->as_array();
                $image = DB::select('file', 'alt')
                    ->from('images_models')
                    ->where('id_models', '=', $id)
                    ->where('important', '=', '1')
                    ->limit(1)
                    ->execute()
                    ->as_array();
                if (!empty($image[0]))
                    $return[$id]['image'] = $image[0];

            }
            return $return;
        } else {
            return false;
        }
    }

    public function ModelGetAll()
    {
        $select = DB::select(
            array('models.id', 'id'),
            array('models.name', 'name'),
            array('models.price', 'price'),
            array('models.other_price', 'other_price'),
            array('models.alias', 'alias'),
            array('categorys.alias', 'categorys_alias'),
            array('categorys.id', 'categorys_id')

        )
            ->from('models')
            ->join('categorys')
            ->on('models.id_categorys', '=', 'categorys.id')
            ->join('products')
            ->on('products.id_models', '=', 'models.id')
            ->join('storages')
            ->on('products.id_storage', '=', 'storages.id')
            ->where('storages.id_citys', '=', $this->city['id'])
            ->where('products.out', '=', '0')
            ->where('products.deleted', '=', '0')
            ->where('models.deleted', '=', '0')
            ->distinct('models.id')
            ->order_by('models.modificated', 'DESC')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
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

    public function ProductCategoryCheckPath($id, $alias, $product)
    {
        $return = false;
        if (!empty($alias) && (!empty($id)) && (!empty($product))) {
            $select = DB::select(
                array('models.id', 'id'),
                array('models.name', 'name'),
                array('models.title', 'title'),
                array('models.keywords', 'keywords'),
                array('models.description', 'description'),
                array('models.price', 'price'),
                array('models.other_price', 'other_price'),
                array('models.alias', 'alias'),
                array('models.text', 'text'),
                array('models.short_text', 'short_text'),
                array('models.complectation', 'complectation'),
                array('categorys.alias', 'categorys_alias'),
                array('categorys.id', 'categorys_id')

            )
                ->from('models')
                ->join('categorys')
                ->on('models.id_categorys', '=', 'categorys.id')
                ->join('products')
                ->on('products.id_models', '=', 'models.id')
                ->join('storages')
                ->on('products.id_storage', '=', 'storages.id')
                ->where('storages.id_citys', '=', $this->city['id'])
                ->where('models.alias', '=', $product)
                ->where('categorys.alias', '=', $alias)
                ->where('categorys.id', '=', $id)
                ->where('products.out', '=', '0')
                ->where('products.deleted', '=', 0)
                ->where('models.deleted', '=', 0)
                ->distinct('models.id')
                ->order_by('models.modificated', 'DESC')
                ->execute()
                ->as_array();
            if (!empty($select[0])) {
                $return['product'] = $select[0];
                $id = $select[0]['id'];
                $return['specifications'] = DB::select(
                    array('specifications_models.id', 'id'),
                    array('specifications_models.value', 'value'),
                    array('specifications_models.manual', 'manual'),
                    array('specifications.id_specifications_groups', 'group_id'),
                    array('specifications.name', 'name')
                )
                    ->from('specifications_models')
                    ->join('specifications')
                    ->on('specifications_models.id_specifications', '=', 'specifications.id')
                    ->where('specifications_models.id_models', '=', $id)
                    ->order_by('specifications.order', 'ASC')
                    ->execute()
                    ->as_array();
                $return['images'] = DB::select('file', 'alt', 'important')
                    ->from('images_models')
                    ->where('id_models', '=', $id)
                    ->where('active', '=', '1')
                    ->execute()
                    ->as_array();
            }
        }
        return $return;
    }

    public function SpecificationsGroupsGetVisible()
    {

        $tmp = DB::select('id', 'name')
            ->from('specifications_groups')
            ->where('deleted', '=', '0')
            ->order_by('order')
            ->execute()
            ->as_array();
        $records = array();
        if (!empty($tmp))
            foreach ($tmp as $one)
                $records[$one['id']] = $one;
        $records[] = array('id' => 0, 'name' => 'Прочее');
        return $records;
    }

    public function GetPath($id,$alias)
    {
        $check = false;
        $return =array();
        if (!empty($alias) && (!empty($id))) {
            $item = DB::select('id','alias','name','id_parent')
                ->from('categorys')
                ->where('alias', '=', $alias)
                ->where('id', '=', $id)
                ->execute()
                ->as_array();
            if (!empty($item[0])) $check = $item[0];
            $return[] = $check;
        }

        if(!empty($check['id_parent'])){
            $parent = $check['id_parent'];
            while($parent > 0){
                $item = DB::select('id','alias','name','id_parent')
                    ->from('categorys')
                    ->where('id', '=', $parent)
                    ->execute()
                    ->as_array();
                if (!empty($item[0])) $check = $item[0];
                $return[] = $check;
                $parent = $check['id_parent'];
            }
        }

        return $return;
    }
}
