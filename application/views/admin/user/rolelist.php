<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo site_url('admin/role/add') ?>" target="navTab" title="角色添加"><span>添加</span></a></li>
            <li><a class="delete" href="<?php echo site_url('admin/role/del/{roleid}') ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="<?php echo site_url('admin/role/edit/{roleid}') ?>" target="navTab"><span>修改/查看</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
            <tr>
                <th width="100">编号</th>
                <th width="200">角色名称</th>
                <th width="200">创建时间</th>
                <th width="400">备注</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($datalist)) {
                foreach ($datalist as $val) {
                    ?>
                    <tr target="roleid" rel="<?php echo $val['id']; ?>">
                        <td><?php echo $val['id']; ?></td>
                        <td><?php echo $val['name']; ?></td>
                        <td ><?php echo $val['dateline']; ?></td>
                        <td><?php echo $val['remarks']; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td>";
                echo "暂无数据!";
                echo "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
