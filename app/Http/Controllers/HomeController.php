<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as SliderModel;
use App\Models\CategoryModel ;
use App\Models\ArticleModel ;
class HomeController extends Controller
{
    private $pathViewController='news.pages.home.';
    private $controllerName='home';
    private $model;
    private $params=[];
    public function __construct(){
        view()->share('controllerName',$this->controllerName);
    }

    public function index(Request $request){ 
        $slidermodel = new SliderModel();
        $categorymodel = new CategoryModel();
        $articlemodel = new ArticleModel();
        $itemsSlider = $slidermodel->listItems(null,['task'=>'news-list-items']);
        $itemsCategory = $categorymodel->listItems(null,['task'=>'news-list-items-is-home']);
        $itemsFeatured = $articlemodel->listItems(null,['task'=>'news-list-items-featured']);

        return view($this->pathViewController.'index',[
            'params'=>$this->params,
            'itemsSlider'=>$itemsSlider,
            'itemsCategory' =>$itemsCategory,
            'itemsFeatured' =>$itemsFeatured,
        ]);
        
    }

}
