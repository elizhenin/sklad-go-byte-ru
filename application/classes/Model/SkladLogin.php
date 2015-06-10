<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladLogin extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager



    public function checkUser($id, $password)
    {
        $id = htmlspecialchars(trim($id));
        $password = md5(trim($password));
        $select = DB::select(
            array('users.id', 'id'),
            array('citys.alias','login'),
            array('citys.id','id_citys'),
            array('users.rights','rights')
        )
            ->from('users')
            ->join('citys')
            ->on('users.id_citys','=','citys.id')
            ->where('users.id', '=', $id)
            ->and_where('users.password', '=', $password)
            ->and_where('users.deleted','=','0')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function GetActive()
    {
        $select = DB::select(
            array('users.id', 'id'),
            array('citys.alias', 'login'),
            array('citys.name', 'name')
        )
            ->from('citys')
            ->join('users')
            ->on('citys.id', '=', 'users.id_citys')
            ->where('users.deleted','=','0')
            ->order_by('citys.name')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

   public function UpdateLogin($id)
   {
       DB::update('users')
            ->set(array(
                    'lastenter' => DB::expr('NOW()'),
                    'lastip' => Request::$client_ip
                )
            )
            ->where('id', '=', $id)
            ->execute();
   }

}
