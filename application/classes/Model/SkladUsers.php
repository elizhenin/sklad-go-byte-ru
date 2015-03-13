<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladUsers extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager


    public function toUrl($str)
    {
        $tr = array(
            "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "zh",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "-"
        );

        if (!preg_match('//u', $str)) {
            $str = iconv('cp1251', 'UTF-8', $str);
        }

        $str = mb_strtolower($str, 'utf-8');
        $str = trim($str);
        $urlstr = strtr($str, $tr);
        $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
        $urlstr = preg_replace('/\-+/', '-', $urlstr);
        return $urlstr;
    }


    public function NewUser($post)
    {
        $post['name'] = trim(htmlspecialchars($post['name']));
        if (empty($post['alias'])) {
            $post['alias'] = $this->toUrl($post['name']);
        } else {
            $post['alias'] = trim(htmlspecialchars($post['alias']));
        }

        $citys_id = DB::insert('citys', array('name', 'alias'))
            ->values(array($post['name'], $post['alias']))
            ->execute();

        DB::insert('users', array('id_citys', 'password', 'rights'))
            ->values(array($citys_id[0], md5(trim(htmlspecialchars($post['password']))), $post['rights']))
            ->execute();
    }

    public function UpdateUser($post)
    {
        $user = $this->GetById($post['users_id']);
        $post['name'] = trim(htmlspecialchars($post['name']));
        if (empty($post['alias'])) {
            $post['alias'] = $this->toUrl($post['name']);
        } else {
            $post['alias'] = trim(htmlspecialchars($post['alias']));
        }
        $post['rights'] = trim(htmlspecialchars($post['rights']));
        if ($user) {
            DB::update('citys')
                ->set(array(
                        'name' => $post['name'],
                        'alias' => $post['alias']
                    )
                )
                ->where('alias', '=', $user['login'])
                ->execute();

            if (empty($post['password'])) {
                DB::update('users')
                    ->set(array(
                            'rights' => $post['rights']
                        )
                    )
                    ->where('id', '=', $user['id'])
                    ->execute();
            } else {
                DB::update('users')
                    ->set(array(
                            'password' => md5(trim(htmlspecialchars($post['password']))),
                            'rights' => $post['rights']
                        )
                    )
                    ->where('id', '=', $user['id'])
                    ->execute();
            }
        }
    }


    public function GetByAlias($alias)
    {
        $select = DB::select(
            array('users.id', 'id'),
            array('citys.alias', 'login'),
            array('users.rights', 'rights'),
            array('citys.name', 'name'),
            array('users.lastenter', 'lastenter'),
            array('users.lastip', 'lastip'),
            array('users.deleted', 'deleted')
        )
            ->from('citys')
            ->join('users')
            ->on('citys.id', '=', 'users.id_citys')
            ->where('citys.alias', '=', $alias)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function GetById($id)
    {
        $select = DB::select(
            array('users.id', 'id'),
            array('citys.alias', 'login'),
            array('users.rights', 'rights'),
            array('citys.name', 'name'),
            array('users.lastenter', 'lastenter'),
            array('users.lastip', 'lastip'),
            array('users.deleted', 'deleted')
        )
            ->from('citys')
            ->join('users')
            ->on('citys.id', '=', 'users.id_citys')
            ->where('users.id', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function GetAll()
    {
        $select = DB::select(
            array('users.id', 'id'),
            array('citys.alias', 'login'),
            array('users.rights', 'rights'),
            array('citys.name', 'name'),
            array('users.lastenter', 'lastenter'),
            array('users.lastip', 'lastip'),
            array('users.deleted', 'deleted')
        )
            ->from('citys')
            ->join('users')
            ->on('citys.id', '=', 'users.id_citys')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function SetDeletedById($id, $deleted)
    {
        DB::update('users')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

}