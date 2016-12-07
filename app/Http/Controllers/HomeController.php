<?php
namespace App\Http\Controllers;

use DB;
use CustomerModel;
use CustomerInfoModel;
use CustomContectersModel;
use Library\Timer;

class HomeController extends Controller
{
    public function index()
    {
        wang_jiance_weixin();
        return view('home/index_1');
    }

    public function index_2()
    {
        wang_jiance_weixin();
        return view('home/index_2');
    }

    public function index_3()
    {
        $openid = $this->_checkInfo();
        echo "<script>var wx_openid='{$openid}' ;</script>";
        return view('home/index_3');
    }

    private function _checkInfo()
    {
        if (!empty($_GET["openid"])) {
            session('openid', $openid = $_GET["openid"]);
        } else {
            if (!session('openid')) {
                $weixin = new \class_weixin();
                if (!isset($_GET["code"])) {
                    $redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    $jumpurl = $weixin->oauth2_authorize($redirect_url, "snsapi_userinfo", "123");
                    header("Location: $jumpurl");
                    die;
                } else {
                    $access_token = $weixin->oauth2_access_token($_GET["code"]);
                    @$openid = $access_token['openid'];
                    @$userinfo = $weixin->oauth2_get_user_info($access_token['access_token'], $access_token['openid']);
                    //echo $openid.$userinfo['nickname'];
                    session('openid', $openid);
                    session(['weixin_name' => $userinfo['nickname'], 'weixin_touxiang' => $userinfo['headimgurl'], 'weixin_sex' => $userinfo['sex'], 'weixin_shenfen' => $userinfo["province"]]);
                }
            } else {
                $openid = session('openid');
            }
        }
        return $openid;
    }

    public function index_4()
    {
        wang_jiance_weixin();
        return view('home/index_4');
    }

    public function index_3_jk()
    {
        return view('home/jk2');
    }

    public function index_4_tj_info()
    {
        return view('home/tj_info');
    }

    /**
     * 文件上传
     * @param string $fieldname 提交字段名称
     * @param string $savename 文件保存名称
     * @return true|string 成功是返回true，失败时返回string表示错误信息
     */
    private function uploadFile($fieldname, $savename)
    {
        //Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
//        if (empty($_FILES[$fieldname])) {
//            return "未检测到上传的文件";
//        }
//        $file1 = $_FILES[$fieldname];//得到传输的数据
//
//        //得到文件名称
//        $filename = $file1['name'];
//
//        //获取文件后缀并转小写
//        $subfix = strtolower(substr($filename, strrpos($filename, '.') + 1));
//
//        //判断文件类型是否被允许上传
//        if (!in_array($subfix, array('jpg', 'jpeg', 'png'))) {
//            return "文件类型不允许";
//        }
//
//        //判断上传文件是否存在于系统缓存目录中
//        if (!is_uploaded_file($file1['tmp_name'])) {
//            return "未检测到上传文件";
//        }
        $upload_path = './uploads/shenfenzheng/'; //上传文件的存放路径，相对于入口文件
//
//        //开始移动文件到相应的文件夹
//        if (move_uploaded_file($file1['tmp_name'], $upload_path . $savename)) {
//            return true;
//        } else {
//            return "转移文件成功";
//        }

        if (empty($_POST[$fieldname])) {
            return "未检测到上传的文件";
        }

        $url = explode(',', $_POST[$fieldname]);

        return file_put_contents($upload_path . $savename, base64_decode($url[1])) ? true : false;//返回的是字节数

    }

    private function _getSessionId()
    {
        $_ssionid = session('openid');
        if (empty($_ssionid)) {
            session('openid', $_ssionid = 'ohyMUwki96X68T3iJ7aHEHZenInU');
            session('weixin_name', '测试');
            var_dump($_ssionid, empty($_ssionid), session('weixin_name'));
            die;


            session('weixin_touxiang', 'http://www.itheima.com/uploads/2015/05/small_icon2.jpg');
            session('weixin_sex', '1');
            session('weixin_shenfen', '545d4sa5d7s8d45s45454');
        }
        return $_ssionid;
    }

    /**
     * @Author:      Wang
     * @DateTime:    2016-11-17 10:06:26
     * @Description:
     */
    public function bd1()
    {
        $sessionid = $this->_getSessionId();


        if (!empty((array)DB::table('customers')->where('wx_openid', $sessionid)->first())) {
            die('<script >self.location="' . asset('home/bd2') . '"; </script>');
        }


        //检测 数据库中是否有OPENID
        $record = CustomerModel::getInstance(1)->where([
            'wx_openid' => $sessionid,
        ])->find();
        if (false === $record) {
            $this->showAlert('检测记录失败');
        } elseif ($record) {
            $this->showAlert('你已填写基本信息');
        }

        $p_xingming = $this->input->post('xingming');
        $p_shoujihao = $this->input->post('shoujihao');
        $p_shenfenzheng = $this->input->post('shenfenzheng');
        $p_email = $this->input->post('email');
        $p_xueli = $this->input->post('xueli');
        $p_gongzuodanwei = $this->input->post('gongzuodanwei');
//        $p_dangqianweizhi = $this->input->post('dangqianweizhi');
//        $p_zhimafen = $this->input->post('zhimafen');
//        $p_shouru = $this->input->post('shouru');
//        $p_dizhi_1 = $this->input->post('dizhi_1');
//        $p_dizhi_2 = $this->input->post('dizhi_2');
//        $p_dizhi_3 = $this->input->post('dizhi_3');
//        $p_dizhi_4 = $this->input->post('dizhi_4');
//        $p_dizhi_5 = $this->input->post('dizhi_5');
//        $p_dizhi_6 = $this->input->post('dizhi_6');
//        $p_dizhi_7 = $this->input->post('dizhi_7');
//        $p_dizhi_8 = $this->input->post('dizhi_8');

        if (!empty($p_xingming)) {
            //$this->session->set_userdata('shenfenzheng', $p_shenfenzheng);
            session(['idCard' => $p_shenfenzheng]);
            //echo $_SESSION['idCard'];
            //$bd1_data=$this->db->get_where('jxl_data1',array('shenfenzheng'=>$p_shenfenzheng))->row_array();
            $model = new CustomerModel();
            $bd1_data = $model->where([
                'idCard' => $p_shenfenzheng])->find();

//            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "iphone")) {
//                $browser = "iphone";
//            } elseif (strpos($_SERVER['HTTP_USER_AGENT'], "Linux")) {
//                $browser = "Android";
//            } else {
//                $browser = "未知";
//            }
            $s = substr($p_shenfenzheng, -2, 1);
            if ($s % 2 == 0) {
                //$sex='女';
                $sex = '2';
            } else {
                //$sex='男';
                $sex = '1';
            }

            $url = "http://apis.juhe.cn/idcard/index";
            $params = array(
                "cardno" => $p_shenfenzheng,//身份证号码
                "dtype" => "",//返回数据格式：json或xml,默认json
                "key" => "599b0c28c1abb0845974dd3494690770",//你申请的key
            );
            $paramstring = http_build_query($params);
            $content = juhecurl($url, $paramstring);
            $result = json_decode($content, true);
            if ($result) {
                if ($result['error_code'] != '0') {
                    $this->showAlert($result['error_code'] . ":" . $result['reason']);
                }
            } else {
                $this->showAlert('聚合验证身份证失败');
            }

            if (true !== ($r = $this->uploadFile('userfile1', 'w_' . session('idCard') . '_1.jpg'))) {
                $this->showAlert('上传第一张图片失败：' . $r);
            }
            if (true !== ($r = $this->uploadFile('userfile2', 'w_' . session('idCard') . '_2.jpg'))) {
                $this->showAlert('上传第二张图片失败：' . $r);
            }
            if (true !== ($r = $this->uploadFile('userfile3', 'w_' . session('idCard') . '_3.jpg'))) {
                $this->showAlert('上传第二张图片失败：' . $r);
            }

            if (empty($bd1_data['idCard'])) {
                $in_data = array(
                    'name' => $p_xingming,
                    'phone' => $p_shoujihao,
                    'idCard' => $p_shenfenzheng,
                    'email' => $p_email,
                    'education' => $p_xueli,
                    'company' => $p_gongzuodanwei,
//                    'address' => $p_dangqianweizhi,
                    'shenfenzheng_img' => serialize(array(1 => 'w_' . session('idCard') . '_1.jpg', 2 => 'w_' . session('idCard') . '_2.jpg', 3 => 'w_' . session('idCard') . '_3.jpg')),
                    'ip' => getIP(),
                    'sex' => $sex,
                    'age' => getAgeByID($p_shenfenzheng),//年龄
                    'hujidizhi' => $result['result']['area'],
                    //'time'=>date("Y-m-d H:i:s"),
                    'wx_openid' => $sessionid,
//                    'input_zhima' => $p_zhimafen,//手动输入芝麻分
//                    'manager' => '1'
                );

                if ($model->insert($in_data)) {
                    $in_weixin = array(
                        'wxid' => $sessionid,
                        'wx_name' => session('weixin_name'),
                        'wx_img' => session('weixin_touxiang'),
                        'wx_sex' => session('weixin_sex'),
                        'wx_addr' => session('weixin_shenfen')
                    );
                    $wx_model = new CustomerInfoModel;
                    if ($wx_model->insert($in_weixin)) {
                        wang_tiaozhuan(asset('home/bd2'));
                    } else {
                        echo "错误:{$wx_model->error()}";

                    }

                } else {
                    echo $model->error();
                }
            } else {
                wang_tishi('用户信息已存在');
            }
            die;
        }
        return view('home/bd/bd1');
    }

    /**
     * @Author:      Wang
     * @DateTime:    2016-11-17 10:06:31
     * @Description:
     */
    public function bd2()
    {
        @$p_fuqin_xingming = $_POST['fuqin_xingming'];
        @$p_fuqin_shoujihao = $_POST['fuqin_shoujihao'];
        @$p_muqin_xingming = $_POST['muqin_xingming'];
        @$p_muqin_shoujihao = $_POST['muqin_shoujihao'];
        @$p_peiou_xingming = $_POST['peiou_xingming'];
        @$p_peiou_shoujihao = $_POST['peiou_shoujihao'];
        @$p_lingdao_xingming = $_POST['lingdao_xingming'];
        @$p_lingdao_shoujihao = $_POST['lingdao_shoujihao'];
        @$p_pengyou_xingming = $_POST['pengyou_xingming'];
        @$p_pengyou_shoujihao = $_POST['pengyou_shoujihao'];
        @$g_openid = $_GET['openid'];
        //echo $g_shenfenzheng;
        if (empty($p_fuqin_xingming)) {
            return view('home/bd/bd2');
        } else {
            $jxl_user_data = DB::table('custom_contecters')->where('uid', session('openid'))->first();
            $jxl_user_data = (array)$jxl_user_data;
            if (empty($jxl_user_data)) {
                $CustomerContecters = CustomContectersModel::getInstance(1);

                $in_data = array(
                    'fname' => $p_fuqin_xingming,
                    'fphone' => $p_fuqin_shoujihao,
                    'mname' => $p_muqin_xingming,
                    'mphone' => $p_muqin_shoujihao,
                    'pname' => $p_peiou_xingming,
                    'pphone' => $p_peiou_shoujihao,
                    'lname' => $p_lingdao_xingming,
                    'lphone' => $p_lingdao_shoujihao,
                    'yname' => $p_pengyou_xingming,
                    'yphone' => $p_pengyou_shoujihao,
                    'uid' => session('openid'),
                );
                $CustomerContecters->beginTransaction();
                if ($CustomerContecters->insert($in_data)) {
                    if (\CustomFormsModel::getInstance(1)->insert(['uid' => session('openid')])) {
                        $CustomerContecters->commit();
                        wang_tishi('OK,提交成功！');
                        wang_tiaozhuan(asset('home/index_2'));
                    } else {
                        $CustomerContecters->rollback();
                    }
                } else {
                    $CustomerContecters->rollback();
                    echo '错误';
                }
            }
        }
    }

    /**
     * @Author:      Wang
     * @DateTime:    2016-11-17 16:53:53
     * @Description: 验证身份证合法性
     */

    public function shenfenzheng_ajax()
    {
        @$p_shenfenzheng = $_POST['shenfenzheng'];
        $url = "http://apis.juhe.cn/idcard/index";
        $params = array(
            "cardno" => $p_shenfenzheng,//身份证号码
            "dtype" => "",//返回数据格式：json或xml,默认json
            "key" => "599b0c28c1abb0845974dd3494690770",
        );
        $paramstring = http_build_query($params);
        $content = juhecurl($url, $paramstring);
        $result = json_decode($content, true);

        $arr = array('code' => $result['error_code']);
        echo json_encode($arr, true);
    }

    /**
     * @Author:      Wang
     * @DateTime:    2016-11-17 14:06:25
     * @Description: 控制图标 禁止点击接口
     */
    public function kongzhi_ajax()
    {
        $openid = session('openid');
        if ($openid) {
            $kongzhi_wc = DB::table('custom_contecters')->where('uid', $openid)->first();
            $kongzhi_wc = (array)$kongzhi_wc;

            $kongzhi_data = DB::table('custom_forms')->where('uid', $openid)->first();
            $kongzhi_data = (array)$kongzhi_data;

            $user_data = DB::table('customers')->where('wx_openid', $openid)->first();
            $user_data = (array)$user_data;

            if (empty($kongzhi_wc) or empty($kongzhi_data) or empty($kongzhi_data)) {
                $this->ajaxReturn([
                    'status' => 0,
                    'message' => '用户信息不完整',
                ]);
            }

            $type = 1;
            if (!in_array($user_data['type'], ['A', 'B', 'C'])) {
                $type = 0;
            }

            if ($kongzhi_data['auth_jd'] == 0) {
                $kongzhi_jd = 0;
                $img_jd = 'jingdong.png';
            } else {
                $kongzhi_jd = 1;
                $img_jd = 'jingdong2.png';
            }

            if ($kongzhi_data['auth_tb'] == 0) {
                $kongzhi_tb = 0;
                $img_tb = 'taobao.png';
            } else {
                $kongzhi_tb = 1;
                $img_tb = 'taobao2.png';
            }

            if ($kongzhi_data['auth_yys'] == 0) {
                $kongzhi_yys = 0;
                $img_yys = 'yys.png';
            } else {
                $kongzhi_yys = 1;
                $img_yys = 'yys2.png';
            }

            if ($kongzhi_data['auth_zfb'] == 0) {
                $kongzhi_zmf = 0;
                $img_zmf = 'zmf.png';
                $dizhi_zmf = 'http://test.pgyxwd.com/zmxy/index?mobileNo=' . $user_data['phone'] . '&certNo=' . $user_data['idCard'] . '&xingming=' . $user_data['name'];
            } else {
                $kongzhi_zmf = 1;
                $img_zmf = 'zmf2.png';
                $dizhi_zmf = '';
            }
            $this->ajaxReturn([
                'status' => 1,
                'message' => [
                    'type' => $type,
                    'user_data' => empty($user_data) ? 0 : 1,
                    'kongzhi_zmf' => $kongzhi_zmf,
                    'dizhi_zmf' => $dizhi_zmf,
                    'img_zmf' => $img_zmf,
                    'kongzhi_yys' => $kongzhi_yys,
                    'dizhi_yys' => asset('jxl/yysqutoken'),
                    'img_yys' => $img_yys,
                    'kongzhi_jd' => $kongzhi_jd,
                    'dizhi_jd' => asset('jxl/jdqutoken'),
                    'img_jd' => $img_jd,
                    'kongzhi_tb' => $kongzhi_tb,
                    'dizhi_tb' => asset('jxl/tbqutoken'),
                    'img_tb' => $img_tb
                ],
            ]);
        } else {
            $this->ajaxReturn([
                'status' => 0,
                'message' => '无法从session中读取OPENID',
            ]);
        }
    }

    /**
     * ajax返回json數據
     * @param $data
     */
    protected function ajaxReturn($data)
    {
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data));
    }
}
