<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Form;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;

class WeixinController extends Controller
{

    /**
     * WeixinController constructor.
     * @param Request $request
     */
    // public function __construct(Request $request)
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request){

        if(!Auth::user()){
            return view('auth.login');
        }
        
        session(['manager'=>$request->user()->id]);

        switch (Auth::User()->auths) {
            case '1' :
                return view('admin.manager');
                // return redirect()->action('ManagerController@index');
            case '2' :
                return view('admin.shenhe');
                // return redirect()->action('VerifyController@index');
            case '3' :
                return view('admin.fangkuan');
                // return redirect()->action('JkController@index');
            case '4' :
                return view('admin.cuishou');
                // return redirect()->action('CsController@index');
        }
    }  
}

