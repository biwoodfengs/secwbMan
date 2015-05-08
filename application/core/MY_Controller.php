<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-4 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class MY_Controller extends CI_Controller {

    public $userid;
    public $username;
    public $roleid;
    public $trunpage;
    /*
     * statusCode 200 操作成功  300 操作失败 301 登陆失效
     * 
     * 
     */
    public $return = array(
        'statusCode' => '301',
        'message' => '登陆失效，请重新登录!',
        'navTabId' => '',
        'rel' => '',
        'callbackType' => 'closeCurrent',
        'forwardUrl' => ''
    );

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/User_Model');
        $userinfo = $this->User_Model->check_userinfo();
        if ($userinfo === FALSE) {
            //跳转
            Header("HTTP/1.1 303 See Other");
            Header("Location: " . site_url('admin/login'));
            exit;
        } else {
            $this->userid = $userinfo['userid'];
            $this->username = $userinfo['username'];
            $this->roleid = $userinfo['roleid'];
        }
        $this->get_trunpage();
    }

    /**
     * 获取跳转标示  page+trunpage 唯一确定一个rel
     */
    public function get_trunpage() {
        $segs = $this->uri->uri_to_assoc(4);
        if (isset($segs['turnpage'])) {
            setcookie("turnpage", "", time() - config_item("cookie_expire"), config_item("cookie_path"), "/");
            setcookie("turnpage", $segs['turnpage'], time() + config_item("cookie_expire"), "/");
            $_COOKIE["turnpage"] = $segs['turnpage'];
        }
        $this->trunpage = isset($_COOKIE["turnpage"]) ? $_COOKIE["turnpage"] : '';
    }

}

?>
