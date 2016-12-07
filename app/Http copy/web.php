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



//借款
Route::get('/jkapi/page_ajax/{current}', 'JkController@getUserList');
Route::get('/jkapi/page_ajax2/{current}', 'JkController@getUserListFiltered');
Route::get('/jkapi/detail', 'JkController@getDetail');
Route::get('/jkapi/doBack', 'JkController@doBack');
Route::get('/jkapi/doContinue', 'JkController@doContinue');
Route::get('/jkapi/doDelay', 'JkController@doDelay');
//催收

//微信

	

Route::any('weixin/erweima','WeixinController@erweima');
Route::any('weixin/jk1','WeixinController@jk1');
Route::any('weixin/jk2','WeixinController@jk2');
Route::any('weixin/tj_info','WeixinController@tj_info');
Route::any('weixin','WeixinController@index');
