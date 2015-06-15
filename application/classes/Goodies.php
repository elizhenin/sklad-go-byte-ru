<?php defined('SYSPATH') or die('No direct script access.');

class Goodies
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

    static function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    static function images_save($name, $path, $width = false, $height = false)
    {
        $files = array();
        if (!empty($_FILES[$name]['name'])) {
            foreach ($_FILES[$name]['error'] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $ext = substr(strrchr($_FILES[$name]['name'][$key], '.'), 1);
                    $filename = time() . '_' . Text::random('alnum', 4);
                    $tmp_name = $_FILES['image']['tmp_name'][$key];
                    $image_file = $filename . '_tmp.' . $ext;
                    move_uploaded_file($tmp_name, stripcslashes($path) . '/' . $image_file);
                    $image = Image::factory(stripcslashes($path) . '/' . $image_file);
                    if ($width && ($image->width > $width)) {
                        $image->resize($width, $image->height);
                    }
                    if ($height && ($image->height > $height)) {
                        $image->resize($image->width, $height);
                    }
                    $image->save();

                    copy(stripcslashes($path) . '/' . $image_file, stripcslashes($path) . '/' . $filename . '.' . $ext);
                    unlink(stripcslashes($path) . '/' . $image_file);

                    $files[] = $filename . '.' . $ext;
                }
            }
            return $files;
        } else return false;
    }

    static function checkCity($name)
    {
        $select = DB::select()
            ->from('citys')
            ->where('name', '=', $name)
            ->limit(1)
            ->execute()
            ->as_array();

        if (!empty($select[0])) {
            return $select[0];
        } else {
            return false;
        }
    }

    static function GetCitys()
    {
        $select = DB::select()
            ->from('citys')
            ->execute()
            ->as_array();
        if (!empty($select))
            foreach ($select as $key => $value) {
                if (($value['alias'] == 'superuser') || ($value['alias'] == 'content')) unset($select[$key]);
            }

        if (!empty($select)) {
            return $select;
        } else {
            return false;
        }
    }

    static function ShowCatalogMenu($items,$link,$root=false)
    {
        $return = '';
            foreach($items as $item) {
                $return.='<li><a href="'.$link.'/'.$item['alias'].'"';
                if($root) $return.='class="root-item"';
                $return.='>'.$item['menu'].'</a>';
                    if(!empty($item['sub'])) $return.= '<ul>'.Goodies::ShowCatalogMenu($item['sub'],$link.'/'.$item['alias']).'</ul>';
                $return.='</li>';
            }
        return $return;
    }
}