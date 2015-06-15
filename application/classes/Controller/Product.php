<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Product extends Controller_Tmp
{

    public
    function action_index()
    {

        $this->page = $alias = $this->request->param('alias');

    }

}
