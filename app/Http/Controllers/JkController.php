<?php
/**
 * Created by linzhonghuang.
 *
 * Date: 2016/11/11
 * Time: 11:51
 */
namespace App\Http\Controllers;

use JkModel;
use CustomerInfoModel;
use Library\Dao;
use YqModel;
use CustomerModel;

/**
 *
 * 测试时关闭csrf保护
 * app\Http\Kernel.php 文件中注释  \App\Http\Middleware\VerifyCsrfToken::class,
 *
 *
 * Class jkpi 借款API
 */
class JkController extends ApiController
{
//--------------------------------------- 列表查询（筛选客户经理） -------------------------------------------------------------------------------//
    private function updateFangkuan($wxopenid)
    {
        $manager = intval(session('manager'));

        if (!empty($wxopenid)) {
            CustomerModel::getInstance(1)->update([
                'fk_uid' => $manager,
            ], [
                'wx_openid' => $wxopenid,
            ]);
        }
    }

    /**
     * 获取用户列表
     * URL：/jkapi/page_ajax/[分页ID]
     * @param $current
     */
    public function getUserList($current = 1)
    {
        $limit = $this->input->get_post('per_page');
        isset($limit) or $limit = 5;
        $offset = ($current - 1) * $limit;

        $model = JkModel::getInstance($this->getManeger());
        $user_data = $model->getUserList($offset, $limit);
        $total = count($model->getUserList());

//        $this->formatList($user_data, function ($item) {
//            return strtotime($item['hkdate']);
//        });

        $this->jsonReturn([
            'data' => $user_data,
            'zongji' => $total,
            //TODO：统计信息待完成
            'statistics' => $model->getStatistics(),
        ]);
    }

    /**
     * URL：/jkapi/jkexist/{openid}
     * Return：
     *
     * @param string $openid 微信openid
     */
    public function hasJkRecord($openid)
    {
        $this->success(JkModel::getInstance($this->getManeger())->where([
            'wx_openid' => $openid,
        ])->order('add_time desc')->find());
    }

    /**
     * 筛选查询API
     * URL：/jkapi/page_ajax2/[分页ID]
     * POST：
     *  (key)         (value)
     * ----------------------------
     *  jine        1000  借款金额
     *  jk          2016-11-1 借款时间
     *  hk          2016-11-2 还款时间
     *  nm          XXXX 姓名
     *  phone       15454578554 手机号
     *  status      jt  - 今天还款
     *              mt - 明天还款
     *              kxr - 宽限日
     *              yq  - 逾期
     * @deprecated
     * @param $current
     * @return void
     */
    public function getUserListFiltered($current = 1)
    {
        //查询字段
        $fields = '
		uj.`status`,
		IFNULL(uj.hkdate,\'\') as hkdate,
		uj.category, -- 借款类型
		uj.jkdate,
		uj.amount,
		uj.add_time,
		jd.`name`,
		jd.id as uid,
		jd.wx_openid ,
		jd.phone,
		jd.sex,
		ci.huabei,
		ci.jdbaitiao';
        //按记录筛选的SQL
        $sql = "SELECT {$fields} FROM customers jd 
INNER JOIN customer_jiekuan uj ON uj.wx_openid = jd.wx_openid
LEFT OUTER JOIN custom_infos ci on ci.wxid = jd.wx_openid";
        $type = $this->input->get_post('key');
        $value = $this->input->get_post('value');

        $size = $this->input->get_post('per_page');
        $size or $size = 10;//$this->input->get('');
        $offset = ($current - 1) * $size;

        //按客户最新的借款记录的筛选
        $sql_newest = "SELECT {$fields} FROM customers jd -- 加入用户最新的借款记录
INNER JOIN view_jiekuan_newest vjn on vjn.wx_openid = jd.wx_openid
INNER JOIN customer_jiekuan uj on uj.id = vjn.jid
-- 花呗，京东等
LEFT OUTER JOIN custom_infos ci on ci.wxid = jd.wx_openid";

        switch ($type) {
            case 'jine'://金额
                $sql .= " where uj.amount = " . intval($value);
                break;
            case 'jk'://借款日期
                $sql .= " where uj.jkdate = '{$this->formatDate($value)}' ";
                break;
            case 'hk'://还款日
                $sql .= " where uj.hkdate = '$value' ";
                break;
            //姓名和手机号是唯一的,根据最新的借款记录来查询
            case 'nm'://姓名
                $sql = "{$sql_newest} WHERE jd.name = '{$value}'";
                break;
            case 'phone':
                $sql = "{$sql_newest} WHERE jd.phone = '{$value}'";
                break;
            case 'status':
                $hkdate = 'UNIX_TIMESTAMP(hkdate)';
                $now = time();//當前時間
                switch ($value) {
                    case 'jt':
                        //今天还款：钱未还 + 今天还款
                        $sql .= " where status < 1 and ($now >= $hkdate)  and ($now - $hkdate < 3600*24)";
                        break;
                    case 'mt':
                        //明天还款：钱未还 + 明天还款
                        $sql .= " where status < 1 and (($now <= $hkdate)  and ($hkdate - $now < 3600*24))";
                        break;
                    case 'kxr':
                        //宽限日 ： 钱未还 + 昨天还款
                        $sql .= " where status < 1 and (($now >= $hkdate)  and ($now - $hkdate >= 3600*24) and ($now - $hkdate < 3600*24*2))";
                        break;
                    case 'yq':
                        //逾期中 : 钱未还 + 还款时间在昨天之前
                        $sql .= " where status < 1 and (($now >= $hkdate)  and ($now - $hkdate >= 3600*24*2))";
                        break;
                    default:
                        $this->failed('错误的value:' . $value);
                }
                break;
            default:
                $this->failed('错误的key:' . $type);
        }
        //审核人筛选
        $sql .= " and jd.manager = '{$this->getManeger()}' ";
        //获取总数
        $total = count($this->db->query($sql));
        $user_data = $this->db->query($sql . " limit $offset,$size ");

        if (false === $user_data) {
            $this->failed($this->db->error());
        } else {
            $this->formatList($user_data, function ($item) {
                return strtotime($item['hkdate']);
            });
        }

        $this->jsonReturn([
            'data' => $user_data,
            'zongji' => $total,
        ]);
    }

//--------------------------------------- 详情获取和信息增改（用户范围已限定，不判断筛选客户经理） -------------------------------------------------------------------------------//
    /**
     * 获取用户详细信息
     * URL:jkapi/detail/[WX_OPENID]
     * @param string $wxid 微信openid
     * @return void
     *
     */
    public function getDetail($wxid)
    {
        //用户信息
        $cusModel = CustomerModel::getInstance($this->getManeger());
        $user_data = $cusModel->getDetail($wxid);
        if (false === $user_data) {
            $this->failed("获取获取客户信息失败：{$cusModel->error()}");
        }
        //用户借款记录获取
        $record_list = JkModel::getInstance($this->getManeger())->getList($wxid);
        if (false === $record_list) {
            $this->failed('获取用户的借款记录失败:' . JkModel::getInstance($this->getManeger())->error());
        }

        if ($record_list) {
            //借款记录分设延期记录列表
            $yqmodel = YqModel::getInstance($this->getManeger());
            foreach ($record_list as &$item) {
                $jk_id = $item['id'];
                $item['cs_list'] = $yqmodel->where([
                    'jk_id' => $jk_id,
                ])->order('add_time desc')->select();
            }
        }

        foreach ($record_list as &$item) {
            $item['category'] = $this->jkttr2Cn($item['category']);
        }
        $user_data['record_list'] = $record_list;

        $this->jsonReturn($user_data);
    }

    /**
     * 未放款
     * URL:/jkapi/weifangkuan
     * POST:
     *      wxid        微信OPENID
     *      huabei      花呗
     */
    public function doWeiFangkuan()
    {
        $wxopenid = $this->input->get_post('wxid') or $this->failed('请填写微信OPENID');
        $beizhu = $this->input->get_post('beizhu') or $beizhu = '';
        $huabei = $this->input->get_post('huabei') or $this->failed('花呗不能为空');

        $cimodel = CustomerInfoModel::getInstance($this->getManeger());
        $cimodel->beginTransaction();
        $this->updateFangkuan($wxopenid);
        if (false === $cimodel->update([// mysql下更新可能为0 ，并不意味着失败
                'huabei' => $huabei,
            ], [
                'wxid' => $wxopenid,
            ])
        ) {
            $cimodel->rollback();
            $this->failed('修改失败.');
        } else {
            if (CustomerModel::getInstance(1)->update([
                'zbfk_time' => date('Y-m-d H:i:s'),
                'zbfk_comment' => $beizhu,
                'orderNo' => time(),
            ], [
                'wx_openid' => $wxopenid,
            ])
            ) {
                $cimodel->commit();
                $this->success('修改成功');
            } else {
                $cimodel->rollback();
                $this->failed('修改失败!');
            }
        }
    }

    /**
     * 放款
     * URL:/jkapi/fangkuan
     * POST:
     *  wxid            微信OPENID
     *  beizhu          备注（可选）
     *  jiekuanri       借款日
     *  huankuanri      还款日
     *  jine            金额
     *  huabei          花呗（首次借款必填）
     */
    public function doFangkuan()
    {
        $wxid = $this->input->get_post('wxid') or $this->failed('请填写微信OPENID');
        $jine = $this->input->get_post('jine') or $this->failed('请填写金额 ');
        $huabei = $this->input->get_post('huabei');
        $beizhu = $this->input->get_post('beizhu');
        $jktime = $this->input->get_post('jiekuanri') or $this->failed('请填写借款日');
        $hktime = $this->input->get_post('huankuanri') or $this->failed('请填写还款日');

        $jkmodel = JkModel::getInstance($this->getManeger());
        $last = $jkmodel->getLast($wxid);

        $result = null;

        if (false === $last) {
            $this->failed('失败:' . $jkmodel->error());
        } elseif (empty($last)) {
            //该客户是第一次借款
            $result = $jkmodel->markFirst($wxid, $huabei, $jine, $jktime, $hktime, $beizhu);
        } else {
            //检查上次是否已经还款
            if ($last['status'] == 0) {
                $this->failed('上次还款记录为 "未还款"');
            } else {
                $this->updateFangkuan($wxid);
                $result = $jkmodel->markContinue($wxid, $jine, $jktime, $hktime, $beizhu);
            }
        }
        if ($result) {
            $this->success('添加成功');
        } else {
            $this->failed('添加失败:' . $jkmodel->error());
        }
    }


    /**
     * 还款
     *
     *  地址:/jkapi/payoff
     *  POST:
     *      wxid                微信openid
     *      shijihuankuanri     实际还款日期 '2016-10-10'
     *      beizhu              备注(可选)
     *
     * @deprecated
     * @access public
     * @return void
     */
    public function doPayoff()
    {
        $wxid = $this->input->get_post('wxid') or $this->failed('请填写微信OPENID');
        $shijihuankuanri = $this->input->get_post('shijihuankuanri') or $shijihuankuanri = date('Y-m-d');
        $beizhu = $this->input->get_post('beizhu');

        $this->updateFangkuan($wxid);
        if (!JkModel::getInstance($this->getManeger())->markPayoff($wxid, $shijihuankuanri, $beizhu)) {
            $this->failed(JkModel::getInstance($this->getManeger())->error());
        }
        $this->success('修改"已还款"成功');
    }

    /**
     * 添加续借
     *
     * API:/jkapi/continue
     * @deprecated
     * POST:
     *  wxid         (int)微信OPENID
     *  jine         (int)金额
     *  jiekuanri    (string)1902-10-11，借款日期
     *  huankuanri   (string)2016-11-12，还款日期
     *  beizhu       (string) 备注，可选
     *
     * @deprecated
     * @access public
     * @return void
     */
    public function doContinue()
    {
        //判斷上次借款是否已經還清
        $wxid = $this->input->get_post('wxid');
        $jkmodel = JkModel::getInstance($this->getManeger());
        $last = $jkmodel->getLast($wxid);
        if ($last) {
            //检查上次是否已经还款
            if ($last['status'] == 0) $this->failed('上次还款记录为 "未还款"');

            $jine = $this->input->get_post('jine');
            $jktime = $this->input->get_post('jiekuanri');
            $hktime = $this->input->get_post('huankuanri');
            $beizhu = $this->input->get_post('beizhu');

            $this->updateFangkuan($wxid);
            if ($jkmodel->markContinue($wxid, $jine, $jktime, $hktime, $beizhu)) {
                $this->success('添加成功');
            } else {
                $this->failed('添加失败:' . $jkmodel->error());
            }
        } else {
            $this->failed('查询借款历史记录失败：' . $jkmodel->error());
        }
    }

    /**
     * 添加延期
     * @deprecated
     * API: /jkapi/delay
     * POST:
     *  user_id      (int)客户ID
     *  jine         (int)金额
     *  jiekuanri    (string)1902-10-11，借款日期
     *  huankuanri   (string)2016-11-12，还款日期(可选，后台会忽略这个参数并根据借款日期加延期天数自动计算)
     *  beizhu       (string) 备注，可选
     *  delay_days   (int) 延期天数
     *  delay_fee    (int) 延期费用
     *
     * @deprecated
     * 备注： 添加延期的时候，如果上次还款状态为”未还款“，则将上次还款状态改为”有延期“,添加的记录还款状态为未还款
     *       可能存在的问题是”“可以无限延期”“
     *
     * @access public
     * @return void
     */
    public function doDelay()
    {
        //判斷上次借款是否是未還款
        $wxid = $this->input->get_post('wxid');
        $jkmodel = JkModel::getInstance($this->getManeger());
        $last = $jkmodel->getLast($wxid);
        if ($last !== false) {
            if ($last['status'] == 0) {
                //只有上次还款状态为未还款，才能进行延期操作
                $jkmodel->beginTransaction();

                //上次改为有逾期
                if (!$jkmodel->updateLastRecordStatus($wxid)) {
                    $jkmodel->rollback();
                    $this->failed('修改上次借款状态为”有逾期“失败');
                }

                $days = $this->input->get_post('delay_days');
                $fee = $this->input->get_post('delay_fee');
                $jine = $this->input->get_post('jine');
                $jktime = $this->input->get_post('jiekuanri');
//                $hktime = $this->input->get_post('huankuanri');
                $beizhu = $this->input->get_post('beizhu');

                if ($jkmodel->markDelay($wxid, $jktime, $jine, $days, $fee, $beizhu)) {
                    $jkmodel->commit();
                    $this->success('成功添加延期记录');
                } else {
                    $this->failed('添加延期失败:' . $jkmodel->error());
                }
            } else {
                $this->failed('上次还款记录已经标记为还清状态，无法添加延期');
            }
        } else {
            $this->failed('不存在借款记录，系统错误');
        }
    }

    /**
     * GET-URL:/jkapi/rawdata/[身份证号码]
     * @param $idcard
     */
    public function rawdata($idcard)
    {
        $rawdata = Dao::getInstance()->query("select `data` from raw_data where idcard = '" . htmlspecialchars(trim($idcard)) . "';");
        if (false === $rawdata) {
            $this->failed('数据库查询出错');
        }
        if (empty($rawdata)) {
            $client_secret = 'a9021a05cb254f21adb9e604231ce269';
            $access_token = '9c28663964be422ab9a1207f7830cf53';

            $customer = CustomerModel::getInstance(1)->where(['idCard' => $idcard])->find();
            if (!empty($customer)) {
                $name = urlencode($customer['name']);
                $phone = $customer['phone'];

                $content = self::get("https://dev.juxinli.com/reportApi/access_report_data?client_secret=$client_secret&access_token=$access_token&name=$name&phone=$phone&idcard={$idcard}");
                $json = json_decode($content, true);
                if ($json and $json['success'] == 'false') {
                    $this->failed($json['note']);
                } else {

                    Dao::getInstance()->exec('INSERT INTO raw_data VALUES (:idcard,:data)', [
                        ':idcard' => $idcard,
                        ':data' => $content,
                    ]);

                    $this->success($content);
                }
            }
            $this->failed("无法查询到身份证为'$idcard'的客户信息");
        } else {
            $this->success($rawdata[0]['data']);
        }
    }

}