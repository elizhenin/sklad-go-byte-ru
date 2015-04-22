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
        $this->template = View::factory('sklad/login');
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

    public function action_orders()
    {
        $OrdersPOST = $this->request->post();
        $session = $this->request->param('first');
        if (empty($OrdersPOST['operation'])) {
            $OrdersPOST['operation'] = 'list';
        }
        $ses = Session::instance();
        $OrderOpened = $ses->get('OrderOpened', false);
        if (($OrdersPOST['operation'] != 'update'
                && $OrdersPOST['operation'] != 'add_product'
                && $OrdersPOST['operation'] != 'remove_product'
                && $OrdersPOST['operation'] != 'close'
                && $OrdersPOST['operation'] != 'buyit'
                && $OrdersPOST['operation'] != 'release'
            ) && ($OrderOpened)
        ) {
            $OrdersPOST['operation'] = 'edit';
            $OrdersPOST['orders_id'] = $OrderOpened;
        }
        $ModelOrders = New Model_SkladOrders();

        switch ($OrdersPOST['operation']) {
            case 'close':
                $ses->set('OrderOpened', false);
                $this->redirect('/sklad/orders');
                break;
            case 'list':

                if ($session) {
                    $content = View::factory('sklad/orders/show_session');
                    $content->items = $ModelOrders->OrdersGetBySession($session);
                }
                else {
                    $content = View::factory('sklad/orders/show_orders');
                    $content->items = $ModelOrders->OrdersGetAll();
                }
                $content->rights = $this->user['rights'];
                break;
            case 'new':
                $ModelOrders->OrdersAdd($OrdersPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'update':
                $ses->set('OrderOpened', false);
                $ModelOrders->OrdersUpdate($OrdersPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'edit':
                $content = View::factory('sklad/orders/edit_order');
                $content->item = $ModelOrders->OrdersGetById($OrdersPOST['orders_id']);
                $content->id_orders = $OrdersPOST['orders_id'];
                $content->sessions = $ModelOrders->SessionsGetAll();
                $content->products = $ModelOrders->OrdersProductsGetAll($OrdersPOST['orders_id']);
                $content->operation = 'update';
                $ses->set('OrderOpened', $OrdersPOST['orders_id']);
                break;
            case 'add':
                $content = View::factory('sklad/orders/edit_order');
                $content->sessions = $ModelOrders->SessionsGetAll();
                if ($session) {
                    $items = $ModelOrders->OrdersGetBySession($session);
                    $content->item = $items[0];
                }
                $content->operation = 'new';
                break;
            case 'buyit':
                $order = $ModelOrders->OrdersAdd(array(
                    'session' => 0,
                    'phone' => '',
                    'text'=> ''
                ));
                $content = View::factory('sklad/orders/edit_order');
                $content->item = $ModelOrders->OrdersGetById($order);
                $content->id_orders = $order;
                $content->sessions = $ModelOrders->SessionsGetAll();
                $content->products = $ModelOrders->OrdersProductsGetAll($order);
                $content->buyit = $ModelOrders->OrdersProductsCheck($OrdersPOST['sku']);
                $content->operation = 'update';
                $ses->set('OrderOpened', $order);
                break;
            case
            'release':
                $ModelOrders->OrdersProductsRelease($this->user['id']);
                $this->redirect($this->request->referrer());
                break;
            case
            'disable':

                $ModelOrders->OrdersSetCompleteById($OrdersPOST['orders_id'], '1');
                $this->redirect($this->request->referrer());
                break;
            case 'enable':

                $ModelOrders->OrdersSetCompleteById($OrdersPOST['orders_id'], '0');
                $this->redirect($this->request->referrer());
                break;
            case 'add_product':
                $ModelOrders->OrdersProductsAdd($OrdersPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'remove_product':
                $ModelOrders->OrdersProductsRemove($OrdersPOST);
                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public
    function action_products()
    {
        $ProductsPOST = $this->request->post();
        if (empty($ProductsPOST['operation'])) {
            $ProductsPOST['operation'] = 'list';
        }

        $ModelProducts = New Model_SkladProducts();
        $ModelModels = New Model_SkladModels();
        $ModelStorages = New Model_SkladStorages();
        switch ($ProductsPOST['operation']) {
            case 'list':
                $id_model = $this->request->param('first');
                $content = View::factory('sklad/products/show_products');
                $filter = $this->request->query('filter');
                $content->items = $ModelProducts->ProductsGetAll($id_model, $filter);
                $content->rights = $this->user['rights'];
                break;
            case 'new':

                if (($this->user['rights'] == 'sale')) $this->redirect($this->request->referrer());
                $ModelProducts->ProductsAdd($ProductsPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'update':

                if (($this->user['rights'] == 'sale')) {
                    unset($ProductsPOST['id_models']);
                    unset($ProductsPOST['sku']);
                }
                $ModelProducts->ProductsUpdate($ProductsPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'edit':
                $content = View::factory('sklad/products/edit_product');
                $content->item = $ModelProducts->ProductsGetById($ProductsPOST['products_id']);
                $content->models = $ModelModels->ModelGetVisible();
                $content->storages = $ModelStorages->StoragesGetAllowed();
                $content->operation = 'update';
                $content->rights = $this->user['rights'];
                break;
            case 'add':
                if (($this->user['rights'] == 'sale')) $this->redirect($this->request->referrer());
                $content = View::factory('sklad/products/edit_product');
                $content->models = $ModelModels->ModelGetVisible();
                $content->storages = $ModelStorages->StoragesGetAllowed();
                $content->operation = 'new';
                break;
            case 'disable':
                if (($this->user['rights'] == 'sale')) $this->redirect($this->request->referrer());
                $ModelProducts->ProductsSetDeletedById($ProductsPOST['products_id'], '1');
                $this->redirect($this->request->referrer());
                break;
            case 'enable':
                if (($this->user['rights'] == 'sale')) $this->redirect($this->request->referrer());
                $ModelProducts->ProductsSetDeletedById($ProductsPOST['products_id'], '0');
                $this->redirect($this->request->referrer());
                break;
            //storage operations
            case 'products_move_prepare':
                $content = View::factory('sklad/products/products_move');
                $content->storages = $ModelStorages->StoragesGetAllowed();
                break;
            case 'products_move_complete':
                  $ModelProducts->ProductsMove($ProductsPOST);
                  $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public
    function action_users()
    {

        if (($this->user['rights'] != 'super')) HTTP::redirect('/sklad/main');

        $UsersPOST = $this->request->post();
        if (empty($UsersPOST['operation'])) {
            $UsersPOST['operation'] = 'list';
        }
        $ModelUsers = New Model_SkladUsers();
        switch ($UsersPOST['operation']) {
            case 'list':
                $content = View::factory('sklad/users/show_users');
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
                $content = View::factory('sklad/users/edit_user');
                $content->item = $ModelUsers->GetById($UsersPOST['users_id']);
                $content->operation = 'update';
                break;
            case 'add':
                $content = View::factory('sklad/users/edit_user');
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

    public
    function action_storages()
    {

        if (($this->user['rights'] != 'super')) HTTP::redirect('/sklad/main');

        $StoragesPOST = $this->request->post();
        if (empty($StoragesPOST['operation'])) {
            $StoragesPOST['operation'] = 'list';
        }
        $ModelStorages = New Model_SkladStorages();
        switch ($StoragesPOST['operation']) {
            case 'list':
                $content = View::factory('sklad/storages/show_storages');
                $content->items = $ModelStorages->StoragesGetAll();
                break;
            case 'new':
                $ModelStorages->StoragesNew($StoragesPOST);
                HTTP::redirect('/sklad/storages');
                break;
            case 'update':
                $ModelStorages->StoragesUpdate($StoragesPOST);
                HTTP::redirect('/sklad/storages');
                break;
            case 'edit':
                $content = View::factory('sklad/storages/edit_storage');
                $content->item = $ModelStorages->StoragesGetById($StoragesPOST['storages_id']);
                $content->citys = $ModelStorages->StoragesGetCitys();
                $content->operation = 'update';
                break;
            case 'add':
                $content = View::factory('sklad/storages/edit_storage');
                $content->citys = $ModelStorages->StoragesGetCitys();
                $content->operation = 'new';
                break;
            case 'disable':
                $ModelStorages->StoragesSetDeletedById($StoragesPOST['storages_id'], '1');
                HTTP::redirect('/sklad/storages');
                break;
            case 'enable':
                $ModelStorages->StoragesSetDeletedById($StoragesPOST['storages_id'], '0');
                HTTP::redirect('/sklad/storages');
                break;
        }

        $this->content = $content;
    }

    public
    function action_storages_rules()
    {

        if (($this->user['rights'] != 'super')) HTTP::redirect('/sklad/main');

        $StoragesPOST = $this->request->post();
        if (empty($StoragesPOST['operation'])) {
            $StoragesPOST['operation'] = 'list';
        }
        $ModelStorages = New Model_SkladStorages();
        switch ($StoragesPOST['operation']) {
            case 'list':
                $content = View::factory('sklad/storages/show_storages_rules');
                $content->items = $ModelStorages->StoragesRulesGetAll();
                break;
            case 'new':
                $ModelStorages->StoragesRulesNew($StoragesPOST);
                HTTP::redirect('/sklad/storages_rules');
                break;
            case 'update':
                $ModelStorages->StoragesRulesUpdate($StoragesPOST);
                HTTP::redirect('/sklad/storages_rules');
                break;
            case 'edit':
                $content = View::factory('sklad/storages/edit_storage_rule');
                $content->item = $ModelStorages->StoragesRulesGetById($StoragesPOST['storages_rules_id']);
                $content->citys = $ModelStorages->StoragesGetCitys();
                $content->storages = $ModelStorages->StoragesGetVisible();
                $content->operation = 'update';
                break;
            case 'add':
                $content = View::factory('sklad/storages/edit_storage_rule');
                $content->citys = $ModelStorages->StoragesGetCitys();
                $content->storages = $ModelStorages->StoragesGetVisible();
                $content->operation = 'new';
                break;
            case 'disable':
                $ModelStorages->StoragesRulesSetDeletedById($StoragesPOST['storages_rules_id'], '1');
                HTTP::redirect('/sklad/storages_rules');
                break;
            case 'enable':
                $ModelStorages->StoragesRulesSetDeletedById($StoragesPOST['storages_rules_id'], '0');
                HTTP::redirect('/sklad/storages_rules');
                break;
        }

        $this->content = $content;
    }

    public
    function action_models()
    {
        $ses = Session::instance();
        if (($this->user['rights'] == 'sale')) HTTP::redirect('/sklad/main');

        $ModelsPOST = $this->request->post();
        if (empty($ModelsPOST['operation'])) {
            $ModelsPOST['operation'] = 'list';
        }

        $ModelOpened = $ses->get('ModelOpened', false);
        if (($ModelsPOST['operation'] != 'update') && ($ModelOpened)) {
            $ModelsPOST['operation'] = 'edit';
            $ModelsPOST['models_id'] = $ModelOpened;
        }

        $ModelModels = New Model_SkladModels();
        switch ($ModelsPOST['operation']) {
            case 'list':
                $content = View::factory('sklad/models/show_models');
                $content->items = $ModelModels->ModelGetAll();
                $content->categorys = $ModelModels->CategoryFullNameAllowed(false);
                break;
            case 'new':
                $ModelModels->ModelAdd($ModelsPOST);
                $return = $ses->get('ReturnTo', '/sklad/categories');
                $ses->delete('ReturnTo');
                $this->redirect($return);
                break;
            case 'update':
                $ModelModels->ModelUpdate($ModelsPOST);
                $ses->set('ModelOpened', false);
                $return = $ses->get('ReturnTo', '/sklad/categories');
                $ses->delete('ReturnTo');
                $this->redirect($return);
                break;
            case 'edit':
                $content = View::factory('sklad/models/edit_model');
                $content->item = $ModelModels->ModelGetById($ModelsPOST['models_id']);
                $content->specifications = $ModelModels->SpecificationsGetVisible();
                $content->specifications_groups = $ModelModels->SpecificationsGroupsGetVisible();
                $content->model_specifications = $ModelModels->SpecificationsModelGetAll($ModelsPOST['models_id']);
                $content->images = $ModelModels->ImagesModelGetAll($ModelsPOST['models_id']);
                $content->categorys = $ModelModels->CategoryFullNameAllowed();
                $content->operation = 'update';
                $content->rights = $this->user['rights'];
                $return = $ses->get('ReturnTo', false);
                if (empty($return)) $ses->set('ReturnTo', $this->request->referrer());
                $ses->set('ModelOpened', $ModelsPOST['models_id']);
                break;
            case 'add':
                $content = View::factory('sklad/models/edit_model');
                $content->categorys = $ModelModels->CategoryFullNameAllowed();
                $content->rights = $this->user['rights'];
                $content->operation = 'new';

                $return = $ses->get('ReturnTo', false);
                if (empty($return)) $ses->set('ReturnTo', $this->request->referrer());
                break;
            case 'disable':
                $ModelModels->ModelSetDeletedById($ModelsPOST['models_id'], '1');
                $this->redirect($this->request->referrer());
                break;
            case 'enable':
                $ModelModels->ModelSetDeletedById($ModelsPOST['models_id'], '0');
                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public
    function action_categories()
    {
        $ses = Session::instance();

        if (($this->user['rights'] == 'sale')) HTTP::redirect('/sklad/main');

        $CategoriesPOST = $this->request->post();
        if (empty($CategoriesPOST['operation'])) {
            $CategoriesPOST['operation'] = 'list';
        }
        $ModelModels = New Model_SkladModels();
        $alias = $this->request->param('alias');
        $check = $ModelModels->CategoryCheckPath($alias);
        switch ($CategoriesPOST['operation']) {
            case 'list':
                if ($check) {
                    $content = View::factory('sklad/models/show_categories');
                    $content->rights = $this->user['rights'];
                    $content->alias = $alias;
                    $items['categories'] = $ModelModels->CategoryGetSub($check);
                    $items['models'] = $ModelModels->ModelGetByCategory($check['id']);
                    $content->items = $items;
                    $categories = $ModelModels->CategoryFullNames(false);
                    if ($check['id'] != 0) $content->name = $categories[$check['id']]['name'];
                    $ses->set('ModelOpened', false);
                } else throw new HTTP_Exception_404;
                break;
            case 'new':
                if (($this->user['rights'] == 'super')) {
                    $ModelModels->CategoryAdd($CategoriesPOST, false);
                }
                $this->redirect($this->request->referrer());
                break;
            case 'update':
                if (($this->user['rights'] == 'super')) {
                    $ModelModels->CategoryUpdate($CategoriesPOST);
                }
                $this->redirect($this->request->referrer());
                break;
            case 'edit':
                if (($this->user['rights'] == 'super')) {
                    $content = View::factory('sklad/models/edit_category');
                    $content->item = $ModelModels->CategoryGetById($CategoriesPOST['category_id']);
                    $content->categorys = $ModelModels->CategoryFullNames();
                    $content->parent = $check['id'];
                    $content->operation = 'update';
                } else $this->redirect($this->request->referrer());
                break;
            case 'add':
                if (($this->user['rights'] == 'super')) {
                    $content = View::factory('sklad/models/edit_category');
                    $content->categorys = $ModelModels->CategoryFullNames();
                    $content->parent = $check['id'];
                    $content->operation = 'new';
                } else $this->redirect($this->request->referrer());
                break;
            case 'disable':
                if (($this->user['rights'] == 'super')) {
                    $ModelModels->CategorySetDeletedById($CategoriesPOST['category_id'], '1');
                }
                $this->redirect($this->request->referrer());
                break;
            case 'enable':
                if (($this->user['rights'] == 'super')) {
                    $ModelModels->CategorySetDeletedById($CategoriesPOST['category_id'], '0');
                }
                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public
    function action_specifications()
    {
        $ses = Session::instance();

        if (($this->user['rights'] == 'sale')) HTTP::redirect('/sklad/main');
        $model = $this->request->param('first');
        $SpecificationsPOST = $this->request->post();
        if (empty($SpecificationsPOST['operation'])) {
            $SpecificationsPOST['operation'] = 'specifications_list';
        }
        $ModelModels = New Model_SkladModels();
        switch ($SpecificationsPOST['operation']) {
//specs itself

            case 'specifications_list':
                $content = View::factory('sklad/specifications/specifications');
                $content->groups = $ModelModels->SpecificationsGroupsGetAll();
                $content->items = $ModelModels->SpecificationsGetAll();
                break;
            case 'specifications_rename':
                $ModelModels->SpecificationsRename($SpecificationsPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_regroup':
                $ModelModels->SpecificationsRegroup($SpecificationsPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_new':
                $ModelModels->SpecificationsAdd($SpecificationsPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_disable':
                $ModelModels->SpecificationsSetDeletedById($SpecificationsPOST['id'], '1');
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_enable':
                $ModelModels->SpecificationsSetDeletedById($SpecificationsPOST['id'], '0');
                $this->redirect($this->request->referrer());
                break;

            case 'specifications_move':
                $ModelModels->SpecificationsMoveTo($SpecificationsPOST['id'], $SpecificationsPOST['newpos']);
                $this->redirect($this->request->referrer());
                break;
//model specs
            case 'model_list':
                $ses->set('ReturnTo', $this->request->referrer());
                $content = View::factory('sklad/specifications/model_specifications');
                $content->referrer = $ses->get('ReturnTo', false);
                $content->items = $ModelModels->SpecificationsModelGetAll($model);

                break;
            case 'model_add':
                $ModelModels->SpecificationsModelAdd($SpecificationsPOST);
                $this->redirect($this->request->referrer());

                break;
            case 'model_delete':
                $ModelModels->SpecificationsModelDelete($SpecificationsPOST['id']);
                $this->redirect($this->request->referrer());

                break;
            case 'model_update':
                $ModelModels->SpecificationsModelUpdate($SpecificationsPOST);
                $this->redirect($this->request->referrer());

                break;
        }

        $this->content = $content;
    }

    public
    function action_specifications_groups()
    {

        if (($this->user['rights'] == 'sale')) HTTP::redirect('/sklad/main');
        $SpecificationsPOST = $this->request->post();
        if (empty($SpecificationsPOST['operation'])) {
            $SpecificationsPOST['operation'] = 'specifications_list';
        }
        $ModelModels = New Model_SkladModels();
        switch ($SpecificationsPOST['operation']) {

            case 'specifications_list':
                $content = View::factory('sklad/specifications/specifications_groups');
                $content->items = $ModelModels->SpecificationsGroupsGetAll();
                break;
            case 'specifications_rename':
                $ModelModels->SpecificationsGroupsRename($SpecificationsPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_new':
                $ModelModels->SpecificationsGroupsAdd($SpecificationsPOST);
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_disable':
                $ModelModels->SpecificationsGroupsSetDeletedById($SpecificationsPOST['id'], '1');
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_enable':
                $ModelModels->SpecificationsGroupsSetDeletedById($SpecificationsPOST['id'], '0');
                $this->redirect($this->request->referrer());
                break;
            case 'specifications_move':
                $ModelModels->SpecificationsGroupsMoveTo($SpecificationsPOST['id'], $SpecificationsPOST['newpos']);
                $this->redirect($this->request->referrer());
                break;
        }

        $this->content = $content;
    }

    public
    function action_images()
    {
        if (($this->user['rights'] == 'sale')) HTTP::redirect('/sklad/main');
        $model = $this->request->param('first');
        $ImagesPOST = $this->request->post();
        if (empty($ImagesPOST['operation'])) {
            $ImagesPOST['operation'] = '';
        }
        $ModelModels = New Model_SkladModels();
        switch ($ImagesPOST['operation']) {
//specs itself
            case 'images_upload':
                $ModelModels->ImagesUpload($ImagesPOST['models_id']);
                $this->redirect($this->request->referrer());
                break;
            case 'images_update':
                $ModelModels->ImagesUpdate($ImagesPOST);
                $this->redirect($this->request->referrer());

                break;
            default:
                $content = View::factory('sklad/models/show_images');
                if (!empty($model)) {
                    $content->images = $ModelModels->ImagesGetAll();
                    $content->model = $model;
                }
                break;
        }

        $this->content = $content;
    }

}
