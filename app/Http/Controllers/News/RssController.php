<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ArticleModel ;
use App\Models\RssModel;
use Illuminate\Support\Collection;
use App\Helpers\Feed;
class RssController extends Controller
{
    private $pathViewController='news.pages.rss.';
    private $controllerName='rss';
    private $model;
    private $params=[];
    public function __construct(){
        view()->share('controllerName',$this->controllerName);
        
    }

    public function index(Request $request){
        view()->share('title', 'Tin tức tổng hợp');
        $rssModel = new RSSModel();
        
        $itemsRss = $rssModel->listItems(null,['task'=>'news-list-items']);
        $data = Feed::read($itemsRss);
        $itemsGold = Feed::readGold();
        $itemsCoin = Feed::readCoin();
        return view($this->pathViewController.'index',[
            'items' => $data,
            'itemsGold'=>$itemsGold,
            'itemsCoin'=>$itemsCoin,
        ]);
        
    }

}
