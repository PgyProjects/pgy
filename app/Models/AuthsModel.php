<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/18
 * Time: 9:17
 */
class AuthsModel extends PgyModel
{
    protected $tablename = 'auths';

    protected function tableName()
    {
        return 'auths';
    }

    protected function validateInsert($fields)
    {
        return true;
    }

    public function validateDelete($where)
    {
        return true;
    }

    protected function validateUpdate($fields, $where)
    {
        return true;
    }

}