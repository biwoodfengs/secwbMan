<div class="pageContent">
    <form method="post" action="<?php echo site_url('admin/func/do_add') ?>" class="pageForm required-validate" onsubmit="return validateCallback(this);">
        <div class="pageFormContent nowrap" layoutH="56">
            <dl>
                <dt>上级：</dt>
                <dd>

                    <input type="hidden" name="orgLookup.id" value="${orgLookup.id}"/>
                    <input name="orgLookup.name" type="text" size="30" value=""  class="required"  />
<!--                    <input type="text" class="required" name="orgLookup.orgName" value="" suggestFields="orgNum,orgName" suggestUrl="demo/database/db_lookupSuggest.html" lookupGroup="orgLookup" />-->
                    <a class="btnLook" href="<?php echo site_url('admin/func/funclist/lookup') ?>" lookupGroup="orgLookup">查找带回</a>	
                </dd>
            </dl>
            <dl>
                <dt>功能名称：</dt>
                <dd><input name="name" type="text" size="30" value=""  class="required" alt="请输入功能名称" /></dd>
            </dl>
            <dl>
                <dt>组别：</dt>
                <dd>
                    <input type="text" name="orgLookup.path" value="" class="required" alt=""/>&nbsp;&nbsp;角色分组
                </dd>
            </dl>
            <dl>
                <dt>权  重：</dt>
                <dd>
                    <input type="text" name="weight" value="" min="1" max="255" class="digits"/>&nbsp;&nbsp;越小越在前面显示
                </dd>
            </dl>
            <dl>
                <dt>访问路径：</dt>
                <dd>
                    <input type="text" name="methods" value=""  size="30" />&nbsp;&nbsp;如：admin/func/funclist
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
