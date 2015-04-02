<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladLogin extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager



    public function checkUser($login, $password)
    {
        $login = htmlspecialchars(trim($login));
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
            ->where('citys.alias', '=', $login)
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
