<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;

class ArticleController extends Controller
{
    private $pathViewController = 'news.pages.article.';
    private $controllerName = 'article';
    private $model;
    private $params = [];
    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $articleModel = new CategoryModel();
        $articleModel = new ArticleModel();
        $params['article_id'] = $request->article_id;
        $itemArticle = $articleModel->getItem($params, ['task' => 'news-get-item']);
        if (empty($itemArticle)) {
            return redirect()->route('home');
        }
        $params['category_id'] = $itemArticle['category_id'];
        $itemArticle['related_articles'] = $articleModel->listItems($params, ['task' => 'news-get-items-related-in-category']);
        // $itemCategory['articles'] = $articleModel->listItems(['id'=>$itemCategory['id']],['task'=>'news-list-items-in-article']);

        $itemsFeatured = $articleModel->listItems(null, ['task' => 'news-list-items-featured']);
        $itemsLatest = $articleModel->listItems(null, ['task' => 'news-list-items-latest']);

        return view($this->pathViewController . 'index', [
            'params' => $this->params,
            'itemsFeatured' => $itemsFeatured,
            'itemsLatest' => $itemsLatest,
            'itemArticle' => $itemArticle,
        ]);
    }
}
