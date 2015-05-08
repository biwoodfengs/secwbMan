<style>
    .tdf{
        font:normal bold 12px/20px arial,sans-serif;
    }
</style>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo site_url('admin/func/add') ?>" target="navTab"><span>添加</span></a></li>
            <li><a class="delete" href="<?php echo site_url('admin/func/del/{funcid}') ?>"  target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="<?php echo site_url('admin/func/edit/{funcid}') ?>" target="navTab"><span>修改</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
            <tr>
                <th width="30">编号</th>
                <th width="300">功能名称</th>
                <th width="100">创建时间</th>
                <th width="100">权限</th>
                <th width="40" align="center">权重</th>
                <th width="40" align="center">组别</th>
                <th width="100" align="center">访问地址</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datalist as $val) {
                ?>

                <tr target="funcid" rel="<?php echo $val['id']; ?>">
                    <td><?php echo $val['id']; ?></td>
                    <td class="tdf"><?php echo $val['name']; ?></td>
                    <td><?php echo $val['dateline']; ?></td>
                    <td><?php echo $val['authority']; ?></td>
                    <td><?php echo $val['weight']; ?></td>
                    <td><?php echo $val['path']; ?></td>
                    <td><?php echo $val['methods']; ?></td>
                </tr>
                <?php
                if (isset($val['childs']) && $val['childs']) {
                    foreach ($val['childs'] as $child_key => $child_val) {
                        ?>
                        <tr target="funcid" rel="<?php echo $child_val['id']; ?>" >
                            <td><?php echo $child_val['id']; ?></td>
                            <td><?php echo str_repeat("&nbsp;", 8); ?><?php echo $child_val['name']; ?></td>
                            <td><?php echo $child_val['dateline']; ?></td>
                            <td><?php echo $child_val['authority']; ?></td>
                            <td><?php echo $child_val['weight']; ?></td>
                            <td><?php echo $child_val['path']; ?></td>
                            <td><?php echo $child_val['methods']; ?></td>
                        </tr>
                        <?php
                        if (isset($child_val['childs']) && $child_val['childs']) {
                            foreach ($child_val['childs'] as $c_key => $c_val) {
                                ?>
                                <tr target="funcid" rel="<?php echo $c_val['id']; ?>" >
                                    <td><?php echo $c_val['id']; ?></td>
                                    <td><?php echo str_repeat("&nbsp;", 16); ?><?php echo $c_val['name']; ?></td>
                                    <td><?php echo $c_val['dateline']; ?></td>
                                    <td><?php echo $c_val['authority']; ?></td>
                                    <td><?php echo $c_val['weight']; ?></td>
                                    <td><?php echo $c_val['path']; ?></td>
                                    <td><?php echo $c_val['methods']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>

