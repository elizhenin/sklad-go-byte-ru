<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Tmp
{

    public function action_index()
    {
        $alias = $this->request->param('alias');
        $page = View::factory('article');
        $article = Model_Articles::GetArticleByAlias($alias);
        if (!empty($article)) {
            $page->content = $article['content'];
            $this->page = $page;
            $this->title = $article['title'];
            $this->keywords = $article['keywords'];
            $this->description = $article['description'];
        }
    }
}
