<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Catalog extends Controller_Tmp
{

    public
    function action_index()
    {
        $ModelCatalog = New Model_Catalog();
        $alias = $this->request->param('alias');
        $check = $ModelCatalog->CategoryCheckPath($alias);
        if ($check) {
            $page = View::factory('catalog');
            $page->alias = $alias;
            $items['categories'] = $ModelCatalog->CategoryGetSub($check);
            $items['models'] = $ModelCatalog->ModelGetByCategory($check['id']);

            $page->items = $items;
            $categories = $ModelCatalog->CategoryFullNames(false);
            if ($check['id'] != 0) $page->name = $categories[$check['id']]['name'];
            $page->menu = $ModelCatalog->CategoryGetMenu();
            $this->page = $page;
        };
    }

}
