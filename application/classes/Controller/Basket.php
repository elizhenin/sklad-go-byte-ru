<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Basket extends Controller_Tmp
{
    private function OrdersAdd($phone)
    {
        $user = DB::select()
            ->from('users')
            ->where('id_citys', '=', $this->city['id'])
            ->limit(1)
            ->execute()
            ->as_array();

        $data['id_users'] = $user[0]['id'];
        $data['session'] = 'site_' . $this->city['alias'] . '_' . time() . Text::random(null, '1');
        $data['created'] = DB::expr('NOW()');
        $data['date'] = DB::expr('NOW()');
        $data['phone'] = $phone;
        $data['modificated'] = $data['date'];
        $data['text'] = 'Заказ с интернет-магазина';
        $order = DB::insert('orders', array_keys($data))
            ->values($data)
            ->execute();
        return $order[0];
    }

    private function ProductsToOrder($orders_id, $models_ids)
    {
        $products = Model_Basket::ModelsAssignProducts($models_ids);
        $products_ids = [];
        foreach ($products as $one)
            $products_ids[] = $one['id'];

        DB::update('products')
            ->set(
                array('out' => '1'),
                array('date_out' => DB::expr('NOW()'))
            )
            ->where('id', 'IN', $products_ids)
            ->execute();

        foreach ($products as $one) {
            $product['id_orders'] = $orders_id;
            $product['id_products'] = $one['id'];
            $product['price_out'] = $one['price'];

            DB::insert('orders_products', array_keys($product))
                ->values($product)
                ->execute();
            Model_SkladProducts::ProductsHistory('[site]Поставлен в резерв ордер id#' . $product['id_orders'], $product['id_products']);
        }
    }

    public function action_index()
    {
        $page = view::factory('basket');
        if ($this->request->method() == Request::POST) {
            $phone = htmlspecialchars(trim($this->request->post('phone')));
            if ($phone) {
                $basket = json_decode(Cookie::get('basket', '[]'), true);
                if (!empty($basket))
                    $items = Model_Basket::ModelsCheckAvailAble($basket);
                if (!empty($items)) {
                    $order = $this->OrdersAdd($phone);
                    $this->ProductsToOrder($order, $basket);
                    Cookie::set('basket', '[]');
                    $page->message = 'Ваш заказ оформлен';
                }else $page->message = 'Сожалеем, но выбранного товара больше нет. Кто-то успел раньше Вас :(';

            } else $page->message = 'Заполните номер телефона';
        }
        $this->page = $page;
    }


}
