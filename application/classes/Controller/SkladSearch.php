<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SkladSearch extends Controller_SkladTmp
{

    public function action_index()
    {
        $query = $this->request->query('query');

        $content = View::factory('sklad/search/result');
        $content->request = $query;
        $this->content = $content;
    }

}
