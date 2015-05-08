<?php

/**
 * 后台功能管理控制器
 * Encoding		:  UTF-8
 * Created on	:  2014-6-6 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Func extends MY_Controller {

    private $where = array();
    private $limit = array();
    private $fields = array('id,name,pid as parentid,dateline,authority,weight,path,methods');

    public function __construct() {
        parent::__construct();
    }

    /**
     * 功能列表
     */
    public function funclist($params = "") {
        $this->load->library('tablelist'); //导入数据库表自定义类
        $list = $this->tablelist->get_tablelist('func', $this->where, $this->fields, array(), $this->limit);
        $result = array();
        if ($list) {
            foreach ($list as $k => $v) {
                $result[$v['id']] = $v;
            }
        }
        $data['datalist'] = genTree9($result, 'id', 'parentid', 'childs');

        if ($params == "lookup") {
            $this->load->view('admin/user/func_lookup', $data);
        } else {
            $this->load->view('admin/user/funclist', $data);
        }
    }

    /**
     * show view
     */
    public function add($id = 0) {
        $this->load->view('admin/user/funcadd');
    }

    /**
     * 执行添加功能操作
     * echo json 格式 dwz的规则,提示用户处理结果
     */
    public function do_add() {
        $data['pid'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("orgLookup_id")))));
        $data['name'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("name")))));
        $data['path'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("orgLookup_path")))));
        $data['weight'] = daddslashes(html_escape(strip_tags($this->input->get_post("weight"))));
        $data['methods'] = html_escape(strip_tags($this->input->get_post("weight")));
        $this->load->model('admin/Func_Model', 'func');
        $data['authority'] = $this->func->get_last_authority($data['path']);
        $this->load->library('Tableinsert'); //导入数据库表自定义类
        if ($this->tableinsert->insert_table('func', $data) > 0) {
            $this->return['statusCode'] = '200';
            $this->return['message'] = '操作成功';
            $this->return['callbackType'] = 'closeCurrent';
        } else {
            $this->return['statusCode'] = '300';
            $this->return['message'] = '操作失败';
            $this->return['callbackType'] = '';
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
        if ($this->tabledel->del('func', $this->where) > 0) {
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
        $this->where = array('id' => dowith_sql(daddslashes(html_escape(strip_tags($id)))));
        $this->load->library('tablerow'); //导入数据库表自定义类
        $data['funcinfo'] = $this->tablerow->get_tablerow('func', $this->where, $this->fields);
        if ($data['funcinfo']['parentid'] == 0) {
            $data['pidname'] = "顶级";
        } else {
            $this->where = array('id' => $data['funcinfo']['parentid']);
            $this->fields = array('name');
            $pidinfo = $this->tablerow->get_tablerow('func', $this->where, $this->fields);
            $data['pidname'] = $pidinfo['name'];
        }
        $this->load->view('admin/user/funcedit', $data);
    }

    /**
     * 执行编辑
     */
    public function do_edit() {
        $id = intval($this->input->get_post("id"));
        $data['name'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("name")))));
        $data['weight'] = daddslashes(html_escape(strip_tags($this->input->get_post("weight"))));
        $data['methods'] = html_escape(strip_tags($this->input->get_post("methods")));
        $this->where = array('id' => $id);
        $this->load->library('tableupdate'); //导入数据库表自定义类
        if ($this->tableupdate->update('func', $data, $this->where)) {
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
