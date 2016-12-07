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




    // Route::get('/welcome', function () {
    //    return view('welcome');
    // }); 
    Route::get('/', 'WeixinController@index');


    Route::get('test', 'Controller@ceshi');
    Route::get('wang', 'Test2Controller@wang');
    Route::get('wang2', 'CeshiController@wang2');
    Route::get('home', 'HomeController@index');
    Route::get('home/index_2', 'HomeController@index_2');
    Route::get('home/index_3', 'HomeController@index_3');
    Route::get('home/index_4', 'HomeController@index_4');
    Route::any('home/bd1', 'HomeController@bd1');
    Route::any('home/bd2', 'HomeController@bd2');
    Route::any('home/bd3', 'HomeController@bd3');
    Route::any('home/bd1_ajax', 'HomeController@bd1_ajax');
    Route::any('home/shenfenzheng_ajax', 'HomeController@shenfenzheng_ajax');
    Route::any('home/kongzhi_ajax', 'HomeController@kongzhi_ajax');
    Route::any('home/index_3_jk', 'HomeController@index_3_jk');
    Route::any('home/index_4_tj_info', 'HomeController@index_4_tj_info');
    Route::any('home/khjl',function(){ return view('home.khjl');});
    Route::get('jxl/tbqutoken', 'JxlapiController@tbqutoken');
    Route::get('jxl/tb1', 'JxlapiController@tb1');
    Route::get('jxl/tb2', 'JxlapiController@tb2');
    Route::any('jxl/tb1_ajax', 'JxlapiController@tb1_ajax');
    Route::any('jxl/tb1_ajax_ok', 'JxlapiController@tb1_ajax_ok');
    Route::any('jxl/jdqutoken', 'JxlapiController@jdqutoken');
    Route::any('jxl/jd1', 'JxlapiController@jd1');
    Route::any('jxl/jd2', 'JxlapiController@jd2');
    Route::any('jxl/jd3', 'JxlapiController@jd3');
    Route::any('jxl/jd1_ajax', 'JxlapiController@jd1_ajax');
    Route::any('jxl/jd2_ajax', 'JxlapiController@jd2_ajax');


    Route::any('jxl/yysqutoken', 'JxlapiController@yysqutoken');
    Route::any('jxl/yys1', 'JxlapiController@yys1');
    Route::any('jxl/yys1_ajax', 'JxlapiController@yys1_ajax');
    Route::any('jxl/yys2', 'JxlapiController@yys2');
    Route::any('jxl/yys2_ajax', 'JxlapiController@yys2_ajax');

    //丁丁
    Route::any('admin/hd', 'JxlapiController@dd_hd');
    Route::any('admin/hd2', 'JxlapiController@dd_hd2');
    Route::any('admin/hd3', 'JxlapiController@dd_hd3');

    //芝麻信用
    Route::any('zmxy/ceshi5', 'JxlapiController@ceshi5');
    Route::any('zmxy/index', 'JxlapiController@zmxyindex');
    Route::any('zmxy/zmxyopenid', 'JxlapiController@zmxyopenid');

    //短信
    Route::any('sms', 'JxlapiController@sms');

    //微信模板消息
    Route::any('wxmsg', 'JxlapiController@wang_weixin_msg1');




    //借款
    Route::any('/jkapi/page_ajax/{current}', 'JkController@getUserList');
    Route::any('/jkapi/page_ajax2/{current}', 'JkController@getUserListFiltered');
    Route::any('/jkapi/detail/{wxid}', 'JkController@getDetail');
    Route::any('/jkapi/payoff', 'JkController@doPayoff');
    Route::any('/jkapi/continue', 'JkController@doContinue');
    Route::any('/jkapi/delay', 'JkController@doDelay');
    Route::any('/jkapi/weifangkuan', 'JkController@doWeiFangkuan');
    Route::any('/jkapi/fangkuan', 'JkController@doFangkuan');

    //催收
    Route::any('/csapi/page_ajax/{current}', 'CsController@getUserList');
    Route::any('/csapi/page_ajax2/{current}', 'CsController@getUserListFiltered');
    Route::any('/csapi/detail/{jk_id}', 'CsController@getDetail');
    Route::any('/csapi/huankuan', 'CsController@addHuankuan');
    Route::any('/csapi/chengnuo', 'CsController@addChengnuo');
    Route::any('/csapi/delay', 'CsController@addDelay');
    Route::any('/csapi/yuqi', 'CsController@addYuqi');

    Route::any('/jkapi/jkexist/{openid}', 'JkController@hasJkRecord');
    Route::any('/test/test1', 'Lite@testGetFields');
    
    
    Route::any('/jkapi/rawdata/{idcard}', 'JkController@rawdata');

    //微信路由

    Route::group(['prefix' => 'weixin'], function () {
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

    Route::post('testing', 'TestingController@testing');
    Route::post('test_admin', 'TestingController@testingAdmin');




    Route::any('testing', 'TestingController@nav');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('shenhe', 'VerifyController@index');
        Route::get('cuishou', 'CsController@index');
        Route::get('fangkuan', 'JkController@index');
        Route::get('manager', 'ManagerController@index');
        Route::any('pass', 'VerifyController@doPass');
        Route::any('denide', 'VerifyController@doDenide');
        Route::any('newCustom', 'VerifyController@newCustom');
        Route::post('showCustom', 'VerifyController@showCustom');
        Route::any('countNew', 'VerifyController@countNew');
        // Route::get('',function(){ return view(admin.cuishou); });
    });
    
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::any('test2','VerifyController@test2');

    Route::post('searchBar','VerifyController@searchBar');

    