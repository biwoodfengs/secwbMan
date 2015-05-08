<?php

/**
 * 自定义验证码（在CI的验证码基础上）
 * Encoding		:  UTF-8
 * Created on	:  2014-5-15 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Captcha {

    public $CI;
    public $config = array(
        'img_path' => './captcha/', //图片存放路径
        'img_url' => 'captcha/', //图片路径
        'img_width' => 110,
        'img_height' => 30,
        "font_path" => "./system/fonts/arialbi.ttf"
    );

    public function __construct($config = array()) {
        if (count($config) > 0) {
            $this->initialize($config);
        }
        $this->CI = & get_instance();
        $this->CI->load->helper('captcha');
        log_message('debug', "Captcha Class Initialized");
    }

    private function initialize($config) {
        foreach ($config as $key => $val) {
            if (isset($this->config[$key])) {
                $this->config[$key] = $val;
            }
        }
    }

    public function my_captcha_create() {
        return create_captcha($this->config);
    }

}

?>
