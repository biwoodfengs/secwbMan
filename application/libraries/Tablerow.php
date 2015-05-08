<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-9 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Tablerow {

    private $link;
    private $table;
    private $where;
    private $fields;
    private $like;
    private $limit;
    private $orderby;
    private $CI;

    public function __construct($link = 'default') {
        $this->link = $link;
        $this->CI = & get_instance();
        log_message('debug', "Tablerow Class Initialized");
    }

    /**
     * 获取表数据 result_array
     * @param type $table 表
     * @param type $where sql 条件
     * @param type $fields sql select()
     * @param type $link 数据库连接 主从
     * @return type Array
     */
    public function get_tablerow($table, $where = array(), $fields = array(), $like = array(), $limit = array(), $orderby = '') {
        $this->table = $table;
        $this->where = $where;
        $this->fields = $fields;
        $this->like = $like;
        $this->limit = $limit;
        $this->orderby = $orderby;
        return $this->CI->Database_Model->get_table_row($this->link, $this->table, $this->where, $this->fields, $this->like, $this->limit, $this->orderby);
    }

}

?>
