<div class="pageContent">
    <form method="post" action="<?php echo site_url('admin/func/do_edit') ?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone);">
        <div class="pageFormContent nowrap" layoutH="56">
            <input name="id" type="hidden" value="<?php echo $funcinfo['id'] ?>">
            <dl>
                <dt>上级：</dt>
                <dd>
                    <?php echo $pidname ?>
                </dd>
            </dl>
            <dl>
                <dt>功能名称：</dt>
                <dd><input name="name" type="text" size="30" value="<?php echo $funcinfo['name'] ?>"  class="required" alt="请输入功能名称" /></dd>
            </dl>
            <dl>
                <dt>组别：</dt>
                <dd>
                    <input type="text" disabled="disabled"  name="path" value="<?php echo $funcinfo['path'] ?>" class="required" alt=""/>&nbsp;&nbsp;角色分组
                </dd>
            </dl>
            <dl>
                <dt>权  重：</dt>
                <dd>
                    <input type="text"  name="weight" value="<?php echo $funcinfo['weight'] ?>" min="1" max="255" class="digits"/>&nbsp;&nbsp;越小越在前面显示
                </dd>
            </dl>
            <dl>
                <dt>访问路径：</dt>
                <dd>
                    <input type="text" name="methods" value="<?php echo $funcinfo['methods'] ?>" size="30"/>&nbsp;&nbsp;如：admin/func/funclist
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
