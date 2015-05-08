<?php

/**
 * 后台登录模块
 * Encoding		:  UTF-8
 * Created on	:  2014-5-15 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Login extends CI_Controller {

    private $name;
    private $password;

    public function __construct() {
        parent::__construct();
        //导入表单验证类
        $this->load->library('form_validation');
        $this->load->model('public/Captcha_Model');
    }

    /**
     * 后台登陆
     */
    public function index($info = '') {
        
        $this->load->model('admin/User_Model');
        /**
         * 检查是否登录，登录了则显示登录后，没有登录则显示登录界面
         */
        $userinfo = $this->User_Model->check_userinfo();
        if ($userinfo !== FALSE) {
            Header("Location: " . site_url('admin/index'));
        }
        //加入自定义验证码类
        /*
         * 生成验证码
         * 'image' => IMAGE TAG
         * 'time' => TIMESTAMP (毫秒)
         * 'word' => s8sj
         */
        $data['captcha'] = $this->Captcha_Model->create_captcha();
        $data['login_error'] = $info;
        //渲染试图
        $this->load->view('admin/login', $data);
    }

    /**
     * 处理登陆信息
     */
    public function dologin() {

        if ($this->check_form() == FALSE) {
            //表单验证失败,返回登录
            $this->index();
        } else {
            //验证用户名密码
            $this->userinfo = $this->check_user();
            if (!empty($this->userinfo)) {

                //登录成功
                $this->Captcha_Model->delete_captcha();
                //存放session
                $this->load->model('admin/User_Model');
                $this->User_Model->save_user_session($this->userinfo);

                //redirect('admin/index');
                Header("Location: " . site_url('admin/index'));
            } else {
                $this->index('<p>用户名或密码错误！</p>');
            }
        }

    }

    /**
     * 
     * @return type验证表单
     */
    public function check_form() {
        /*
         * 表单验证规则
         * required 不为空
         * callback_auth_check 回调函数验证 auth_check()
         */
        $this->form_validation->set_rules('name', '用户名', 'required');
        $this->form_validation->set_rules('password', '密码', 'required');
        $this->form_validation->set_rules('code', '验证码', 'required');
        $this->form_validation->set_rules('code', 'Code', 'callback_auth_check');
        /*
         * 自定义验证显示内容
         */
        $this->form_validation->set_message('required', '%s 不能为空！');
        return $this->form_validation->run();
    }

    /**
     * 查询用户是否存在
     * @return Array or array()
     */
    public function check_user() {
        $this->name = $this->input->post('name');
        $this->password = $this->input->post('password');
        $where = array('name' => $this->name, 'password' => md5($this->password));
        $fields = array('id as userid,name,roleid,realname,dateline,lasttime');
        return $this->Database_Model->get_table_row('default', 'admin', $where, $fields);
    }

    /**
     * 验证验证码是否正确
     * @param type $code 表单输入的验证码
     * @return boolean
     */
    public function auth_check($code) {
        if (strcmp(strtoupper($code), strtoupper($this->session->userdata('captcha'))) != 0) {
            $this->form_validation->set_message('auth_check', '验证码 输入错误！');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 登录注销
     */
    public function logout() {
        $this->session->sess_destroy();
        if (empty($this->userid) && empty($this->username)) {
            redirect('admin/login');
        } else {
            echo '注销失败!';
        }
    }

    /**
     * 更换验证码
     */
    public function change_code() {
        $cap = $this->Captcha_Model->create_captcha();
        exit($cap['time']);
    }

}

?>
