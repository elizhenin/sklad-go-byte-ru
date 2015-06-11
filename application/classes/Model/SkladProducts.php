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
        $model = htmlspecialchars(trim($post['models']));
        unset($post['models']);
        if(!empty($model))
        $db = DB::select('id', 'name')
            ->from('models')
            ->where('name', '=', $model)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($db[0])) {
            $post['id_models'] = $db[0]['id'];
            $post['sku'] = trim(htmlspecialchars($post['sku']));
            $post['comments'] = trim(htmlspecialchars($post['comments']));
            $post['id_storage'] = trim(htmlspecialchars($post['id_storage']));
            $post['sku'] = trim(htmlspecialchars($post['sku']));
            $post['out'] = '0';
            $post['date_out'] = '0';
            $post['deleted'] = '0';
            unset($post['operation']);
            $id = DB::insert('products', array_keys($post))
                ->values($post)
                ->execute();
            Model_SkladProducts::ProductsHistory('Создан',$id[0]);
        }
    }

    public function ProductsUpdate($post)
    {
        $product = $this->ProductsGetById($post['id']);

        if ($product) {
            $model = htmlspecialchars(trim($post['models']));
            unset($post['models']);
            if(!empty($model))
            $db = DB::select('id', 'name')
                ->from('models')
                ->where('name', '=', $model)
                ->limit(1)
                ->execute()
                ->as_array();
            if (!empty($db[0])) {
                $post['id_models'] = $db[0]['id'];
            }
            if (!empty($post['sku']))
                $post['sku'] = trim(htmlspecialchars($post['sku']));
            if (!empty($post['comments']))
                $post['comments'] = trim(htmlspecialchars($post['comments']));
            $post['id_storage'] = trim(htmlspecialchars($post['id_storage']));
            if (!empty($post['out'])) $post['out'] = '1'; else $post['out'] = '0';
            $post['out'] = trim(htmlspecialchars($post['out']));
            //$post['date_out'] = trim(htmlspecialchars($post['date_out']));

            unset($post['id']);
            unset($post['operation']);

            $ses = Session::instance();
            $user = $ses->get('user', 0);

            if ($product['out'] && $user['rights'] != 'super') {
            } else {
                Model_SkladProducts::ProductsHistory('Изменен',$product['id']);
                DB::update('products')
                    ->set($post)
                    ->where('id', '=', $product['id'])
                    ->execute();
            }

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

    public function ProductsGetAll($model = false, $filter = false)
    {
        $select = DB::select(
            array('products.id', 'id'),
            array('models.alias', 'alias'),
            array('models.name', 'model'),
            array('products.sku', 'sku'),
            array('storages.name', 'storage'),
            array('products.out', 'out'),
            array('products.date_out', 'date_out'),
            array('products.deleted', 'deleted'),
            array('orders_products.id_orders', 'id_orders')

        )
            ->from('products')
            ->join('models')
            ->on('products.id_models', '=', 'models.id')
            ->join('storages')
            ->on('products.id_storage', '=', 'storages.id')
            ->join('orders_products', 'LEFT')
            ->on('products.id', '=', 'orders_products.id_products')
            ->join('orders', 'LEFT')
            ->on('orders.id', '=', 'orders_products.id_orders');

        if ($model)
            $select->where('models.alias', '=', $model);
        if ($filter) {
            $select->and_where_open();
            $select->or_where('products.sku', 'like', '%' . $filter . '%');
            $select->or_where('models.sku', 'like', '%' . $filter . '%');
            $select->or_where('models.name', 'like', '%' . $filter . '%');
            $select->or_where('models.alias', 'like', '%' . $filter . '%');
            $select->and_where_close();
        } else {
            $ses = Session::instance();
            $user = $ses->get('user', false);
            if ($user['rights'] == 'sale')
                $select->where('storages.id_citys', '=', $user['id_citys']);
        }

        $select = $select
            ->order_by('models.name')
            ->order_by('products.sku')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            if ($filter) {
            } else {
                foreach ($select as $key => $value)
                    if ($value['out']) {
                        $orders = DB::select(array('orders.id', 'id'))
                            ->from('orders')
                            ->join('orders_products')
                            ->on('orders.id', '=', 'orders_products.id_orders')
                            ->where('orders_products.id_products', '=', $value['id'])
                            ->where('orders.complete', '=', '1')
                            ->limit(1)
                            ->execute()
                            ->as_array();
                        if (!empty($orders)) unset($select[$key]);
                    }
            }

            return $select;
        } else {
            return false;
        }
    }

    public function ProductsGetCounted($id_category = false)
    {
        $select = DB::select(
            array('products.id', 'id'),
            array('models.name', 'model'),
            array('products.sku', 'sku'),
            array('products.id_storage', 'id_storage'),
            array('products.out', 'out'),
            array('products.date_out', 'date_out'),
            array('products.deleted', 'deleted'),
            array(DB::expr('count("products.id_models")'), 'count')

        )
            ->from('products')
            ->join('models')
            ->on('products.id_models', '=', 'models.id');

        if ($id_category)
            $select->where('models.id_categorys', '=', $id_category);

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
            $select = DB::select()
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
            $select = DB::select()
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
        switch ($deleted) {
            case '1':
                Model_SkladProducts::ProductsHistory('Удален',$id);
                break;
            case '0':
                Model_SkladProducts::ProductsHistory('Восстановлен',$id);
                break;
        }

        DB::update('products')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    static function ProductsMoveCheck($sku)
    {
        $ses = Session::instance();
        $user = $ses->get('user', 0);
        $product = DB::select(
            array('products.id', 'id'),
            array('products.sku', 'sku'),
            array('models.name', 'name'),
            array('storages.name', 'storage'),
            array('citys.alias', 'city')
        )
            ->from('products')
            ->join('models')
            ->on('models.id', '=', 'products.id_models')
            ->join('storages')
            ->on('storages.id', '=', 'products.id_storage')
            ->join('citys')
            ->on('citys.id', '=', 'storages.id_citys')
            ->where('products.sku', '=', $sku)
            ->where('products.out', '=', '0')
            ->limit(1)
            ->execute()
            ->as_array();

        if ($product) {
            $product = $product[0];
            $check = true;
//            $check = false;
//            if ($product['city'] == $user['login']) {
//                $check = true;
//                goto finish;
//            }
//            $settings = DB::select(
//                array('storages.id_citys', 'from')
//            )
//                ->from('storages_settings')
//                ->join('storages')
//                ->on('storages.id', '=', 'storages_settings.from')
//                ->where('storages.id_citys', '=', $user['id_citys'])
//                ->execute()
//                ->as_array();
//            if ($settings)
//                foreach ($settings as $setting) {
//                    if ($setting['from'] == $user['login']) {
//                        $check = true;
//                        goto finish;
//                    }
//                }
            finish:
            if ($check) return $product; else return false;
        } else return false;
    }

    public function ProductsMove($post)
    {
        if (!empty($post['items'])) {
            $move = DB::update('products')
                ->set(array('id_storage' => $post['destination']))
                ->and_where_open();
            foreach ($post['items'] as $id) {
                Model_SkladProducts::ProductsHistory('Перемещен на другой склад',$id);
                $move->or_where('id', '=', $id);
            }
            $move->and_where_close()->execute();
        }
    }

    static function ProductsReturnCheck($sku)
    {
        $ses = Session::instance();
        $user = $ses->get('user', 0);
        $product = DB::select(
            array('products.id', 'id'),
            array('products.sku', 'sku'),
            array('models.name', 'name'),
            array('orders_products.price_out','money')
        )
            ->from('products')
            ->join('models')
            ->on('models.id', '=', 'products.id_models')
            ->join('orders_products')
            ->on('orders_products.id_products','=','products.id')
            ->where('products.sku', '=', $sku)
            ->where('products.out', '=', '1')
            ->limit(1)
            ->execute()
            ->as_array();

        if ($product[0]) {
        return $product[0];
        } else return false;
    }

    public function ProductsReturn($post)
    {
        if (!empty($post['items'])) {
            $move = DB::update('products')
                ->set(array(
                    'id_storage' => $post['destination'],
                    'out' => '0',
                    'date_out' => '0',
                    'returned' =>'1',
                ))
                ->and_where_open();
            foreach ($post['items'] as $id) {
                Model_SkladProducts::ProductsHistory('Возврат товара',$id);
                $move->or_where('id', '=', $id);
            }
            $move->and_where_close()->execute();
        }
    }

    static function ProductsHistory($message,$id_products)
    {
        $db = DB::select()
            ->from('products')
            ->where('id','=',$id_products)
            ->limit(1)
            ->execute()
            ->as_array();
        if(!empty($db[0])) {
            $product = $db[0];
            $old_values['products'] = $product;

            $db = DB::select()
                ->from('orders_products')
                ->where('id_products','=',$product['id'])
                ->limit(1)
                ->execute()
                ->as_array();
            if(!empty($db[0])){
                $old_values['orders_products'] = $db[0];
            }
            $data = array();
            $data['id_products'] = $product['id'];
            $data['sku_products'] = $product['id'];
            $data['message'] = $message;
            $data['old_values'] = json_encode($old_values);
            $data['date'] = DB::expr('NOW()');
            $ses = Session::instance();
            $user = $ses->get('user',false);
            $data['id_users'] = $user['id'];
            DB::insert('products_history', array_keys($data))
                ->values($data)
                ->execute();
        }
    }
}
