<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/29
 * Time: 10:52
 */
namespace Library;


date_default_timezone_set('Asia/Shanghai');

defined('DEAMON_DIR') or define('DEAMON_DIR', __DIR__ . '/Timer/');
define('DEAMON_LOOP_DIR', DEAMON_DIR . 'loop/');
define('DEAMON_ONCE_DIR', DEAMON_DIR . 'once/');
is_dir(DEAMON_DIR) or mkdir(DEAMON_DIR);
is_dir(DEAMON_LOOP_DIR) or mkdir(DEAMON_LOOP_DIR);
is_dir(DEAMON_ONCE_DIR) or mkdir(DEAMON_ONCE_DIR);
define('DEAMON_ACTION', empty($argv[1]) ? '' : $argv[1]);

/**
 * Class Timer 定时器类
 *
 * 开启定时器:
 *  require_once __DIR__.'/../autoload.php';
 *  \Library\Timer::run(3);
 *
 * 添加一次性脚本：
 *  use Library\Timer;
 *  require_once __DIR__ . '/../autoload.php';
 *  var_dump(Timer::once("echo 'Hello Once';", 10));
 *
 * 添加循环脚本：
 *  use Library\Timer;
 *  require_once __DIR__ . '/../autoload.php';
 *  var_dump(Timer::loop("echo 'Hello Loop';", 'looptest'));
 *
 * 推出循环脚本：
 *  use Library\Timer;
 *  require_once __DIR__ . '/../autoload.php';
 *  var_dump(Timer::loopout('looptest'));
 *
 * @package Library
 */
class Timer
{
    /**
     * 开启定时器服务
     * @param int $sec 检视间隔，以秒计
     */
    public static function run($sec)
    {
        self::setTimeoutLoop(function () {
            try {
                $time = time();
                //检查once目录，执行到时脚本
                self::scan(DEAMON_ONCE_DIR, function ($file, $path) use ($time) {
                    echo "EXEC ONCE:$file,$path --> ";
                    $exec_time = pathinfo($file, PATHINFO_FILENAME);

                    if ($time >= intval($exec_time) and is_file($path)) {
                        echo " TIMEOUT EXECUTE AND REMOVE\n";
                        //到点包含php文件，之后删除
                        require $path;
                        unlink($path);
                    } else {
                        //没到点
                        echo " TIMEWAIT\n";
                    }
                });

                self::scan(DEAMON_LOOP_DIR, function ($file, $path) {
                    echo "EXEC LOOP:$file,$path\n";
                    is_file($path) and require($path);
                });
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }, $sec);
    }

    /**
     * 添加一次性执行的代码
     * @param string $code 延迟执行的代码
     * @param int $delay 延迟的时间
     * @return bool
     */
    public static function once($code, $delay)
    {
        $time = time();
        $exec_time = $time + $delay;
        $exec_time2 = date('Y-m-d H:i:s', $exec_time);
        return file_put_contents(DEAMON_ONCE_DIR . $exec_time . '.php',
            "
<?php
/**
 * create by Timer
 * will execute in $exec_time2
 */
$code") ? true : false;
    }

    /**
     * 添加一个loop脚本
     * @param string $code 可执行PHP代码
     * @param string $name loop脚本的名称
     * @return bool
     */
    public static function loop($code, $name)
    {
        $filename = DEAMON_LOOP_DIR . $name . '.php';
        return file_put_contents($filename,
            "<?php
/**
 * create by Timer
 * will execute on loop
 */
$code") ? true : false;
    }

    /**
     * 删除loop脚本
     * @param $name
     */
    public static function loopout($name)
    {
        $filename = DEAMON_LOOP_DIR . $name . '.php';
        is_file($filename) and unlink($filename);
    }

    public static function scan($dir, $callback)
    {
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file === '.' or '..' === $file or pathinfo($file, PATHINFO_EXTENSION) !== 'php') continue;
                    $callback($file, $dir . $file);
                }
                closedir($dh);
            }
        }
    }

    /**
     * 定期执行
     * @param callable $callback 定时制定的回调用函数
     * @param int $sec 间隔检查的秒数
     */
    public static function setTimeoutLoop(callable $callback, $sec)
    {
        self::delayCall($callback, $sec);
        self::setTimeoutLoop($callback, $sec);
    }

    /**
     * 延期执行
     * @param callable $callback 定时制定的回调用函数
     * @param int $sec 间隔检查的秒数
     */
    public static function delayCall(callable $callback, $sec)
    {
        sleep($sec);
        $callback();
    }

    public static function autorun($sec = 10)
    {
        if (PHP_SAPI === 'cli' and DEAMON_ACTION === 'start') {
            echo "----------- DEAMON START -----------\n";
            self::run($sec);
        }
    }

}

Timer::autorun(30);