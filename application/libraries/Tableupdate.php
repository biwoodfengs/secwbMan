<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-10 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Tableupdate {

    private $link;
    private $table;
    private $where;
    private $set;
    private $CI;

    public function __construct($link = 'default') {
        $this->link = $link;
        $this->CI = & get_instance();
        log_message('debug', "Tableupdate Class Initialized");
    }

    /**
     * 删除表数据
     * @param type $table
     * @param type $where
     * @return typeF
     */
    public function update($table, $set, $where) {
        $this->table = $table;
        $this->set = $set;
        $this->where = $where;
        return $this->CI->Database_Model->update($this->link, $this->table, $this->set, $this->where);
    }

}

?>
