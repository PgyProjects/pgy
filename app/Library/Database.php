<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */
namespace Library;

use Exception;

/**
 * Class Database
 * Base class of ActiveRecord and Model
 *
 * @method bool beginTransaction()
 * @method bool commit() commit current transaction
 * @method bool rollback() rollback current transaction
 * @method bool inTransaction()  check if is in a transaction
 * @method int lastInsertId($name = null) get auto-inc id of last insert record
 *
 * @package Sharin\Library
 */
abstract class Database
{

    /**
     * 数据访问对象
     * 每个模型都对应一个
     * @var Dao
     */
    protected $_dao = null;

    /**
     * @var string 当前的数据库访问对象对应的数据表的名称
     */
    protected $tablename = null;

    /**
     * @var array all fields this table hold(should not include primary key and auto-update fields like timestamp which change on update )
     */
    protected $fields = null;
    /**
     * @var string|array 主键名称,如果是array则为复合主键
     */
    protected $pk = 'id';

    /**
     * 最近错误信息
     * 可以通过设置 $this->error 来设置错误信息
     * 访问错误信息可以通过 $this->error();来获取错误信息，该方法获取后会清空error属性（即连续两次调用$this->error()前次可以获取对应的错误信息，后一次一定获取的是null）
     * @var string
     */
    protected $error = '';

    /**
     * 上一次执行的SQL语句
     * @var string
     */
    protected $_lastSql = null;
    /**
     * 返回上一次查询的SQL输入参数
     * @var array
     */
    protected $_lastParams = null;

    /**
     * set table prefix
     * it's useful to set a base model to change the default prefix to fit you
     * requirement in your application
     * @return string
     */
    protected function tablePrefix()
    {
        return '';
    }

    /**
     * set $this->tablename in force
     * @return string
     */
    abstract protected function tableName();

    /**
     * 获取上一次执行的SQL
     * @return null|string
     */
    final public function getLastSql()
    {
        return $this->_lastSql;
    }

    final public function getLastParams()
    {
        return $this->_lastParams;
    }

    /**
     * 获取主键名称
     * @access public
     * @return array|string
     */
    final public function getPk()
    {
        return $this->pk;
    }

    /**
     * 获取表的名称
     * @return string
     */
    final public function getTable()
    {
        return $this->tablename;
    }

    /**
     * 获取上一次调用的错误信息
     * 返回错误信息后会清空错误标志位
     * @return string
     */
    public function error()
    {
        //检查是否设置了error
        if (!$this->error) {
            $this->error = $this->_dao->error();
        }
        //每次获取error之后清空操作
        $error = $this->error;
        $this->error = '';
        return $error;
    }

    /**
     * Model constructor.
     * 单参数为非null时就指定了该表的数据库和字段,来对制定的表进行操作
     * Model constructor.
     * @param mixed $index 数据库配置的主键,通过设置该参数可以指定模型使用的是哪个数据库
     * @throws Exception
     */
    public function __construct($index = null)
    {
        $this->_dao = Dao::getInstance($index);
        $this->tablename = $this->tablePrefix() . $this->tableName();
    }

    /**
     * 执行EXEC类型的SQL并返回结果
     * @param string $sql 查询SQL
     * @param array|null $inputs 输入参数
     * @return false|int
     */
    public function exec($sql, array $inputs = null)
    {
        return $this->_dao->exec($this->_lastSql = $sql, $this->_lastParams = $inputs);
    }

    /**
     * 执行返回结果集合的SQL并返回结果集合
     * @param string $sql 查询SQL
     * @param array|null $inputs 输入参数
     * @return array|false
     */
    public function query($sql, array $inputs = null)
    {
        return $this->_dao->query($this->_lastSql = $sql, $this->_lastParams = $inputs);
    }

    /**
     * 调用不存在的方法时 转至 dao对象上调用
     * 需要注意的是，访问了禁止访问的方法时将返回false
     * @param string $name 方法名称
     * @param array $args 方法参数
     * @return false|mixed
     */
    public function __call($name, $args)
    {
        return call_user_func_array([$this->_dao, $name], $args);
    }

    /**
     * get field info by fieldname
     * @param string|null $fieldname it will return array of all fields if this parameter is null, array of certain field info if is real exist field,and null if the field not exist
     * @return array|null
     */
    public function getFields($fieldname = null)
    {
        $fields = $this->_dao->getFields($this->tableName());
        return isset($fieldname) ? (
        isset($fields[$fieldname]) ?
            $fields[$fieldname] : null
        ) : $fields;
    }

}