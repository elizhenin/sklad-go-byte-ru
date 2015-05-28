<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tmp extends Controller_Template
{
    public $template = 'template';
    public $title;
    public $description;
    public $keywords;
    public $content;
    public $alias;
    public $user;

    public function before()
    {
        parent::before();

    }

    public function after()
    {

        parent::after();
    }


}
