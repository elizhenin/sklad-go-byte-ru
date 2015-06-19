<?php defined('SYSPATH') or die('No direct script access.');

class Model_Basket extends Model
{

     static function ModelsCheckAvailAble($ids)
    {
        $ses = Session::instance();
        $city = DB::select()
            ->from('citys')
            ->where('name', '=', $ses->get('city', 'Воронеж'))
            ->limit(1)
            ->execute()
            ->as_array();
        $city = $city[0];

        $select = DB::select(
            array('models.id', 'id'),
            array('models.sku', 'sku'),
            array('models.name', 'name'),
            array('models.price', 'price')
        )
            ->from('models')
            ->join('categorys')
            ->on('models.id_categorys', '=', 'categorys.id')
            ->join('products')
            ->on('products.id_models', '=', 'models.id')
            ->join('storages')
            ->on('products.id_storage', '=', 'storages.id')
            ->where('storages.id_citys', '=', $city['id'])
            ->where('products.out', '=', '0')
            ->where('products.deleted', '=', '0')
            ->where('models.deleted', '=', '0')
            ->where('models.id','IN',$ids)
            ->distinct(true)
            ->order_by('models.modificated', 'DESC')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

}
