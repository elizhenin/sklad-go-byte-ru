<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Basket extends Controller_Tmp
{

    public function action_index()
    {



        $page = view::factory('basket');
      $this->page = $page;
    }


}
