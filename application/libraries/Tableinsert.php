<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-9 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Tableinsert {

    private $link;
    private $table;
    private $data;
    private $CI;

    public function __construct($link = 'default') {
        $this->link = $link;
        $this->CI = & get_instance();
        log_message('debug', "Tableinsert Class Initialized");
    }

    /**
     * 插入一条数据
     * @param type $table
     * @param type $data 
     * @return Int insert_id
     */
    public function insert_table($table, $data) {
        $this->table = $table;
        $this->data = $data;
        return $this->CI->Database_Model->insert($this->link, $this->table, $this->data);
    }

}

?>
