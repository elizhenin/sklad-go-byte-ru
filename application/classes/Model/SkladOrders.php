<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladOrders extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager


    public function OrdersAdd($post)
    {

        $client['phone'] = trim(htmlspecialchars($post['phone']));
        if (empty($post['confirm']))
            $client['confirm'] = '0';
        else
            $client['confirm'] = '1';
        $check = DB::select()
            ->from('clients')
            ->where('phone', '=', $client['phone'])
            ->execute()
            ->as_array();
        if (empty($check)) {
            $check = DB::insert('clients', array_keys($client))
                ->values($client)
                ->execute();
            $check = $check[0];
        } else {
            $check = $check[0]['id'];
        }
        if ($post['id_sessions'] == '0')
            $post['id_sessions'] = $this->SessionsAdd($post['text'],$check);
        else {
            DB::update('sessions')
                ->set(
                    array('text'=>trim(htmlspecialchars($post['text'])),
                        'modificated' =>DB::expr('NOW()'),
                        'id_clients'=>$check
                    ))
                ->where('id','=', $post['id_sessions'])
                ->execute();
        }
        $ses = Session::instance();
        $user = $ses->get('user', false);

        $order['date'] = DB::expr('NOW()');
        $order['id_users'] = $user['id'];

        $order = DB::insert('orders', array_keys($order))
            ->values($order)
            ->execute();

        DB::insert('orders_session', array('id_sessions', 'id_orders'))
            ->values(array($post['id_sessions'], $order[0]))
            ->execute();
    }

    public function OrdersGetAll()
    {
        $select = DB::select(
            array('orders.id','id'),
            array('orders.date','date'),
            array('sessions.id','id_sessions'),
            array('orders.complete','complete'),
            array('sessions.created','created'),
            array('sessions.text','text'),
            array('clients.phone','phone')

        )
            ->from('orders_session')
            ->join('sessions')
            ->on('sessions.id','=','orders_session.id_sessions')
            ->join('orders')
            ->on('orders.id','=','orders_session.id_orders')
            ->join('clients')
            ->on('clients.id','=','sessions.id_clients')
            ->order_by('sessions.created','DESC')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function SessionsAdd($text='',$id_clients)
    {
        $post['created'] = DB::expr('NOW()');
        $post['modificated'] = DB::expr('NOW()');
        $post['text'] = trim(htmlspecialchars($text));
        $post['id_clients'] = trim(htmlspecialchars($id_clients));
        $result = DB::insert('sessions', array_keys($post))
            ->values($post)
            ->execute();

        return $result[0];

    }


    public function SessionsGetAll()
    {
        $select = DB::select()
            ->from('sessions')
            ->order_by('created', 'DESC')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

}
