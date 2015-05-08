<style>
    .tdf{
        font:normal bold 12px/20px arial,sans-serif;
    }
</style>
<div class="pageContent">

    <table class="table" layoutH="118" targetType="dialog" width="100%">
        <thead>
            <tr>
                <th width="120" orderfield="name">功能名称</th>
                <th width="120" orderfield="dateline">创建时间</th>
                <th width="120" orderfield="authority">权限</th>
                <th width="40" orderfield="weight">权重</th>
                <th width="80" orderfield="path">组别</th>
                <th width="120" orderfield="methods">访问地址</th>
                <th width="80">查找带回</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tdf">顶级</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btnSelect" href="javascript:$.bringBack({id:'0', name:'顶级',path:''})" title="查找带回">选择</a>
                </td>
            </tr>
            <?php foreach ($datalist as $val) { ?>
                <tr>
                    <td class="tdf"><?php echo $val['name']; ?></td>
                    <td><?php echo $val['dateline']; ?></td>
                    <td><?php echo $val['authority']; ?></td>
                    <td><?php echo $val['weight']; ?></td>
                    <td><?php echo $val['path']; ?></td>
                    <td><?php echo $val['methods']; ?></td>
                    <td>
                        <a class="btnSelect" href="javascript:$.bringBack({id:'<?php echo $val['id'] ?>', name:'<?php echo $val['name'] ?>',path:'<?php echo $val['path'] ?>'})" title="查找带回">选择</a>
                    </td>
                </tr>
                <?php
                if (isset($val['childs']) && $val['childs']) {
                    foreach ($val['childs'] as $child_key => $child_val) {
                        ?>
                        <tr target="funcid" rel="<?php echo $child_val['id']; ?>" >
                            <td><?php echo str_repeat("&nbsp;", 8); ?><?php echo $child_val['name']; ?></td>
                            <td><?php echo $child_val['dateline']; ?></td>
                            <td><?php echo $child_val['authority']; ?></td>
                            <td><?php echo $child_val['weight']; ?></td>
                            <td><?php echo $child_val['path']; ?></td>
                            <td><?php echo $child_val['methods']; ?></td>
                            <td>
                                <a class="btnSelect" href="javascript:$.bringBack({id:'<?php echo $child_val['id'] ?>', name:'<?php echo $child_val['name'] ?>',path:'<?php echo $val['path'] ?>'})" title="查找带回">选择</a>
                            </td>
                        </tr>
                        <?php
                        if (isset($child_val['childs']) && $child_val['childs']) {
                            foreach ($child_val['childs'] as $c_key => $c_val) {
                                ?>
                                <tr target="funcid" rel="<?php echo $c_val['id']; ?>" >
                                    <td><?php echo str_repeat("&nbsp;", 16); ?><?php echo $c_val['name']; ?></td>
                                    <td><?php echo $c_val['dateline']; ?></td>
                                    <td><?php echo $c_val['authority']; ?></td>
                                    <td><?php echo $c_val['weight']; ?></td>
                                    <td><?php echo $c_val['path']; ?></td>
                                    <td><?php echo $c_val['methods']; ?></td>
                                    <td>
                                        <a class="btnSelect" href="javascript:$.bringBack({id:'<?php echo $c_val['id'] ?>', name:'<?php echo $c_val['name'] ?>',path:'<?php echo $val['path'] ?>'})" title="查找带回">选择</a>
                                    </td>
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