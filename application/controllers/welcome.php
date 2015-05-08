<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
//            session_start();
//            $_SESSION['name'] = 'test';
//            echo '<pre>';
//            var_dump($_SESSION);
//            echo '</pre>';
        $this->load->helper('cookie');
        $cookie = array(
            'name' => 'turnpage',
            'value' => "111",
            'expire' => time() + config_item("cookie_expire"),
            'domain' => config_item("cookie_domain"),
            'path' => config_item("cookie_path"),
            'secure' => TRUE
        );
        set_cookie($cookie);
        $this->trunpage = get_cookie("turnpage");

        setcookie("admin_auth", 'asd', time() + config_item("cookie_expire"), config_item("cookie_path"), config_item("cookie_domain"));
        echo '<pre>';
        var_dump($this->trunpage);
        echo '</pre>';
        echo '<pre>';
        var_dump($_COOKIE);
        echo '</pre>';
        $this->load->view('welcome_message');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */