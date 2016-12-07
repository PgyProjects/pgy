<?php

/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */

/**
 * Class JkModel 借款模型
 *
 * 表：
 * DROP TABLE IF EXISTS `customer_jiekuan`;
 * CREATE TABLE `customer_jiekuan` (
 * `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 * `wx_openid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '微信openid',
 * `amount` int(11) DEFAULT '0' COMMENT '金额',
 * `jkdate` date DEFAULT NULL COMMENT '借款时间',
 * `hkdate` date DEFAULT NULL COMMENT '还款时间',
 * `paydate` date DEFAULT NULL COMMENT '实际还款时间（付清时间）',
 * `status` tinyint(255) unsigned DEFAULT '0' COMMENT '借款状态,0-未还款 1-已经还款 2-有逾期',
 * `category` tinyint(4) unsigned DEFAULT '0' COMMENT '类别，0为首借1为延期2为续借',
 * `delay_days` smallint(6) DEFAULT NULL,
 * `delay_fee` smallint(6) DEFAULT NULL,
 * `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 * `note` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
 * PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
 *
 *
 * 视图:
 * view_jiekuan
 * -- 借款记录表，内联上用户表后加入客户经理信息，可以适当添加客户的其他信息
 * SELECT DISTINCT
 * `uj`.`wx_openid` AS `wx_openid`,
 * `uj`.`add_time` AS `add_time`,
 * `uj`.`amount` AS `amount`,
 * `uj`.`hkdate` AS `hkdate`,
 * `uj`.`status` AS `status`,
 * `jd`.`manager` AS `manager`
 * FROM
 * `customer_jiekuan` `uj`
 * INNER JOIN `customers` `jd` ON `jd`.`wx_openid` = `uj`.`wx_openid`
 * -- 注意编码方式 utf8-unicode-ci和utf-general-ci无法进行直接的比较
 *
 * view_jiekuan_newest
 * -- 客户的最新借款记录 视图
 * SELECT
 * max(`uj`.`id`) AS `jid`,
 * `uj`.`wx_openid` AS `wx_openid`
 * FROM
 * `customer_jiekuan` `uj`
 * GROUP BY
 * `uj`.`wx_openid
 *
 * @method JkModel getInstance(string $manager = null) static
 */
class JkModel extends PgyModel
{
    protected function tableName()
    {
        return 'customer_jiekuan';
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
     * 获取借款用户列表
     * 筛选：最近一笔借款逾期7天或者7天以内或者最近一笔借款是明天还款的
     *
     * 放款客户列表的筛选条件是:
     *  一、客户资料审核通过 customer = 2
     *  二、该客户不存在历史放款记录，即该客户的微信OPENID不存在于借款表(customer_jiekuan)中
     * 这些客户的资料存放于视图（view_customer_fangkuan_list）中：
     * SELECT
     * `jd`.`id` AS `id`,
     * `jd`.`wx_openid` AS `wx_openid`,
     * `jd`.`name` AS `name`,
     * `jd`.`idCard` AS `idCard`,
     * `jd`.`phone` AS `phone`,
     * `jd`.`education` AS `education`,
     * `jd`.`company` AS `company`,
     * `jd`.`shenfenzheng_img` AS `shenfenzheng_img`,
     * `jd`.`address` AS `address`,
     * `jd`.`email` AS `email`,
     * `jd`.`ip` AS `ip`,
     * `jd`.`input_zhima` AS `input_zhima`,
     * `jd`.`sex` AS `sex`,
     * `jd`.`age` AS `age`,
     * `jd`.`hujidizhi` AS `hujidizhi`,
     * `jd`.`manager` AS `manager`,
     * `jd`.`create_at` AS `create_at`,
     * `jd`.`denide_at` AS `denide_at`,
     * `jd`.`status` AS `status`,
     * `jd`.`type` AS `type`,
     * `jd`.`passed_at` AS `passed_at`,
     * `jd`.`comment` AS `comment`,
     * `ci`.`jiekuanyongtu` AS `jiekuanyongtu`,
     * `ci`.`position` AS `position`,
     * `ci`.`auth_jd` AS `auth_jd`,
     * `ci`.`auth_tb` AS `auth_tb`,
     * `ci`.`auth_yys` AS `auth_yys`,
     * `ci`.`auth_zfb` AS `auth_zfb`,
     * `ci`.`money_wanted` AS `money_wanted`
     * FROM
     * customers jd
     * LEFT OUTER JOIN custom_forms ci ON ci.uid = jd.wx_openid
     * WHERE
     * -- 条件1: 审核通过
     * jd.`status` = 2
     * -- 条件2: 不存在借款记录
     * AND NOT EXISTS (
     *  SELECT 1 from customer_jiekuan cj where cj.wx_openid = jd.wx_openid
     * )
     * -- wx_openid NOT IN (
     * --    SELECT DISTINCT
     * --        wx_openid
     * --    FROM
     * --        customer_jiekuan
     * -- )
     *
     * @param null|int $offset 偏移
     * @param null|int $limit 条数限制
     * @return array
     */
    public function getUserList($offset = null, $limit = null)
    {
        $limit = isset($offset, $limit) ? "  limit $offset,$limit " : '';
        $list = $this->query("
select * from view_customer_fangkuan_list
-- AND jd.manager = '{$this->manager}' -- 筛选该客户经理的
$limit ;");
        return $list;
    }

    /**
     * 获取统计信息
     * @return array
     */
    public function getStatistics()
    {
        return [
//            'mon_yql' => ($this->getSumByMon(-1, 0, 'YQ') / $this->getSumByMon(-1, 0, 'NF')) * 100
        ];
    }

    /**+
     * @param int $monbegin 开始的月份，如上个月就是-1，这个月就是0，下个月就是-1
     * @param int $monend 结束的月份，格式同上
     * @param string $filter
     * @return false|int
     */
    private function getSumByMon($monbegin, $monend, $filter = 'NF')
    {
        switch ($filter) {
            case 'NF':
                //不作筛选 no filter
                $filter = '';
                break;
            case 'YQ': // yuqi
                //逾期（未还款 + 逾期天数大于7天）
                $filter = ' 
AND `status` < 1
AND (
	UNIX_TIMESTAMP(NOW()) > UNIX_TIMESTAMP(huankuanri)
)
AND (
	UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(huankuanri) >= 8 * 3600 * 24
)
';
                break;
            default:
                $this->error = '错误的筛选条件';
                return false;
        }
        //月份筛选

        $monbegin = strtotime(date('Y-m-01', strtotime("{$monbegin} months")));
        $monend = strtotime(date('Y-m-01', strtotime("{$monend} months")));

        $sql = "
SELECT
	IFNULL(SUM(jine),0) as c
FROM
	view_jiekuan 
WHERE
	shenheren = '{$this->manager}'
AND  (
--  时间筛选
	UNIX_TIMESTAMP(add_time) > $monbegin
	AND UNIX_TIMESTAMP(add_time) < $monend
)
{$filter} 
";
        $result = $this->find($sql);
//        dump($sql,$result);
        return $result ? $result['c'] : false;
    }

    /**
     * 获取该用户的借款记录列表
     * @param string $wx_openid openid
     * @return array
     */
    public function getList($wx_openid)
    {
        return $this->order('add_time')->where([
            'wx_openid' => $wx_openid,
        ])->select();
    }

    /**
     * 根据借款ID查询到用户信息
     * @param int $jk_id 借款ID
     * @return bool|array
     */
    public function getUserinfoByJkid($jk_id)
    {
        $data = $this->innerJoin('customers c ON c.wx_openid = cj.wx_openid')
            ->table('customer_jiekuan cj')
            ->where('cj.id = ' . intval($jk_id))->find();
        if (!$data) {
            $this->error = '无法通过借款ID查询到用户信息';
            return false;
        } else {
            return $data;
        }
    }

    /**
     * 獲取用戶最后一次借款的記錄
     * @param int $wx_openid 用戶ID
     * @return array|false
     */
    public function getLast($wx_openid)
    {
        $data = $this->where([
            'wx_openid' => $wx_openid,
        ])->order('add_time DESC')->find();
        if (false === $data) {
            $this->error = '获取最近一条借款记录失败:' . $this->error();
            return false;
        }
        return $data;
    }

    /**
     * 根据借款ID获取借款记录
     * @param int $jkid 借款ID
     * @return bool|array
     */
    public function getJiekuanById($jkid)
    {
        $jiekuan = $this->distinct(true)->where([
            'id' => $jkid,
        ])->find();

        //检测借款记录是否存在
        if (!$jiekuan) {
            //借款记录不存在
            $this->error = "查询不到ID为'{$jkid}'的借款记录";
            return false;
        }
        return $jiekuan;
    }

    public function markDelay($wxid, $jktime, $jine, $days, $fee, $beizhu = '')
    {
        if (!$days) {
            $this->error = '延期时间未填写';
        } elseif (!$fee) {
            $this->error = '延期费用未填写';
        } elseif (!$jine) {
            $this->error = '借款金额不能为空';
        } elseif (!$jktime) {
            $this->error = '借款时间不能为空';
        } else {
            //还款时间等于借款时间加上延期天数，忽略前台传递的还款时间
            $hktime = date('Y-m-d', strtotime($jktime) + intval($days) * 3600 * 24);//借款日加天數 的時間戳
            if ($this->insert([
                //接受参数
                'wx_openid' => $wxid,
                'jkdate' => $jktime,
                'amount' => $jine,
                'delay_days' => empty($days) ? 0 : $days,
                'delay_fee' => empty($fee) ? 0 : $fee,
                //接受参数(可选)
                'note' => $beizhu ? $beizhu : '',//備註
                //限定
                'category' => 1, //设置为延期 1
                'status' => 0,  //未还款
                //动态计算
                'hkdate' => $hktime,
            ])
            ) {
                return true;
            }
        }
        return false;
    }

    public function markFirst($wxopenid, $huabei, $jine, $jktime, $hktime, $beizhu = '')
    {
        if (!$jine) {
            $this->error = '借款金额不能为空';
        } elseif (!$jktime) {
            $this->error = '借款时间不能为空';
        } elseif (!$hktime) {
            $this->error = '还款时间不能为空';
        } else {
            //修改花呗

            $this->beginTransaction();

            $cimodel = CustomerInfoModel::getInstance($this->manager);

            if (false === $cimodel->update([// mysql下更新可能为0 ，并不意味着失败
                    'huabei' => $huabei,
                ], [
                    'wxid' => $wxopenid,
                ])
            ) {
                $this->error = '更新花呗失败：' . $cimodel->getLastSql() . var_export($cimodel->getLastParams(), true);
                $this->rollback();
                return false;
            }

            if ($this->insert([
                'wx_openid' => $wxopenid,
                'category' => 0,//首借的狀態值為 0
                'status' => 0,
                'jkdate' => $jktime,
                'hkdate' => $hktime,
                'hthkdate' => $hktime,
                'amount' => $jine,
                'note' => $beizhu ? $beizhu : '',//備註
            ])
            ) {
                $this->commit();
                return true;
            } else {
                $this->rollback();
            }
        }

        return false;
    }

    /**
     * 添加续借
     * @param $wxopenid
     * @param $jine
     * @param $jktime
     * @param $hktime
     * @param $beizhu
     * @return bool
     */
    public function markContinue($wxopenid, $jine, $jktime, $hktime, $beizhu = '')
    {
        if (!$jine) {
            $this->error = '借款金额不能为空';
        } elseif (!$jktime) {
            $this->error = '借款时间不能为空';
        } elseif (!$hktime) {
            $this->error = '还款时间不能为空';
        } else {
            if ($this->insert([
                'wx_openid' => $wxopenid,
                'category' => 2,//續借的狀態值為 2
                'status' => 0,
                'jkdate' => $jktime,
                'hkdate' => $hktime,
                'hthkdate' => $hktime,
                'amount' => $jine,
                'note' => $beizhu ? $beizhu : '',//備註
            ])
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * 设置用户ID为XXX的借款记录为已经还款
     * @param string $wx_openid 微信openid
     * @param null $paydate 还款时间
     * @param string $note 备注
     * @return bool
     */
    public function markPayoff($wx_openid, $paydate = null, $note = null)
    {
        //获取上一次的还款记录
        $last = $this->getLast($wx_openid);
        if ($last !== false) {
            $fields = [
                'status' => 1,
                'paydate' => empty($paydate) ? date('Y-m-d') : $paydate,
            ];
            isset($note) and $fields['note'] = $note;

            if ($last['status'] == 0) {
                //上次改为已经还款
                if ($this->update($fields, [
                    'id' => $last['id'],
                ])
                ) {
                    return true;
                } else {
                    $this->error = '修改 "已还款" 失败' . $this->error();
                }
            } else {
                //上次還款記錄為 “已還款1 或者 有逾期2”
                $this->error = '上次还款记录为 "已还款/已逾期"，修改错误';
            }
        } else {
            $this->error = "用户ID为'$wx_openid'不存在借款记录，修改失败";
        }
        return false;
    }

    /**
     * 修改上次的借款狀態
     * 借款狀態有三種：
     * //     *  0 - 首次借款
     * //     *  1 - 延期
     * //     *  2 - 續借
     * @param int|string $wx_openid 用戶ID
     * @param int|null $status 不给订参数或者参数为null的情况下自动将还款时间和当前日期进行比较
     * @return bool
     * @throws Exception
     */
    public function updateLastRecordStatus($wx_openid, $status = null)
    {
        $last = $this->getLast($wx_openid);
        if (false === $last) {
            return false;
        } else {
            $id = $last['id'];
            if (null === $status) {
                $huankuanri = strtotime($last['hkdate']);
                $now = strtotime(date('Y-m-d'));//今天0点的时间
                if ($huankuanri >= intval($now)) {
                    //类别设置为“已还款”
                    $status = 1;
                } else {
                    //类别设置为“（已还款但是）有逾期”
                    $status = 2;
                }
            }

            $updfields = [
                'status' => $status,
            ];
            if (intval($status) > 0) {//在不是设置最后一次还款状态为未还款
                $updfields['paydate'] = date('Y-m-d');//修改实际还款时间
            } else {
                $updfields['paydate'] = null;
            }

            return $this->update($updfields, [
                'id' => $id,
            ]);
        }
    }

    /**
     * 添加延期
     * @param $wx_openid
     * @param $amount
     * @param $jkdate
     * @param $delay_days
     * @param $delay_fee
     * @param string $note
     * @return bool
     */
    public function insertDelay($wx_openid, $amount, $jkdate, $delay_days, $delay_fee, $note = '')
    {
        if (empty($wx_openid)) {
            $this->error = '微信OPENID未填写';
            return false;
        }
        $last = $this->getLast($wx_openid);
        if ($last !== false) {
            if ($last['status'] == 0) {
                //開啟事務
                if (empty($delay_fee)) {
                    $this->error = '延期费用未填写';
                    return false;
                }
                if (empty($delay_days)) {
                    $this->error = '延期时间未填写';
                    return false;
                }
                if (empty($amount)) {
                    $this->error = '金额未填写';
                    return false;
                }
                if (empty($jkdate)) {
                    $this->error = '借款时间未填写';
                    return false;
                }

                //上次改为有逾期
                if (!$this->updateLastRecordStatus($wx_openid, 2)) {
                    $this->error = '无法修改上次借款状态为有逾期:' . $this->error();
                    return false;
                }

                $hkdate = date('Y-m-d', strtotime($jkdate) + intval($delay_days) * 3600 * 24);
                $fields = [
                    'wx_openid' => $wx_openid,
                    'category' => 1,//借款类别为延期
                    'jkdate' => $jkdate,
                    'hkdate' => $hkdate,//借款日加天數 的時間戳
                    'hthkdate' => $hkdate,
                    'amount' => $amount,
                    'note' => $note ? $note : '',
                    'delay_days' => $delay_days,
                    'delay_fee' => $delay_fee,
                ];
                if ($this->insert($fields)) {
                    return true;
                } else {
                    $this->error = '添加延期失败:' . $this->error();
                }
            } else {
                $this->error = '上次还款记录已经标记为还清状态，无法添加延期';
            }
        } else {
            $this->error = '不存在借款记录，系统错误';
        }
        return false;
    }

}