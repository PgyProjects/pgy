<?php
/**
 * Repository: https://github.com/kbylin0531/psrg7_newest.git
 * User: Linzh
 * Date: ${DATE}
 * Time: ${TIME}
 */
namespace Library\Traits;

/**
 * Class Singleton
 * for single design pattern
 * Warning: The constructor of class which put this trait in use must be public ,
 *          otherwise the error will occur.
 * @package Sharin\Traits
 */
trait Singleton
{
    /**
     * @var array
     */
    protected static $_single_instances = [];

    /**
     * @param ...
     * @return object
     */
    public static function getInstance()
    {
        $clsnm = static::class;
        if (!isset(self::$_single_instances[$clsnm])) {
            if (func_num_args() > 0) {
                self::$_single_instances[$clsnm] = (new \ReflectionClass($clsnm))->newInstanceArgs(func_get_args());
            } else {
                self::$_single_instances[$clsnm] = new $clsnm();
            }
        }
        return self::$_single_instances[$clsnm];
    }

}