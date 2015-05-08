<div class="pageContent">
    <form method="post" action="<?php echo site_url("admin/user/do_edit") ?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone);">
        <div class="pageFormContent nowrap" layoutH="56">
            <input type="hidden" name="id"  value="<?php echo $info['id']; ?>">
            <dl>
                <dt>用 户 名：</dt>
                <dd><input name="name" type="text" size="30" value="<?php echo $info['name']; ?>"  class="required" /></dd>
            </dl>
            <dl>
                <dt>真实姓名：</dt>
                <dd><input name="realname" type="text" size="30" value="<?php echo $info['realname']; ?>"  class="required" /></dd>
            </dl>
            <dl>
                <dt>角    色：</dt>
                <dd>
                    <select name="roleid" class="required combox">
                        <?php
                        foreach ($rolelist as $role) {
                            $selected = '';
                            if ($role['id'] == $info['roleid']) {
                                $selected = 'selected';
                            }
                            echo "<option value='{$role['id']}' {$selected}>{$role['name']}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>

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
