<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SkladTmp extends Controller_Template
{
    public $template = 'sklad/template';
    public $title;
    public $description;
    public $keywords;
    public $content;
    public $alias;
    public $user;

    public function before()
    {
        parent::before();

        $ses = Session::instance();
        if (!$ses->get('user', false) && $this->request->action() != 'login') {
            HTTP::redirect('/sklad/login');
        } else $this->user = $ses->get('user', false);
    }

    public function after()
    {
            $this->template->title = 'Склад';


        $topmenu = view::factory('/sklad/menu/top');
        $topmenu->title = $this->template->title;
        $this->template->topmenu = $topmenu;

        $this->template->content = $this->content;
        $this->template->status = view::factory('/sklad/statusbar');
        $this->template->status->info = Model_SkladOrders::OrdersStatus();


        switch ($this->user['rights']) {
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
        $controller = $this->request->controller();
        $action = $this->request->action();
        if ($controller == 'Sklad' || $controller = 'SkladSearch') {
            switch ($action) {
                case 'users':
                    $this->template->submenu = view::factory('/sklad/menu/submenu/users');
                    break;
                case 'storages':
                    $this->template->submenu = view::factory('/sklad/menu/submenu/storages');
                    break;
                case 'storages_rules':
                    $this->template->submenu = view::factory('/sklad/menu/submenu/storages');
                    break;
                case 'products':
                    $submenu = view::factory('/sklad/menu/submenu/products');
                    $submenu->rights = $this->user['rights'];
                    $this->template->submenu = $submenu;
                    break;
                case 'orders':
                    $submenu = view::factory('/sklad/menu/submenu/orders');
                    $submenu->rights = $this->user['rights'];
                    $this->template->submenu = $submenu;
                    break;
                case 'categories':
                    $submenu = View::factory('/sklad/menu/submenu/categories');
                    $submenu->rights = $this->user['rights'];
                    $this->template->submenu = $submenu;
                    break;
                case 'models':
                    $submenu = View::factory('/sklad/menu/submenu/categories');
                    $submenu->rights = $this->user['rights'];
                    $this->template->submenu = $submenu;
                    break;
                case 'specifications':
                    $submenu = View::factory('/sklad/menu/submenu/categories');
                    $submenu->rights = $this->user['rights'];
                    $this->template->submenu = $submenu;
                    break;
                case 'specifications_groups':
                    $submenu = View::factory('/sklad/menu/submenu/categories');
                    $submenu->rights = $this->user['rights'];
                    $this->template->submenu = $submenu;
                    break;
                default:
                    $this->template->submenu = view::factory('/sklad/menu/submenu/default');
                    break;
            }
        }

        if (!empty($this->alias)) {
            $this->template->alias = $this->alias;
        }

        parent::after();
    }


}
