<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */
namespace Library\Dao;

use PDO;
use Exception;
use PDOException;

/**
 * Class DaoAbstract Dao
 * 实现的差异：
 *  ① MySQL的group by在字段未加入聚合函数时会取多条数据的第一条，而SQL Server会提示错误并终止执行
 *  ② mysql中是 ``, sqlserver中是 [], oracle中是 ""
 *
 * @package Kbylin\System\Core\Dao
 */
abstract class DaoAbstract extends PDO
{
    /**
     * 创建驱动类对象
     * DatabaseDriver constructor.
     * @param array $config
     * DaoDriver constructor.
     * @param array $config
     * @throws Exception
     */
    public function __construct(array $config)
    {
        $dsn = empty($config['dsn']) ? $this->buildDSN($config) : $config['dsn'];
        $option = empty($config['option']) ? null : $config['option'];
        try {
            parent::__construct($dsn, $config['username'], $config['password'], $option);
        } catch (PDOException $e) {
            throw new Exception("DSN '$dsn' is wrong :{$e->getMessage()}");
        }
    }

    /**
     * compile component to executable sql statement
     * @param array $components
     * @return mixed
     */
    abstract public function compile(array $components);

    /**
     *  transfer word(may be keywork) if not transferred
     * @param string $field
     * @return string
     */
    abstract public function escape($field);

    /**
     * 取得数据表的字段信息
     * @access public
     * @param string $tableName 数据表名称
     * @return array
     */
    abstract public function getFields($tableName);

    /**
     * 取得数据库的表信息
     * @access public
     * @param string $dbName
     * @return array
     */
    abstract public function getTables($dbName = null);

    /**
     * 根据配置创建DSN
     * @param array $config 数据库连接配置
     * @return string
     */
    abstract public function buildDSN(array $config);


}