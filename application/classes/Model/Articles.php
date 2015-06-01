<?php defined('SYSPATH') or die('No direct script access.');

class Model_Articles extends Model
{
    static function GetArticleByAlias($alias)
    {
        $alias = htmlspecialchars(trim($alias));
        $db = DB::select()
            ->from('articles')
            ->where('alias', '=', $alias)
            ->execute()
            ->as_array();
        if (!empty($db[0])) return $db[0];
        else return false;
    }
}
