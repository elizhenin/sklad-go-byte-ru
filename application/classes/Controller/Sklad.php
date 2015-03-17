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
    {

    }

    public function action_users()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if (($user['rights'] != 'super')) HTTP::redirect('/sklad/main');

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
                $this->redirect($this->request->referrer());
                break;
            case 'update':
                $ModelUsers->UpdateUser($UsersPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'edit':
                $content = View::factory('users/edit_user');
                $content->item = $ModelUsers->GetById($UsersPOST['users_id']);
                $content->operation = 'update';
                break;
            case 'add':
                $content = View::factory('users/edit_user');
                $content->operation = 'new';
                break;
            case 'disable':
                $ModelUsers->SetDeletedById($UsersPOST['users_id'], '1');
                $this->redirect($this->request->referrer());
                break;
            case 'enable':
                $ModelUsers->SetDeletedById($UsersPOST['users_id'], '0');
                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public function action_storages()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if (($user['rights'] != 'super')) HTTP::redirect('/sklad/main');

        $StoragesPOST = $this->request->post();
        if (empty($StoragesPOST['operation'])) {
            $StoragesPOST['operation'] = 'list';
        }
        $ModelStorages = New Model_SkladStorages();
        switch ($StoragesPOST['operation']) {
            case 'list':
                $content = View::factory('storages/show_storages');
                $content->items = $ModelStorages->GetAll();
                break;
            case 'new':
                $ModelStorages->NewStorage($StoragesPOST);
                HTTP::redirect('/sklad/storages');
                break;
            case 'update':
                $ModelStorages->UpdateStorage($StoragesPOST);
                HTTP::redirect('/sklad/storages');
                break;
            case 'edit':
                $content = View::factory('storages/edit_storage');
                $content->item = $ModelStorages->GetById($StoragesPOST['storages_id']);
                $content->citys = $ModelStorages->GetCitys();
                $content->operation = 'update';
                break;
            case 'add':
                $content = View::factory('storages/edit_storage');
                $content->citys = $ModelStorages->GetCitys();
                $content->operation = 'new';
                break;
            case 'disable':
                $ModelStorages->SetDeletedById($StoragesPOST['storages_id'], '1');
                HTTP::redirect('/sklad/storages');
                break;
            case 'enable':
                $ModelStorages->SetDeletedById($StoragesPOST['storages_id'], '0');
                HTTP::redirect('/sklad/storages');
                break;
        }

        $this->content = $content;
    }

    public function action_models()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if (($user['rights'] != 'super')) HTTP::redirect('/sklad/main');

        $ModelsPOST = $this->request->post();
        if (empty($ModelsPOST['operation'])) {
            $ModelsPOST['operation'] = 'list';
        }
        $ModelModels = New Model_SkladModels();
        switch ($ModelsPOST['operation']) {
            case 'list':
                $content = View::factory('models/show_models');
                $content->items = $ModelModels->GetAll();
                break;
            case 'new':
                $ModelModels->NewModel($ModelsPOST);
                $this->redirect($ses->get('ReturnTo', false));
                break;
            case 'update':
                $ModelModels->UpdateModel($ModelsPOST);
                $this->redirect($ses->get('ReturnTo', false));
                break;
            case 'edit':
                $content = View::factory('models/edit_model');
                $content->item = $ModelModels->GetById($ModelsPOST['models_id']);
                $content->categorys = $ModelModels->CategoriesFullNameAllowed();
                $content->operation = 'update';
                $ses->set('ReturnTo', $this->request->referrer());
                break;
            case 'add':
                $content = View::factory('models/edit_model');
                $content->categorys = $ModelModels->CategoriesFullNameAllowed();
                $content->operation = 'new';
                $ses->set('ReturnTo', $this->request->referrer());
                break;
            case 'disable':
                $ModelModels->SetDeletedById($ModelsPOST['models_id'], '1');
                $this->redirect($this->request->referrer());
                break;
            case 'enable':
                $ModelModels->SetDeletedById($ModelsPOST['models_id'], '0');
                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public function action_categories()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if (($user['rights'] == 'sale')) HTTP::redirect('/sklad/main');

        $CategoriesPOST = $this->request->post();
        if (empty($CategoriesPOST['operation'])) {
            $CategoriesPOST['operation'] = 'list';
        }
        $ModelModels = New Model_SkladModels();
        $alias = $this->request->param('alias');
        $check = $ModelModels->CategoriesCheckPath($alias);
        switch ($CategoriesPOST['operation']) {
            case 'list':
                if ($check) {
                    $content = View::factory('models/show_categories');
                    $content->rights = $user['rights'];
                    $content->alias = $alias;
                    $items['categories'] = $ModelModels->CategoriesGetCurrent($check);
                    $items['models'] = $ModelModels->GetCurrent($check['id']);
                    $content->items = $items;
                    $categories = $ModelModels->CategoriesFullName(true);
                    if($check['id']!=0) $content->name = $categories[$check['id']]['name'];

                } else throw new HTTP_Exception_404;
                break;
            case 'new':
                if (($user['rights'] == 'super')) {
                    $ModelModels->AddCategory($CategoriesPOST, $check['id']);
                }
                $this->redirect($this->request->referrer());
                break;
            case 'update':
                if (($user['rights'] == 'super')) {
                    $ModelModels->CategoriesUpdateRecord($CategoriesPOST);
                }
                $this->redirect($this->request->referrer());
                break;
            case 'edit':
                if (($user['rights'] == 'super')) {
                    $content = View::factory('models/edit_category');
                    $content->item = $ModelModels->CategoriesGetById($CategoriesPOST['category_id']);
                    $content->categorys = $ModelModels->CategoriesFullName();
                    $content->parent = $check['id'];
                    $content->operation = 'update';
                } else $this->redirect($this->request->referrer());
                break;
            case 'add':
                if (($user['rights'] == 'super')) {
                    $content = View::factory('models/edit_category');
                    $content->categorys = $ModelModels->CategoriesFullName();
                    $content->parent = $check['id'];
                    $content->operation = 'new';
                } else $this->redirect($this->request->referrer());
                break;
            case 'disable':
                if (($user['rights'] == 'super')) {
                    $ModelModels->CategorySetDeletedById($CategoriesPOST['category_id'], '1');
                }
                $this->redirect($this->request->referrer());
                break;
            case 'enable':
                if (($user['rights'] == 'super')) {
                    $ModelModels->CategorySetDeletedById($CategoriesPOST['category_id'], '0');
                }
                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public function action_specifications()
    {
        $ses = Session::instance();
        $user = $ses->get('user', false);
        if (($user['rights'] != 'super')) HTTP::redirect('/sklad/main');
        $model = $this->request->param('model');
        $param = $this->request->param('param');
        $SpecificationsPOST = $this->request->post();
        if (empty($SpecificationsPOST['operation'])) {
            $SpecificationsPOST['operation'] = 'list';
        }
        $ModelModels = New Model_SkladModels();
        $cache = Cache::instance();
        switch ($SpecificationsPOST['operation']) {
            case 'list':
                $content = View::factory('specifications/show_specifications');
                $content->items = $ModelModels->SpecificationsGetCurrent($model);
                break;
            case 'new':
                $ModelModels->NewSpecification($SpecificationsPOST);
                $this->redirect($cache->get('ReturnTo', false));
                break;
            case 'update':
                $ModelModels->UpdateSpecification($SpecificationsPOST);
                $this->redirect($cache->get('ReturnTo', false));
                break;
            case 'edit':
                $content = View::factory('specifications/edit_specification');
                $content->item = $ModelModels->SpecificationGetById($SpecificationsPOST['models_id']);
                $content->operation = 'update';
                $cache->set('ReturnTo', $this->request->referrer());
                break;
            case 'add':
                $content = View::factory('specifications/edit_specification');
                $content->operation = 'new';
                $cache->set('ReturnTo', $this->request->referrer());
                break;
//            case 'disable':
//                $ModelModels->SpecificationsSetDeletedById($SpecificationsPOST['specifications_id'], '1');
//                $this->redirect($this->request->referrer());
//                break;
//            case 'enable':
//                $ModelModels->SpecificationsSetDeletedById($SpecificationsPOST['specifications_id'], '0');
//                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

}
