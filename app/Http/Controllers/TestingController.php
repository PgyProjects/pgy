<?php

namespace App\Http\Controllers;

use App\Models\admin_user;
use App\Models\list_loan;
use Illuminate\Http\Request;
use App\Models\customer;
use DB;
use Illuminate\Auth\Access\Response;

class TestingController extends Controller
{
    public $year;
    public $month;
    public $day;
    public $admin=1;
    public $time;
    public $mod = 'App\Models\admin_user';


    public function __construct(Request $request)
    {
        //让前端传值传百分号
//        $this->year = $request->has('year') ? $request->input('year') : date('Y');
//        $this->month = $request->has('month') ? $request->input('year') : date('m');
//        $this->admin = $request->has('admin') ? $request->input('year') : '';
//        $this->admin = $request->has('day') ? $request->input('day') : date('day');

        $this->year = date('Y');
        $this->month = date('m');
        $this->day = date('d');
        $this->admin = 1;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 新增申请量 默认当日
     * @return mixed
     */
    public function count_apply()
    {

        $model = new customer;
        //todo::设置接收单独表单传值, 设置可接时间区间传值,
        $res = $model->where('manager', $this->admin)->where(date_format('created_at', '%Y%m%d'), $this->year.$this->month.$this->day)->count();

        return $res;
    }

    /**
     * 日新增通过量方法
     * @param Request $request
     */
    public function count_passed()
    {
        $model = new customer();
        return $res = $model->where('manager',$this->admin) -> where('status','2')->count();
    }

    /**
     * 总放款金额方法
     */
    public function total_out_money()
    {
        $model = new list_loan();
        return $model->sum('money');
    }

    /**
     * 日放款金额和人数方法
     */
    public function out_money()
    {
        $model = new list_loan();
        return $model ->selectRaw("count(*) as newCostom ,sum(money) as outMoney")->where('created_at',$this->time)->get()->toArray();
    }

    /**
     * 总逾期率
     */
    public function total_delay()
    {
        $model = new list_loan();
        return $model->selectRaw('round((t1.co/t2.totalCo)*100,1) as delay')->from(DB::raw(
            "(select sum(`money`) as co from list_loans where status='2')t1, (select sum(`money`) as totalCo from list_loans)t2"
        ))->get()->toArray();
    }

    /**
     * 阶段逾期率
     * TODO:: 测试SQL注入是否有效防护 如果没有 想办法过滤传入参数
     */
    public function time_delay()
    {
        $model = new list_loan();
        return $model->selectRaw ('round((t1.co/t2.totalCo)*100,1) as time_delay')->from (DB::raw("(select sum(`money`) as co from list_loans where status='2' where create_at = $this->time)t1, (select sum(`money`) as totalCo from list_loans where create_at = $this->time)t2"))->get()->toArray();
    }

    /**
     * 显示客户数据的方法
     * TODO:: 这个方法要整合 通过数据控制查哪些数据;
     */
    public function show_customer(){
        $model = new customer;
        return $model->select('*,a.*')->join('custom_info as a','id','=','a.id')->orderby('create_at','desc') -> paginate(10)->toArray();
    }

    /**
     * 显示以上数据的综合方法, TODO::测试阶段
     */
    public function nav(){
//        $this->count_apply()=1;


        // return ['apply'=>1,'passed' => $this->count_passed(), 'new' => $this->out_money(), 'outMoney'=> $this->total_out_money(), 'delay'=>$this->total_delay()];
        return ["apply"=>1,"passed"=>0,"new"=>array("newCostom"=>98,"outMoney"=>"239454"),"outMoney"=>"244710","delay"=>array("delay"=>"50.0")];
    }

    public function showInfo(){
        return Array('custom'=>Array('total'=>'2','per_page'=>'10','current_page'=>'1','last_page'=>'1','next_page_url'=>'','prev_page_url'=>'','from'=>'1','to'=>'2','data'=>Array('0'=>Array('id'=>'1','wx_openid'=>'JBf4iyRkff','name'=>'DVLOSpJMTV','idCard'=>'692028428531355','phone'=>'156414048849708','education'=>'1','company'=>'VNZwABWEal','address'=>'zzF0G3kcTt','email'=>'RYaorfFB5K@gmail.com','ip'=>'0','input_zhima'=>'456','sex'=>'2','age'=>'23','hujidizhi'=>'ERaKR31Ckj','created_at'=>'','manager'=>'1','updated_at'=>'2016-11-1803:37:50','status'=>'1'),'1'=>Array('id'=>'2','wx_openid'=>'i2JM0BfQ9a','name'=>'AAqEoXxnrD','idCard'=>'751923118355788','phone'=>'997072822052158','education'=>'3','company'=>'EkHEJau6ms','address'=>'sXnshA2PTn','email'=>'lxTTPb5y3J@gmail.com','ip'=>'0','input_zhima'=>'297','sex'=>'2','age'=>'20','hujidizhi'=>'zSy84ZsLTn','created_at'=>'','manager'=>'1','updated_at'=>'2016-11-1803:38:21','status'=>'1'))),'info'=>Array('0'=>Array('id'=>'12','uid'=>'1','wx_name'=>'NUEmw92TYX','wx_img'=>'UNg0RLYTNl','wx_sex'=>'0','wx_addr'=>'wIwSEfX047','wangling'=>'3','zhimafen'=>'380','jdbaitiao'=>'2365','huabei'=>'4695','loan_times'=>'3','loan_sum'=>'61404','created_at'=>'','updated_at'=>''),'1'=>Array('id'=>'15','uid'=>'2','wx_name'=>'BaYp0UdUTx','wx_img'=>'O5kLKi7wRq','wx_sex'=>'0','wx_addr'=>'NxPcpRNEu0','wangling'=>'1','zhimafen'=>'753','jdbaitiao'=>'2075','huabei'=>'4215','loan_times'=>'1','loan_sum'=>'40114','created_at'=>'','updated_at'=>'')),'form'=>Array('0'=>Array('id'=>'29','uid'=>'1','jiekuanyongtu'=>'TyvLf','position'=>'aoNCpcny4oqNQL4ToRc3','idCard_img'=>'Ux86V51jtboOvRgTH8','auth_jd'=>'2','auth_tb'=>'2','auth_yys'=>'1','auth_zfb'=>'2','money_wanted'=>'2011','created_at'=>'','updated_at'=>''),'1'=>Array('id'=>'43','uid'=>'2','jiekuanyongtu'=>'g0qJe','position'=>'8JCqPE7bAXvvoTdVzxbM','idCard_img'=>'f6HZBBCrZhF7T6akz5','auth_jd'=>'1','auth_tb'=>'1','auth_yys'=>'2','auth_zfb'=>'1','money_wanted'=>'3672','created_at'=>'','updated_at'=>'')),'conn'=>Array('0'=>Array('id'=>'1','uid'=>'1','fname'=>'638569020','fphone'=>'85oHXQuiZZu','mname'=>'mrJH','mphone'=>'10633941848','pname'=>'2','pphone'=>'3','yname'=>'3','yphone'=>'1','lname'=>'2','lphone'=>'3','created_at'=>'','updated_at'=>''),'1'=>Array('id'=>'2','uid'=>'2','fname'=>'391601829','fphone'=>'TKl6alaowH9','mname'=>'1Lku','mphone'=>'8871623433','pname'=>'2','pphone'=>'3','yname'=>'2','yphone'=>'3','lname'=>'3','lphone'=>'1','created_at'=>'','updated_at'=>'')));
    }

    public function showInfo2(){
       dd(Array('custom'=>Array('total'=>'2','per_page'=>'10','current_page'=>'1','last_page'=>'1','next_page_url'=>'','prev_page_url'=>'','from'=>'1','to'=>'2','data'=>Array('0'=>Array('id'=>'1','wx_openid'=>'JBf4iyRkff','name'=>'DVLOSpJMTV','idCard'=>'692028428531355','phone'=>'156414048849708','education'=>'1','company'=>'VNZwABWEal','address'=>'zzF0G3kcTt','email'=>'RYaorfFB5K@gmail.com','ip'=>'0','input_zhima'=>'456','sex'=>'2','age'=>'23','hujidizhi'=>'ERaKR31Ckj','created_at'=>'','manager'=>'1','updated_at'=>'2016-11-1803:37:50','status'=>'1'),'1'=>Array('id'=>'2','wx_openid'=>'i2JM0BfQ9a','name'=>'AAqEoXxnrD','idCard'=>'751923118355788','phone'=>'997072822052158','education'=>'3','company'=>'EkHEJau6ms','address'=>'sXnshA2PTn','email'=>'lxTTPb5y3J@gmail.com','ip'=>'0','input_zhima'=>'297','sex'=>'2','age'=>'20','hujidizhi'=>'zSy84ZsLTn','created_at'=>'','manager'=>'1','updated_at'=>'2016-11-1803:38:21','status'=>'1'))),'info'=>Array('0'=>Array('id'=>'12','uid'=>'1','wx_name'=>'NUEmw92TYX','wx_img'=>'UNg0RLYTNl','wx_sex'=>'0','wx_addr'=>'wIwSEfX047','wangling'=>'3','zhimafen'=>'380','jdbaitiao'=>'2365','huabei'=>'4695','loan_times'=>'3','loan_sum'=>'61404','created_at'=>'','updated_at'=>''),'1'=>Array('id'=>'15','uid'=>'2','wx_name'=>'BaYp0UdUTx','wx_img'=>'O5kLKi7wRq','wx_sex'=>'0','wx_addr'=>'NxPcpRNEu0','wangling'=>'1','zhimafen'=>'753','jdbaitiao'=>'2075','huabei'=>'4215','loan_times'=>'1','loan_sum'=>'40114','created_at'=>'','updated_at'=>'')),'form'=>Array('0'=>Array('id'=>'29','uid'=>'1','jiekuanyongtu'=>'TyvLf','position'=>'aoNCpcny4oqNQL4ToRc3','idCard_img'=>'Ux86V51jtboOvRgTH8','auth_jd'=>'2','auth_tb'=>'2','auth_yys'=>'1','auth_zfb'=>'2','money_wanted'=>'2011','created_at'=>'','updated_at'=>''),'1'=>Array('id'=>'43','uid'=>'2','jiekuanyongtu'=>'g0qJe','position'=>'8JCqPE7bAXvvoTdVzxbM','idCard_img'=>'f6HZBBCrZhF7T6akz5','auth_jd'=>'1','auth_tb'=>'1','auth_yys'=>'2','auth_zfb'=>'1','money_wanted'=>'3672','created_at'=>'','updated_at'=>'')),'conn'=>Array('0'=>Array('id'=>'1','uid'=>'1','fname'=>'638569020','fphone'=>'85oHXQuiZZu','mname'=>'mrJH','mphone'=>'10633941848','pname'=>'2','pphone'=>'3','yname'=>'3','yphone'=>'1','lname'=>'2','lphone'=>'3','created_at'=>'','updated_at'=>''),'1'=>Array('id'=>'2','uid'=>'2','fname'=>'391601829','fphone'=>'TKl6alaowH9','mname'=>'1Lku','mphone'=>'8871623433','pname'=>'2','pphone'=>'3','yname'=>'2','yphone'=>'3','lname'=>'3','lphone'=>'1','created_at'=>'','updated_at'=>''))));
    }

    /**
     * 获取用户信息
     * @param string $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCustom($limit = 'limit 5'){
        $this->manager = 1;
        $this->status =1; 
        $model = new customer();
        $wxid = 1;
        $c = ['customers.*'];
        $ci = ['wx_name', 'wx_img', 'wx_sex', 'wx_addr', 'wangling', 'zhimafen', 'jdbaitiao', 'huabei'];
        $cf = ['jiekuanyongtu', 'position', 'idCard_img', 'auth_jd', 'auth_tb', 'auth_yys', 'auth_zfb', 'money_wanted'];
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

        $info = $model->select($arr)->leftJoin('custom_forms', 'customers.wx_openid', '=', 'custom_forms.uid')->leftJoin('custom_infos','customers.wx_openid','=','custom_infos.wxid')->
        leftJoin('custom_contecters','customers.wx_openid','=','custom_contecters.uid')->where('customers.manager',$this->manager)->where('status',$this->status)->DISTINCT()->get()->toArray();

        return response()->json($info,200);
    }
}    