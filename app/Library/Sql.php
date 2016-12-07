<?php
/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/17
 * Time: 16:01
 */

namespace Library;


class Sql
{

    /**
     * 连接符号
     */
    CONST CONNECT_AND = ' AND ';
    CONST CONNECT_OR = ' OR ';
    CONST CONNECT_COMMA = ' , ';

    /**
     * 运算符
     */
    CONST OPERATOR_EQUAL = ' = ';
    CONST OPERATOR_NOTEQUAL = ' != ';
    CONST OPERATOR_LIKE = ' LIKE ';
    CONST OPERATOR_NOTLIKE = ' NOT LIKE ';
    CONST OPERATOR_IN = ' IN ';
    CONST OPERATOR_NOTIN = ' NOT IN ';


    /**
     * 综合字段绑定的方法
     * <code>
     *      $operator = '='
     *          $fieldName = :$fieldName
     *          :$fieldName => trim($fieldValue)
     *
     *      $operator = 'like'
     *          $fieldName = :$fieldName
     *          :$fieldName => dowithbinstr($fieldValue)
     *
     *      $operator = 'in|not_in'
     *          $fieldName in|not_in array(...explode(...,$fieldValue)...)
     * </code>
     * @param string $fieldName 字段名称
     * @param string|array $fieldValue 字段值
     * @param string $operator 操作符
     * @_param bool $escape 是否对字段名称进行转义,MSSQL中使用[],默认为false
     * @return array
     * @throws Exception
     */
    private static function parseSegment($fieldName, $fieldValue, $operator = self::OPERATOR_EQUAL)
    {
        //该库开启的清空下
        if (false !== strpos($fieldName, '.')) {
            //field has assign to one table
            $arr = explode('.', $fieldName);
            $holder = ':' . array_pop($arr);
        } else {
            $holder = ":{$fieldName}";
        }

        $sql = $fieldName;
        $input = [];

        switch ($operator) {
            case self::OPERATOR_EQUAL:
            case self::OPERATOR_NOTEQUAL:
            case self::OPERATOR_LIKE:
            case self::OPERATOR_NOTLIKE:
                if($fieldValue === null){
                    //it will set value to null in database,not zero in convention
                    $sql .= " {$operator} NULL ";
                }else{
                    $sql .= " {$operator} {$holder} ";
                    $input[$holder] = $fieldValue;
                }
                break;
            case self::OPERATOR_IN:
            case self::OPERATOR_NOTIN:
                if (is_array($fieldValue)) $fieldValue = "'" . implode("','", $fieldValue) . "'";
                is_string($fieldValue) or Exception::throwing($fieldValue);
                $sql .= " {$operator} ({$fieldValue}) ";
                break;
            default:
                Exception::throwing("Unkown operator of '{$operator}'");
        }
        return [$sql, $input];
    }

    /**
     * 片段翻译(片段转化)
     * <note>
     *      片段匹配准则:
     *      $map == array(
     *           //第一种情况,连接符号一定是'='//
     *          'key' => $val,
     *          'key' => array($val,$operator,true),
     *
     *          //第二种情况，数组键，数组值//    -- 现在保留为复杂and和or连接 --
     *          //array('key','val','like|=',true),//参数4的值为true时表示对key进行[]转义
     *          //array(array(array(...),'and/or'),array(array(...),'and/or'),...) //此时数组内部的连接形式
     *
     *          //第三种情况，字符键，数组值//
     *          'assignSql' => array(':bindSQLSegment',value)//与第一种情况第二子目相区分的是参数一以':' 开头
     *      );
     * </note>
     * @param array $segments 片段数组
     * @param string $connect 表示是否使用and作为连接符，false时为,
     * @return array
     * @throws Exception
     */
    public static function parseSegments($segments, $connect = self::CONNECT_AND)
    {
        $segments or Exception::throwing($segments, $connect);

        $sql = '';
        $bind = [];
        //元素连接
        foreach ($segments as $field => $segment) {
            if (is_numeric($field)) {
                //第二中情况,符合形式组成
                $result = self::parseSegment($segment[0], $segment[1]);
                $sql .= " {$result[0]} {$connect}";
                $bind = array_merge($bind, $result[1]);
            } elseif (is_array($segment) and strpos($segment[0], ':') === 0) {
                //第三种情况,过于复杂而选择由用户自定义
                $sql .= " {$field} {$connect}";
                $bind[$segment[0]] = $segment[1];
            } else {
                //第一种情况
//                $escape = false;
                $operator = self::OPERATOR_EQUAL;

                if (is_array($segment)) {
//                    $escape = isset($segment[2])?$segment[2]:false;
                    $operator = isset($segment[1]) ? $segment[1] : self::OPERATOR_EQUAL;
                    $segment = $segment[0];//value
                }
                $rst = self::parseSegment($field, $segment, $operator);//第一种情况一定是'='的情况
                if (is_array($rst)) {
                    $sql .= " {$rst[0]} {$connect}";
                    $bind = array_merge($bind, $rst[1]);
                }
            }
        }
        return [
            substr($sql, 0, strlen($sql) - strlen($connect)),
            $bind,
        ];
    }

}