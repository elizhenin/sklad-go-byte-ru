<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladProducts extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager

//products

    public function ProductsAdd($post)
    {
        $post['id_models'] = trim(htmlspecialchars($post['id_models']));
        $post['sku'] = trim(htmlspecialchars($post['sku']));
        $post['comments'] = trim(htmlspecialchars($post['comments']));
        $post['id_storage'] = trim(htmlspecialchars($post['id_storage']));
        $post['sku'] = trim(htmlspecialchars($post['sku']));
        $post['out'] = '0';
        $post['date_out'] = '0';
        $post['deleted'] = '0';
        unset($post['operation']);
        DB::insert('products', array_keys($post))
            ->values($post)
            ->execute();

    }

    public function ProductsUpdate($post)
    {
        $product = $this->ProductsGetById($post['id']);

        if ($product) {
            if(!empty($post['id_models']))
            $post['id_models'] = trim(htmlspecialchars($post['id_models']));
            if(!empty($post['sku']))
            $post['sku'] = trim(htmlspecialchars($post['sku']));
            if(!empty($post['comments']))
            $post['comments'] = trim(htmlspecialchars($post['comments']));
            $post['id_storage'] = trim(htmlspecialchars($post['id_storage']));
            if(!empty($post['out'])) $post['out']='1';else $post['out'] = '0';
            $post['out'] = trim(htmlspecialchars($post['out']));
            //$post['date_out'] = trim(htmlspecialchars($post['date_out']));

            unset($post['id']);
            unset($post['operation']);

            $ses = Session::instance();
            $user = $ses->get('user', 0);

            if($product['out'] && $user['rights']!='super'){}
            else
            DB::update('products')
                ->set($post)
                ->where('id', '=', $product['id'])
                ->execute();

        }
    }


    public function ProductsGetById($id)
    {
        $select = DB::select()
            ->from('products')
            ->where('products.id', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function ProductsGetAll($model = false,$filter=false)
    {
        $select = DB::select(
            array('products.id','id'),
            array('models.alias','alias'),
            array('models.name','model'),
            array('products.sku','sku'),
            array('storages.name','storage'),
            array('products.out','out'),
            array('products.date_out','date_out'),
            array('products.deleted','deleted')

        )
            ->from('products')
            ->join('models')
            ->on('products.id_models','=','models.id')
            ->join('storages')
            ->on('products.id_storage','=','storages.id');

        if($model)
            $select->where('models.alias','=',$model);
        if($filter) {
            $select->and_where_open();
            $select->or_where('products.sku', 'like', '%' . $filter . '%');
            $select->or_where('models.sku', 'like', '%' . $filter . '%');
            $select->or_where('models.name', 'like', '%' . $filter . '%');
            $select->or_where('models.alias', 'like', '%' . $filter . '%');
            $select->and_where_close();
        }else{
            $ses = Session::instance();
            $user = $ses->get('user', false);
            if($user['rights']=='sale')
                $select->where('storages.id_citys','=',$user['id_citys']);
        }

        $select = $select
            ->order_by('models.name')
            ->order_by('products.sku')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ProductsGetCounted($id_category = false)
    {
        $select = DB::select(
            array('products.id','id'),
            array('models.name','model'),
            array('products.sku','sku'),
            array('products.id_storage','id_storage'),
            array('products.out','out'),
            array('products.date_out','date_out'),
            array('products.deleted','deleted'),
            array(DB::expr('count("products.id_models")'),'count')

        )
            ->from('products')
            ->join('models')
            ->on('products.id_models','=','models.id');

        if($id_category)
            $select->where('models.id_categorys','=',$id_category);

        $select = $select
            ->order_by('products.id_models')
            ->group_by('products.id_models')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ProductsGetByModel($model)
    {
        if (empty($model)) {
            $select = $this->ProductsGetAll();
        } else {
            $select = DB::select(

            )
                ->from('products')

                ->where('products.id_models', '=', $model)

                ->execute()
                ->as_array();
        }
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ProductsGetByStorage($storage)
    {
        if (empty($storage)) {
            $select = $this->ProductsGetAll();
        } else {
            $select = DB::select(

            )
                ->from('products')

                ->where('products.id_storage', '=', $storage)

                ->execute()
                ->as_array();
        }
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ProductsSetDeletedById($id, $deleted)
    {
        DB::update('products')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }
}
