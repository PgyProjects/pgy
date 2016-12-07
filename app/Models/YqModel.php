<?php

/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/23
 * Time: 13:06
 */
class YqModel extends PgyModel
{
    protected function tableName()
    {
        return 'customer_yanqi';
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