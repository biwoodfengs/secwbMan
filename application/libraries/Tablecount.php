<?php

/**
 * 自定义外部类，调用model类，实现获取数据库 表的内容
 * Encoding		:  UTF-8
 * Created on	:  2014-6-6 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Tablecount {

    private $link;
    private $table;
    private $where;
    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
        log_message('debug', "Tablelist Class Initialized");
    }

    /**
     * 统计表数量
     * @param type $table 表名
     * @param type $where 条件
     * @param type $link  $link 数据库连接 主从
     * @return type Array
     */
    public function get_tablecount($table, $where = array(), $link = "default") {
        $this->table = $table;
        $this->where = $where;
        $this->link = $link;
        return $this->CI->Database_Model->count_table_num($this->link, $this->table, $this->where);
    }

}

?>
