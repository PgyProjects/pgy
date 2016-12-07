<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/18
 * Time: 9:19
 */
class CustomDetailsModel extends PgyModel
{
    protected $tablename = 'custom_details';

    protected function tableName()
    {
        return 'custom_details';
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