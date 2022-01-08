<?php

namespace App\Http\Controllers\Admin ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserRequest as MainRequest;
class UserController extends Controller
{
    private $pathViewController='admin.pages.user.';
    private $controllerName='user';
    private $model;
    private $params=[];
    public function __construct(){
        $this->model = new MainModel();
        $this->params['pagination']['totalItemPerPage'] = 5;
        view()->share('controllerName',$this->controllerName);
    }

    public function index(Request $request){ 
        
        $this->params['filter']['status'] = $request->get('filter_status','all');
        $this->params['search']['field'] = $request->get('search_field','all');
        $this->params['search']['value'] = $request->get('search_value','');

        $items = $this->model->listItems($this->params,['task'=> 'admin-list-items' ]);

        $itemsStatusCount = $this->model->countItems($this->params,['task'=> 'admin-count-items-group-by-status']);
        return view($this->pathViewController.'index',[
            'items'=>$items,
            'itemsStatusCount'=>$itemsStatusCount,
            'params'=>$this->params,
        ]);
        
    }
    public function status(Request $request){
        $params["currentStatus"]=$request->status;
        $params["id"] =$request->id;
        $this->model->saveItem($params,['task'=>'change-status']);
        return redirect()->route('user')->with('zvn_notify','cập nhập thành công');
    }
    public function delete(Request $request){
        $params["id"] =$request->id;
        $this->model->deleteItem($params,['task'=>'delete-item']);
        return redirect()->route('user')->with('zvn_notify','xóa phần tử '.$params['id'].' thành công');
    }
    public function form(Request $request){

        if($request->id!=null){
            $params['id']=$request->id;
            $item =$this->model->getItem($params,['task'=>'get-item']);
            echo '<pre>' ;
            print_r($item); 
            echo'</pre>';
        }
        return view($this->pathViewController.'form',[
            'item'=>$item??null
        ]);
    }
    public function save(MainRequest $request){
        if ($request->method() == 'POST'){            
            $params = $request->all();
            $task ='add-item';
            $notify= 'Thêm mới thành công';
            if ($params['id']!=null){
                $task ='edit-item';
                unset($params['password']);
                unset($params['level']);
                $notify= 'Cập nhật thành công';
            }
            $this->model->saveItem($params,['task'=>$task]);
            return redirect()->route($this->controllerName)->with("zvn_notify",$notify);
        }
        return redirect()->route($this->controllerName)->with("zvn_notify",'something wrong with saveing');
    }
    public function changePassword(MainRequest $request){
        if ($request->method() == 'POST'){
            $params = $request->all();
            $task = 'change-password';
            $notify ='cập nhật mật khẩu thành công';
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }
    public function level(Request $request)
    {
        $params['currentLevel'] = $request->level;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-level']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'cập nhập level user thành công');
    }
    public function changeLevel(MainRequest $request)
    {
        if($request->method() == 'POST'){
            $params['level'] = $request->level;
            $params['id'] = $request->id;
            $this->model->saveItem($params, ['task' => 'change-level-post']);
            return redirect()->route($this->controllerName)->with('zvn_notify', 'thay đổi level user thành công');
        }
    }
}
