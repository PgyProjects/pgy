<?php
/**
 * Repository: https://github.com/kbylin0531/psrg7_newest.git
 * User: Linzh
 * Date: ${DATE}
 * Time: ${TIME}
 */

namespace Library\Traits;

/**
 * Class Multiton
 * for multiple design pattern
 * @package Sharin\Traits
 */
trait Multiton
{
    /**
     * @var array
     */
    protected static $_multiple_instances = [];

    /**
     * @param ...
     * @return mixed
     */
    public static function getInstance(){
        $static = static::class;
        isset(self::$_multiple_instances[$static]) or self::$_multiple_instances[$static] = [];

        $num = func_num_args();
        $arguments = null;
        if($num){
            $arguments = func_get_args();
            $index = md5(serialize($arguments));
        }else{
            $index = '';
        }

        if (!isset(self::$_multiple_instances[$static][$index])) {
            self::$_multiple_instances[$static][$index] = $num ?
                (new \ReflectionClass($static))->newInstanceArgs($arguments):
                new $static();
        }
        return self::$_multiple_instances[$static][$index];
    }


}