<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: CoolBennym
// +----------------------------------------------------------------------
// $Id: Model.class.php 2779 2012-02-24 02:56:57Z liu21st $

/**
 * ThinkPHP CLI模式Model模型类
 * @category   Think
 * @package  Think
 * @subpackage  Core
 * @author    liu21st <liu21st@gmail.com>
 */
class Model {

    // 当前数据库操作对象
    protected $db = null;
    // 主键名称
    protected $pk  = 'id';
    // 数据表前缀
    protected $tablePrefix  =   '';
    // 模型名称
    protected $name = '';
    // 数据库名称
    protected $dbName  = '';
    // 数据表名（不包含表前缀）
    protected $tableName = '';
    // 实际数据表名（包含表前缀）
    protected $trueTableName ='';
    // 最近错误信息
    protected $error = '';
    // 字段信息
    protected $fields = array();
    // 数据信息
    protected $data =   array();
    // 查询表达式参数
    protected $options  =   array();
    protected $_validate       = array();  // 自动验证定义
    protected $_auto           = array();  // 自动完成定义
    // 是否自动检测数据表字段信息
    protected $autoCheckFields   =   true;
    // 是否批处理验证
    protected $patchValidate   =  false;

    /**
     * 架构函数
     * 取得DB类的实例对象 字段检查
     * @param string $name 模型名称
     * @param string $tablePrefix 表前缀
     * @param mixed $connection 数据库连接信息
     * @access public
     */
    public function __construct($name='',$tablePrefix='',$connection='') {
        // 模型初始化
        $this->_initialize();
        // 获取模型名称
        if(!empty($name)) {
            if(strpos($name,'.')) { // 支持 数据库名.模型名的 定义
                list($this->dbName,$this->name) = explode('.',$name);
            }else{
                $this->name   =  $name;
            }
        }elseif(empty($this->name)){
            $this->name =   $this->getModelName();
        }
        if(!empty($tablePrefix)) {
            $this->tablePrefix =  $tablePrefix;
        }
        // 设置表前缀
        $this->tablePrefix = $this->tablePrefix?$this->tablePrefix:C('DB_PREFIX');
        // 数据库初始化操作
        // 获取数据库操作对象
        // 当前模型有独立的数据库连接信息
        $this->db(0,empty($this->connection)?$connection:$this->connection);
        // 字段检测
        if(!empty($this->name) && $this->autoCheckFields)    $this->_checkTableInfo();
    }

    /**
     * 自动检测数据表信息
     * @access protected
     * @return void
     */
    protected function _checkTableInfo() {
        // 如果不是Model类 自动记录数据表信息
        // 只在第一次执行记录
        if(empty($this->fields)) {
            // 如果数据表字段没有定义则自动获取
            if(C('DB_FIELDS_CACHE')) {
                $db   =  $this->dbName?$this->dbName:C('DB_NAME');
                $this->fields = F('_fields/'.$db.'.'.$this->name);
                if(!$this->fields)   $this->flush();
            }else{
                // 每次都会读取数据表信息
                $this->flush();
            }
        }
    }

    /**
     * 获取字段信息并缓存
     * @access public
     * @return void
     */
    public function flush() {
        // 缓存不存在则查询数据表信息
        $fields =   $this->db->getFields($this->getTableName());
        if(!$fields) { // 无法获取字段信息
            return false;
        }
        $this->fields   =   array_keys($fields);
        $this->fields['_autoinc'] = false;
        foreach ($fields as $key=>$val){
            // 记录字段类型
            $type[$key]    =   $val['type'];
            if($val['primary']) {
                $this->fields['_pk'] = $key;
                if($val['autoinc']) $this->fields['_autoinc']   =   true;
            }
        }
        // 记录字段类型信息
        if(C('DB_FIELDTYPE_CHECK'))   $this->fields['_type'] =  $type;

        // 2008-3-7 增加缓存开关控制
        if(C('DB_FIELDS_CACHE')){
            // 永久缓存数据表信息
            $db   =  $this->dbName?$this->dbName:C('DB_NAME');
            F('_fields/'.$db.'.'.$this->name,$this->fields);
        }
    }

    /**
     * 设置数据对象的值
     * @access public
     * @param string $name 名称
     * @param mixed $value 值
     * @return void
     */
    public function __set($name,$value) {
        // 设置数据对象属性
        $this->data[$name]  =   $value;
    }

    /**
     * 获取数据对象的值
     * @access public
     * @param string $name 名称
     * @return mixed
     */
    public function __get($name) {
        return isset($this->data[$name])?$this->data[$name]:null;
    }

    /**
     * 检测数据对象的值
     * @access public
     * @param string $name 名称
     * @return boolean
     */
    public function __isset($name) {
        return isset($this->data[$name]);
    }

    /**
     * 销毁数据对象的值
     * @access public
     * @param string $name 名称
     * @return void
     */
    public function __unset($name) {
        unset($this->data[$name]);
    }

    /**
     * 利用__call方法实现一些特殊的Model方法
     * @access public
     * @param string $method 方法名称
     * @param array $args 调用参数
     * @return mixed
     */
    public function __call($method,$args) {
        if(in_array(strtolower($method),array('table','where','order','limit','page','alias','having','group','lock','distinct'),true)) {
            // 连贯操作的实现
            $this->options[strtolower($method)] =   $args[0];
            return $this;
        }elseif(in_array(strtolower($method),array('count','sum','min','max','avg'),true)){
            // 统计查询的实现
            $field =  isset($args[0])?$args[0]:'*';
            return $this->getField(strtoupper($method).'('.$field.') AS tp_'.$method);
        }elseif(strtolower(substr($method,0,5))=='getby') {
            // 根据某个字段获取记录
            $field   =   parse_name(substr($method,5));
            $where[$field] =  $args[0];
            return $this->where($where)->find();
        }else{
            throw_exception(__CLASS__.':'.$method.L('_METHOD_NOT_EXIST_'));
            return;
        }
    }
    // 回调方法 初始化模型
    protected function _initialize() {}

    /**
     * 对保存到数据库的数据进行处理
     * @access protected
     * @param mixed $data 要操作的数据
     * @return boolean
     */
     protected function _facade($data) {
        // 检查非数据字段
        if(!empty($this->fields)) {
            foreach ($data as $key=>$val){
                if(!in_array($key,$this->fields,true)){
                    unset($data[$key]);
                }elseif(C('DB_FIELDTYPE_CHECK') && is_scalar($val)) {
                    // 字段类型检查
                    $this->_parseType($data,$key);
                }
            }
        }
        return $data;
     }

    /**
     * 新增数据
     * @access public
     * @param mixed $data 数据
     * @param array $options 表达式
     * @return mixed
     */
    public function add($data='',$options=array()) {
        if(empty($data)) {
            // 没有传递数据，获取当前数据对象的值
            if(!empty($this->data)) {
                $data    =   $this->data;
            }else{
                $this->error = L('_DATA_TYPE_INVALID_');
                return false;
            }
        }
        // 分析表达式
        $options =  $this->_parseOptions($options);
        // 数据处理
        $data = $this->_facade($data);
        // 写入数据到数据库
        $result = $this->db->insert($data,$options);
        if(false !== $result ) {
            $insertId   =   $this->getLastInsID();
            if($insertId) {
                // 自增主键返回插入ID
                return $insertId;
            }
        }
        return $result;
    }

    /**
     * 保存数据
     * @access public
     * @param mixed $data 数据
     * @param array $options 表达式
     * @return boolean
     */
    public function save($data='',$options=array()) {
        if(empty($data)) {
            // 没有传递数据，获取当前数据对象的值
            if(!empty($this->data)) {
                $data    =   $this->data;
            }else{
                $this->error = L('_DATA_TYPE_INVALID_');
                return false;
            }
        }
        // 数据处理
        $data = $this->_facade($data);
        // 分析表达式
        $options =  $this->_parseOptions($options);
        if(!isset($options['where']) ) {
            // 如果存在主键数据 则自动作为更新条件
            if(isset($data[$this->getPk()])) {
                $pk   =  $this->getPk();
                $where[$pk]   =  $data[$pk];
                $options['where']  =  $where;
                unset($data[$pk]);
            }else{
                // 如果没有任何更新条件则不执行
                $this->error = L('_OPERATION_WRONG_');
                return false;
            }
        }
        $result = $this->db->update($data,$options);
        return $result;
    }

    /**
     * 删除数据
     * @access public
     * @param mixed $options 表达式
     * @return mixed
     */
    public function delete($options=array()) {
        if(empty($options) && empty($this->options['where'])) {
            // 如果删除条件为空 则删除当前数据对象所对应的记录
            if(!empty($this->data) && isset($this->data[$this->getPk()]))
                return $this->delete($this->data[$this->getPk()]);
            else
                return false;
        }
        if(is_numeric($options)  || is_string($options)) {
            // 根据主键删除记录
            $pk   =  $this->getPk();
            if(strpos($options,',')) {
                $where[$pk]   =  array('IN', $options);
            }else{
                $where[$pk]   =  $options;
                $pkValue = $options;
            }
            $options =  array();
            $options['where'] =  $where;
        }
        // 分析表达式
        $options =  $this->_parseOptions($options);
        $result=    $this->db->delete($options);
        // 返回删除记录个数
        return $result;
    }

    /**
     * 查询数据集
     * @access public
     * @param array $options 表达式参数
     * @return mixed
     */
    public function select($options=array()) {
        if(is_string($options) || is_numeric($options)) {
            // 根据主键查询
            $pk   =  $this->getPk();
            if(strpos($options,',')) {
                $where[$pk] =  array('IN',$options);
            }else{
                $where[$pk]   =  $options;
            }
            $options =  array();
            $options['where'] =  $where;
        }
        // 分析表达式
        $options =  $this->_parseOptions($options);
        $resultSet = $this->db->select($options);
        if(false === $resultSet) {
            return false;
        }
        if(empty($resultSet)) { // 查询结果为空
            return null;
        }
        return $resultSet;
    }

    /**
     * 分析表达式
     * @access proteced
     * @param array $options 表达式参数
     * @return array
     */
    protected function _parseOptions($options=array()) {
        if(is_array($options))
            $options =  array_merge($this->options,$options);
        // 查询过后清空sql表达式组装 避免影响下次查询
        $this->options  =   array();
        if(!isset($options['table']))
            // 自动获取表名
            $options['table'] =$this->getTableName();
        if(!empty($options['alias'])) {
            $options['table']   .= ' '.$options['alias'];
        }
        // 字段类型验证
        if(C('DB_FIELDTYPE_CHECK')) {
            if(isset($options['where']) && is_array($options['where'])) {
                // 对数组查询条件进行字段类型检查
                foreach ($options['where'] as $key=>$val){
                    if(in_array($key,$this->fields,true) && is_scalar($val)){
                        $this->_parseType($options['where'],$key);
                    }
                }
            }
        }
        return $options;
    }

    /**
     * 数据类型检测
     * @access protected
     * @param mixed $data 数据
     * @param string $key 字段名
     * @return void
     */
    protected function _parseType(&$data,$key) {
        $fieldType = strtolower($this->fields['_type'][$key]);
        if(false !== strpos($fieldType,'int')) {
            $data[$key]   =  intval($data[$key]);
        }elseif(false !== strpos($fieldType,'float') || false !== strpos($fieldType,'double')){
            $data[$key]   =  floatval($data[$key]);
        }elseif(false !== strpos($fieldType,'bool')){
            $data[$key]   =  (bool)$data[$key];
        }
    }

    /**
     * 查询数据
     * @access public
     * @param mixed $options 表达式参数
     * @return mixed
     */
    public function find($options=array()) {
        if(is_numeric($options) || is_string($options)) {
            $where[$this->getPk()] =$options;
            $options = array();
            $options['where'] = $where;
        }
        // 总是查找一条记录
        $options['limit'] = 1;
        // 分析表达式
        $options =  $this->_parseOptions($options);
        $resultSet = $this->db->select($options);
        if(false === $resultSet) {
            return false;
        }
        if(empty($resultSet)) {// 查询结果为空
            return null;
        }
        $this->data = $resultSet[0];
        return $this->data;
    }

    /**
     * 设置记录的某个字段值
     * 支持使用数据库字段和方法
     * @access public
     * @param string|array $field  字段名
     * @param string|array $value  字段值
     * @return boolean
     */
    public function setField($field,$value) {
        if(is_array($field)) {
            $data = $field;
        }else{
            $data[$field]   =  $value;
        }
        return $this->save($data);
    }

    /**
     * 字段值增长
     * @access public
     * @param string $field  字段名
     * @param integer $step  增长值
     * @return boolean
     */
    public function setInc($field,$step=1) {
        return $this->setField($field,array('exp',$field.'+'.$step));
    }

    /**
     * 字段值减少
     * @access public
     * @param string $field  字段名
     * @param integer $step  减少值
     * @return boolean
     */
    public function setDec($field,$step=1) {
        return $this->setField($field,array('exp',$field.'-'.$step));
    }

    /**
     * 获取一条记录的某个字段值
     * @access public
     * @param string $field  字段名
     * @param string $spea  字段数据间隔符号
     * @return mixed
     */
    public function getField($field,$sepa=null) {
        $options['field']    =  $field;
        $options =  $this->_parseOptions($options);
        if(strpos($field,',')) { // 多字段
            $resultSet = $this->db->select($options);
            if(!empty($resultSet)) {
                $_field = explode(',', $field);
                $field  = array_keys($resultSet[0]);
                $move   =  $_field[0]==$_field[1]?false:true;
                $key =  array_shift($field);
                $key2 = array_shift($field);
                $cols   =   array();
                $count  =   count($_field);
                foreach ($resultSet as $result){
                    $name   =  $result[$key];
                    if($move) { // 删除键值记录
                        unset($result[$key]);
                    }
                    if(2==$count) {
                        $cols[$name]   =  $result[$key2];
                    }else{
                        $cols[$name]   =  is_null($sepa)?$result:implode($sepa,$result);
                    }
                }
                return $cols;
            }
        }else{   // 查找一条记录
            $options['limit'] = 1;
            $result = $this->db->select($options);
            if(!empty($result)) {
                return reset($result[0]);
            }
        }
        return null;
    }

    /**
     * 创建数据对象 但不保存到数据库
     * @access public
     * @param mixed $data 创建数据
     * @return mixed
     */
     public function create($data='') {
        // 如果没有传值默认取POST数据
        if(empty($data)) {
            $data    =   $_POST;
        }elseif(is_object($data)){
            $data   =   get_object_vars($data);
        }
        // 验证数据
        if(empty($data) || !is_array($data)) {
            $this->error = L('_DATA_TYPE_INVALID_');
            return false;
        }

        // 验证完成生成数据对象
        if($this->autoCheckFields) { // 开启字段检测 则过滤非法字段数据
            $vo   =  array();
            foreach ($this->fields as $key=>$name){
                if(substr($key,0,1)=='_') continue;
                $val = isset($data[$name])?$data[$name]:null;
                //保证赋值有效
                if(!is_null($val)){
                    $vo[$name] = (MAGIC_QUOTES_GPC && is_string($val))?   stripslashes($val)  :  $val;
                }
            }
        }else{
            $vo   =  $data;
        }

        // 赋值当前数据对象
        $this->data =   $vo;
        // 返回创建的数据以供其他调用
        return $vo;
     }

    /**
     * SQL查询
     * @access public
     * @param mixed $sql  SQL指令
     * @return mixed
     */
    public function query($sql) {
        if(!empty($sql)) {
            if(strpos($sql,'__TABLE__'))
                $sql    =   str_replace('__TABLE__',$this->getTableName(),$sql);
            return $this->db->query($sql);
        }else{
            return false;
        }
    }

    /**
     * 执行SQL语句
     * @access public
     * @param string $sql  SQL指令
     * @return false | integer
     */
    public function execute($sql) {
        if(!empty($sql)) {
            if(strpos($sql,'__TABLE__'))
                $sql    =   str_replace('__TABLE__',$this->getTableName(),$sql);
            return $this->db->execute($sql);
        }else {
            return false;
        }
    }

    /**
     * 切换当前的数据库连接
     * @access public
     * @param integer $linkNum  连接序号
     * @param mixed $config  数据库连接信息
     * @param array $params  模型参数
     * @return Model
     */
    public function db($linkNum,$config='',$params=array()){
        static $_db = array();
        if(!isset($_db[$linkNum])) {
            // 创建一个新的实例
            if(!empty($config) && false === strpos($config,'/')) { // 支持读取配置参数
                $config  =  C($config);
            }
            $_db[$linkNum]            =    Db::getInstance($config);
        }elseif(NULL === $config){
            $_db[$linkNum]->close(); // 关闭数据库连接
            unset($_db[$linkNum]);
            return ;
        }
        if(!empty($params)) {
            if(is_string($params))    parse_str($params,$params);
            foreach ($params as $name=>$value){
                $this->setProperty($name,$value);
            }
        }
        // 切换数据库连接
        $this->db   =    $_db[$linkNum];
        return $this;
    }

    /**
     * 得到当前的数据对象名称
     * @access public
     * @return string
     */
    public function getModelName() {
        if(empty($this->name))
            $this->name =   substr(get_class($this),0,-5);
        return $this->name;
    }

    /**
     * 得到完整的数据表名
     * @access public
     * @return string
     */
    public function getTableName() {
        if(empty($this->trueTableName)) {
            $tableName  = !empty($this->tablePrefix) ? $this->tablePrefix : '';
            if(!empty($this->tableName)) {
                $tableName .= $this->tableName;
            }else{
                $tableName .= parse_name($this->name);
            }
            $this->trueTableName    =   strtolower($tableName);
        }
        return (!empty($this->dbName)?$this->dbName.'.':'').$this->trueTableName;
    }

    /**
     * 启动事务
     * @access public
     * @return void
     */
    public function startTrans() {
        $this->commit();
        $this->db->startTrans();
        return ;
    }

    /**
     * 提交事务
     * @access public
     * @return boolean
     */
    public function commit() {
        return $this->db->commit();
    }

    /**
     * 事务回滚
     * @access public
     * @return boolean
     */
    public function rollback() {
        return $this->db->rollback();
    }

    /**
     * 返回模型的错误信息
     * @access public
     * @return string
     */
    public function getError(){
        return $this->error;
    }

    /**
     * 返回数据库的错误信息
     * @access public
     * @return string
     */
    public function getDbError() {
        return $this->db->getError();
    }

    /**
     * 返回最后插入的ID
     * @access public
     * @return string
     */
    public function getLastInsID() {
        return $this->db->getLastInsID();
    }

    /**
     * 返回最后执行的sql语句
     * @access public
     * @return string
     */
    public function getLastSql() {
        return $this->db->getLastSql();
    }
    // 鉴于getLastSql比较常用 增加_sql 别名
    public function _sql(){
        return $this->getLastSql();
    }

    /**
     * 获取主键名称
     * @access public
     * @return string
     */
    public function getPk() {
        return isset($this->fields['_pk'])?$this->fields['_pk']:$this->pk;
    }

    /**
     * 获取数据表字段信息
     * @access public
     * @return array
     */
    public function getDbFields(){
        if($this->fields) {
            $fields   =  $this->fields;
            unset($fields['_autoinc'],$fields['_pk'],$fields['_type']);
            return $fields;
        }
        return false;
    }

    /**
     * 指定查询字段 支持字段排除
     * @access public
     * @param mixed $field
     * @param boolean $except 是否排除
     * @return Model
     */
    public function field($field,$except=false){
        if($except) {// 字段排除
            if(is_string($field)) {
                $field =  explode(',',$field);
            }
            $fields   =  $this->getDbFields();
            $field =  $fields?array_diff($fields,$field):$field;
        }
        $this->options['field']   =   $field;
        return $this;
    }

    /**
     * 设置数据对象值
     * @access public
     * @param mixed $data 数据
     * @return Model
     */
    public function data($data){
        if(is_object($data)){
            $data   =   get_object_vars($data);
        }elseif(is_string($data)){
            parse_str($data,$data);
        }elseif(!is_array($data)){
            throw_exception(L('_DATA_TYPE_INVALID_'));
        }
        $this->data = $data;
        return $this;
    }

    /**
     * 查询SQL组装 join
     * @access public
     * @param mixed $join
     * @return Model
     */
    public function join($join) {
        if(is_array($join))
            $this->options['join'] =  $join;
        else
            $this->options['join'][]  =   $join;
        return $this;
    }

    /**
     * 查询SQL组装 union
     * @access public
     * @param array $union
     * @return Model
     */
    public function union($union) {
        if(empty($union)) return $this;
        // 转换union表达式
        if($union instanceof Model) {
            $options   =  $union->getProperty('options');
            if(!isset($options['table'])){
                // 自动获取表名
                $options['table'] =$union->getTableName();
            }
            if(!isset($options['field'])) {
                $options['field'] =$this->options['field'];
            }
        }elseif(is_object($union)) {
            $options   =  get_object_vars($union);
        }elseif(!is_array($union)){
            throw_exception(L('_DATA_TYPE_INVALID_'));
        }
        $this->options['union'][]  =   $options;
        return $this;
    }

    /**
     * 设置模型的属性值
     * @access public
     * @param string $name 名称
     * @param mixed $value 值
     * @return Model
     */
    public function setProperty($name,$value) {
        if(property_exists($this,$name))
            $this->$name = $value;
        return $this;
    }

    /**
     * 获取模型的属性值
     * @access public
     * @param string $name 名称
     * @return mixed
     */
    public function getProperty($name){
        if(property_exists($this,$name))
            return $this->$name;
        else
            return NULL;
    }
}