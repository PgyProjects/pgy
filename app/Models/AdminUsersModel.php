<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/18
 * Time: 9:16
 */
class AdminUsers extends PgyModel
{
    protected $tablename = 'admin_users';

    protected function tableName()
    {
        return 'admin_users';
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