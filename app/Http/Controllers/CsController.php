<?php
/**
 * Created by linzhonghuang.
 *
 * Date: 2016/11/11
 * Time: 11:51
 */
namespace App\Http\Controllers;

use CustomerModel;
use YqModel;
use CsModel;
use JkModel;

/**
 * Class csapi 催收API
 */
class CsController extends ApiController
{

    //催收状态
    const STATUS_YQ = 0;//逾期
    const STATUS_CN = 1;//承诺
    const STATUS_DONE = 2;//已经还款
    const STATUS_DELAY = 3;//延期

    /**
     * 获取催收客户列表
     * URL： /csapi/page_ajax/1
     * POST:
     *  yq_type     '0+1'今天还款
     *              '1+2'宽限日(昨天还款)
     *              '2+8' 逾期2到7天
     *              '8+16' 逾期8到15天
     *              '16+30'逾期16到30天
     *
     *              ['A+B'，逾期大于等于A天，小于B天]
     *
     * @param $current
     */
    public function getUserList($current)
    {
        $per_page = $this->input->get('per_page');
        $per_page or $per_page = 5;//$this->input->get('');
        $offset = ($current - 1) * $per_page;

        $model = CsModel::getInstance($this->getManeger());
        //刷新催收记录表
        $model->refresh();

        $yqtype = $this->input->get_post('yq_type');
        //获取催收用户列表
        $user_data = $model->getUserList($offset, $per_page, $yqtype);
        if (false === $user_data) {
            $this->failed('获取用户列表数据失败：' . $model->error());
        }
        //获取催收用户列表总数
        $total = count($model->getUserList(null, null, $yqtype));

        $this->jsonReturn([
            'data' => $user_data,
            'zongji' => $total,
        ]);
    }


    /**
     * 筛选查询API
     * URL：/csapi/page_ajax2/[分页ID]
     * POST：
     *  (key)         (value)
     * ----------------------------
     *  jine        1000  借款金额
     *  jk          2016-11-1 借款时间
     *  hk          2016-11-2 还款时间
     *  nm          XXXX 姓名
     *  phone       15454578554 手机号
     *  age         (int) 年龄
     *  status      催款状态：
     *              cn  - 承诺还款
     *              yq  - 逾期
     *  sex         性别：
     *              M - 男
     *              F - 女
     * @param $current
     */
    public function getUserListFiltered($current)
    {
        $model = CsModel::getInstance($this->getManeger());
        //刷新催收记录表
        $model->refresh();

        $sql = '
SELECT
	uc.jk_id,
	-- 借款ID
	uc.`status` AS cs_status,
	uc.cnhkdate,
	uc.note AS cs_note,
	uc.weiyuejin as cs_weiyuejin,
	uc.add_time as cd_add_time,
	uj.*, jd.*
FROM
	customer_cuishou uc
INNER JOIN customer_jiekuan uj ON uc.jk_id = uj.id
INNER JOIN customers jd ON jd.wx_openid = uj.wx_openid
';
        $type = $this->input->get_post('key');
        $value = $this->input->get_post('value');

        $per_page = $this->input->get_post('per_page');
        $per_page or $per_page = 10;
        $offset = ($current - 1) * $per_page;

        //获取客户的最新催收记录（最新借款记录的最新催收记录）
        $sql_newest = '
SELECT
	uc.jk_id,
	-- 借款ID
	uc.`status` AS cs_status,
	uc.cnhkdate,
	uc.note AS cs_note,
	uc.weiyuejin as cs_weiyuejin,
	uc.add_time as cd_add_time,
	uj.*, jd.* -- 从用户表中获取用户信息
FROM customers jd 
-- 借款记录的最新记录获取
INNER JOIN view_jiekuan_newest vjn ON vjn.wx_openid = jd.wx_openid
INNER JOIN customer_jiekuan uj ON vjn.jid = uj.id 
-- 最新的借款记录的最新的催收记录获取
INNER JOIN view_cuishou_newest vjc ON vjc.jid = uj.id
INNER JOIN customer_cuishou uc ON uc.id = vjc.cid';

        switch ($type) {
            case 'jine':
                $sql .= " where uj.amount = " . intval($value);
                break;
            case 'jk':
                $value = $this->formatDate($value);
                $sql .= " where uj.jkdate = '$value' ";
                break;
            case 'hk':
                $value = $this->formatDate($value);
                $sql .= " where uj.hkdate = '$value' ";
                break;
            case 'nm':
                $sql = $sql_newest . " WHERE jd.name = '{$value}'";
                break;
            case 'phone':
                $sql = $sql_newest . " WHERE jd.phone = '{$value}'";
                break;
            case 'age':
                $sql = $sql_newest . ' WHERE jd.age = ' . intval($value);
                break;
            case 'sex':
                // 0男 1女
                switch ($value) {
                    case 'M':
                        $sql .= 'WHERE jd.sex = 0';
                        break;
                    case 'F':
                        $sql .= 'WHERE jd.sex = 1';
                        break;
                    default:
                        $this->failed('错误的value');
                }
                break;
            case 'status':
                switch ($value) {
                    case 'yq'://逾期
                        $sql .= " WHERE uc.`status` = 0 ";
                        break;
                    case 'cn'://承诺还款
                        $sql .= " WHERE uc.`status` = 1 ";
                        break;
                    default:
                        $this->failed('错误的value');
                }
                break;
            default:
                $this->failed('错误的key');
        }
        //审核人筛选
        $sql .= " and jd.manager = '{$this->getManeger()}' ";

        //获取总数
        $total = count($model->query($sql));
        $user_data = $model->query($sql . "limit $offset,$per_page ");
        if (false === $user_data) {
            \Sharin\dumpout($sql);
            $this->failed('获取失败:' . $model->error());
        }

        $this->jsonReturn([
            'data' => $user_data,
            'zongji' => $total,
        ]);
    }

    /**
     * 获取借款的催收详情
     * URI:/csapi/detail/[借款ID]
     * @param $jk_id
     */
    public function getDetail($jk_id)
    {
        $csmodel = CsModel::getInstance($this->getManeger());
        $jkmodel = JkModel::getInstance($this->getManeger());
        $yqmodel = YqModel::getInstance($this->getManeger());

        //获取该借款的催收记录
        $cslist = $csmodel->getList($jk_id);

        $user = $csmodel->getUserInfoByJkid($jk_id);
        if (false === $user) {
            $this->failed("获取客户信息失败:{$csmodel->error()}");
        }
        $wxid = $user['wx_openid'];

        $userinfo = CustomerModel::getInstance($this->getManeger())->getDetail($wxid);

        //获取该用户借款记录
        $jklist = $jkmodel->getList($wxid);
        if (false === $jklist) {
            $this->failed('获取用户的借款记录失败:' . $jkmodel->error());
        } else {
            foreach ($jklist as &$item) {
                $jk_id = $item['id'];
                $item['cs_list'] = $yqmodel->where([
                    'jk_id' => $jk_id,
                ])->order('add_time desc')->select();
            }
        }

        $userinfo['cuishou_list'] = $cslist;
        $userinfo['jiekuan_list'] = $jklist;
        $this->jsonReturn($userinfo);
    }

    /**
     * 添加催款记录为“已还款”
     * API:
     *  /csapi/huankuan
     *  POST:
     *      jk_id   (int) 借款ID
     *      hktime  (string) 还款时间 如：2018-10-25【可选,为空时默认为今天的日期】
     *      weiyuejin (int)  违约金【可选，为空时默认为0】
     *      beizhu  (stirng) 备注【可选】
     *
     * 修改成功的前提是：
     *  上一次的借款记录为“未还款”
     *
     * @return void
     */
    public function addHuankuan()
    {
        $jk_id = $this->input->get_post('jk_id') or $this->failed('无法获取借款ID');
        $jkmodel = JkModel::getInstance($this->getManeger());

        //获取借款信息
        $jkinfo = $jkmodel->getJiekuanById($jk_id);
        $wxid = $jkinfo['wx_openid'];

        if (false !== $jkinfo) {
            if (intval($jkinfo['status']) > 0) {
                $this->error = '上一次借款已经处于“已还款（包括有逾期）”状态，修改失败';
            } else {
                $jkmodel = JkModel::getInstance($this->getManeger());

                $hktime = $this->input->get_post('hktime') or $hktime = date('Y-m-d');
//                $wyj = $this->input->get_post('weiyuejin') or $wyj = 0;
                $beizhu = $this->input->get_post('beizhu');

                //$csmodel->add($jk_id, self::STATUS_DONE, 0/* 承诺还款时间 */, $beizhu, $wyj)//添加催款记录为已经还款(没有必要这么做)
                if (!$jkmodel->markPayoff($wxid, $this->formatDate($hktime), $beizhu)) {
                    $this->error = $jkmodel->error();
                } else {
                    $this->success('还款成功');
                }
            }
        } else {
            $this->error = $jkmodel->error();
        }
        $this->failed($this->error);
    }

    /**
     * 添加催款记录为“承诺还款”
     * 添加成功的前提条件是上一条催款记录为“逾期”的状态
     *
     * API:
     *  /csapi/addChengnuo
     *  POST:
     *      jk_id       (int) 借款ID
     *      cnhktime    (string) 承诺还款日期，如2018-10-10
     *      beizhu      (string) 备注，可选
     */
    public function addChengnuo()
    {
        empty($jk_id = $this->input->get_post('jk_id')) and $this->failed('缺少借款记录ID');
        empty($cnhktime = $this->input->get_post('cnhktime')) and $this->failed('缺少承诺还款日期');
        empty($beizhu = $this->input->get_post('beizhu')) and $beizhu = '';

        $csmodel = CsModel::getInstance($this->getManeger());

        $lastCuishou = $csmodel->getLastByJkid($jk_id);
        if (false !== $lastCuishou) {
            if ($lastCuishou['status'] < 2) {
                //承诺还款(1)，逾期(0)状态下
                if ($csmodel->add($jk_id, self::STATUS_CN, $cnhktime, $beizhu, 0)) {
                    $this->success('添加催款记录为“承诺还款”成功');
                }
            } else {
                //处于逾期状态下才能修改
                $this->error = '该借款的催收已经处于“已还款/延期”状态，无法修改';
            }
        }
        $this->failed($this->error ? $this->error : $csmodel->error());
    }

    /**
     * 添加逾期
     * URL:/csapi/yuqi
     * POST:
     *  jk_id       (int)借款ID
     *  beizhu      (string)备注
     */
    public function addYuqi()
    {
        $jk_id = $this->input->get_post('jk_id') or $this->failed('未填写借款ID');
        empty($note = $this->input->get_post('beizhu')) and $note = '';//备注为可选择

        //催收记录中添加逾期
        $csmodel = CsModel::getInstance($this->getManeger());
        if (!$csmodel->add($jk_id, self::STATUS_YQ, null, $note, 0)) {
            //添加催收记录为延期状态
            $this->failed("催收记录中添加延期失败:{$csmodel->error()}");
        } else {
            $this->success('修改成功');
        }
    }

    /**
     * 添加延期
     * API:
     *  /csapi/delay
     *  POST:
     *      jk_id       (int )借款ID
     *      delay_days  (int) 延期天数
     *      delay_fee   (int) 延期费用
     *      jine        (int) 金额
     *      begin_date  (string) 日期格式如 2018-12-10
     *      beizhu      (string) 备注，可选
     * 注：
     *  可以延期的款项可以一直延期
     *
     * 步骤：
     *  1. 根据借款ID'$jk_id'获取客户的详细信息'$userinfo'
     *  2. 根据客户详细信息获取客户的微信OPENID'$wx_openid'和客户类型'$user_type'
     *  3. 获取输入参数
     *  4. 根据客户类型和延期天数决定借款记录是
     *      新增(A方案：添加一条新的借款记录并将上次借款状态设置为有延期2)
     *          或者
     *      修改(B方案：添加一天延期记录并修改借款记录的还款时间为延期到期时间)
     *  5.1 如果借款记录为新增，直接使用JkModel::insertDelay()方法添加借款记录
     *  5.2 如果借款记录为修改，则制定6和7两步操作：
     *  6. 延期表中新增延期记录
     *  7. 借款表中修改还款时间字段为延期到期时间.
     *
     */
    public function addDelay()
    {
        $jk_id = $this->input->get_post('jk_id') or $this->failed('未填写借款ID');
        empty($amount = $this->input->get_post('jine')) and $this->failed('未填写金额');
        empty($jktime = $this->input->get_post('begin_date')) and $this->failed('未填写借款日/延期日');
        empty($days = intval($this->input->post('delay_days'))) and $this->failed('未填写延期天数');
        empty($fee = $this->input->post('delay_fee')) and $this->failed('未填写延期费用');
        empty($note = $this->input->get_post('beizhu')) and $note = '';//备注为可选择

        $jkmodel = JkModel::getInstance($this->getManeger());

        $userinfo = $jkmodel->getUserinfoByJkid($jk_id);
        if (!$userinfo) {
            $this->failed("无法获取借款ID为'{$jk_id}'的客户的jkmodel信息:'{$jkmodel->error()}'");
        }
        $wx_openid = $userinfo['wx_openid'];

        $last = $jkmodel->getLast($wx_openid);
        if (false === $last) {
            $this->failed("无法获取该客户的最近一次的借款记录 ：{$jkmodel->error()}");
        } else {
            //根据客户类型 决定 是添加新的借款记录还是仅仅更新还款时间
//                $type = 0;//添加借款记录1/修改借款记录0
//                switch ($user_type) {
//                    case 'A':
//                        if ($days > 28) $type = 1;
//                        break;
//                    case 'B':
//                        if ($days > 14) $type = 1;
//                        break;
//                    case 'C':
//                        if ($days > 7) $type = 1;
//                        break;
//                    default:
//                        $this->failed("检测到不合法的客户类型'{$userinfo['type']}'!");
//                }
//                if ($type) {
//                    //A方案
//                    if (!$jkmodel->insertDelay($wx_openid, $jine, $jktime, $days, $fee, $beizhu)) {
//                        $jkmodel->rollback();
//                        $this->failed($jkmodel->error());
//                    }
//                } else {
            $jkmodel->beginTransaction();
            $yqdate = date('Y-m-d', strtotime($jktime) + $days * 24 * 3600);//延期至
            $yqModel = YqModel::getInstance($this->getManeger());
            if (!$yqModel->insert([
                'jk_id' => $jk_id,
                'begin_date' => $jktime,
                'days' => $days,
                'end_date' => $yqdate,
                'fee' => $fee,
                'note' => $note,
                'amount' => $amount,//金额
            ])
            ) {
                $jkmodel->rollback();
                $this->failed('添加延期记录失败：' . $yqModel->error());
            } elseif (false === $jkmodel->update(['hkdate' => $yqdate], ['id' => $jk_id])) {
                //修改借款记录的 "还款时间"
                //TODO:填写延期时金额是否更新到借款记录的金额上,"amount"
                $jkmodel->rollback();
                $this->failed('更新借款记录失败：' . $jkmodel->error());
            }
            //else; //前两项修改成功
        }

        //催收记录中添加延期
        $csmodel = CsModel::getInstance($this->getManeger());
        if (!$csmodel->add($jk_id, self::STATUS_DELAY, null, $note, 0)) {
            //添加催收记录为延期状态
            $jkmodel->rollback();
            $this->failed("催收记录中添加延期失败:{$csmodel->error()}");
        }
        //前两个操作添加成功 才能被认定为添加完成
        $jkmodel->commit();
        $this->success('延期成功');
    }
}