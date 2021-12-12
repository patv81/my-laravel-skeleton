<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
class SliderController extends Controller
{
    private $pathViewController='admin.pages.slider.';
    private $controllerName='slider';
    private $model;
    private $params=[];
    public function __construct(){
        $this->model = new MainModel();
        $this->params['pagination']['totalItemPerPage'] = 1;
        view()->share('controllerName',$this->controllerName);
    }

    public function index(){ 
        $items = $this->model->listItems($this->params,['task'=> 'admin-list-items' ]);
        return view($this->pathViewController.'index',['items'=>$items]);
    }
}
