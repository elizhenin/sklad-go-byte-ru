<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contacts extends Controller_Tmp
{

    public function action_index()
    {
        $page = View::factory('contacts');

            $this->page = $page;
            $this->title = 'Контакты';
            $this->keywords = '';
            $this->description = '';

    }
}
