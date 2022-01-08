<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Models\UserModel;
class AuthController extends Controller
{
    private $pathViewController = 'news.pages.auth.';
    private $controllerName = 'auth';
    private $model;
    private $params = [];
    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function login(Request $request)
    {
        
        return view($this->pathViewController . 'login', [
        ]);
    }
    public function postLogin(MainRequest $request){
        $userModel = new UserModel();
        if ($request->method() == 'POST'){
            $params = $request->all();
            $userInfo = $userModel->getItem($params,['task' =>'auth-login']);
            if (!$userInfo){
                return redirect()->route("$this->controllerName/login")->with('news_notify','tài khoản hoặc mật khẩu không chính xác');
            }else{
                $request->session()->put('userInfo',$userInfo);
                return redirect()->route("home");
            }
        }
    }
    public function logout(Request $request){
        if ($request->session()->has('userInfo')){
            $request->session()->pull('userInfo');
            return redirect()->route("home");
        }
    }
}
