<div class="pageContent">
    <form method="post" action="<?php echo site_url('admin/user/do_add') ?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone);">
        <input type="hidden" name="verify_string" value="<?php echo $verify_string ?>" />
        <div class="pageFormContent nowrap" layoutH="56">
            <dl>
                <dt>用 户 名：</dt>
                <dd><input name="name" type="text" size="30" value=""  class="required" alt="请输入用户名" /></dd>
            </dl>
            <dl>
                <dt>密    码：</dt>
                <dd><input name="pwd" class="required" type="password" size="30"  minlength="6" maxlength="20" value="" alt="字母、数字、下划线 6-20位" />
                    <span class="info">字母、数字、下划线 6-20位</span>    
                </dd>
            </dl>
            <dl>
                <dt>真实姓名：</dt>
                <dd><input name="realname" type="text" size="30" value=""  class="required" alt="" /></dd>
            </dl>
            <dl>
                <dt>角    色：</dt>
                <dd>
                    <select name="roleid" class="required combox">
                        <option value="">请选择</option>
                        <?php
                        foreach ($rolelist as $role) {
                            echo "<option value='{$role['id']}'>{$role['name']}</option>";
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
