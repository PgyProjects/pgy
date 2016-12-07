<?php

namespace App\Models;

use App\Http\Controllers\ManagerController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use DB;

class customer extends Model
{

    protected $fillable = [
        'name', 'email', 'phone', 'status', 'comment'
    ];

    public $timestamps = false;


    /**
     * 审核员执行通过审核
     * @param $request
     * @return mixed
     */
    public function doPass($id,$comment){
        $obj = $this->findOrFail($id);
        if($obj->status == 1) {
            $time = date('Y-m-d H:i:s');
            // return $obj->update(['status'=>2, 'comment'=>$comment, 'denide_at' => "$time"]);
            return $obj->update(['denide_at' => $time]);
        }else{
            return false;
        }
    }

    /**
     * 审核员执行拒绝通过
     * @param $request
     * @return mixed
     */
   public function doDenide($id,$comment){
        $obj = $this->find($id);
        if($obj->status == 1) {
            $time = date('Y-m-d H:i:s');
            return $obj->update(['status'=>3, 'comment'=>$comment, 'denide_at' => "$time"]);
        }else{
            return false;
        }
    }

    /**
     * 管理员待处理用户数
     * @param $manager
     * @param $status
     * @return mixed
     */
    public function check($manager, $status){
        return $this->where('verifyBy',$manager)->where('status',$status)->count();
    }

    /**
     * 今日新增用户
     * @param $manager
     * @return mixed
     */
    public function count_passed($manager,$time)
    {
        $model = new customer();
        return $model->where('verifyBy',$manager) -> where('status','2') -> whereRaw("date_format(passed_at,'%Y%m%d') = '$time'")->count();
    }

    /**
     * 判断用户类型的方法
     * @param $id
     * @return bool|string
     */
    public function type($id,$is_opneid=false)
    {
        
        if($is_opneid){
            $t = $this->where('wx_openid',$id)->first();
        }else{
            $t = $this->findOrFail($id);
        }
        $y = $this->select('zhimafen')->from('custom_infos')->where('wxid',$t->wx_openid)->first();
        if(empty($y)){
            return false;
        }
        if ($t->age < 25 or $t->age > 36 or ($t->sex == 1 and !in_array($t->education,['大专','本科','本科以上'])) 
            or ($t->sex == 1 and $y['zhimafen'] < 650) or ($t->sex == 2 and $y['zhimafen'] < 600)
            or in_array(mb_substr($t->hujidizhi,0,2), ['新疆','内蒙','西藏','辽宁','吉林','黑龙'])) {
            $res = $this->where('id',$t->id)->update(['status' => 3, 'denide_at' => date("Y-m-d h:i:s"), 'verifyBy' => 999]);
            return false;
        }
        if ($t->sex == 1) {
            if ($y['zhimafen'] >= 720) {
                $res = $this->where('id',$t->id)->update(['type'=>'A']);
                return true;
            } elseif ($y['zhimafen'] >= 700) {
                $res = $this->where('id',$t->id)->update(['type'=>'B']);
                return true;
            } elseif ($y['zhimafen'] >= 650) {
                $res = $this->where('id',$t->id)->update(['type'=>'C']);
                return true;
            } else {
                return false;
            }
        } elseif ($t->sex == 2) {
            if ($y['zhimafen'] >= 700) {
                $res = $this->where('id',$t->id)->update(['type'=>'A']);
                return true;
            } elseif ($y['zhimafen'] >= 650) {
                $res = $this->where('id',$t->id)->update(['type'=>'B']);
                return true;
            } elseif ($y['zhimafen'] >= 600) {
                $res = $this->where('id',$t->id)->update(['type'=>'C']);
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * [managerName description]
     * @param  [type]  $id       传入用户id或管理员id,
     * @param  boolean $verifyBy 默认false, 传入$id的值为管理员id时,设置此参数为true
     * @return [type]            [description]
     */
    public function managerName($id, $verifyBy = false){
        if($verifyBy){
            $tar = $id;
        }else{
            $res = $this->select('verifyBy')->where('id',$id)->first()->toArray();
            $tar = $res['verifyBy'];
        }
        $name = $this->select('name')->from('users')->where('id',$tar)->first();
        if($name){
            $name->toArray();
            return $name['name'];
        }
        

    }
}
