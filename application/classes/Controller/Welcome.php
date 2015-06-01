<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Tmp
{

    public function action_index()
    {
        $page = View::factory('welcome');
        $this->page = $page;
        }

}
