<?php

use DB;
use App\Http\Controller;
use App\weixin;
namespace App\Http\Controllers;

class CeshiController extends Controller
{
	public function wang(){
		echo 'wang';
		//$users = DB::table('jxl_data1')->first();
		//$users=DB::table('jxl_data1')->where('xingming', '张晓成')->get()->toArray();
		//var_dump($users);
		//$weixin = new class_weixin();
		//var_dump($weixin);
	}
	public function wang2(){
		echo 'wang2';
	}
}