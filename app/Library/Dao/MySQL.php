<?php
/**
 * Created by linzhonghuang.
 * Date: 2016/11/11
 * Time: 11:51
 */

namespace Library\Dao;

use PDO;

/**
 * Class MySQL MySQL驱动
 * @package Sharin\Core\Dao
 */
class MySQL extends DaoAbstract
{
    protected $config = [
        'dbname' => 'sharin',//选择的数据库
        'username' => 'lin',
        'password' => '123456',
        'host' => '127.0.0.1',
        'port' => '3306',
        'charset' => 'UTF8',
        'dsn' => null,//默认先检查差DSN是否正确,直接写dsn而不设置其他的参数可以提高效率，也可以避免潜在的bug
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//默认异常模式
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//结果集返回形式
        ],
    ];

    public function escape($field)
    {
        return (strpos($field, '`') !== false) ? $field : "`{$field}`";
    }

    /**
     * 根据配置创建DSN
     * @param array $config 数据库连接配置
     * @return string
     */
    public function buildDSN(array $config)
    {
        $dsn = "mysql:host={$config['host']}";
        if (isset($config['dbname'])) {
            $dsn .= ";dbname={$config['dbname']}";
        }
        if (!empty($config['port'])) {
            $dsn .= ';port=' . $config['port'];
        }
        if (!empty($config['socket'])) {
            $dsn .= ';unix_socket=' . $config['socket'];
        }
        if (!empty($config['charset'])) {
            //为兼容各版本PHP,用两种方式设置编码
            $dsn .= ';charset=' . $config['charset'];//$this->options[\PDO::MYSQL_ATTR_INIT_COMMAND]    =   'SET NAMES '.$config['charset'];
        }
        return $dsn;
    }


    /**
     * 取得数据表的字段信息
     * @access public
     * @param string $tableName 数据表名称
     * @return array
     */
    public function getFields($tableName)
    {
        list($tableName) = explode(' ', $tableName);
        if (strpos($tableName, '.')) {
            list($dbName, $tableName) = explode('.', $tableName);
            $sql = 'SHOW COLUMNS FROM `' . $dbName . '`.`' . $tableName . '`';
        } else {
            $sql = 'SHOW COLUMNS FROM `' . $tableName . '`';
        }

        $result = $this->query($sql);
        $info = array();
        if ($result) {
            foreach ($result as $key => $val) {
                if (\PDO::CASE_LOWER != $this->getAttribute(\PDO::ATTR_CASE)) {
                    $val = array_change_key_case($val, CASE_LOWER);
                }
                $info[$val['field']] = array(
                    'name' => $val['field'],
                    'type' => $val['type'],
                    'notnull' => (bool)($val['null'] === ''), // not null is empty, null is yes
                    'default' => $val['default'],
                    'primary' => (strtolower($val['key']) == 'pri'),
                    'autoinc' => (strtolower($val['extra']) == 'auto_increment'),
                );
            }
        }
        return $info;
    }

    /**
     * 取得数据库的表信息
     * @access public
     * @param string $dbName
     * @return array
     */
    public function getTables($dbName = null)
    {
        $sql = empty($dbName) ? 'SHOW TABLES ;' : "SHOW TABLES FROM {$dbName};";
        $result = $this->query($sql);
        $info = array();
        foreach ($result as $key => $val) {
            $info[$key] = current($val);
        }
        return $info;
    }

    /**
     * SELECT %DISTINCT% %FIELD% FROM %TABLE% %FORCE% %JOIN% %WHERE% %GROUP% %HAVING% %ORDER% %LIMIT% %UNION% %LOCK% %COMMENT%;
     *
     * Avalable SQL:
     * SELECT DISTINCT
     *  a.aid,COUNT(is_show) as c
     * from
     *  blg_article a
     * INNER JOIN blg_article_pic ap on ap.aid = a.aid
     * INNER JOIN blg_article_tag bat on bat.aid = a.aid
     * WHERE a.author = 'bjy' and a.aid = 17
     * GROUP BY a.aid
     * HAVING COUNT(is_show) > 0
     * ORDER BY a.aid
     * LIMIT 0,1
     *
     * @param array $components
     * @return mixed
     */
    public function compile(array $components)
    {
        //------------------------- join ------------------------------------------------//
        if (!empty($components['join']) and is_array($components['join'])) {
            $j = '';
            foreach ($components['join'] as $join) {
                $j .= "\n{$join}\n";
            }
            $components['join'] = $j;
        }

        //------------------------- limit ------------------------------------------------//
        if (isset($components['limit'])) {
            $l = '';
            if (empty($components['offset'])) {
                $l .= " LIMIT {$components['limit']} ";
            } else {
                $l .= " LIMIT {$components['offset']},{$components['limit']} ";//                    $sql .= ' LIMIT '.$this->_options['offset'].' , '.$this->_options['limit'];
            }
            $components['limit'] = $l;
        }

        return str_replace(
            array('%TABLE%', '%DISTINCT%', '%FIELD%', '%JOIN%', '%WHERE%', '%GROUP%', '%HAVING%', '%ORDER%', '%LIMIT%',
//                '%UNION%', '%LOCK%', '%COMMENT%', '%FORCE%'
            ),
            array(
                $components['table'],
                !empty($components['distinct']) ? 'DISTINCT' : '',
                !empty($components['fields']) ? $components['fields'] : ' * ',
                !empty($components['join']) ? $components['join'] : '',
                !empty($components['where']) ? $components['where'] : '',
                !empty($components['group']) ? $components['group'] : '',
                !empty($components['having']) ? $components['having'] : '',
                !empty($components['order']) ? $components['order'] : '',
                !empty($components['limit']) ? $components['limit'] : '',
//                !empty($components['union']) ? $components['union'] : '',
//                isset($components['lock']) ? $components['lock'] : '',
//                !empty($components['comment']) ? $components['comment'] : '',
//                !empty($components['force']) ? $components['force'] : '',
            ), 'SELECT %DISTINCT% %FIELD% FROM %TABLE% %JOIN% %WHERE% %GROUP% %HAVING% %ORDER% %LIMIT%;');
    }

}