<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-9 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Tablequery {

    private $link;
    private $sql;
    private $CI;

    public function __construct($link = 'default') {
        $this->link = $link;
        $this->CI = & get_instance();
        log_message('debug', "Tablequery Class Initialized");
    }

    /**
     * 获取表数据 result_array
     * @param type $table 表
     * @param type $where sql 条件
     * @param type $fields sql select()
     * @param type $link 数据库连接 主从
     * @return type Array
     */
    public function query($sql) {
        $this->sql = $sql;
        return $this->CI->Database_Model->query($this->link, $this->sql);
    }

}

?>
