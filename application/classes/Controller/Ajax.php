<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{

    function before()
    {
        $ses = Session::instance();
        $auth = $ses->get('user', 0);
        if ($auth == 0) {
            die('No unautorized ajax access.');
        }

    }

    public function action_imageUpload()
    {
        if (isset($_FILES['file'])) {
            if (!empty($_FILES['file']['name'])) {
                $ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
                $filename = time();
                substr(strrchr(Upload::save($_FILES['file'], $filename . '.' . $ext, 'images/uploads/'), DIRECTORY_SEPARATOR), 1);
                $array = array('filelink' => '/images/uploads/' . $filename . '.' . $ext);
                echo stripslashes(json_encode($array));
            }
        }
    }

    public function action_checkProduct()
    {
        $ses = Session::instance();
        $user = $ses->get('user', 0);

        $product = DB::select(
            array('models.name', 'name'),
            array('models.price', 'price'),
            array('models.in_price', 'in_price'),
            array('products.id', 'id')
        )
            ->from('products')
            ->join('models')
            ->on('models.id', '=', 'products.id_models')
            ->join('storages')
            ->on('storages.id', '=', 'products.id_storage')
            ->join('citys')
            ->on('citys.id', '=', 'storages.id_citys')
            ->where('products.sku', '=', trim(htmlspecialchars(($this->request->post('sku')))))
            ->where('products.out', '=', '0')
            ->where('citys.alias', '=', $user['login'])
            ->limit(1)
            ->execute()
            ->as_array();
        if ($product)
            echo json_encode($product[0]);
    }
}