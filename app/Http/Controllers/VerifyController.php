<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;

/**
 * 审核员控制器
 * Class VerifyController
 * @package App\Http\Controllers
 */
class VerifyController extends Controller
{
    protected $manager; //登录的管理员的ID
    const STATUS = 1;  //登录的管理员所管理的客户状态分类
    const AUTH = 2;



    protected function getManager(){
        $this->manager = session('manager');
    }
    
    /**
     * 判断权限,进入审核员页面,否则返回该用户应有权限页面
     * @param  Request $request [description]
     * @return view | redirect 进入界面或重定向到该用户拥有权限的界面
     */
    public function index(Request $request)
    {   
        if (!$request->user()) {
                return redirect()->to('login'); 
             }     
        if($request->user()->auths == self::AUTH){
            return view('admin.shenhe');
        }else{
            return redirect()->to('/');
        }
    }

    /**
     * 通过按钮
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function doPass(Request $request){
        $model = new customer;
        $id = $request->input('id');
        $time = date('Y-m-d H:i:s');
        $arr =  $request->has('comment') ? ['passed_at'=>$time,'status'=>2,'comment'=>$request->input('comment')] : ['passed_at'=>$time,'status'=>2];
        $res = $model->where('id',$id)->where('status',1)->update($arr);
        if($res){
            return response('true');
        }else
            return response('false');
    }
    



    /**
     * 拒绝按钮
     * @param Request $request
     * @return string
     */
     public function doDenide(Request $request){
        $model = new customer;
        $id = $request->input('id');
        $time = date('Y-m-d H:i:s');
        $arr = $request->has('comment') ?['denide_at'=>$time,'status'=>3,'comment'=>$request->input('comment')] :['denide_at' => $time, 'status'=>3];
        $res = $model->where('id',$id)->where('status',1)->update($arr);
        if($res){
            return response('true');
        }else
            return response('false');
    }
    

    /**
     * 显示客户信息||获取新用户按钮
     * @param  integer $limit [每页客户数]
     * @return [type]         [含有客户信息的json数组]
     */
    public function showCustom($limit = 5){
        $model = new customer();
        $this->getManager();
        $count = $model->where('verifyBy',$this->manager)->where('status',self::STATUS)->count();
        if ($count <5) {
            $model->where(['status'=>0,'verifyBy'=>0])->whereIn('type',['A','B','C'])->orderBy('create_at')->limit(1)->update(['verifyBy'=>$this->manager,'status' => self::STATUS]);
        }
        $c = ['customers.*'];
        $ci = ['wx_name', 'wx_img', 'wx_sex', 'wx_addr', 'wangling', 'zhimafen', 'jdbaitiao', 'huabei'];
        $cf = ['jiekuanyongtu', 'position', 'idCard_img','auth_jd', 'auth_tb', 'auth_yys', 'auth_zfb', 'money_wanted'];
        $cc = ['fname', 'fphone', 'mname', 'mphone', 'pname', 'pphone', 'yname', 'yphone', 'lname', 'lphone'];
        foreach ($ci as $v) {
            $ci_r[] = 'custom_infos.' . $v;
        };
        foreach ($cf as $v) {
            $cf_r[] = 'custom_forms.' . $v;
        }
        foreach ($cc as $v) {
            $cc_r[] = 'custom_contecters.' . $v;
        }

        $arr = array_merge($c ,$ci_r ,$cf_r ,$cc_r);

        $info = $model->select($arr)->leftJoin('custom_forms', 'customers.wx_openid', '=', 'custom_forms.uid')->
            leftJoin('custom_infos','customers.wx_openid','=','custom_infos.wxid')->
            leftJoin('custom_contecters','customers.wx_openid','=','custom_contecters.uid')->where('customers.verifyBy',$this->manager)->
            where('status',self::STATUS)->DISTINCT()->limit($limit)->get()->toArray();
        $new = $this->countNew();
        
        for($i=0;$i<$limit;$i++){
            if (empty($info[$i])) {
                continue;
            }
            $info[$i]['shenfenzheng_img'] = unserialize($info[$i]['shenfenzheng_img']);
            $info[$i]['verifyBy'] = $this->getName( $info[$i]['verifyBy'], true );
        }
        
        return response()->json(['info'=>$info,'new'=>$new],200);
        
    }

    /**
     * 日新增用户数, 昨日新增用户处
     */
    public function countNew(){
        $time = date('Ymd');
        $model = new customer();
        $this->getManager();
        $c_today = $model->count_passed($this->manager,$time);

        $time = date('Ymd')-1;
        $c_yesterday = $model->count_passed($this->manager,$time);

        return [$c_today,$c_yesterday];
    }

    /**
     * 显示审核员姓名
     * @param  integer $id       [description]
     * @param  boolean $verifyBy [description]
     * @return [type]            [description]
     */
    public function getName($id = 1,$verifyBy = false){
        $model = new customer();
        return $model->managerName($id,$verifyBy);
    }


    /**
     * 搜索栏
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function searchBar(Request $request)
        {
            $model = new customer;
            if ($request->has('type') && $request->has('value')) {
                $data[$request->input('type')] = $request->input('value');
                $table = $model->getTable();
                $res = $model
                    ->where(function ($query) use ($data, $table) {
                        if (isset($data['id'])) {
                            $query->where($table . '.id', '=', trim($data['id']));
                        }
                    })
                    ->where(function ($query) use ($data, $table) {
                        if (isset($data['name'])) {
                            $query->where($table . '.name', '=', trim($data['name']));
                        }
                    })
                    ->where(function ($query) use ($data, $table) {
                        if (isset($data['phone'])) {
                            $query->where($table . '.phone', '=', trim($data['phone']));
                        }
                    })
                    ->where(function ($query) use ($data, $table) {
                        if (isset($data['idCard'])) {
                            $query->where($table . '.idCard', '=', trim($data['idCard']));
                        }
                    })
                    ->first();

                if ($res) {
                    $info = $model->from('custom_infos')->where('custom_infos.wxid',$res->wx_openid)
                        ->leftJoin('custom_forms','custom_forms.uid','=','custom_infos.wxid')
                        ->leftJoin('custom_contecters','custom_contecters.uid','=','custom_infos.wxid')
                        ->first()->toArray();

                    $jk = $model->from('customer_jiekuan')->where('wx_openid',$res->wx_openid)->orderBy('add_time')->get()->toArray();
                    unset($info['id']);
                    foreach ($jk as $k=>$v){
                        $jk[$k]['cs'] = $model->from('customer_cuishou')->where('jk_id',$v['id'])->get()->toArray();
                        $jk[$k]['yanqi'] = $model->from('customer_yanqi')->where('jk_id',$v['id'])->get()->toArray();
                    }
                    $res = $res->toArray();
                    $res['verifyBy'] = $this->getName( $res['verifyBy'], true );
                    $result = array_merge($res,$info);
                    $result['shenfenzheng_img'] = unserialize($result['shenfenzheng_img']);
                    
                    return ['info'=>$result, 'jk'=>$jk];
                } else {
                    return 'false';
                }
            } else {
                return 'false';
            }

        }
}