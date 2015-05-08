<?php

/**
 * Encoding		:  UTF-8
 * Created on	:  2014-6-11 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Submitverify {

    private $verify_value;
    private $verify_fields;
    private $CI;

    public function __construct($verify_fields = "verify") {
        $this->CI = & get_instance();
        log_message('debug', "Submitverify Class Initialized");
        $this->verify_fields = $verify_fields;
    }

    /**
     * 生成验证串，放到session中
     */
    public function create_verify() {
        $this->CI->load->helper('string');
        $this->verify_value = random_string('md5', 32);
        $this->CI->session->set_userdata($this->verify_fields, $this->verify_value);
        return $this->verify_value;
    }

    /**
     * 验证提交
     * @param type $post_verify 表单的post值
     * @return type
     */
    public function do_verify_submit($post_verify) {
        if ($this->CI->session->userdata($this->verify_fields) == $post_verify) {
            $this->CI->session->unset_userdata($this->verify_fields);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 清空验证串 
     */
    public function clear_verify_string() {
        $this->CI->session->unset_userdata($this->verify_fields);
    }

}

?>
