<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladOrders extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager


    public function OrdersAdd($post)
    {

        $post['phone'] = trim(htmlspecialchars($post['phone']));
        if (empty($post['confirm']))
            $post['confirm'] = '0';
        else
            $post['confirm'] = '1';

        $ses = Session::instance();
        $user = $ses->get('user', false);

        if ($post['session'] == '0') {
            $post['session'] = $user['login'] . time() . Text::random(null, '1');
            $post['created'] = DB::expr('NOW()');
        } else {
            $check = $this->OrdersGetBySession($post['session']);
            $post['created'] = $check[0]['created'];
        }

        $post['date'] = DB::expr('NOW()');
        $post['id_users'] = $user['id'];

        $post['modificated'] = DB::expr('NOW()');
        $post['text'] = trim(htmlspecialchars($post['text']));

        unset($post['operation']);
        unset($post['id']);
        $order = DB::insert('orders', array_keys($post))
            ->values($post)
            ->execute();
        return $order[0];

    }

    public function OrdersUpdate($post)
    {

        $post['phone'] = trim(htmlspecialchars($post['phone']));
        if (empty($post['confirm']))
            $post['confirm'] = '0';
        else
            $post['confirm'] = '1';

        $ses = Session::instance();
        $user = $ses->get('user', false);

        if ($post['session'] == '0') {
            $post['session'] = $user['login'] . time() . Text::random(null, '1');
            $post['created'] = DB::expr('NOW()');
        } else {
            $check = $this->OrdersGetBySession($post['session']);
            $post['created'] = $check[0]['created'];
        }

        $post['id_users'] = $user['id'];

        $post['modificated'] = DB::expr('NOW()');
        $post['text'] = trim(htmlspecialchars($post['text']));

        unset($post['operation']);
        $id=$post['id'];
        unset($post['id']);
        DB::update('orders')
            ->set($post)
            ->where('id','=',$id)
            ->execute();
    }

    public function OrdersGetAll()
    {
        $select = DB::select()
            ->from('orders')
            ->order_by('created', 'DESC');

        $ses = Session::instance();
        $user = $ses->get('user', false);
        if($user['rights']=='sale')
            $select->where('orders.id_users','=',$user['id']);
        $select = $select
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function OrdersGetById($id)
    {
        $select = DB::select()
            ->from('orders')
            ->where('id', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function OrdersGetBySession($session)
    {
        $select = DB::select()
            ->from('orders')
            ->where('session', '=', $session)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function OrdersSetCompleteById($id, $deleted)
    {
        DB::update('orders')
            ->set(array('complete' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    public function OrdersProductsAdd($post)
    {
        $product['id_orders'] = trim(htmlspecialchars($post['id_orders']));
        $product['id_products'] = trim(htmlspecialchars($post['id_products']));
        $product['price_out'] = trim(htmlspecialchars($post['price_out']));

        $check = DB::select(
            array('models.in_price', 'in_price')
        )
            ->from('products')
            ->join('models')
            ->on('models.id', '=', 'products.id_models')
            ->where('products.id', '=', $product['id_products'])
            ->limit(1)
            ->execute()
            ->as_array();
        if ($product['price_out']<$check[0]['in_price'])
            $product['price_out'] = $check[0]['in_price'];

        DB::insert('orders_products', array_keys($product))
            ->values($product)
            ->execute();
        DB::update('products')
            ->set(array('out' => '1', 'date_out' => DB::expr('NOW()')))
            ->where('id', '=', $product['id_products'])
            ->execute();

    }

    public function OrdersProductsRelease($id_users)
    {
        $orders = DB::select(
            array('orders.id','id')
        )
            ->from('orders')
            ->where('orders.id_users','=',$id_users)
            ->where('orders.complete','=','0')
            ->execute()
            ->as_array();
        if($orders)
            foreach($orders as $one)
            {
                $products = DB::select(
                    array('orders_products.id_products','id')
                )
                    ->from('orders_products')
                    ->where('id_orders','=',$one['id'])
                    ->execute()
                    ->as_array();
                DB::delete('orders_products')
                    ->where('id_orders','=',$one['id'])
                    ->execute();
                foreach($products as $product)
                {
                    DB::update('products')
                        ->set(array('out' => '0','date_out'=>''))
                        ->where('id', '=', $product['id'])
                        ->execute();
                }
            }

    }

    static function OrdersProductsCheck($sku){
        $ses = Session::instance();
        $user = $ses->get('user', 0);
        $product = DB::select(
            array('models.name', 'name'),
            array('models.price', 'price'),
            array('models.in_price', 'in_price'),
            array('products.id', 'id'),
            array('products.sku', 'sku')
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
            ->where('citys.alias', '=', $user['login'])
            ->limit(1)
            ->execute()
            ->as_array();
        if($product) return $product[0];
    }

    public function OrdersProductsRemove($post)
    {
        DB::update('products')
            ->set(array('out' => '0'))
            ->where('id', '=', $post['product'])
            ->execute();
        DB::delete('orders_products')
            ->where('id', '=', $post['id'])
            ->execute();
    }

    public function OrdersProductsGetAll($id)
    {
        $products = DB::select(
            array('orders_products.id', 'id'),
            array('orders_products.id_products', 'id_products'),
            array('orders_products.price_out', 'price_out'),
            array('products.sku', 'sku'),
            array('models.name', 'name')
        )
            ->from('orders_products')
            ->join('products')
            ->on('products.id', '=', 'orders_products.id_products')
            ->join('models')
            ->on('models.id', '=', 'products.id_models')
            ->where('orders_products.id_orders', '=', $id)
            ->execute()
            ->as_array();
        if ($products) {
            $products['products'] = $products;
            $cash = 0;
            foreach ($products['products'] as $product) {
                $cash += $product['price_out'];
            }
            $products['cash'] = $cash;

            return $products;
        } else return false;
    }

    public function SessionsGetAll()
    {
        $select = DB::select(
            array('orders.session', 'id'),
            array('orders.created', 'created')
        )
            ->from('orders')
            ->order_by('created', 'DESC')
            ->group_by('session');

        $ses = Session::instance();
        $user = $ses->get('user', false);
        if($user['rights']=='sale')
            $select->where('orders.id_users','=',$user['id']);
        $select = $select
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

}
