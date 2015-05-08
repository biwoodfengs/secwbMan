<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include __ROOT__."/include/function/common_function.php" ;  //包含公用的方法 前台和后台公用
/**
 * 分页参数
 * @param type $total_data 总条数
 * @param type $curr_page 默认第一页
 * @return type 
 */
if (!function_exists("page")) {

    function page($total_data, $curr_page = 1) {
        $ci = &get_instance(); //初始化 为了用方法
        $per_page_num = $ci->config->item('per_page_num');
        $offset = ($curr_page - 1) * $per_page_num; //偏移量
        $total_page = ceil($total_data / $per_page_num); //总页数
        return array(
            'limit' => array($per_page_num, $offset),
            'pageinfo' => array(
                'per_page_num' => $per_page_num, //每页显示条数
                'total_page' => $total_page, //总页数
                'total_data' => $total_data, //总条数
                'curr_page' => $curr_page //当前页
            )
        );
    }

}
/**

 * 处理form 提交的参数过滤
 * $string	string  需要处理的字符串或者数组
 * $force	boolean  强制进行处理
 * @return	string 返回处理之后的字符串或者数组
 */
if (!function_exists("daddslashes")) {

    function daddslashes($string, $force = 1) {
        if (is_array($string)) {
            $keys = array_keys($string);
            foreach ($keys as $key) {
                $val = $string[$key];
                unset($string[$key]);
                $string[addslashes($key)] = daddslashes($val, $force);
            }
        } else {
            $string = addslashes($string);
        }
        return $string;
    }

}
/**

 * 处理form 提交的参数过滤
 * $string	string  需要处理的字符串
 * @return	string 返回处理之后的字符串或者数组
 */
if (!function_exists("dowith_sql")) {

    function dowith_sql($str) {
        $str = str_replace("and", "", $str);
        $str = str_replace("execute", "", $str);
        $str = str_replace("update", "", $str);
        $str = str_replace("count", "", $str);
        $str = str_replace("chr", "", $str);
        $str = str_replace("mid", "", $str);
        $str = str_replace("master", "", $str);
        $str = str_replace("truncate", "", $str);
        $str = str_replace("char", "", $str);
        $str = str_replace("declare", "", $str);
        $str = str_replace("select", "", $str);
        $str = str_replace("create", "", $str);
        $str = str_replace("delete", "", $str);
        $str = str_replace("insert", "", $str);
        // $str = str_replace("'","",$str);
        // $str = str_replace('"',"",$str);
        // $str = str_replace(" ","",$str);
        $str = str_replace("or", "", $str);
        $str = str_replace("=", "", $str);
        $str = str_replace("%20", "", $str);
        //echo $str;
        return $str;
    }

}
//获取登录的用户名
if (!function_exists("login_name")) {

    function login_name() {
        $data = decode_data();
        if (isset($data['username'])) {
            return $data['username'];
        } else {
            return '';
        }
    }

}

//获取登录的用户所在的群组
if (!function_exists("group_name")) {

    function group_name() {
        $data = decode_data();
        if (isset($data['group_name'])) {
            return $data['group_name'];
        } else {
            return '';
        }
    }

}
//获取登录的用户所在的角色ID 
if (!function_exists("role_id")) {

    function role_id() {
        $data = decode_data();
        if (isset($data['role_id'])) {
            return $data['role_id'];
        } else {
            return '';
        }
    }

}

//获取登录的用户的uid
if (!function_exists("admin_id")) {

    function admin_id() {
        $data = decode_data();
        if (isset($data['admin_id'])) {
            return $data['admin_id'];
        } else {
            return '';
        }
    }

}

//判断当前登录的用户是不是超级管理员
if (!function_exists("is_super_admin")) {

    function is_super_admin() {
        $data = decode_data();
        if (isset($data['isadmin']) && $data['isadmin']) {
            return true;
        } else {
            return false;
        }
    }

}

/*
 * @记录系统操作日志文件到数据库里面 
 * *sql 是要插入数据库中的 log_sql的值 
 * $action 动作
 * $person 操作人
 * $ip ip地址
 * status 操作是否成功 1成功 0失败
 * message 失败信息
 * groupname_ 定义数据库连接信息的时候的 groupname
 */
if (!function_exists("write_action_log")) {

    function write_action_log($sql, $url = '', $person = '', $ip = '', $status = '1', $message = '', $groupname_ = "real_data") {
        if (!config_item('is_write_log_to_database')) {//是否记录日志文件到数据表中
            return false;
        }

        $sql = str_replace("\\", "", $sql); // 把\进行过滤掉
        $sql = str_replace("%", "\%", $sql); // 把 '%'前面加上\
        $sql = str_replace("'", "\'", $sql); // 把 ''过滤掉
        $message = daddslashes($message);
        $time = date("Y-m-d H:i:s", time());
        $time_table = date("Ym", time());


        $table_pre = table_pre($groupname_);

        $sql_table = <<<EOT
CREATE TABLE IF NOT EXISTS `{$table_pre}common_log_{$time_table}` (
  `log_id` mediumint(8) NOT NULL auto_increment,
  `log_url` varchar(50) NOT NULL,
  `log_person` varchar(16) NOT NULL,
  `log_time` datetime NOT NULL,
  `log_ip` char(15) NOT NULL,
  `log_sql` text NOT NULL,
  `log_status` tinyint(1) NOT NULL default '1',
  `log_message` varchar(255) NOT NULL,
  PRIMARY KEY  (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;		
EOT;
        $ci = &get_instance(); //初始化 为了用方法
        $d = $ci->load->database($groupname_, true);
        $d->query($sql_table);
        $sql_log = "INSERT INTO `{$table_pre}common_log_{$time_table}`(`log_url`,`log_person`,`log_time`,`log_ip`,`log_sql`,`log_status`,`log_message`)VALUES('{$url}','{$person}','{$time}','{$ip}','{$sql}','{$status}','{$message}')";
        $d->query($sql_log);
    }

}



/**
 * 将数据格式化成树形结构
 * @author 王建
 * @param array $items
 * @return array
 */
if (!function_exists("genTree9")) {

    function genTree9($items, $id = 'id', $pid = 'pid', $child = 'children') {
        $tree = array(); //格式化好的树
        foreach ($items as $item)
            if (isset($items[$item[$pid]]))
                $items[$item[$pid]][$child][] = &$items[$item[$id]];
            else
                $tree[] = &$items[$item[$id]];
        return $tree;
    }

}

/**
 * 格式化select
 * @author 王建
 * @param array $parent
 * @deep int 层级关系 
 * @return array
 */
function getChildren($parent, $deep = 0) {
    foreach ($parent as $row) {
        $data[] = array("id" => $row['id'], "name" => $row['name'], "pid" => $row['parentid'], 'deep' => $deep, 'url' => $row['url']);
        if (isset($row['childs']) && !empty($row['childs'])) {
            $data = array_merge($data, getChildren($row['childs'], $deep + 1));
        }
    }
    return $data;
}

/**
 * 格式化select,生成options
 * @author 王建
 * @param array $parent
 * @deep int 层级关系 
 * @return array
 */
function getChildren2($parent, $deep = 0, $id = 'id', $pid = 'pid', $name = 'typename', $children = 'children') {
    foreach ($parent as $row) {
        $data[] = array("id" => $row[$id], "name" => $row[$name], "pid" => $row[$pid], 'deep' => $deep);
        if (isset($row[$children]) && !empty($row[$children])) {
            $data = array_merge($data, getChildren2($row[$children], $deep + 1, $id, $pid, $name, $children));
        }
    }
    return $data;
}

/**
 * 格式化数组，
 * @author 王建
 * @param array $list
 * @return array
 */
function tree_format(&$list, $pid = 0, $level = 0, $html = '--', $pid_string = 'pid', $id_string = 'id') {
    static $tree = array();
    foreach ($list as $v) {
        if ($v[$pid_string] == $pid) {
            $v['sort'] = $level;
            $v['html'] = str_repeat($html, $level);
            $tree[] = $v;
            tree_format($list, $v[$id_string], $level + 1, $html);
        }
    }
    return $tree;
}

/**
 * 显示页面
 * @author 王建
 * @param string $message 错误信息
 * @param string $url 页面跳转地址
 * @param string $timeout 时间
 * @param string $iserror 是否错误 1正确 0错误
 * @param string $params 其他参数前面加? 例如?id=122&time=333
 */
if (!function_exists('showmessage')) {

    //跳转

    function showmessage($message = '', $url = '', $timeout = '3', $iserror = 1, $params = '') {
        if ($iserror == 1) {//正确
            include APPPATH . '/errors/showmessage.php';
        } else {
            include APPPATH . '/errors/showmessage_error.php';
        }

        die();
    }

}
/**
 * 获取后台登陆的数据，其中参数主要是为了 ，有时候用插件上传图片的时候 登陆状态消失
 * @author 王建
 * @param $string 解密的值
 * @return array
 */
if (!function_exists("decode_data")) {

    function decode_data($string = '') {
        $data = array();
        $encode_string = '';
        $encode_string = ($string != "" ) ? $string : (isset($_COOKIE['admin_auth']) ? $_COOKIE['admin_auth'] : '');

        //$encode_string = isset($_COOKIE['admin_auth'])?$_COOKIE['admin_auth']:'' ;
        if (empty($encode_string)) {
            return $data;
        }
        $encode_string = auth_code($encode_string, "DECODE", config_item("s_key"));
        $data = unserialize($encode_string);
        return $data;
    }

}

/*
  32	函数名称：verify_id()
  33	函数作用：校验提交的ID类值是否合法
  34	参　　数：$id: 提交的ID值
  35	返 回 值：返回处理后的ID
  36
 */
if (!function_exists("verify_id")) {

    function verify_id($id = null) {
        if (!$id) {
            return 0;
        } // 是否为空判断
        elseif (inject_check($id)) {
            return 0;
        } // 注射判断
        elseif (!is_numeric($id)) {
            return 0;
        } // 数字判断
        $id = intval($id); // 整型化		 
        return $id;
    }

}

/*
 * 检测提交的值是不是含有SQL注射的字符，防止注射，保护服务器安全
 * 参　　数：$sql_str: 提交的变量
 * 返 回 值：返回检测结果，ture or false 
 */

if (!function_exists("inject_check")) {

    function inject_check($sql_str) {
        return @eregi('select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str); // 进行过滤
    }

}
?>