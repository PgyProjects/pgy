<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/14
 * Time: 14:04
 */

namespace App\Http\Controllers;

use Exception;
use JkModel;
use Library\Dao;
use Library\Input;

require_once __DIR__ . '/../../autoload.php';

/**
 * Class ApiController
 * @package App\Http\Controllers
 * @property Input $input
 * @property Dao $db
 */
class ApiController extends Controller
{

    protected $error = '';

    /**
     * 获取错误信息
     * @return string
     */
    protected function getError()
    {
        return $this->error;
    }

    /**
     * TODO:获取客户经理
     */
    protected function getManeger()
    {
//        $data = $this->session->get_userdata();
//        return $data['username'];
        return '1';
    }


    /**
     * @param $url
     * @param string $cookie
     * @param bool $header
     * @param array $opts
     * @return string|false
     */
    public static function get($url, $cookie = '', $header = false, array $opts = [])
    {
        $ch = curl_init($url);
        if(strpos($url,'https://') === 0){
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_HEADER, $header); //将头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($cookie) {
            $dir = dirname($cookie);
            if (!is_dir($dir)) {
                if (!mkdir($dir, 0777, true)) {
                    return false;
                }
            }
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        }
        if ($opts) foreach ($opts as $k => $v) {
            curl_setopt($ch, $k, $v);
        }

        $content = curl_exec($ch);
        curl_close($ch);
        return false === $content ? '' : (string)$content;
    }


    public function __get($name)
    {
        static $instances = [];
        if (!isset($instances[$name])) {
            switch ($name) {
                case 'db':
                    $instances[$name] = Dao::getInstance();
                    break;
                case 'input':
                    $instances[$name] = new Input();
                    break;
            }
        }
        return $instances[$name];
    }


    /**
     * 時間戳轉時間
     * @param $timestamp
     * @return false|string
     */
    protected function timestamp2datetime($timestamp)
    {
        return date('Y-m-d H:i:s', intval($timestamp));
    }

    /**
     * 整理日期格式
     * @param $cndate
     * @return bool|false|int|string
     */
    protected function formatDate($cndate)
    {
        if (empty($cndate)) {
            $cndate = 0;//'0000-00-00'
        } else {
            $datetemp = strtotime($cndate);
            if (false === $datetemp) {
                $this->error = '不合法的日期值:' . $cndate;
                return false;
            } else {
                $cndate = date('Y-m-d', $datetemp);
            }
            $cndate = date('Y-m-d', strtotime($cndate));
        }
        return $cndate;
    }

    /**
     * ajax返回json數據
     * @param $data
     */
    protected function jsonReturn($data)
    {
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data));
    }


    protected function failed($info = null)
    {
        if (null === $info) $info = $this->error;
        $this->jsonReturn([
            'status' => 0,
            'message' => $info,
        ]);
    }

    public function post()
    {

    }

    protected function success($info)
    {
        $this->jsonReturn([
            'status' => 1,
            'message' => $info,
        ]);
    }

    /**
     * @param array $user_data 用户信息列表
     * @param callable $callback 时间戳格式化参数
     */
    protected function formatList(array &$user_data, callable $callback = null)
    {
        $now = time();//当前时间
        $daysecs = 3600 * 24;
        foreach ($user_data as &$item) {
            $timestamp = $callback($item);//合同还款时间
            $dis = $now - $timestamp;
            if (intval($item['status'])) {
                //状态等于1，已经还款
                $item['zhuangtai'] = '已经还款';
            } else {
                //未还款
                if ($dis < -1 * $daysecs) {
                    //距离还款时间一天以上
                    $item['zhuangtai'] = '未还款';
                } elseif ($dis < 0) {
                    $item['zhuangtai'] = '明天还款';
                } elseif ($dis < 1 * $daysecs) {
                    $item['zhuangtai'] = '今天还款';
                } elseif ($dis < 2 * $daysecs) {
                    $item['zhuangtai'] = '宽限日';
                } else {
                    $item['zhuangtai'] = '逾期中';
                }
            }
        }
    }

    /**
     * 借款状态(借款属性：首借、续借、延期)转中文
     * @param $id
     * @return string
     */
    protected function jkttr2Cn($id)
    {
        switch ((string)$id) {
            case '0':
                $id = '首借';
                break;
            case '1':
                $id = '延期';
                break;
            case '2':
                $id = '续借';
                break;
            default:
                $id = '未知状态.';
        }
        return $id;
    }

    /**
     * 借款状态（未还款、已还款、有延期）转中文
     * @param $id
     * @return string
     */
    protected function jkStatus2Cn($id)
    {
        switch ((string)$id) {
            case '0':
                $id = '未还款';
                break;
            case '1':
                $id = '已还款';
                break;
            case '2':
                $id = '有逾期';
                break;
            default:
                $id = '未知状态.';
        }
        return $id;
    }


    /**
     * 修改上次的借款狀態
     * 借款狀態有三種：
     * //     *  0 - 首次借款
     * //     *  1 - 延期
     * //     *  2 - 續借
     * @param int|string $uid 用戶ID
     * @param int|null $status 不给订参数或者参数为null的情况下自动将还款时间和当前日期进行比较
     * @return bool
     * @throws Exception
     */
    protected function updateLastRecordStatus($uid, $status = null)
    {
        $last = JkModel::getInstance($this->getManeger())->getLast($uid);
        if (false === $last) {
            return false;
        } else {
            $id = $last['id'];
            if (null === $status) {
                $huankuanri = strtotime($last['huankuanri']);
                $now = strtotime(date('Y-m-d'));
                if ($huankuanri >= intval($now)) {
                    //今天
                    $status = 1;
                } else {
                    $status = 2;
                }
            }
            return JkModel::getInstance()->update([
                'status' => $status,
                'shijihuankuanri' => date('Y-m-d'),
            ], [
                'id' => $id,
            ]);
        }
    }
}