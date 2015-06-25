<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Catalog extends Controller_Tmp
{

    public function before()
    {
        parent::before();
        if ($this->request->method() == Request::POST) {
            $post = $this->request->post();
            foreach ($post as $key => $value) $post[$key] = htmlspecialchars(trim($value));
            switch ($post['operation']) {
                case 'request_product':
                    if(!empty($post['phone']) && !empty($post['email']) && !empty($post['name'])) {

                        MailSender::request_product($post);
                    }
                    break;
            }
        }
    }

    public
    function action_index()
    {
        $ModelCatalog = New Model_Catalog($this->city);
        $alias = $this->request->param('alias');
        $id = $this->request->param('id');
        $product = $this->request->param('product');
        $category_check = $ModelCatalog->CategoryCheckPathID($id, $alias);
        switch (empty($product)) {
            case true:
                if ($category_check) {
                    $page = View::factory('catalog');
                    $items = $ModelCatalog->ModelGetByCategory($category_check['id']);
                    $page->current_city_id = $this->city['id'];
                    $page->items = $items;
                    $categories = $ModelCatalog->CategoryFullNames(false);
                    if ($category_check['id'] != 0) {
                        $page->name = $categories[$category_check['id']]['name'];
                        $this->title = $categories[$category_check['id']]['title'];
                        $this->description = $categories[$category_check['id']]['description'];
                        $this->keywords = $categories[$category_check['id']]['keywords'];
                    }

                };
                break;
            case false:
                $product_check = $ModelCatalog->ProductCategoryCheckPath($id, $alias, $product);
                if ($product_check) {
                    $page = View::factory('product');
                    $page->current_city_id = $this->city['id'];
                    $page->spec_groups = $ModelCatalog->SpecificationsGroupsGetVisible();
                    $page->item = $product_check;
                    $page->similar = $ModelCatalog->ModelGetByCategory($category_check['id']);
                    $this->title = $product_check['product']['title'];
                    $this->description = $product_check['product']['description'];
                    $this->keywords = $product_check['product']['keywords'];
                }
                break;
        }
        if (!empty($page)) {
            $page->breadcrumbs = $ModelCatalog->GetPath($id, $alias);
            $this->page = $page;
        } else
            throw new HTTP_Exception_404;
    }
}
