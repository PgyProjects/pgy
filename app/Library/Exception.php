<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */
namespace Library;


class Exception extends \Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return true;
     */
    public static function throwing()
    {
        throw new static(var_export(func_get_args(), true));
    }
}