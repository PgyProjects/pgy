<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/18
 * Time: 9:18
 */
class CustomCreditsModel extends PgyModel
{
    protected $tablename = 'custom_credits';

    protected function tableName()
    {
        return 'custom_credits';
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