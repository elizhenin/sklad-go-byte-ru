<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{

    function before()
    {
        $ses = Session::instance();
        $auth = $ses->get('user', 0);
        if ($auth == 0) {
            die('No unautorized ajax access.');
        }

    }

    public function action_imageUpload()
    {
        if (HTTP_Request::POST == $this->request->method()) {
            $file = Goodies::image_save('file', 'images/sklad');
            if ($file) {
                echo stripslashes(json_encode(array('filelink' => 'images/sklad/' . $file)));
            }
        }
    }
}