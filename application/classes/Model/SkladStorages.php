<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladStorages extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager


    public function NewStorage($post)
    {
        $post['name'] = trim(htmlspecialchars($post['name']));
        if (empty($post['present'])) $post['present'] = '0';
        else $post['present'] = '1';
        if (empty($post['transit'])) $post['transit'] = '0';
        else $post['transit'] = '1';

        DB::insert('storages', array('name', 'present', 'id_citys', 'transit'))
            ->values(array($post['name'], $post['present'], $post['id_citys'], $post['transit']))
            ->execute();
    }

    public function UpdateStorage($post)
    {
        $storage = $this->GetById($post['storage_id']);

        if ($storage) {
            $post['name'] = trim(htmlspecialchars($post['name']));
            if (empty($post['present'])) $post['present'] = '0';
            else $post['present'] = '1';
            if (empty($post['transit'])) $post['transit'] = '0';
            else $post['transit'] = '1';
            unset($post['storage_id']);
            unset($post['operation']);
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
            ->where('storages.id', '=', $id)
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
            array('storages.id','id'),
            array('storages.name','name'),
            array('storages.present','present'),
            array('citys.name','city'),
            array('storages.arrive','arrive'),
            array('storages.transit','transit'),
            array('storages.deleted','deleted')
        )
            ->from('storages')
            ->join('citys')
            ->on('citys.id', '=', 'storages.id_citys')
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

    public function GetCitys()
    {
        $select = DB::select(
            array('id','id'),
            array('name','name')
        )
            ->from('citys')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }
}