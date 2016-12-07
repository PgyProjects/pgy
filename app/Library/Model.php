<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */
namespace Library;

/**
 * Class Model
 *
 * Note:
 *  It could change attribute of 'pk' to set the table primary key,
 *  otherwise default to 'id'
 *
 * 2016-11-16:
 *  Operation of 'insert,update,delete' will go validation at first,it will interrupt if
 *  validate method return false,and we can set $this->error to provide error infomation.
 *
 * @package Sharin\Library
 */
abstract class Model extends Database
{
    /**
     * @var array components of sql,ref. $this->reset()
     */
    private $_components = [];
    /**
     * input parameters for bind
     * categoory by field and where
     * @var array
     */
    private $_bindParam = [];

    public function __construct($index = null)
    {
        parent::__construct();
        $tablename = $this->tableName();

        if (false !== strpos($tablename, '{{')) {
            $this->_replaceTablePrefix($tablename);
        } else {
            $tablename = $this->tablename;//'prefix + tablename' done at class<Database>
        }
        $this->reset([
            'table' => $tablename,
        ]);
    }

    /**
     * 获取模型实例
     * @param string|int $index
     * @return Model 返回模型实例
     */
    public static function getInstance($index = null)
    {
        static $instances = [];
        $clsnm = static::class;
        $key = $index . '-' . static::class;
        if (!isset($instances[$key])) {
            $instances[$key] = new $clsnm($index);
        }
        return $instances[$key];
    }

    /**
     * 重置CURD参数
     * @param array|null $originOption 初始化时使用的参数
     * @return $this
     */
    protected function reset(array $originOption = null)
    {
        static $origin = [
            //查询
            'distinct' => false,
            'fields' => ' * ',//操作的字段,最终将转化成字符串类型.(可以转换的格式为['fieldname'=>'value'])
            'table' => null,//操作的数据表名称
            /** @var array */
            'join' => null,
            'where' => null,//操作的where信息
            'group' => null,
            'order' => null,
            'having' => null,
            'limit' => null,
            'offset' => null,
        ];
        $originOption and $origin = array_merge($origin, $originOption);

        $this->_components = $origin;
        $this->table($this->getTable());//{{XX}}
        $this->_bindParam = [];
        return $this;
    }

    /**
     * execute 'insert,update,delete' sql and return the affected rows
     * @param string $sql
     * @param array|null $inputs parameters for bind to avoid sql injection
     * @return false|int
     */
    public function exec($sql, array $inputs = null)
    {
        $result = parent::exec($sql, $inputs);
        $this->reset();
        return $result;
    }

    /**
     * 执行返回结果集合的SQL并返回结果集合
     * @param string $sql 查询SQL
     * @param array|null $inputs 输入参数
     * @return array|false
     */
    public function query($sql, array $inputs = null)
    {
        $result = parent::query($sql, $inputs);
        $this->reset();
        return $result;
    }

    /********************************************** link style method call - NODE **************************************************************************************************/
    /**
     * set distinct
     * @param bool $dist
     * @return $this
     */
    public function distinct($dist = true)
    {
        $this->_components['distinct'] = $dist;
        return $this;
    }

    /**
     * set fields for select/unselect or update/insert
     * the fields will conver to string before end this method
     * @param array|string $fields fields of select or unselect
     * @param bool $except whether the fields in first parameter is except of select
     * @return $this
     * @throws Exception exception will be thrown if parameter is invalid
     */
    public function fields($fields, $except = false)
    {
        if (empty($fields) or true === $fields) {
            $this->_components['fields'] = ' * ';
        } else {
            if (is_array($fields)) {
                //check what the purpose of this fields usage (for select or update/insert)
                // get key of first unit.If it is numeric ,it mean 'select or unselect those fields'
                // it those fields is for insert of update,the field name must be as key and not the type numeric
                if (is_numeric(key($fields))) {
                    array_walk($fields, function (&$field) {
                        $field = Dao::getInstance()->escape(trim($field));
                    });
                    $this->_components['fields'] = implode(',', $fields);
                } else {
                    $keys = array_keys($fields);
                    if (true === $except) {
                        $all_fields = $this->getFields();
                        // fields exist in $all_fields but not in $keys
                        $keys = array_diff($all_fields, $keys);
                    }
                    array_walk($keys, function (&$field) {
                        $field = Dao::getInstance()->escape($field);
                    });

                    $this->_components['fields'] = implode(',', $keys);
                    $this->_bindParam['fields'] = array_values($fields);
                }
            } else {
                if (!is_string($fields)) {
                    throw new Exception('invalid field');
                }
                $this->_components['fields'] = $fields;
            }
        }
//        Exception::throwing($fields,'fields方法期待的参数类型是\'array|string|true\'');//it will pass if params is invalid
        return $this;
    }

    /**
     * 设置当前要操作的数据表
     * @param $tablename
     * @return $this
     */
    public function table($tablename)
    {
        $this->_replaceTablePrefix($tablename);
        $this->_components['table'] = $tablename;
        return $this;
    }

    /**
     * YII style
     * replace tablename placeholder with tablename with prefix
     * It used for tablename format and join format
     *
     * where the table stand is "FROM" and "JOIN"
     *
     *  <code>
     *      //code below performs low
     *      preg_replace('/\{\{([\d\w_]+)\}\}/',"{$this->tablePrefix()}$1",$tablename);
     *  </code>
     * @param string $tablename table name without prefix
     * @return void
     */
    protected function _replaceTablePrefix(&$tablename)
    {
        if (strpos($tablename, '{{') !== false) {
            $tablename = str_replace(
                ['{{', '}}'], [$this->tablePrefix(), ''], $tablename);
        }
    }

    /**
     * 只针对mysql有效
     * @param int $limit
     * @param int $offset
     * @return $this
     */
    public function limit($limit, $offset = 0)
    {
        isset($limit) and $this->_components['limit'] = intval($limit);
        isset($offset) and $this->_components['offset'] = intval($offset);
        return $this;
    }

    /**
     * @param string $group
     * @return $this
     */
    public function group($group)
    {
        $this->_components['group'] = "GROUP BY {$group} ";
        return $this;
    }

    /**
     * 设置当前要操作的数据的排列顺序
     * @param string $order
     * @return $this
     */
    public function order($order)
    {
        $this->_components['order'] = "ORDER BY {$order}";
        return $this;
    }

    /**
     * 在 SQL 中增加 HAVING 子句原因是，WHERE 关键字无法与合计函数一起使用。
     * @param string $having
     * @return $this
     */
    public function having($having)
    {
        $this->_components['having'] = "HAVING {$having}";
        return $this;
    }


    /**
     * set where condituib
     * @param array|string $where
     * @return $this
     */
    public function where($where)
    {
        if (is_array($where)) {
            $where = Sql::parseSegments($where, Sql::CONNECT_AND);
            $this->_bindParam['where'] = $where[1];
            $where = $where[0];
        }

        $this->_components['where'] = "WHERE {$where}";
        return $this;
    }

    const JOIN = 0;
    const INNER_JOIN = 1;
    const LEFT_OUTER_JOIN = 2;

    public function join($join, $type = null)
    {
        switch ($type) {
            case self::INNER_JOIN:
                $join = " INNER JOIN {$join} ";
                break;
            case self::LEFT_OUTER_JOIN:
                $join = " LEFT OUTER JOIN {$join} ";
                break;
            case self::JOIN:
                $join = " JOIN {$join} ";
            case null:
            default:
                //keep its origin pattern
        }
        $this->_replaceTablePrefix($join);
        if (empty($this->_components['join'])) {
            $this->_components['join'] = [$join];
        } else {
            $this->_components['join'][] = $join;
        }
        return $this;
    }

    /**
     * @param string $join statement without 'INNER JOIN'
     * @return $this
     */
    public function innerJoin($join)
    {
        return $this->join($join, self::INNER_JOIN);
    }

    /**
     * @param string $join statement without 'LEFT OUTER JOIN'
     * @return $this
     */
    public function leftOuterJoin($join)
    {
        return $this->join($join, self::LEFT_OUTER_JOIN);
    }
    /********************************************** link style method call - ENDNODE ***********************************/

    /**
     * validate the fields to insert is validate
     * <code>
     *
     *  //while insert an record to database ,code below is suggested
     *  if (is_array($fields)) {
     *      foreach ($fields as $key => $value) {
     *          if (!$this->getFields($key)) {
     *              $this->error = "fields'{$key}' do not exist!";
     *              return false;
     *          }
     *      }
     *  }
     *
     *  // to validate certain field
     *  if (empty($fields['FIELD_NAME'])) {
     *      $this->error = 'please keep field 'FIELD_NAME' not empty!';
     *      return false;
     *  }
     *
     * </code>
     * @param array|string $fields
     * @return bool
     */
    abstract protected function validateInsert($fields);

    /**
     * insert an record to database
     * <code>
     *      $fields ==> array(
     *          'fieldName' => 'fieldValue',
     *      );
     * </code>
     *
     * format ：
     * ①INSERT INTO [tablename] VALUES (value1, value2 ,....)
     * ②INSERT INTO table_name (column1, column2,...) VALUES (value1, value2 ,....)
     *
     * @param array $data
     * @return int|false return the record id which inserted (useful for inc)
     * @throws Exception
     */
    public function insert(array $data = null)
    {
        $tablename = $this->_getTable();
        null === $data and $data = $this->_bindParam['fields'];

        //validate
        empty($data) and Exception::throwing('Data to insert should not be empty!');
        if (!$data or (is_array($data) and !$this->validateInsert($data))) {
            empty($data) and $this->error = 'insert deny';
            return false;
        }

        //fields test
        $keys = array_keys($data);
        array_walk($keys, function (&$field) {
            $field = Dao::getInstance()->escape($field);
        });//对字段进行转义
        $fields = implode(',', $keys);
        $holder = rtrim(str_repeat('?,', count($keys)), ',');
        empty($fields) and Exception::throwing('Empty field is not allowed');

        return $this->exec("INSERT INTO {$tablename} ( {$fields} ) VALUES ( {$holder} );", array_values($data));
    }

    /**
     * validate where should be remove
     * @param string|array $where
     * @return bool
     */
    abstract public function validateDelete($where);

    /**
     * delete record by where condition
     * eg. where must be set
     * @param array $where fields of where or string
     * @return bool
     * @throws Exception
     */
    public function delete(array $where = null)
    {
        $tablename = $this->_getTable();

        null === $where and $where = $this->_components['where'];
        //validate
        if (!$this->validateDelete($where)) {
            empty($this->error) and $this->error = 'delete deny';
            return false;
        }

        //parse where and input
        if (is_array($where)) {
            list($where, $inputs) = Sql::parseSegments($where, Sql::CONNECT_AND);
        }

        if (empty($where)) {
            $this->error = 'Where shuld not be empty';
            return false;
        }

        return $this->exec("DELETE FROM {$tablename} WHERE {$where};", empty($inputs) ? null : $inputs);
    }

    /**
     * @param string|array $fields
     * @param string|array $where
     * @return bool
     */
    abstract protected function validateUpdate($fields, $where);

    /**
     * update record
     * note:it will return 0 if data to update is same to origin data
     * @param string|array $fields
     * @param string|array $where
     * @return false|int it will return the num of rows affected,and false on error occur
     * @throws Exception
     */
    public function update($fields = null, $where = null)
    {
        $tablename = $this->_getTable();

        if (!$fields and !($fields = $this->_components['fields'])) {
            $this->error = 'Fields should not be empty!';
            return false;
        }
        if (!$where and !($where = $this->_components['where'])) {
            $this->error = 'Where should not be empty!';
            return false;
        }

        //validate
        if (!$this->validateUpdate($fields, $where)) {
            empty($this->error) and $this->error = 'update deny';
            return false;
        }

        if (is_array($fields)) {/* fields come from the first parameter  */
//            $fkeys = array_keys($fields);
//            array_walk($fkeys, function (&$field) {
//                $field = " {Dao::getInstance()->escape($field)} = ? ";
//            });
//            $fields = implode(',', $fields);
//            $inputs = array_values($fields);
            list($fields, $inputs) = Sql::parseSegments($fields, Sql::CONNECT_COMMA);
        } else {
            /* fields come from '$this->_components['fields']' */
            $inputs = empty($this->_bindParam['fields']) ? null : $this->_bindParam['fields'];
        }

        if (is_array($where)) {
            list($where, $winput) = Sql::parseSegments($where, Sql::CONNECT_AND);
            if (empty($inputs)) {
                $inputs = $winput;
            } else {
                $inputs = array_merge($inputs, $winput);
            }
        } else {
            $inputs = empty($this->_bindParam['where']) ? null : $this->_bindParam['where'];
        }

        if(stripos($where,'WHERE') === false){
            $where = "WHERE $where";
        }
        return $this->exec("UPDATE {$tablename} SET {$fields} {$where};", $inputs);
    }


//---------------------------------------------------------------------------------------------------------------
    /**
     * 从数据库中获取指定条件的数据对象
     * @param array|null|string $options 如果是字符串是代表查询这张表中的所有数据并直接返回
     * @return array|false 返回数组或者false(发生了错误)
     * @throws Exception
     */
    public function select($options = null)
    {
        // component for combine
        $components = [
            'distinct' => false,
            'fields' => ' * ',//操作的字段,最终将转化成字符串类型.(可以转换的格式为['fieldname'=>'value'])
            'table' => null,//操作的数据表名称
            'join' => null,
            'where' => null,//操作的where信息
            'group' => null,
            'order' => null,
            'having' => null,
            'limit' => null,
            'offset' => null,
        ];
        $this->_components and $components = array_merge($components, $this->_components);
        $options and $components = array_merge($components, $options);
        $sql = Dao::getInstance()->compile($components);
        //onlu where has condition bind
        $bind = empty($this->_bindParam['where']) ? null : $this->_bindParam['where'];
        return $this->query($sql, $bind);
    }

    /**
     * find a column from table of this table
     * 查询一条数据，依据逐渐，如果数据不存在时返回false
     * @param int|string|array|null $keys
     * @param bool $getall 是否获取全部数据
     * @return false|array it will return false if an error occur,empty array on target not exist ,infomation array if record exist
     */
    public function find($keys = null, $getall = false)
    {
        if (null === $keys) {
            $result = $this->select(null);
            if (false === $result) {
                return false;
            } elseif (!$result) {
                return [];
            } else {
                return array_shift($result);
            }
        } else {
            if (!is_array($keys)) {
                if (!$this->pk) return Exception::throwing('Primary key invalid!');
                $keys = [
                    $this->pk => $keys,
                ];
            }
            $result = $this->where($keys)->select(null);
        }
        if ($getall) {
            if (false === $result) return false;//发生错误时才但会false
            return $result ? $result : [];
        } else {
            return empty([0]) ? false : $result[0];
        }
    }

    /**
     * 获取查询选项中满足条件的记录数目
     * @return false|int 返回表中的数据的条数,发生了错误将不会返回数据
     */
    public function count()
    {
        empty($this->_components['table']) and Exception::throwing('Model has no table binded!');
        $this->_components['fields'] = ' count(*) as c';
        $result = $this->select();
        return isset($result[0]['c']) ? intval($result[0]['c']) : false;
    }
//---------------------------------------------------------------------------------------------------------------

    /********************************************** PRIVATE ************************************************************************/
    /**
     * get table name to opera
     * @return mixed|null|string
     * @throws Exception it will thrown exception if no table selected
     */
    private function _getTable()
    {
        if (empty($this->_components['table'])) {
            $tablename = $this->tablename;
        } else {
            $tablename = $this->_components['table'];
        }
        empty($tablename) and Exception::throwing('No table selected');

        return Dao::getInstance()->escape($tablename);
    }

}