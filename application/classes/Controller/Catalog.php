<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Catalog extends Controller_Tmp
{

    public
    function action_index()
    {
        $ModelCatalog = New Model_Catalog();
        $alias = $this->request->param('alias');
        $id = $this->request->param('id');
        $product = $this->request->param('product');
        switch (empty($product)) {
            case true:
                $check = $ModelCatalog->CategoryCheckPathID($id, $alias);
                if ($check) {
                    $page = View::factory('catalog');
                    $items['models'] = $ModelCatalog->ModelGetByCategory($check['id']);

                    $page->items = $items;
                    $categories = $ModelCatalog->CategoryFullNames(false);
                    if ($check['id'] != 0) {
                        $page->name = $categories[$check['id']]['name'];

                    }
                    $this->page = $page;
                };
                break;
            case false:
                $check = $ModelCatalog->ProductCategoryCheckPath($id, $alias, $product);
                if ($check) {
                    $page = View::factory('product');
                    $page->spec_groups = $ModelCatalog->SpecificationsGroupsGetVisible();
                    $page->item = $check;
                    $this->page = $page;
                    $this->title = $check['product']['title'];
                    $this->description = $check['product']['description'];
                    $this->keywords = $check['product']['keywords'];
                }
                break;
        }
    }
}
