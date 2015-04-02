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
        $product = Model_SkladOrders::OrdersProductsCheck(trim(htmlspecialchars($this->request->post('sku'))));
        if ($product)
            echo json_encode($product);
    }
}