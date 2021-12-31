<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$prefixAdmin = config('myconf.url.prefixAdmin');
$prefixNews = config('myconf.url.prefixNews');
Route::group(['prefix' => $prefixAdmin,'namespace' =>'Admin'], function() {
    //====================================== DASHBOARD ========================================
    $prefix = 'dashboard';
    $controllerName = 'dashboard';
    Route::group(['prefix' => $prefix], function() use ($controllerName) {
        $controller = ucfirst($controllerName). 'Controller@';
        Route::get('/',                    ['as' =>        $controllerName,                         'uses'=> $controller.'index']);

    });

    //====================================== SLIDER ===========================================
    $prefix = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                          ['as' =>    $controllerName,             'uses' => $controller . 'index']);
        Route::post('save',                      ['as' =>    $controllerName.'/save',     'uses' => $controller . 'save']);
        Route::get('form/{id?}',                 ['as' =>    $controllerName.'/form',     'uses' => $controller . 'form']);
        Route::get('delete/{id}',                ['as' =>    $controllerName.'/delete',   'uses' => $controller . 'delete']);
        Route::get('change-status-{status}/{id}',['as' =>    $controllerName.'/status',   'uses' => $controller . 'status'])->where('id','[0-9]+');
    });
    //====================================== CATEGORY ===========================================
    $prefix = 'category';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                            ['as' =>    $controllerName,             'uses' => $controller . 'index']);
        Route::post('save',                        ['as' =>    $controllerName.'/save',     'uses' => $controller . 'save']);
        Route::get('form/{id?}',                   ['as' =>    $controllerName.'/form',     'uses' => $controller . 'form']);
        Route::get('delete/{id}',                  ['as' =>    $controllerName.'/delete',   'uses' => $controller . 'delete']);
        Route::get('change-status-{status}/{id}',  ['as' =>    $controllerName.'/status',   'uses' => $controller . 'status'])->where('id','[0-9]+');
        Route::get('change-is-home-{isHome}/{id}', ['as' =>    $controllerName.'/isHome',   'uses' => $controller . 'isHome'])->where('id','[0-9]+');
        Route::get('change-display-{display}/{id}',['as' =>    $controllerName.'/display',  'uses' => $controller . 'display'])->where('id','[0-9]+');
    });
    //====================================== CATEGORY ===========================================
    $prefix = 'article';
    $controllerName = 'article';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as' =>    $controllerName,             'uses' => $controller . 'index']);
        Route::post('save',                         ['as' =>    $controllerName.'/save',     'uses' => $controller . 'save']);
        Route::get('form/{id?}',                    ['as' =>    $controllerName.'/form',     'uses' => $controller . 'form']);
        Route::get('delete/{id}',                   ['as' =>    $controllerName.'/delete',   'uses' => $controller . 'delete']);
        Route::get('change-status-{status}/{id}',   ['as' =>    $controllerName.'/status',   'uses' => $controller . 'status'])->where('id','[0-9]+');
        Route::get('change-type-{type}/{id}',       ['as' =>    $controllerName.'/type',     'uses' => $controller . 'type'])->where('id','[0-9]+');
    });
});


Route::group(['prefix' => $prefixNews, 'namespace'=>'News'], function() {    
    //====================================== HOMEPAGE ===========================================
    $prefix = '';
    $controllerName = 'home';
    Route::group(['prefix' => $prefix], function() use ($controllerName) {
        $controller = ucfirst($controllerName). 'Controller@';
        Route::get('/',                                      ['as' =>     $controllerName,            'uses'=> $controller.'index']);

    });
    $prefix = 'chuyen-muc';
    $controllerName = 'category';
    Route::group(['prefix' => $prefix], function() use ($controllerName) {
        $controller = ucfirst($controllerName). 'Controller@';
        Route::get('/{category_name}-{category_id}.html',    ['as' =>  $controllerName.'/index',  'uses'=> $controller.'index'])
        ->where('category_id', '[0-9]+')
        ->where('category_name', '[a-zA-Z0-9_-]+');
    });
    
});
