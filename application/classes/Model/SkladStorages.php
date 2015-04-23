<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladStorages extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager


    public function StoragesNew($post)
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

    public function StoragesUpdate($post)
    {
        $storage = $this->StoragesGetById($post['storage_id']);

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


    public function StoragesGetById($id)
    {
        $select = DB::select()
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

    public function StoragesGetAll()
    {
        $select = DB::select(
            array('storages.id', 'id'),
            array('storages.name', 'name'),
            array('storages.present', 'present'),
            array('citys.name', 'city'),
            array('storages.arrive', 'arrive'),
            array('storages.transit', 'transit'),
            array('storages.deleted', 'deleted')
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

    public function StoragesGetVisible()
    {
        $select = DB::select(
            array('storages.id', 'id'),
            array('storages.name', 'name'),
            array('storages.present', 'present'),
            array('citys.name', 'city'),
            array('storages.arrive', 'arrive'),
            array('storages.transit', 'transit')
        )
            ->from('storages')
            ->join('citys')
            ->on('citys.id', '=', 'storages.id_citys')
            ->where('storages.deleted', '=', '0')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function StoragesGetAllowed()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if ($user['rights'] != 'sale') {
            $select = DB::select(
                array('storages.id', 'id'),
                array('storages.name', 'name')
            )
                ->from('storages')
                ->where('storages.deleted', '=', '0')
                ->execute()
                ->as_array();
        } else {
            $select = DB::select
            (
                array('storages.id', 'id'),
                array('storages.name', 'name')
            )
                ->from('storages')
                ->join(array('storages_settings', 'rules'))
                ->on('rules.to', '=', 'storages.id')
                ->where('storages.id_citys', '=', $user['id_citys'])
                ->or_where('rules.id_citys', '=', $user['id_citys'])
                ->execute()
                ->as_array();
        }

        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function StoragesSetDeletedById($id, $deleted)
    {
        DB::update('storages')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    public function StoragesGetCitys()
    {
        $select = DB::select(
            array('id', 'id'),
            array('name', 'name')
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

    public function StoragesRulesNew($post)
    {
        DB::insert('storages_settings', array('from', 'to', 'id_citys'))
            ->values(array($post['from'], $post['to'], $post['id_citys']))
            ->execute();
    }

    public function StoragesRulesUpdate($post)
    {
        $id = $post['id'];
        unset($post['id']);
        unset($post['operation']);
        DB::update('storages_settings')
            ->set($post)
            ->where('id', '=', $id)
            ->execute();
    }

    public function StoragesRulesGetById($id)
    {
        $select = DB::select()
            ->from('storages_settings')
            ->where('storages_settings.id', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function StoragesRulesGetAll()
    {
        $select = DB::select(
            array('storages_settings.id', 'id'),
            array('from.name', 'from'),
            array('to.name', 'to'),
            array('storages_settings.deleted', 'deleted'),
            array('citys.name', 'city')
        )
            ->from('storages_settings')
            ->join('citys')
            ->on('citys.id', '=', 'storages_settings.id_citys')
            ->join(array('storages', 'from'))
            ->on('from.id', '=', 'storages_settings.from')
            ->join(array('storages', 'to'))
            ->on('to.id', '=', 'storages_settings.to')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function StoragesRulesGetVisible()
    {
        $select = DB::select(
            array('storages_settings.id', 'id'),
            array('from.name', 'from'),
            array('to.name', 'to'),
            array('storages_settings.deleted', 'deleted'),
            array('citys.name', 'city')
        )
            ->from('storages_settings')
            ->join('citys')
            ->on('citys.id', '=', 'storages_settings.id_citys')
            ->join(array('storages', 'from'))
            ->on('from.id', '=', 'storages_settings.from')
            ->join(array('storages', 'to'))
            ->on('to.id', '=', 'storages_settings.to')
            ->where('storages_settings.deleted', '=', '0')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function StoragesRulesSetDeletedById($id, $deleted)
    {
        DB::update('storages_settings')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }

    public function StorageExport($storage_id)
    {
        $products = DB::select(
            array('products.sku', 'sku'),
            array('models.name', 'name'),
            array('models.in_price', 'in_price'),
            array('models.price', 'price')
        )
            ->from('products')
            ->join('models')
            ->on('models.id', '=', 'products.id_models')
            ->where('products.out', '=', '0')
            ->where('products.id_storage','=',$storage_id)
            ->order_by('models.id_categorys')
            ->order_by('models.name')
            ->order_by('products.sku')
            ->execute()
            ->as_array();
        $result = 'Код; Название; Мин.цена; Цена'. "\n";
        if (!empty($products))
            foreach ($products as $product)
                $result .= $product['sku'] . '; ' . $product['name'] . '; ' . $product['in_price'] . '; ' . $product['price'] . ';' . "\n";
        return $result;
    }
}