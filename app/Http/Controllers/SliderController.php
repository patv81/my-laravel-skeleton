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

    public function index(Request $request){ 
        $this->params['filter']['status'] = $request->get('filter_status','all');
        $this->params['search']['field'] = $request->get('search_field','all');
        $this->params['search']['value'] = $request->get('search_value','');

        echo '<pre>' ;
        print_r($this->params); 
        echo'</pre>';
        $items = $this->model->listItems($this->params,['task'=> 'admin-list-items' ]);
        $itemsStatusCount = $this->model->countItems($this->params,['task'=> 'admin-count-items-group-by-status']);
        return view($this->pathViewController.'index',[
            'items'=>$items,
            'itemsStatusCount'=>$itemsStatusCount,
            'params'=>$this->params,
        ]);
    }
}
