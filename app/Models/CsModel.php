<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */

/**
 * Class CsModel
 * @method CsModel getInstance($manager = null) static
 */
class CsModel extends PgyModel
{

    //催收状态
    const STATUS_YQ = 0;//逾期
    const STATUS_CN = 1;//承诺
    const STATUS_DONE = 2;//已经还款
    const STATUS_DELAY = 3;//延期

    protected function tableName()
    {
        return 'customer_cuishou';
    }

    protected function validateInsert($fields)
    {
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
     * 添加催收记录
     * @param int $jkid 借款记录ID
     * @param int $status 催收记录状态
     * @param string|null $cndate 承诺还款日期，格式如'2016-12-10'
     * @param string $beizhu 备注，默认为空
     * @param int $wyj 违约金，默认为0
     * @return bool
     */
    public function add($jkid, $status, $cndate = null, $beizhu = '', $wyj = 0)
    {
        $jkid = intval($jkid);
        $jkmodel = JkModel::getInstance($this->manager);
        //检测借款记录是否存在
        if ($jiekuan = $jkmodel->getJiekuanById($jkid)) {
            //获取最后一次的借款记录
            $wxopenid = $jiekuan['wx_openid'];
            $lastjiekuan = $jkmodel->getLast($wxopenid);

            if ($lastjiekuan !== false) {
                if ($lastjiekuan['status'] == 0) { //上次借款状态为未还款 ==> 允许修改
                    //状态值检测
                    if (!in_array(intval($status), [1, 2, 3, 0])) {
                        $this->error = '不合法的状态值:' . $status;
                        return false;
                    }
                    return $this->insert([
                        'jk_id' => $jkid,
                        'status' => $status,
                        'note' => $beizhu ? $beizhu : '',
                        'cnhkdate' => empty($cndate) ? null : $cndate,
                        'weiyuejin' => (int)$wyj,
                    ]);
                } else {
                    //上次還款記錄為 “已還款1 或者 有逾期2”
                    $this->error = '上次还款记录为 "已还款/已逾期"，修改错误';
                }
            } else {
                $this->error = "无法查询到用户ID为'$wxopenid'的末次借款记录";
            }
        } else {
            //借款记录不存在
            $this->error = $jkmodel->error();
        }
        return false;
    }

    /**
     * 获取某条借款记录的催收记录列表
     * @param int $jk_id
     * @return array
     */
    public function getList($jk_id)
    {
        return $this->where([
            'jk_id' => intval($jk_id),
        ])->order('add_time desc')->select();
    }

    /**
     * 获取上一次的催收记录
     * @param int $jkid 借款记录ID
     * @return bool|array
     */
    public function getLastByJkid($jkid)
    {
        $result = $this->where([
            'jk_id' => intval($jkid),
        ])->order('add_time desc')->find();
        if (!is_array($result)) {
            $this->error = $this->error();
        } elseif (empty($result)) {
            $this->error = "无法获取借款ID为'$jkid'的催收记录";
        } else {
            return $result;
        }
        return false;
    }


    /**
     * 刷新催收列表
     *
     * 只有未还款并且还款日期大于等于8天的才会出现在催收列表中
     *
     * 检查借款列表中是否存在逾期借款记录
     * 如果存在则检查这条逾期记录是否在催收列表中
     * 不存在则插入到催收列表中
     * @return bool
     */
    public function refresh()
    {
        $sql = '
INSERT INTO customer_cuishou (jk_id)
select uj.id as jk_id 
from customer_jiekuan uj 
where 
(`status` < 1 ) -- 注：一个账户最多只有一个status < 1(款还清后才能继续借)
and ( -- 还款时间过去的时间已经大于等于1天
   UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(hkdate) >= 3600*24
) 
and not EXISTS ( -- 借款记录ID不存在于催收列表中
		select 1 from customer_cuishou uc where uj.id = uc.jk_id
)
';
        return $this->exec($sql);
    }

    public function getUserInfoByJkid($jkid)
    {
        return $this->fields('c.*')->table('customer_jiekuan cj')
            ->innerJoin('customers c on c.wx_openid = cj.wx_openid')->where('cj.id = ' . intval($jkid))->find();
    }

    /**
     * 获取用户详细信息
     * @param $jkid
     * @return array
     */
    public function getUserDetail($jkid)
    {
        return $this->query('
SELECT
    uc.jk_id,
    uc.add_time as cs_add_time,
    uc.`status` as cs_status,
    uc.note as cs_note,
    cnhkdate,
    uj.*,jd.*,cf.*,ci.*
FROM customer_cuishou uc
INNER JOIN customer_jiekuan uj on uj.id = uc.jk_id
INNER JOIN customers jd on jd.wx_openid = uj.wx_openid
LEFT OUTER JOIN custom_forms cf on cf.uid = jd.wx_openid
LEFT OUTER JOIN custom_infos ci on ci.wxid = jd.wx_openid
where jk_id = ' . $jkid . ' ORDER BY uc.add_time DESC limit 1');
    }

    /**
     * 催收客户列表
     *
     * 筛选条件：客户有借款未还款，如果存在系统累积性错误，可能存在一个客户多条记录的情况
     *
     * ＶＩＥＷ：view_customer_cuishou_list
     * SELECT
     * (
     * (
     * unix_timestamp(now()) - unix_timestamp(`cj`.`hkdate`)
     * ) / (3600 * 24)
     * ) AS `overdue_days`, -- 逾期天数
     * `jd`.`id` AS `id`,
     * `jd`.`wx_openid` AS `wx_openid`,
     * `jd`.`name` AS `name`,
     * `jd`.`phone` AS `phone`,
     * `jd`.`education` AS `education`,
     * `jd`.`company` AS `company`,
     * `jd`.`shenfenzheng_img` AS `shenfenzheng_img`,
     * `jd`.`address` AS `address`,
     * `jd`.`email` AS `email`,
     * `jd`.`ip` AS `ip`,
     * `jd`.`sex` AS `sex`,
     * `jd`.`age` AS `age`,
     * `jd`.`type` AS `type`,
     * `jd`.`passed_at` AS `passed_at`,
     * `jd`.`comment` AS `comment`,
     * `cj`.`id` AS `jk_id`,
     * `cj`.`status` AS `jk_status`,
     * `cj`.`hkdate` AS `hkdate`,
     * `cj`.`category` AS `category`,
     * `cj`.`jkdate` AS `jkdate`,
     * `cj`.`amount` AS `amount`,
     * `ci`.`jiekuanyongtu` AS `jiekuanyongtu`,
     * `ci`.`position` AS `position`,
     * `ci`.`idCard_img` AS `idCard_img`,
     * `ci`.`auth_jd` AS `auth_jd`,
     * `ci`.`auth_tb` AS `auth_tb`,
     * `ci`.`auth_yys` AS `auth_yys`,
     * `ci`.`auth_zfb` AS `auth_zfb`,
     * `ci`.`money_wanted` AS `money_wanted`
     * FROM `customers` `jd`
     * INNER JOIN `customer_jiekuan` `cj` ON `cj`.`wx_openid` = `jd`.`wx_openid`
     * LEFT OUTER JOIN `custom_forms` `ci` ON `ci`.`uid` = `jd`.`wx_openid`
     * WHERE `cj`.`status` < 1
     *
     * @param null $offset
     * @param null $limit
     * @param null $yqcond
     * @return array|false
     */
    public function getUserList($offset = null, $limit = null, $yqcond = null)
    {
        // '0-1'://今天
        //'1-2'://昨天（宽限日）
        //'2-7'://2-7天 .........
        if (is_string($yqcond) and strpos($yqcond, '+')) {
            list($begin, $end) = explode('+', $yqcond);
            $begin = intval($begin);
            $end = intval($end);
            $yqcond = " overdue_days >= {$begin} and overdue_days < {$end} ";
        } else {
            $yqcond = ' 1 ';//无限制
        }
        $list = $this->table('view_customer_cuishou_list')->where($yqcond)
            ->order('jk_id')->limit($limit, $offset)->select();
        return $list;
    }


}