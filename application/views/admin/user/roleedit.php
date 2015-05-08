<div class="pageContent">
    <form method="post" action="<?php echo site_url("admin/role/do_edit") ?>" class="pageForm required-validate" onsubmit="return validateCallback(this);">
        <div class="pageFormContent" layoutH="56">
            <input  type="hidden" name="id" value="<?php echo $info['id'] ?>">
            <label>角色名称:</label><input  type="text" name="name" value="<?php echo $info['name'] ?>">
            <table class="table" width="100%">
                <thead>
                    <tr>
                        <th>功能名称如下</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($datalist)) {
                        foreach ($datalist as $key => $val) {
                            $checked = "";
                            foreach ($have as $k => $h) {
                                if ($val['path'] == $k) {
                                    if (in_array($val['authority'], $h))
                                        $checked = "checked";
                                }
                            }
                            ?>
                            <tr>
                                <td>
                                    <span style="font-weight:bold"><?php echo $val['name'] ?></span><input type="checkbox" <?php echo $checked ?> name="<?php echo $val['path'] ?>_authority[]" value="<?php echo $val['authority'] ?>" >
                                </td>
                            </tr>
                            <?php
                            if (!empty($val['childs'])) {
                                foreach ($val['childs'] as $v) {
                                    $checked = "";
                                    foreach ($have as $k => $h) {
                                        if ($v['path'] == $k) {
                                            if (in_array($v['authority'], $h))
                                                $checked = "checked";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo str_repeat("&nbsp;", 8); ?><?php echo $v['name'] ?><input type="checkbox" <?php echo $checked ?> name="<?php echo $val['path'] ?>_authority[]" value="<?php echo $v['authority'] ?>" >
                                        </td>
                                    </tr>
                                    <?php
                                    if (!empty($v['childs'])) {
                                        foreach ($v['childs'] as $va) {
                                            $checked = "";
                                            foreach ($have as $k => $h) {
                                                if ($va['path'] == $k) {
                                                    if (in_array($va['authority'], $h))
                                                        $checked = "checked";
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo str_repeat("&nbsp;", 16); ?><?php echo $va['name'] ?><input type="checkbox" <?php echo $checked ?>  name="<?php echo $val['path'] ?>_authority[]" value="<?php echo $va['authority'] ?>" >
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="formBar">
            <ul>
                    <!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li>
                    <div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
                </li>
            </ul>
        </div>
    </form>
</div>
