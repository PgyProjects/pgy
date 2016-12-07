<?php
/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/16
 * Time: 13:45
 */

/**
 * Class CustomerInfoModel  客户元数据信息表
 */
class CustomerInfoModel extends PgyModel
{
    protected function tablename()
    {
        return 'custom_infos';
    }


    public function validateDelete($where)
    {
        if (empty($where['wxid'])) {
            $this->error = '请填写微信OPENID';
            return false;
        }
        return true;
    }

    protected function validateUpdate($fields, $where)
    {
        if (is_array($fields)) {
            foreach ($fields as $key => $value) {
                if (!$this->getFields($key)) {
                    $this->error = "字段{$key}不存在";
                    return false;
                }
            }
        }
        if (empty($where['wxid'])) {
            $this->error = '请通过微信OPENID进行修改';
            return false;
        }
        return true;
    }

    protected function validateInsert($fields)
    {
//        if (empty($fields['wxid'])) {
//            $this->error = '请填写微信OPENID';
//            return false;
//        }
//        if (empty($fields['wx_name'])) {
//            $this->error = '请填写微信昵称';
//            return false;
//        }
//        if (empty($fields['wx_img'])) {
//            $this->error = '请填写微信微信头像';
//            return false;
//        }
//        if (empty($fields['wx_sex'])) {
//            $this->error = '请填写微信性别';
//            return false;
//        }
//        if (!empty($fields['wx_addr'])) {
//            $this->error = '请填写微信地址';
//            return false;
//        }
        foreach ($fields as $key => $value) {
            if (!$this->getFields($key)) {
                $this->error = "字段{$key}不存在";
                return false;
            }
        }
        //其他有默认值
        return true;
    }

    /**
     * 根据微信ID获取客户元数据
     * @param $wxid
     * @return array|false
     */
    public function getInfoByWeixinId($wxid)
    {
        return $this->where([
            'wxid' => $wxid,
        ])->find();
    }

    /**
     * 更具客户ID获取客户信息
     * @param $cid
     * @return bool
     */
    public function getInfoByCustomerId($cid)
    {
        $info = $this->query('SELECT ci.* from customers c INNER JOIN custom_infos ci on ci.wxid = c.wx_openid where c.id = ' . intval($cid));
        if (empty($info)) {
            $this->error = '查询失败:' . $this->error();
            return false;
        } else {
            return $info[0];
        }
    }


}