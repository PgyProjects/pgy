<?php
/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/21
 * Time: 9:52
 */

namespace Library;


class DaoConnectException extends Exception
{
    public function __construct($message)
    {
        $this->message = $message;
    }

}