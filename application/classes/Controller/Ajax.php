<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{

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

    public function action_checkModel()
    {
        $product = Model_SkladModels::ProductsModelsCheck(trim(htmlspecialchars($this->request->post('sku'))));
        if ($product)
            echo json_encode($product);
    }

    public function action_checkProduct()
    {
        $product = Model_SkladOrders::OrdersProductsCheck(trim(htmlspecialchars($this->request->post('sku'))));
        if ($product)
            echo json_encode($product);
    }

    public function action_addMoveProduct()
    {
        $product = Model_SkladProducts::ProductsMoveCheck(trim(htmlspecialchars($this->request->post('sku'))));
        if ($product)
            echo json_encode($product);
    }

    public function action_addReturnProduct()
    {
        $product = Model_SkladProducts::ProductsReturnCheck(trim(htmlspecialchars($this->request->post('sku'))));
        if ($product)
            echo json_encode($product);
    }

    public function action_selectCity()
    {
        if ($this->request->method() == Request::POST) {
            $id = (int)$this->request->post('id');
            $select = DB::select_array(array('name'))
                ->from('citys')
                ->where('id', '=', $id)
                ->limit(1)
                ->execute()
                ->as_array();

            if(!empty($select)){
                $city =  $select[0]['name'];
            }else{
                $city =  false;
            }

            if(!empty($city)){
                $ses = Session::instance();
                $ses->set('city', $city);
                echo 'ok';
            }
        }
    }
}