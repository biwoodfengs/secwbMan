<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-10 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Tabledel {

    private $link;
    private $table;
    private $where;
    private $CI;

    public function __construct($link = 'default') {
        $this->link = $link;
        $this->CI = & get_instance();
        log_message('debug', "Tabledel Class Initialized");
    }

    /**
     * 删除表数据
     * @param type $table
     * @param type $where
     * @return type
     */
    public function del($table, $where, $limit = array(1)) {
        $this->table = $table;
        $this->where = $where;
        $this->limit = $limit;
        return $this->CI->Database_Model->del($this->link, $this->table, $this->where, $this->limit);
    }

}

?>
