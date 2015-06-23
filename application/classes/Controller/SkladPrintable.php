<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SkladPrintable extends Controller
{
    private $user;

    public function before()
    {
        parent::before();

        $ses = Session::instance();
        if (!$ses->get('user', false) && $this->request->action() != 'login') {
            HTTP::redirect('/sklad/login');
        } else $this->user = $ses->get('user', false);
    }

    private function content($content)
    {
        $page = View::factory('printable');
        $page->body = $content;
        $this->response->body($page);
    }

    public function action_index()
    {
    }

    public function action_order()
    {
        if ($this->request->method() == Request::POST) {
            $OrdersPOST = $this->request->post();
            $ModelOrders = New Model_SkladOrders();
            $content = View::factory('sklad/printable/order');
            $content->item = $ModelOrders->OrdersGetById($OrdersPOST['orders_id']);
            $content->products = $ModelOrders->OrdersProductsGetAll($OrdersPOST['orders_id']);

            $this->content($content);
        }else HTTP::redirect($this->request->referrer());
    }
}