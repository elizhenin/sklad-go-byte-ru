<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Basket extends Controller_Tmp
{
    private function OrdersAdd($phone, $text)
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
        $data['text'] = $text;
        $order = DB::insert('orders', array_keys($data))
            ->values($data)
            ->execute();
        return $order[0];
    }

    private function ProductsToOrder($orders_id, $models_ids)
    {
        $products = Model_Basket::ModelsAssignProducts($models_ids);
        $products_ids = array();
        foreach ($products as $one)
            $products_ids[] = $one['id'];

        DB::update('products')
            ->set(array('out' => '1', 'date_out' => DB::expr('NOW()')))
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
            $post = $this->request->post();
            foreach ($post as $key => $value) $post[$key] = htmlspecialchars(trim($value));
            $check = true;$feedback_message='Заказ успешно оформлен';
            if (empty($post['client_email'])) {
                $check = false;
                $feedback_message = 'Введите email';
            }
            if (empty($post['client_phone'])) {
                $check = false;
                $feedback_message = 'Заполните номер телефона';
            }
            if (empty($post['client_address']) && $post['deliv_id'] == '2') {
                $check = false;
                $feedback_message = 'А куда везти-то?';
            }
            if ($check) {
                $basket = json_decode(Cookie::get('basket', '[]'), true);
                if (!empty($basket))
                    $items = Model_Basket::ModelsCheckAvailAble($basket);
                if (!empty($items)) {
                    $phone = $post['client_phone'];
                    if ($post['deliv_id'] == '2')
                        $text = 'С доставкой по адресу: ' . $post['client_address'] . "\n";
                    else $text = 'Самовывоз' . "\n";
                    if (!empty($post['client_name'])) {
                    $text .= 'Имя: ' . $post['client_name'] . "\n";
                    $text .= 'Почта: ' . $post['client_email'] . "\n";
                    if (!empty($post['client_comments'])) {
                        $text .= 'Комментарий клиента:' . "\n";
                        $text .= $post['client_comments'];
                    }
                    $order = $this->OrdersAdd($phone, $text);
                    $this->ProductsToOrder($order, $basket);
                    Cookie::set('basket', '[]');
                        $feedback_message = 'Ваш заказ оформлен';
                } else $feedback_message = 'Сожалеем, но выбранного товара больше нет. Кто-то успел раньше Вас :(';

            }
                    $page->message = $feedback_message;
        }
        $this->page = $page;
    }
}