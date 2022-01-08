<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;

class NotifyController extends Controller
{
    private $pathViewController = 'news.pages.notify.';
    private $controllerName = 'notify';
    private $params = [];
    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $articlemodel = new ArticleModel();
        $itemsLatest = $articlemodel->listItems(null, ['task' => 'news-list-items-latest']);
        return view($this->pathViewController . 'notify', [
            'itemsLatest' => $itemsLatest,
        ]);
    }
}
