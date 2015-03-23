<?php defined('SYSPATH') or die('No direct script access.');

class Model_SkladProducts extends Model
{
//    Users rights:
//super = superuser;
//content = content manager
//sale = sale manager

//products

    public function ProductsAdd($post)
    {
        $post['id_models'] = trim(htmlspecialchars($post['id_models']));
        $post['sku'] = trim(htmlspecialchars($post['sku']));
        $post['comments'] = trim(htmlspecialchars($post['comments']));
        $post['id_storage'] = trim(htmlspecialchars($post['id_storage']));
        $post['sku'] = trim(htmlspecialchars($post['sku']));
        $post['out'] = '0';
        $post['date_out'] = '0';
        $post['deleted'] = '0';
        unset($post['operation']);
        DB::insert('products', array_keys($post))
            ->values($post)
            ->execute();

    }

    public function ProductsUpdate($post)
    {
        $product = $this->ProductsGetById($post['id']);

        if ($product) {
            $post['id_models'] = trim(htmlspecialchars($post['id_models']));
            $post['sku'] = trim(htmlspecialchars($post['sku']));
            $post['comments'] = trim(htmlspecialchars($post['comments']));
            $post['id_storage'] = trim(htmlspecialchars($post['id_storage']));
            $post['sku'] = trim(htmlspecialchars($post['sku']));
            if(!empty($post['out'])) $post['out']='1';else $post['out'] = '0';
            $post['out'] = trim(htmlspecialchars($post['out']));
            //$post['date_out'] = trim(htmlspecialchars($post['date_out']));

            unset($post['id']);
            unset($post['operation']);

            DB::update('products')
                ->set($post)
                ->where('id', '=', $product['id'])
                ->execute();

        }
    }


    public function ProductsGetById($id)
    {
        $select = DB::select()
            ->from('products')
            ->where('products.id', '=', $id)
            ->limit(1)
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select[0];
        } else {
            return false;
        }
    }

    public function ProductsGetAll()
    {
        $select = DB::select()
            ->from('products')
            ->execute()
            ->as_array();
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ProductsGetByModel($model)
    {
        if (empty($model)) {
            $select = $this->ProductsGetAll();
        } else {
            $select = DB::select(

            )
                ->from('products')

                ->where('products.id_models', '=', $model)

                ->execute()
                ->as_array();
        }
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ProductsGetByStorage($storage)
    {
        if (empty($storage)) {
            $select = $this->ProductsGetAll();
        } else {
            $select = DB::select(

            )
                ->from('products')

                ->where('products.id_storage', '=', $storage)

                ->execute()
                ->as_array();
        }
        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    public function ProductsSetDeletedById($id, $deleted)
    {
        DB::update('products')
            ->set(array('deleted' => $deleted))
            ->where('id', '=', $id)
            ->execute();
    }
}
