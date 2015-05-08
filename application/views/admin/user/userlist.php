<form id="pagerForm" method="post" action="<?php echo site_url("admin/user/userlist") ?>">
    <input type="hidden" name="pageNum" value="<?php echo $total_data; ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $per_page_num; ?>" />
</form>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo site_url('admin/user/add') ?>" target="navTab" ><span>添加</span></a></li>
            <li><a class="delete" href="<?php echo site_url('admin/user/del/{userid}') ?>" target="ajaxTodo"  title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="<?php echo site_url('admin/user/edit/{userid}') ?>" target="navTab"><span>修改</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="75">
        <thead>
            <tr>
                <th width="80">编号</th>
                <th width="80">用户名</th>
                <th width="80">真实姓名</th>
                <th width="140">创建时间</th>
                <th width="140">最后登陆时间</th>
                <th width="120">最后登录ip</th>
                <th width="120" align="center">角色</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datalist as $val) { ?>
                <tr target="userid" rel="<?php echo $val['id']; ?>">
                    <td><?php echo $val['id']; ?></td>
                    <td><?php echo $val['name']; ?></td>
                    <td><?php echo $val['realname']; ?></td>
                    <td><?php echo $val['dateline']; ?></td>
                    <td><?php echo $val['lasttime']; ?></td>
                    <td><?php echo $val['lastip']; ?></td>
                    <td><?php echo $val['roleid']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
<!--            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>-->
            <span>共<?php echo $total_data; ?>条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo $total_page; ?>" numPerPage="<?php echo $per_page_num; ?>" pageNumShown="10" currentPage="<?php echo $curr_page; ?>"></div>
    </div>
</div>
