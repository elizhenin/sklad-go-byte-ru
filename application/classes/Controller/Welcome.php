<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Tmp
{

    public function action_index()
    {
        $ModelWelcome = new Model_Welcome($this->city);
        $page = View::factory('welcome');
        $page->current_city_id = $this->city['id'];
        $page->ModelsNew = $ModelWelcome->ModelGetNew();
        $page->ModelsLeader = $ModelWelcome->ModelGetLeaders();
        $ses = Session::instance();
        $Special = $ses->get('ModelsSpecial',false);
        if(empty($Special)) $Special = $ModelWelcome->ModelGetSpecial();
        $page->ModelsSpecial = $Special;
        $this->page = $page;
        }

}
