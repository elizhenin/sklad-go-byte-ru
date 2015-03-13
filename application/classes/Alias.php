<?php defined('SYSPATH') or die('No direct script access.');

class Alias
{
    static function textToAlias($str)
    {
        $tr = array(
            "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "zh",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "-"
        );

        if (!preg_match('//u', $str)) {
            $str = iconv('cp1251', 'UTF-8', $str);
        }

        $str = mb_strtolower($str, 'utf-8');
        $str = trim($str);
        $urlstr = strtr($str, $tr);
        $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
        $urlstr = preg_replace('/\-+/', '-', $urlstr);
        return $urlstr;
    }
}