<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('test','Controller@ceshi');
    Route::get('wang','Test2Controller@wang');
    Route::get('wang2','CeshiController@wang2');
    Route::get('home','HomeController@index');
    Route::get('home/index_2','HomeController@index_2');
    Route::get('home/index_3','HomeController@index_3');
    Route::get('home/index_4','HomeController@index_4');
    Route::any('home/bd1','HomeController@bd1');
    Route::any('home/bd2','HomeController@bd2');
    Route::any('home/bd3','HomeController@bd3');
    Route::any('home/bd1_ajax','HomeController@bd1_ajax');
    Route::any('home/shenfenzheng_ajax','HomeController@shenfenzheng_ajax');
    Route::any('home/kongzhi_ajax','HomeController@kongzhi_ajax');
    Route::any('home/index_3_jk','HomeController@index_3_jk');
    Route::any('home/index_4_tj_info','HomeController@index_4_tj_info');
    Route::get('jxl/tbqutoken','JxlapiController@tbqutoken');
    Route::get('jxl/tb1','JxlapiController@tb1');
    Route::get('jxl/tb2','JxlapiController@tb2');
    Route::any('jxl/tb1_ajax','JxlapiController@tb1_ajax');
    Route::any('jxl/tb1_ajax_ok','JxlapiController@tb1_ajax_ok');
    Route::any('jxl/jdqutoken','JxlapiController@jdqutoken');
    Route::any('jxl/jd1','JxlapiController@jd1');
    Route::any('jxl/jd2','JxlapiController@jd2');
    Route::any('jxl/jd3','JxlapiController@jd3');
    Route::any('jxl/jd1_ajax','JxlapiController@jd1_ajax');
    Route::any('jxl/jd2_ajax','JxlapiController@jd2_ajax');
    Route::any('jxl/yys1','JxlapiController@yys1');
    Route::any('jxl/yys1_ajax','JxlapiController@yys1_ajax');
    Route::any('jxl/yys2','JxlapiController@yys2');
    Route::any('jxl/yys2_ajax','JxlapiController@yys2_ajax');

    //丁丁
    Route::any('admin/hd','JxlapiController@dd_hd');
    Route::any('admin/hd2','JxlapiController@dd_hd2');
    Route::any('admin/hd3','JxlapiController@dd_hd3');

    //芝麻信用
    Route::any('zmxy/ceshi5','JxlapiController@ceshi5');
    Route::any('zmxy/index','JxlapiController@zmxyindex');
    Route::any('zmxy/zmxyopenid','JxlapiController@zmxyopenid');

    //短信
    Route::any('sms','JxlapiController@sms');

    //微信模板消息
    Route::any('wxmsg','JxlapiController@wang_weixin_msg1');

});



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




//借款
Route::get('/jkapi/page_ajax/{current}', 'JkController@getUserList');
Route::get('/jkapi/page_ajax2/{current}', 'JkController@getUserListFiltered');
Route::get('/jkapi/detail', 'JkController@getDetail');
Route::get('/jkapi/doBack', 'JkController@doBack');
Route::get('/jkapi/doContinue', 'JkController@doContinue');
Route::get('/jkapi/doDelay', 'JkController@doDelay');

//Route::post();
//催收





//微信路由


//微信路由

Route::group(['prefix'=>'weixin'],function() {
    Route::get('erweima', 'WeixinController@erweima');
    Route::get('information', 'WeixinController@information');
    Route::post('information', 'WeixinController@post_information');
    Route::get('jk1', 'WeixinController@jk1');
    Route::get('jk2', 'WeixinController@jk2');
    Route::get('tj_info', 'WeixinController@tj_info');
    Route::get('bd1', 'WeixinController@bd1');
    Route::get('bd2', 'WeixinController@bd2');
    Route::get('bd3', 'WeixinController@bd3');
    Route::get('/', 'WeixinController@index');
});

//Route::any('1','testcontroller');
//
//
//
//后台页面相关路由

Route::post('testing','TestingController@testing');
Route::post('test_admin','TestingController@testingAdmin');



Route::any('testing','TestingController@nav');

Route::group(['prefix'=>'admin'],function(){
	Route::get('shenhe',function(){ return view('admin.shenhe'); });
    Route::get('cuishou',function(){ return view('admin.cuishou'); });
    Route::get('fangkuan',function(){ return view('admin.fangkuan'); });
    Route::get('manager',function(){ return view('admin.manager'); });
    Route::any('showInfo','TestingController@showInfo');
    Route::any('nav','ManagerController@nav');
    // Route::any('info','LibController@showInfo'); //作废待修改
    Route::any('test','ManagerController@test');
    Route::any('rect','ManagerController@rect');
    Route::any('pass','VerifyController@doPass');
    Route::any('denide','VerifyController@doDenide');
    Route::any('newCustom','VerifyController@newCustom');
    Route::any('sql','VerifyController@sql');
});
      






