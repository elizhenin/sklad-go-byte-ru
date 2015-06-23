<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Catalog extends Controller_Tmp
{

    public
    function action_index()
    {
        $ModelCatalog = New Model_Catalog($this->city);
        $alias = $this->request->param('alias');
        $id = $this->request->param('id');
        $product = $this->request->param('product');
        switch (empty($product)) {
            case true:
                $check = $ModelCatalog->CategoryCheckPathID($id, $alias);
                if ($check) {
                    $page = View::factory('catalog');
                    $items['models'] = $ModelCatalog->ModelGetByCategory($check['id']);
                    $page->current_city_id = $this->city['id'];
                    $page->items = $items;
                    $categories = $ModelCatalog->CategoryFullNames(false);
                    if ($check['id'] != 0) {
                        $page->name = $categories[$check['id']]['name'];
                        $this->title = $categories[$check['id']]['title'];
                        $this->description = $categories[$check['id']]['description'];
                        $this->keywords = $categories[$check['id']]['keywords'];
                    }

                };
                break;
            case false:
                $check = $ModelCatalog->ProductCategoryCheckPath($id, $alias, $product);
                if ($check) {
                    $page = View::factory('product');
                    $page->current_city_id = $this->city['id'];
                    $page->spec_groups = $ModelCatalog->SpecificationsGroupsGetVisible();
                    $page->item = $check;
                    $this->title = $check['product']['title'];
                    $this->description = $check['product']['description'];
                    $this->keywords = $check['product']['keywords'];
                }
                break;
        }
        if(!empty($page)) {
            $page->breadcrumbs = $ModelCatalog->GetPath($id, $alias);
            $this->page = $page;
        }else
            throw new HTTP_Exception_404;
    }
}
