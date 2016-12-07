<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/16
 * Time: 13:34
 */

/**
 * Class CustomerModel
 * @method CustomerModel getInstance(string $manager = null) static
 */
class CustomerModel extends PgyModel
{
    /**
     * 获取客户基本信息
     * @param $uid
     * @return array|bool
     */
    public function getCustomerBasicInfo($uid)
    {
        return $this->find($uid);
    }

    /**
     * 根据客户微信获取客户详细信息
     * @param string $wxid
     * @return array|false
     */
    public function getDetail($wxid)
    {
        $list = $this->fields('jd.*,cf.*,ci.*,cc.* ,
        au.`name` as manager_name, -- 客户经理名称
        jd.create_at as cstm_create_at, -- 添加时间
        jd.passed_at as cstm_passed_at, -- 通过时间
        jd.denide_at as cstm_denide_at, -- 拒绝时间
        jd.`comment` as cstm_comment,   -- 审核备注
        jd.`status` as cstm_status,      -- 审核状态0新用户1待审核2已通过3未通过  
                                        -- PS："新客户"不就是"待审核"吗
        ifnull(jd.zbfk_time,\'\') as zbfk_time
        ')->table('customers jd')->where([
            'jd.wx_openid' => $wxid,
        ])
            ->leftOuterJoin('users au on au.id = jd.manager')
            ->leftOuterJoin('custom_forms cf on cf.uid = jd.wx_openid')
            ->leftOuterJoin('custom_infos ci on ci.wxid = jd.wx_openid')
            ->leftOuterJoin('custom_contecters cc on cc.uid = jd.wx_openid')
            ->find();
        empty($list['shenfenzheng_img']) or $list['shenfenzheng_img'] = unserialize($list['shenfenzheng_img']);
        return $list;
    }
    protected function tableName()
    {
        return 'customers';
    }

    protected function validateInsert($fields)
    {
        if (is_array($fields)) {
            foreach ($fields as $key => $value) {
                if (!$this->getFields($key)) {
                    $this->error = "字段{$key}不存在";
                    return false;
                }
            }
        }
        return true;
    }

    public function validateDelete($where)
    {
        return true;
    }

    protected function validateUpdate($fields, $where)
    {
        return true;
    }
    /**
     * 判断用户类型的方法, 根据ID, 或其他
     * @param $id,
     * @return bool
     */
    public function type($id)
    {
        //获取用户实例
        $t = $this->find($id);
        //查询对应的芝麻分
        $y = $this->select('zhimafen')->from('custom_infos')->where('wxid',$t->wxopid)->first()->toArray();

        //如果不满足条件,由系统直接判断拒绝,管理员编号999
        if ($t->age < 23 or $t->age > 40 or ($t->sex = 1 and $t->education > 3) or ($t->sex = 1 and $y['zhimafen'] < 650) or ($t->sex = 2 and $y['zhimafen'] < 600))
        {
            $t->update(['status' => 3, 'denide_at' => date("Y-m-d h:i:s", time()), 'manager' => 999]);
            return false;
        }
        //满足条件则根据性别分配ABC类型;
        if ($t->sex == 1) {                      //男
            if ($y['zhimafen'] >= 720) {
                $t->update(['type' => 'A']);
                return true;
            } elseif ($y['zhimafen'] >= 700) {
                $t->update(['type' => 'B']);
                return true;
            } elseif ($y['zhimafen'] >= 650) {
                $t->update(['type' => 'C']);
                return true;
            } else {
                return false;
            }
        } elseif ($t->sex == 2) {                //女
            if ($y['zhimafen'] >= 700) {
                $t->update(['type' => 'A']);
                return true;
            } elseif ($y['zhimafen'] >= 650) {
                $t->update(['type' => 'B']);
                return true;
            } elseif ($y['zhimafen'] >= 600) {
                $t->update(['type' => 'C']);
                return true;
            } else {
                return false;
            }
        }else{                                    //其他情况?
            return false;
        }
    }

}