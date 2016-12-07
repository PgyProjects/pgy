<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/18
 * Time: 9:21
 */
class CustomFormsModel extends PgyModel
{
    protected $tablename = 'custom_forms';

    protected function tableName()
    {
        return 'custom_forms';
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