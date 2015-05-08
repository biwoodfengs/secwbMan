
<div class="pageContent">

    <form method="post" action="<?php echo base_url() . index_page() ?>/my/do_changepwd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="58">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="unit">
                <label>旧密码：</label>
                <input type="password" name="oldPassword" size="30" minlength="6" maxlength="20" class="required" value=""/>
            </div>
            <div class="unit">
                <label>新密码：</label>
                <input type="password" id="cp_newPassword" name="newPassword" size="30" minlength="6" maxlength="20" class="required alphanumeric"/>
            </div>
            <div class="unit">
                <label>重复输入新密码：</label>
                <input type="password" name="rnewPassword" size="30" equalTo="#cp_newPassword" class="required alphanumeric"/>
            </div>

        </div>
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>

</div>
