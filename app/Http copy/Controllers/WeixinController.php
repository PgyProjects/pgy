<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Form;
use DB;

class WeixinController extends Controller
{
//    public function __construct()
//    {
//        parent::__construct();
//    }

    /**
     * 微信借款主页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //需要传入用户借款额度
        return view('weixin.index');

    }

    /**
     * 用户基本信息填写页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 用户基本信息存入数据库方法
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 显示用户借款记录
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view();
    }

    /**
     * 提额页面(基本信息填写，第三方资料授权)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upgrade()
    {
        return view();
    }

    //私有方法访问微信开发者平台，取得用户微信基本信息存入session，在构造函数中调用
    private function info()
    {
        //通过openid取得用户头像，昵称，性别等信息，存入用户session以备调用
        $_SESSION['openid'];

    }

    //微信提额页面
    public function information()
    {
        return view('weixin.information');
    }

    //微信推荐二维码页面
    public function erweima()
    {
        return view('weixin.erweima');
    }

    //微信借款记录页面(显示当前借款钱数和还款日期)
    public function jk1()
    {
        return view('weixin.jk1');
    }

    //微信推荐信息页面
    public function tj_info()
    {
        return view('weixin.erweima');
    }

    //微信借款记录页面2?
    public function jk2()
    {
        return view('weixin.jk2');
    }

    //表单1
    public function bd1(){
        return view('weixin.bd1');
    }

    //表单2
    public function bd2(){
        return view('weixin.bd2');
    }

    //表单3
    public function bd3(){
        return view('weixin.bd3');
    }

    public function post_information(){
        // $_Session['wx_openid'] = 'JBf4iyRkff';
        $a = '1';
        // $uid = $_Session['wx_openid'];
        $uid = $a;

        DB::connection()->enableQueryLog(); // 开启查询日志

        $res = DB::table('custom_forms')->first();
        $queries = DB::getQueryLog(); // 获取查询日志

        print_r($queries); // 即可查看执行的sql，传入的参数等等

        dd($res);
    }    









}


