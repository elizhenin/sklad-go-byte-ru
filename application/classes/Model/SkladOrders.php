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

        $ses = Session::instance();
        $user = $ses->get('user', false);
        if (!empty($post['complete'])) {
            unset($post['complete']);
            $this->OrdersSetCompleteById($post['id'], '1');
        }
        else {
            if ($user['rights'] == 'superuser') $post['complete'] = '0';
        }
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
        $id = $post['id'];
        unset($post['id']);
        DB::update('orders')
            ->set($post)
            ->where('id', '=', $id)
            ->execute();
    }

    public function OrdersGetAll()
    {
        $select = DB::select()
            ->from('orders')
            ->order_by('created', 'DESC');

        $ses = Session::instance();
        $user = $ses->get('user', false);
        if ($user['rights'] == 'sale')
            $select->where('orders.id_users', '=', $user['id']);
        $select = $select
            ->where('deleted', '=', '0')
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
            ->where('deleted', '=', '0')
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
            ->where('deleted', '=', '0')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            $total_products = 0;
            $total_cash = 0;
            foreach ($select as $key => $item) {
                $select[$key]['products'] =
                    DB::select(
                        array('products.sku', 'sku'),
                        array('models.name', 'name'),
                        array('orders_products.price_out', 'price_out')
                    )
                        ->from('products')
                        ->join('orders_products')
                        ->on('orders_products.id_products', '=', 'products.id')
                        ->join('models')
                        ->on('products.id_models', '=', 'models.id')
                        ->where('orders_products.id_orders', '=', $item['id'])
                        ->execute()
                        ->as_array();
                if (!empty($select[$key]['products']) && $item['complete'])
                    foreach ($select[$key]['products'] as $product) {
                        $total_products++;
                        $total_cash += $product['price_out'];
                    }
            }
            $select['total_cash'] = $total_cash;
            $select['total_products'] = $total_products;
            return $select;
        } else {
            return false;
        }
    }

    public function OrdersSetCompleteById($id, $status)
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if ($user['rights'] != 'super' && $status == 0) {
        } else {
            DB::update('orders')
                ->set(array('complete' => $status))
                ->where('id', '=', $id)
                ->execute();

            $products = DB::select(
                array('orders_products.id_products', 'id'),
                array('products.id_models', 'id_models')
            )
                ->from('orders_products')
                ->join('products')
                ->on('products.id', '=', 'orders_products.id_products')
                ->where('orders_products.id_orders', '=', $id)
                ->execute()
                ->as_array();
            $models = array();
            switch ($status) {
                case '1':
                    if (!empty($products))
                        foreach ($products as $product) {
                            Model_SkladProducts::ProductsHistory('Проведен ордер', $product['id']);
                            $models[] = $product['id_models'];
                    }
                    Model_SkladModels::ModelsCountInc($models);
                    break;
                case '0':
                    if (!empty($products))
                        foreach ($products as $product)
                            Model_SkladProducts::ProductsHistory('Отменен ордер', $product['id']);
                    break;
            }
        }
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
        if (!empty($check[0])) {
            if ($product['price_out'] < $check[0]['in_price'])
                $product['price_out'] = $check[0]['in_price'];

            DB::insert('orders_products', array_keys($product))
                ->values($product)
                ->execute();
            Model_SkladProducts::ProductsHistory('Поставлен в резерв ордер id#' . $product['id_orders'], $product['id_products']);
            DB::update('products')
                ->set(array('out' => '1', 'date_out' => DB::expr('NOW()')))
                ->where('id', '=', $product['id_products'])
                ->execute();
        }

    }

    public function OrdersProductsRelease($id_users)
    {
        $orders = DB::select(
            array('orders.id', 'id')
        )
            ->from('orders');
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if ($user['rights'] == 'sale')
            $orders->where('orders.id_users', '=', $id_users);
        $orders = $orders
            ->where('orders.complete', '=', '0')
            ->execute()
            ->as_array();
        if ($orders)
            foreach ($orders as $one) {
                $products = DB::select(
                    array('orders_products.id_products', 'id')
                )
                    ->from('orders_products')
                    ->where('id_orders', '=', $one['id'])
                    ->execute()
                    ->as_array();
                foreach ($products as $product) {
                    Model_SkladProducts::ProductsHistory('Освобожден из резерва', $product['id']);
                    DB::update('products')
                        ->set(array('out' => '0', 'date_out' => ''))
                        ->where('id', '=', $product['id'])
                        ->execute();
                }
                DB::delete('orders_products')
                    ->where('id_orders', '=', $one['id'])
                    ->execute();
                $this->OrdersDeleteById($one['id']);

            }

    }

    static function OrdersProductsCheck($sku)
    {
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
            ->where('products.deleted', '=', '0')
            ->where('citys.alias', '=', $user['login'])
            ->limit(1)
            ->execute()
            ->as_array();
        if ($product) return $product[0];
    }

    public function OrdersProductsRemove($post)
    {
        Model_SkladProducts::ProductsHistory('Удален из ордера', $post['product']);
        DB::update('products')
            ->set(array('out' => '0', 'date_out' => ''))
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
            array('orders_products.moneyback', 'moneyback'),
            array('orders_products.returned', 'returned'),
            array('products.sku', 'sku'),
            array('models.in_price', 'in_price'),
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
                if (($product['moneyback'] + $product['returned']) == '0')
                    $cash += $product['price_out'];
            }
            $products['cash'] = $cash;

            return $products;
        } else return false;
    }

    public function OrdersProductsAlterPrice($post)
    {
        Model_SkladProducts::ProductsHistory('Изменение цены в ордере', $post['product']);
        $model = DB::select('models.in_price')
            ->from('models')
            ->join('products')
            ->on('products.id_models', '=', 'models.id')
            ->where('products.id', '=', $post['product'])
            ->execute()
            ->as_array();
        if (!empty($model)) {
            $model = $model[0]['in_price'];
            if ($model <= $post['price_out'])
                DB::update('orders_products')
                    ->set(array('price_out' => $post['price_out']))
                    ->where('id', '=', $post['id'])
                    ->execute();
        }
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
        if ($user['rights'] == 'sale')
            $select->where('orders.id_users', '=', $user['id']);
        $select = $select
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    static function OrdersStatus()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        $result = '';
        $orders = DB::select(
            array('orders_products.price_out', 'price')
        )
            ->from('orders_products')
            ->join('orders')
            ->on('orders.id', '=', 'orders_products.id_orders')
            ->join('products')
            ->on('products.id', '=', 'orders_products.id_products')
            ->where('orders.id_users', '=', $user['id'])
            ->where('orders.deleted', '=', '0')
            ->where('orders.complete', '=', '1')
            ->where('orders_products.moneyback', '=', '0')
            ->where('products.date_out', '>', DB::expr("MAKEDATE(YEAR(NOW()), DAYOFYEAR(NOW()))"))
            ->execute()
            ->as_array();
        $count = 0;
        $money = 0;
        if (!empty($orders))
            foreach ($orders as $one) {
                $count++;
                $money = $money + $one['price'];
            }
        $result = 'Продано за сегодня: ' . $count . ' товаров на сумму ' . $money . ' рублей';
        return $result;
    }

    public function OrdersDeleteById($id)
    {
        $id = htmlspecialchars(trim($id));
        DB::update('orders')
            ->set(array('deleted' => '1'))
            ->where('id', '=', $id)
            ->execute();
    }
}
