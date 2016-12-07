<?php

namespace App\Http\Controllers;

use App\Models\admin_user;
use App\Models\list_loan;
use Illuminate\Http\Request;
use App\Models\customer;
use DB;
use Illuminate\Auth\Access\Response;

class ManagerController extends Controller
{
    public $year;
    public $month;
    public $day;
    public $admin=1;
    public $time;
    public $mod = 'App\Models\admin_user';
    const AUTH = 1;


    public function __construct(Request $request)
    {
        //让前端传值传百分号
        $this->year = $request->input('year')!=0 ? $request->input('year') : date('Y');
        $this->month = $request->input('month')!=0 ? $request->input('month') : date('m');
        $this->admin = $request->has('admin')!=0 ? $request->input('admin') : '';
        $this->admin = $request->has('day')!=0 ? $request->input('day') : date('day');


//        $this->year = date('Y');
//        $this->month = date('m');
//        $this->day = date('d');
//        $this->admin = 1;
    }

    /**
     * 登录页面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {   
        // dd(Auth::user());
        if (!$request->user()) {
            return redirect()->to('login'); 
        }     
        if($request->user()->auths == self::AUTH){
            $this->manager = Auth::user()->id;
            return view('admin.fangkuan',['manager'=>$this->manager]);
        }else{
            return redirect()->to('/');
        }
    }

    public function count_apply()
    {

        $model = new customer;
        //todo::设置接收单独表单传值, 设置可接时间区间传值,
        $res = $model->where('manager', $this->admin)->where(date_format(created_at, '%Y%m%d'), $this->year.$this->month.$this->day)->count();

        return $res;
    }

    /**
     * 日新增通过量方法
     * @param Request $request;
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

            for($i=1;$i<=12;$i++) {
                $time = $this->year.$i;
                $arr[] = $model->selectRaw('round((t1.co/t2.totalCo)*100,1) as delay')->from(DB::raw("(select sum(`money`) as co from list_loans
                    where status='2' and date_format(created_at,'%Y%m') = '{$time}')t1,
                    (select sum(`money`) as totalCo from list_loans where date_format(created_at,'%Y%m') = '{$time}')t2"))->toSql();
            };

            $row = '';
            foreach ($arr as $v) {
                $row .= $v.'union';
                $sql = rtrim($row,'union');
            }

            DB::raw($sql);

            var_dump($sql);

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
        return ['apply'=>1,'passed' => $this->count_passed(), 'new' => $this->out_money(), 'outMoney'=> $this->total_out_money(), 'delay'=>$this->total_delay()];
    }

    public function rect(){
        $this->time_delay();
    }

    public function test(){
        dd($this->year,$this->month,$this->day,$this->admin);
    }

}
