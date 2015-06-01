<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Tmp
{

    public function action_index()
    {
        $alias = $this->request->param('alias');
        $this->content = View::factory('article');
        $article = Model_Articles::GetArticleByAlias($alias);
        if (!empty($article)) {
            $this->content->content = $article['content'];
        }
    }

}
