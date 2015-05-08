<?php

/**
 * 后台  功能控制器
 * Encoding		:  UTF-8
 * Created on	:  2014-6-9 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Func_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 计算获取待插入功能的二进制权限
     * 获取最后一条数据的二进制100，计算获得下一个二进制权限为1000
     * @return String
     */
    public function get_last_authority($path) {
        $this->load->library('tablerow'); //导入数据库表自定义类
        $where = array('path' => $path);
        $fields = array('authority');
        $row = $this->tablerow->get_tablerow('func', $where, $fields, array(), array(), 'dateline desc');

        if (!empty($row)) {
            $row_length = strlen($row['authority']);
            $insert_authority = str_pad('1', $row_length + 1, '0');
        } else {
            $insert_authority = 1;
        }
        return $insert_authority;
    }

    /**
     * 获取权限代表值
     */
    public function get_own_func($authority) {
        $authority_array = explode(',', $authority);
        $owner_func = array();
        $where = "";
        foreach ($authority_array as $value) {
            $have_array = array();
            $authority_new = explode(':', $value);
            $authority_len = strlen($authority_new[1]);
            for ($i = 0; $i < $authority_len; $i++) {

                $sub_value = substr($authority_new[1], $i, 1);
                if ($sub_value == 1) {
                    $have_array[] = str_pad($sub_value, $authority_len - $i, "0");
                }
            }
            $have_string = implode(',', $have_array);
            $where .= " (path='{$authority_new[0]}' AND authority IN ({$have_string})) OR ";
        }
        $where = rtrim($where, "OR ");
        return $this->get_sql_data($where);
    }

    /**
     * 获取拥有权限功能的名称
     * @param type $path
     * @param type $authority_string
     * @return type
     */
    public function get_sql_data($where) {
        //选择主从库，默认是default
        $this->Database_Model->get_db();
        $sql = "SELECT * FROM {$this->db->dbprefix}func where {$where}";
        $this->load->library('tablequery');
        $query = $this->tablequery->query($sql);
        return $query->result_array();
    }

}

?>
