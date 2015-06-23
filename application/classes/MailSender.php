<?php defined('SYSPATH') or die('No direct script access.');

class MailSender
{

    static function request_product($post)
    {
        $message = View::factory('mail/request_product');
        $message->input = $post;
        $ses = Session::instance();

        $message->city = $ses->get('city');
        Email::factory('Заказ товара')
            ->from('site@go-byte.ru', 'Магазин GO-BYTE')
            ->message($message, 'text/html')
            ->to('dev@studio-pulse.ru')
            ->send();
    }

}