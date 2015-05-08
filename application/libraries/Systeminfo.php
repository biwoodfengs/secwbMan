<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-6 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Systeminfo {

    /**
     * 获取操作系统
     * @return string
     */
    function getOS() {
        $os = '';
        $Agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/win/', $Agent) && strpos($Agent, '95')) {
            $os = 'Windows 95';
        } elseif (preg_match('/win 9x/', $Agent) && strpos($Agent, '4.90')) {
            $os = 'Windows ME';
        } elseif (preg_match('/win/', $Agent) && ereg('/98/', $Agent)) {
            $os = 'Windows 98';
        } elseif (preg_match('/win/', $Agent) && preg_match('/nt 5.0/', $Agent)) {
            $os = 'Windows 2000';
        } elseif (preg_match('/win/', $Agent) && preg_match('/nt 6.0/', $Agent)) {
            $os = 'Windows Vista';
        } elseif (preg_match('/win/', $Agent) && preg_match('/nt 6.1/', $Agent)) {
            $os = 'Windows 7';
        } elseif (preg_match('/win/', $Agent) && preg_match('/nt 5.1/', $Agent)) {
            $os = 'Windows XP';
        } elseif (preg_match('/win/', $Agent) && preg_match('/nt/', $Agent)) {
            $os = 'Windows NT';
        } elseif (preg_match('/win/', $Agent) && preg_match('/32/', $Agent)) {
            $os = 'Windows 32';
        } elseif (preg_match('/linux/', $Agent)) {
            $os = 'Linux';
        } elseif (preg_match('/unix/', $Agent)) {
            $os = 'Unix';
        } else if (preg_match('/sun/', $Agent) && preg_match('/os/', $Agent)) {
            $os = 'SunOS';
        } elseif (preg_match('/ibm/', $Agent) && preg_match('/os/', $Agent)) {
            $os = 'IBM OS/2';
        } elseif (preg_match('/Mac/', $Agent) && preg_match('/PC/', $Agent)) {
            $os = 'Macintosh';
        } elseif (preg_match('/PowerPC/', $Agent)) {
            $os = 'PowerPC';
        } elseif (preg_match('/AIX/', $Agent)) {
            $os = 'AIX';
        } elseif (preg_match('/HPUX/', $Agent)) {
            $os = 'HPUX';
        } elseif (preg_match('/NetBSD/', $Agent)) {
            $os = 'NetBSD';
        } elseif (preg_match('/BSD/', $Agent)) {
            $os = 'BSD';
        } elseif (preg_match('/OSF1/', $Agent)) {
            $os = 'OSF1';
        } elseif (preg_match('/IRIX/', $Agent)) {
            $os = 'IRIX';
        } elseif (preg_match('/FreeBSD/', $Agent)) {

            $os = 'FreeBSD';
        } elseif ($os == '') {
            $os = 'Unknown';
        }
        return $os;
    }

    /**
     * 获取浏览器信息
     * @return string
     */
    function getBrowser() {
        $sys = $_SERVER['HTTP_USER_AGENT'];
        if (stripos($sys, "NetCaptor") > 0) {
            $exp[0] = "NetCaptor";
            $exp[1] = "";
        } elseif (stripos($sys, "Firefox/") > 0) {
            preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
            $exp[0] = "Mozilla Firefox";
            $exp[1] = $b[1];
        } elseif (stripos($sys, "MAXTHON") > 0) {
            preg_match("/MAXTHON\s+([^;)]+)+/i", $sys, $b);
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            // $exp = $b[0]." (IE".$ie[1].")";
            $exp[0] = $b[0] . " (IE" . $ie[1] . ")";
            $exp[1] = $ie[1];
        } elseif (stripos($sys, "MSIE") > 0) {
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            //$exp = "Internet Explorer ".$ie[1];
            $exp[0] = "Internet Explorer";
            $exp[1] = $ie[1];
        } elseif (stripos($sys, "Netscape") > 0) {
            $exp[0] = "Netscape";
            $exp[1] = "";
        } elseif (stripos($sys, "Opera") > 0) {
            $exp[0] = "Opera";
            $exp[1] = "";
        } elseif (stripos($sys, "Chrome") > 0) {
            $exp[0] = "Chrome";
            $exp[1] = "";
        } else {
            $exp = "未知浏览器";
            $exp[1] = "";
        }
        return $exp;
    }

    /**
     * 获取运行环境
     */
    public function server_software() {
        return $_SERVER['SERVER_SOFTWARE'];
    }

    /**
     * 获取php运行方式
     */
    public function phphander() {
        return PHP_SAPI;
    }

    /**
     * 获取mysql版本
     */
    public function mysql_version() {
        return mysql_get_server_info();
    }

    /**
     * 获取文件附件限制
     */
    public function post_max_size() {
        return ini_get("post_max_size");
    }

    /**
     * 获取脚本实行时间限制
     * @return type
     */
    public function max_exec_time() {
        return ini_get("max_execution_time");
    }
    

}

?>
