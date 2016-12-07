<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */
/**
 * Class UserModel
 * @method UserModel getInstance(string $manager = null) static
 */
class UserModel extends PgyModel
{
    /**
     * 获取客户基本信息
     * @param int $uid
     * @return array
     */
    public function getUserinfo($uid)
    {
        $user_data = $this->query(' select * from jxl_data1 where id = ' . intval($uid));
        $user_data['shenfenzheng_img'] = unserialize($user_data['shenfenzheng_img']);
        return $user_data;
    }

}