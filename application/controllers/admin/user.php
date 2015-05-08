<?php

/**
 * 后台用户管理控制器
 * Encoding		:  UTF-8
 * Created on	:  2014-6-6 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class User extends MY_Controller {

    private $where = array();
    private $limit = array();
    private $fields = array('id,name,realname,lastip,dateline,lasttime,roleid');

    public function __construct() {
        parent::__construct();
    }

    /**
     * 用户列表
     */
    public function userlist() {
        $this->load->library('tablecount'); //导入数据库表自定义类
        $total_data = $this->tablecount->get_tablecount('admin', $this->where); //总条数
        $pageNum = isset($_POST['pageNum']) ? $_POST['pageNum'] : 1;
        $pageinfo = page($total_data, $pageNum); //计算分页总数和分页条件
        $this->load->library('tablelist'); //导入数据库表自定义类
        $this->limit = $pageinfo['limit'];
        $data = $pageinfo['pageinfo'];
        $data['datalist'] = $this->tablelist->get_tablelist('admin', $this->where, $this->fields = array(), array(), $this->limit);
        $this->load->view('admin/user/userlist', $data);
    }

    /**
     * show view
     */
    public function add() {
        $this->load->library('submitverify', "user"); //导入重复提交
        $data['verify_string'] = $this->submitverify->create_verify();
        $this->load->library('tablekeyvalue'); //导入数据库表自定义类
        $this->where = array('state' => Adminconfig::STATE_1_CODE);
        $data['rolelist'] = $this->tablekeyvalue->getkeyvalue('role', $this->where, 'id', array('id,name'));
        $this->load->view('admin/user/useradd', $data);
    }

    /**
     * 执行添加功能操作
     * echo json 格式 dwz的规则,提示用户处理结果
     */
    public function do_add() {
        $verify_string = strip_tags($this->input->get_post("verify_string"));
        $this->load->library('submitverify', "user"); //导入数据库表自定义类
        if ($this->submitverify->do_verify_submit($verify_string)) {
            $data['name'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("name")))));
            $data['password'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("pwd")))));
            $data['realname'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("realname")))));
            $data['roleid'] = verify_id($this->input->get_post("roleid"));
            $data['dateline'] = date('Y-m-d H:i:s');
            $this->load->library('Tableinsert'); //导入数据库表自定义类
            if ($this->tableinsert->insert_table('admin', $data) > 0) {
                $this->return['statusCode'] = '200';
                $this->return['message'] = '操作成功';
                $this->return['navTabId'] = 'page' . $this->trunpage;
            } else {
                $this->return['statusCode'] = '300';
                $this->return['message'] = '操作失败';
            }
        } else {
            $this->return['statusCode'] = '300';
            $this->return['message'] = '请勿重复提交！';
        }
        echo json_encode($this->return);
    }

    /**
     * 删除数据
     * @param type $id
     */
    public function del($id) {
        $this->where = array('id' => dowith_sql(daddslashes(html_escape(strip_tags($id)))));
        $this->load->library('tabledel'); //导入数据库表自定义类
        if ($this->tabledel->del('admin', $this->where) > 0) {
            $this->return['statusCode'] = '200';
            $this->return['message'] = '操作成功';
            $this->return['navTabId'] = 'page' . $this->trunpage;
            $this->return['callbackType'] = '';
        } else {
            $this->return['statusCode'] = '300';
            $this->return['message'] = '操作失败';
            $this->return['callbackType'] = '';
        }
        echo json_encode($this->return);
    }

    /**
     * 编辑
     */
    public function edit($id) {
        $this->load->library('tablekeyvalue'); //导入数据库表自定义类
        $this->where = array('state' => Adminconfig::STATE_1_CODE);
        $data['rolelist'] = $this->tablekeyvalue->getkeyvalue('role', $this->where, 'id', array('id,name'));
        $this->where = array('id' => verify_id($id));
        $this->load->library('tablerow'); //导入数据库表自定义类
        $data['info'] = $this->tablerow->get_tablerow('admin', $this->where, $this->fields);
        $this->load->view('admin/user/useredit', $data);
    }

    /**
     * 执行编辑
     */
    public function do_edit() {
        $id = verify_id($this->input->get_post("id"));
        $data['name'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("name")))));
        $data['realname'] = daddslashes(html_escape(strip_tags($this->input->get_post("realname"))));
        $data['roleid'] = verify_id($this->input->get_post("roleid"));
        $this->where = array('id' => $id);
        $this->load->library('tableupdate'); //导入数据库表自定义类
        if ($this->tableupdate->update('admin', $data, $this->where)) {
            $this->return['statusCode'] = '200';
            $this->return['message'] = '操作成功';
            $this->return['navTabId'] = 'page' . $this->trunpage;
        } else {
            $this->return['statusCode'] = '300';
            $this->return['message'] = '操作失败';
            $this->return['callbackType'] = "";
        }
        echo json_encode($this->return);
    }

}

?>
