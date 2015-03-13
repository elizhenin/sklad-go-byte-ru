<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladUsers extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager


       public function NewStorage($post)
    {
        $post['name'] = trim(htmlspecialchars($post['name']));
        if(empty($post['present'])) $post['present'] = '0';
            else $post['present'] = '1';
        if(empty($post['transit'])) $post['transit'] = '0';
            else $post['transit'] = '1';

        DB::insert('storages', array('name', 'present', 'id_citys', 'transit'))
            ->values($post['name'], $post['present'], $post['id_citys'], $post['transit'])
            ->execute();
    }

    public function UpdateStorage($post)
    {
        $storage = $this->GetById($post['storage_id']);

        if ($storage) {
            $post['name'] = trim(htmlspecialchars($post['name']));
            if(empty($post['present'])) $post['present'] = '0';
            else $post['present'] = '1';
            if(empty($post['transit'])) $post['transit'] = '0';
            else $post['transit'] = '1';
            unset($post['storage_id']);

                DB::update('storages')
                    ->set($post)
                    ->where('id', '=', $storage['id'])
                    ->execute();
            }
        }


    public function GetById($id)
    {
        $select = DB::select(
        )
            ->from('storages')

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

    public function GetAll()
    {
        $select = DB::select(
        )
            ->from('storages')
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
        DB::update('storages')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

}