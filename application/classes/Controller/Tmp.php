<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tmp extends Controller_Template
{
    public $page;
    public $title = 'Дисконт цифровой техники. Лучшие решения по низким ценам';
    public $description;
    public $keywords;

    public function before()
    {
        parent::before();
        $this->template->bind('title', $this->title);
        $this->template->bind('description', $this->description);
        $this->template->bind('keywords', $this->keywords);
        $this->template->bind('page', $this->page);
    }

    public function after()
    {
        if(empty($this->page)){
            throw new HTTP_Exception_404;
        }

        parent::after();
    }
}
