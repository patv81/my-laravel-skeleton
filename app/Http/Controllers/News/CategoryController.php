<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as SliderModel;
use App\Models\CategoryModel ;
use App\Models\ArticleModel ;
class CategoryController extends Controller
{
    private $pathViewController='news.pages.category.';
    private $controllerName='home';
    private $model;
    private $params=[];
    public function __construct(){
        view()->share('controllerName',$this->controllerName);
    }

    public function index(Request $request){ 
        $categorymodel = new CategoryModel();
        $articlemodel = new ArticleModel();
        $params['category_id'] = $request->category_id;
        $itemCategory = $categorymodel->getItem($params,['task'=>'news-get-item']);
        if (empty($itemCategory)){
            return redirect()->route('home');
        }
        $itemCategory['articles'] = $articlemodel->listItems(['id'=>$itemCategory['id']],['task'=>'news-list-items-in-category']);

        $itemsFeatured = $articlemodel->listItems(null,['task'=>'news-list-items-featured']);
        $itemsLatest = $articlemodel->listItems(null,['task'=>'news-list-items-latest']);
        
        return view($this->pathViewController.'index',[
            'params'=>$this->params,
            'itemCategory' =>$itemCategory,
            'itemsFeatured' =>$itemsFeatured,
            'itemsLatest' =>$itemsLatest,
        ]);
        
    }

}
