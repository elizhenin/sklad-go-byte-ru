<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SkladTmp extends Controller_Template
{
    public $template = 'sklad/template';
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

        $ses = Session::instance();
        $user = $ses->get('user', false);

        switch($user['rights']) {
            case 'super':
                $this->template->menu = view::factory('sklad/menu/super');
                break;
            case 'content':
                $this->template->menu = view::factory('sklad/menu/content');
                break;
            default:
                $this->template->menu = view::factory('sklad/menu/sale');
                break;
        }


        if(!empty($this->alias)){$this->template->alias = $this->alias;}
        parent::after();
    }


}
