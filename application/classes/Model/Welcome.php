<?php defined('SYSPATH') or die('No direct script access.');

class Model_Welcome extends Model
{
    private $city = false;

    public function __construct($city)
    {
        $this->city = $city;
    }


    public function ModelGetNew()
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
            ->where('storages.transit','=',0)
            ->where('storages.present','=',1)
            ->where('products.out', '=', '0')
            ->where('products.deleted', '=', '0')
            ->where('models.deleted', '=', '0')
            ->distinct(true)
            ->order_by('models.modificated', 'DESC')
            ->limit(4)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ModelGetLeaders()
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
            ->where('storages.transit','=',0)
            ->where('storages.present','=',1)
            ->where('products.out', '=', '0')
            ->where('products.deleted', '=', '0')
            ->where('models.deleted', '=', '0')
            ->distinct(true)
            ->order_by('models.modificated', 'DESC')
            ->limit(4)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ModelGetSpecial()
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
            ->where('storages.transit','=',0)
            ->where('storages.present','=',1)
            ->where('products.out', '=', '0')
            ->where('products.deleted', '=', '0')
            ->where('models.deleted', '=', '0')
            ->distinct(true)
            ->order_by('models.special', 'DESC')
            ->order_by('models.modificated', 'DESC')
            ->limit(4)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

}
