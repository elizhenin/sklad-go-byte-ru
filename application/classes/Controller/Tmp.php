<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tmp extends Controller_Template
{
    public $page;
    public $title = 'Дисконт цифровой техники. Лучшие решения по низким ценам';
    public $description;
    public $keywords;
    public $city = '';

    private function detect_city()
    {
        $ses = Session::instance();
        $getCity = Goodies::checkCity($ses->get('city', false));
        if (empty($getCity)) {
            $sxGeo = new SxGeo(DOCROOT . 'SxGeoCity.dat', SXGEO_BATCH | SXGEO_MEMORY);
            $city = $sxGeo->getCity(Request::$client_ip);
            $getCity = Goodies::checkCity($city['city']['name_ru']);
            if (!empty($getCity)) {
                $ses->set('city', $city['city']['name_ru']);
            } else {
                $ses->set('city', 'Воронеж');
                $getCity['name'] = 'Воронеж';
                $getCity['id'] = DB::select()
                    ->from('citys')
                    ->where('name', '=', 'Воронеж')
                    ->limit(1)
                    ->execute()
                    ->as_array();
                $getCity['id'] = $getCity['id'][0]['id'];
            }
        }
        $this->city = $getCity;
    }

    public function before()
    {
        parent::before();
        $this->template->bind('title', $this->title);
        $this->template->bind('description', $this->description);
        $this->template->bind('keywords', $this->keywords);
        $this->template->bind('page', $this->page);
        $this->template->bind('ActiveCity', $this->city);
        $this->detect_city();
    }

    public function after()
    {
//        if (empty($this->page)) {
//            throw new HTTP_Exception_404;
//        }
        $this->template->CitysList = Goodies::GetCitys();
        $modelCatalog = New Model_Catalog($this->city);
        $this->template->menu = $modelCatalog->CategoryGetMenu();

        $tpl_head = View::factory('tpl-head');
        $controller = $this->request->controller();
        if ($controller == 'Welcome')
            $tpl_head->welcome = true;
        elseif ($controller == 'Catalog')
            $tpl_head->catalog = true;
        $this->template->tpl_head = $tpl_head;
        parent::after();
    }
}
