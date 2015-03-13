<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sklad extends Controller_SkladTmp
{

    public function action_index()
    {
        HTTP::redirect('/sklad/main');
    }

    public function action_logout()
    {
        $ses = Session::instance();
        $ses->delete('user');
        HTTP::redirect('/sklad');
    }

    public function action_login()
    {
        $ses = Session::instance();
        $this->template = View::factory('login');
        $modelSklad = new Model_SkladLogin();
        if (HTTP_Request::POST == $this->request->method()) {
            $login = $this->request->post('login');
            $password = $this->request->post('password');

            if ($user = $modelSklad->checkUser($login, $password)) {
                $ses->set('user', $user);
            } else {
                $this->template->error = true;
            }
        }
        $user = $ses->get('user', false);
        if ($user) {
            $modelSklad->UpdateLogin($user['id']);
            HTTP::redirect('/sklad/main');
        }

    }


    public function action_main()
    {}

    public function action_users()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if(($user['rights']!='super')) HTTP::redirect('/sklad/main');

        $UsersPOST = $this->request->post();
        if (empty($UsersPOST['operation'])) {
            $UsersPOST['operation'] = 'list';
        }
        $ModelUsers = New Model_SkladUsers();
        switch ($UsersPOST['operation']) {
            case 'list':
                $content = View::factory('users/show_users');
                $content->items = $ModelUsers->GetAll();
                break;
            case 'new':
                $ModelUsers->NewUser($UsersPOST);
                HTTP::redirect('/sklad/users');
                break;
            case 'update':
                $ModelUsers->UpdateUser($UsersPOST);
                HTTP::redirect('/sklad/users');
                break;
            case 'edit':
                $content = View::factory('/users/edit_user');
                $content->item = $ModelUsers->GetById($UsersPOST['users_id']);
                $content->operation = 'update';
                break;
            case 'add':
                $content = View::factory('/users/edit_user');
                $content->operation = 'new';
                break;
            case 'disable':
                $ModelUsers->SetDeletedById($UsersPOST['users_id'], '1');
                HTTP::redirect('/sklad/users');
                break;
            case 'enable':
                $ModelUsers->SetDeletedById($UsersPOST['users_id'], '0');
                HTTP::redirect('/sklad/users');
                break;
        }

        $this->content = $content;
    }

}
