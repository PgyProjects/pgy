<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/18
 * Time: 9:12
 */
class CustomContectersModel extends PgyModel
{
    protected $tablename = 'custom_contecters';

    protected function tableName()
    {
        return 'custom_contecters';
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