<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
class SliderController extends Controller
{
    private $pathViewController='admin.slider.';
    private $controllerName='slider';
    private $model;
    public function __construct(){
        $this->model = new MainModel();
        view()->share('controllername',$this->controllerName);
    }

    public function index(){ 
        $items = $this->model->listItems(null,['task'=> 'admin-list-items' ]);
        return view($this->pathViewController.'index',['items'=>$items]);
    }
}
