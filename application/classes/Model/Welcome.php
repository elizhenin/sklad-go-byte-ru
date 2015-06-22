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
            ->where('products.out', '=', 0)
            ->where('products.deleted', '=', 0)
            ->where('models.deleted', '=', 0)
            ->distinct(true)
            ->order_by('models.modificated', 'DESC')
            ->limit(4)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            foreach($select as $key=>$value){
                $db = DB::select('file','alt')
                    ->from('images_models')
                    ->where('id_models','=',$value['id'])
                    ->where('important','=',1)
                    ->where('active','=',1)
                    ->limit(1)
                    ->execute()
                    ->as_array();
                if(!empty($db[0])){
                    $select[$key]['file'] = $db[0]['file'];
                    $select[$key]['alt'] = $db[0]['alt'];
                }
            }
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
            ->join('models_count')
            ->on('models.id','=','models_count.id_models')
            ->where('storages.id_citys', '=', $this->city['id'])
            ->where('storages.transit','=',0)
            ->where('storages.present','=',1)
            ->where('products.out', '=', 0)
            ->where('products.deleted', '=', 0)
            ->where('models.deleted', '=', 0)
            ->group_by('models.id')
            ->order_by('models_count.count','DESC')
            ->order_by('models.price', 'DESC')
            ->limit(4)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            foreach($select as $key=>$value){
                $db = DB::select('file','alt')
                    ->from('images_models')
                    ->where('id_models','=',$value['id'])
                    ->where('important','=',1)
                    ->where('active','=',1)
                    ->limit(1)
                    ->execute()
                    ->as_array();
                if(!empty($db[0])){
                    $select[$key]['file'] = $db[0]['file'];
                    $select[$key]['alt'] = $db[0]['alt'];
                }
            }
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
            ->where('products.out', '=', 0)
            ->where('products.deleted', '=', 0)
            ->where('models.deleted', '=', 0)
            ->distinct(true)
            ->order_by(DB::expr('RAND()'))
            ->limit(4)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            foreach($select as $key=>$value){
                $db = DB::select('file','alt')
                    ->from('images_models')
                    ->where('id_models','=',$value['id'])
                    ->where('important','=',1)
                    ->where('active','=',1)
                    ->limit(1)
                    ->execute()
                    ->as_array();
                if(!empty($db[0])){
                    $select[$key]['file'] = $db[0]['file'];
                    $select[$key]['alt'] = $db[0]['alt'];
                }
            }
            return $select;
        } else {
            return false;
        }
    }

}
