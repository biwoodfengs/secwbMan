<?php

/**
 * 以主键为key获取数组
 * Encoding		:  UTF-8
 * Created on	:  2014-6-12 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Tablekeyvalue {

    private $link;
    private $table;
    private $where;
    private $fields;
    private $CI;
    private $data;

    public function __construct($link = 'default') {
        $this->link = $link;
        $this->CI = & get_instance();
        log_message('debug', "Tablekeyvalue Class Initialized");
    }

    /**
     * 获取以key为下表的数组
     * @param type $table
     * @param type $where
     * @param type $key
     * @param type $fields
     * @return type
     */
    public function getkeyvalue($table, $where = array(), $key = '', $fields = array()) {
        $this->table = $table;
        $this->key = $key;
        $this->where = $where;
        $this->fields = $fields;
        $result = $this->CI->Database_Model->get_table_data($this->link, $this->table, $this->where, $this->fields);
        $this->data = array();
        foreach ($result as $value) {
            $this->data[$value[$this->key]] = $value;
        }
        return $this->data;
    }

}

?>
