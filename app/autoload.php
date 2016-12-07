<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */
date_default_timezone_set('Asia/Shanghai');
$file = __DIR__.'/../tests/Sharin/web.inc';
$trace = __DIR__.'/Library/trace.plugin.inc';
is_file($file) and require $file;
is_file($trace) and require $trace;
defined('SR_IS_CLI') or define('SR_IS_CLI', PHP_SAPI === 'cli');

/**
 * 获取标准化的数据库连接配置
 * @return array
 * @throws Exception
 */
function getDbConnection()
{
    $conf = __DIR__ . '/../.env';
    if (!is_file($conf)) {
        throw new Exception("file '{$conf}' not found !");
    }
    $connections = parse_ini_file($conf);
    return [
        'dbname' => $connections['DB_DATABASE'],
        'username' => $connections['DB_USERNAME'],
        'password' => $connections['DB_PASSWORD'],
        'host' => $connections['DB_HOST'],
        'port' => $connections['DB_PORT'],
    ];
}

define('APPLICAITON_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('CONTROLLER_DIR', APPLICAITON_DIR . 'Http/Controllers/');
define('MODEL_DIR', APPLICAITON_DIR . 'Models/');
define('LIBRARY_DIR', APPLICAITON_DIR . 'Library/');

spl_autoload_register(function ($clsnm) {
    $clsnm = str_replace('\\', DIRECTORY_SEPARATOR, $clsnm);
    if (strpos($clsnm, '\\')) {
        // 存在命名空间的情况
        $file = APPLICAITON_DIR . $clsnm . '.php';
        if (is_file($file) and is_readable($file)) {
            include_once $file;
        }
    } else {
        foreach ([APPLICAITON_DIR, CONTROLLER_DIR, MODEL_DIR, LIBRARY_DIR,APPLICAITON_DIR.'Wang/'] as $dir) {
            $file = $dir . $clsnm . '.php';
            if (is_file($file) and is_readable($file)) {
                include_once $file;
                break;
            }
        }
    }
});
