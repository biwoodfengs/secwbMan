<?php

/**
 * 后台用户管理控制器
 * Encoding		:  UTF-8
 * Created on	:  2014-6-6 by Tom , xiuluo_0816@163.com
 * WebSite		:  www.statnet.com.cn 
 */
class Role extends MY_Controller {

    private $where = array();
    private $limit = array();
    private $fields = array('id,name,dateline,authority');

    public function __construct() {
        parent::__construct();
    }

    /**
     * 用户列表
     */
    public function rolelist() {
        $this->load->library('tablelist'); //导入数据库表自定义类
        $data['datalist'] = $this->tablelist->get_tablelist('role', $this->where, $this->fields = array(), array(), $this->limit);
        $this->load->view('admin/user/rolelist', $data);
    }

    /**
     * show view
     */
    public function add() {
        $this->load->view('admin/user/roleadd');
    }

    /**
     * 执行添加功能操作
     * echo json 格式 dwz的规则,提示用户处理结果
     */
    public function do_add() {
        $data['name'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("name")))));
        $data['authority'] = "manager:0,"; //默认给权限字段值  省的判断为空
        $this->load->library('Tableinsert'); //导入数据库表自定义类
        if ($this->tableinsert->insert_table('role', $data) > 0) {
            $this->return['statusCode'] = '200';
            $this->return['message'] = '操作成功';
            $this->return['navTabId'] = 'page' . $this->trunpage;
        } else {
            $this->return['statusCode'] = '300';
            $this->return['message'] = '操作失败';
        }
        echo json_encode($this->return);
    }

    /**
     * 删除数据
     * @param type $id
     */
    public function del($id) {
        if ($id == 1) {
            //系统管理员禁止删除
            $this->return['statusCode'] = '300';
            $this->return['message'] = '系统管理员禁止删除';
            $this->return['callbackType'] = '';
            echo json_encode($this->return);
        }
        $this->where = array('id' => verify_id($id));
        $this->load->library('tabledel'); //导入数据库表自定义类
        if ($this->tabledel->del('role', $this->where) > 0) {
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
        $this->where = array('id' => verify_id($id));
        $this->load->library('tablerow'); //导入数据库表自定义类
        $data['info'] = $this->tablerow->get_tablerow('role', $this->where, $this->fields);
        $authority = trim($data['info']['authority'], ',');
        $authority_array = explode(',', $authority);
        $have_array = array();
        foreach ($authority_array as $array) {

            $authority_new = explode(':', $array);
            $authority_len = strlen($authority_new[1]);
            for ($i = 0; $i < $authority_len; $i++) {
                $sub_value = substr($authority_new[1], $i, 1);
                if ($sub_value == 1) {
                    $have_array[$authority_new[0]][] = str_pad($sub_value, $authority_len - $i, "0");
                }
            }
        }
        $data['have'] = $have_array;
        $this->load->library('tablelist'); //导入数据库表自定义类
        $this->fields = array('id,name,pid as parentid,authority,path');
        $list = $this->tablelist->get_tablelist('func', array(), $this->fields);
        $result = array();
        if ($list) {
            foreach ($list as $k => $v) {
                $result[$v['id']] = $v;
            }
        }
        $data['datalist'] = genTree9($result, 'id', 'parentid', 'childs');
        $this->load->view('admin/user/roleedit', $data);
    }

    /**
     * 执行编辑
     */
    public function do_edit() {
        $insert_authority = '';
        foreach ($_POST as $key => $value) {
            //$postfix = substr($key, -9);   user:101010
            if (substr($key, -9) == 'authority') {
                $array = explode('_', $key);
                $authority = '';
                foreach ($_POST[$key] as $value) {
                    $value = (int) $value;
                    $authority += $value;
                }
                $insert_authority .= $array[0] . ':' . $authority . ',';
            }
        }
        $data['authority'] = $insert_authority;
        $data['name'] = dowith_sql(daddslashes(html_escape(strip_tags($this->input->get_post("name")))));
        $id = verify_id($this->input->get_post("id"));
        $this->where = array('id' => $id);
        $this->load->library('tableupdate'); //导入数据库表自定义类
        if ($this->tableupdate->update('role', $data, $this->where)) {
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
