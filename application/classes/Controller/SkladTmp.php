<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SkladTmp extends Controller_Template
{
    public $template = 'template';
    public $title;
    public $description;
    public $keywords;
    public $content;
    public $alias;

    public function before()
    {
        parent::before();
        $ses = Session::instance();
        if (!$ses->get('user', false) && $this->request->action() != 'login') {
            HTTP::redirect('/sklad/login');
        }
    }

    public function after()
    {
        if (!empty($this->title)) {
            $this->template->title = $this->title;
        } else {
            $this->template->title = 'Склад';
        }

        $this->template->content = $this->content;

        $menu = view::factory('menu');
        $ses = Session::instance();
        $rights = $ses->get('user', false);

        $menu->rights = $rights['rights'];
        $this->template->menu = $menu;

        if(!empty($this->alias)){$this->template->alias = $this->alias;}
        parent::after();
    }


}
