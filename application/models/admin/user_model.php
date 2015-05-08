<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-5 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class User_Model extends CI_Model {

    private $userid;
    private $username;
    private $roleid;

    public function __construct() {
        parent::__construct();
    }

    /**
     * 用户信息存放在session中
     * @param type $userinfo
     */
    public function save_user_session($userinfo) {
        $this->session->set_userdata($userinfo);
    }

    /**
     * 获取id
     */
    public function get_session_userid() {
        $this->userid = $this->session->userdata('userid');
    }

    /**
     * 获取name
     */
    public function get_session_roleid() {
        $this->roleid = $this->session->userdata('roleid');
    }

    /**
     * 获取name
     */
    public function get_session_username() {
        $this->username = $this->session->userdata('name');
    }

    /**
     * 检查session值
     * @return boolean
     */
    public function check_userinfo() {
        $this->get_session_userid();
        $this->get_session_username();
        $this->get_session_roleid();
        if (empty($this->username) || empty($this->userid)) {
            return FALSE;
        } else {
            return array('userid' => $this->userid, 'username' => $this->username, 'roleid' => $this->roleid);
        }
    }

}

?>
