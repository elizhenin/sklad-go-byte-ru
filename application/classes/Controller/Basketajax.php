<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Basketajax extends Controller
{
    public function action_add()
    {
        if ($this->request->method() == Request::POST) {
            $basket = json_decode(Cookie::get('basket', '[]'),true);
            $BasketPOST = $this->request->post();
            foreach($BasketPOST as $key=>$value)
                $BasketPOST[$key] = htmlspecialchars(trim($value));

            if(!empty($BasketPOST['id'])) {
                $basket[$BasketPOST['id']] = $BasketPOST['id'];
                Cookie::set('basket', json_encode($basket));
                echo json_encode(array('result'=>'ok'));
            }else
                echo json_encode(array('result'=>'error'));

        }
    }
    public function action_del()
    {
        if ($this->request->method() == Request::POST) {
            $basket = json_decode(Cookie::get('basket', '[]'),true);
            $BasketPOST = $this->request->post();
            foreach($BasketPOST as $key=>$value)
                $BasketPOST[$key] = htmlspecialchars(trim($value));
            if(!empty($BasketPOST['id']) && (!empty($basket[$BasketPOST['id']]))) {
                unset ($basket[$BasketPOST['id']]);
                Cookie::set('basket', json_encode($basket));
                echo json_encode(array('result'=>'ok'));
            }else
                echo json_encode(array('result'=>'error'));

        }
    }

    public function action_preview()
    {
        if ($this->request->method() == Request::POST) {
            $basket = json_decode(Cookie::get('basket', '[]'),true);
            if(!empty($basket))
              $items = Model_Basket::ModelsCheckAvailAble($basket);
                $total = 0;
                $count = 0;
                $table = '';
                if(!empty($items))
                    foreach($items as $item) {
                        $total += $item['price'];
                        $count+=1;
                        $table.='<tr><td>'.$item['name'].'</td><td>'.$item['price'].' р.</td></tr>';
                    }
            if ($count=='0') $count = 'пуста';
            else  $count.=' шт';
            if ($total=='0') $total = 'бесплатно';
            else  $total.=' р.';
                echo json_encode(array('count'=>$count,'total'=>$total,'items'=>$table));


        }
    }

    public function action_edit()
    {
        if ($this->request->method() == Request::POST) {
            $basket = json_decode(Cookie::get('basket', '[]'),true);
            if(!empty($basket))
                $items = Model_Basket::ModelsCheckAvailAble($basket);
                $total = 0;
                $count = 0;
                $table = '';
                if(!empty($items))
                    foreach($items as $item) {
                        $total += $item['price'];
                        $count+=1;
                        $line = View::factory('basket_t_line');
                        $line->item = $item;
                        $table.=$line;
                    }
            if ($count=='0') $count = 'пуста';
            else  $count.=' шт';
            if ($total=='0') $total = 'бесплатно';
            else  $total.=' р.';
                echo json_encode(array('count'=>$count,'total'=>$total,'items'=>$table));


        }
    }
}