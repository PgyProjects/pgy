<?php

/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */
abstract class PgyModel extends \Library\Model
{

    protected $manager = '1';

    /**
     * Model constructor.
     * @param string $manager 客户经理
     */
    public function __construct($manager='1')
    {
        $this->manager = $manager;
        parent::__construct(null);
    }



    /**
     * 获取模型实例
     * @param string $manager 客户经理，如admin
     * @return PgyModel
     * @throws Exception
     */
    public static function getInstance($manager = null)
    {
        static $_manager = null;
        static $_instances = [];
        isset($manager) and $_manager = $manager;
        isset($_manager) or $_manager = 1;
        $clsnm = get_called_class();
        if (!isset($_instances[$clsnm])) {
            if (!isset($_manager)) throw new Exception('无法获取客户经理信息');
            $_instances[$clsnm] = new $clsnm($_manager);
        }
        return $_instances[$clsnm];
    }

}