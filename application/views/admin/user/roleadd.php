<div class="pageContent">
    <form method="post" action="<?php echo site_url('admin/role/do_add') ?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone);">
        <div class="pageFormContent nowrap" layoutH="56">
            <dl>
                <dt>角色名称：</dt>
                <dd><input name="name" type="text" size="30" value=""  class="required" alt="请输入角色名称" /></dd>
            </dl>
            <!--            <dl>
                            <dt>权    限：</dt>
                            <dd>
                                <input type="checkbox" class="checkboxCtrl" group="authority[]" />全选
                                <br />
                                <dl>
            <?php
//                        if (!empty($all_func_list)) {
//                            foreach ($all_func_list as $key => $val) {
//                                if (!empty($val['son'])) {
//                                    echo '<dl><h3><label><input type="checkbox" name="' . $val['path'] . '_authority[]" value="' . $val['authority'] . '" />' . $val['name'] . '</label><h3></dl>';
//                                    foreach ($val['son'] as $v) {
//                                        if (!empty($v['son'])) {
//                                            echo '<dt><label><input type="checkbox" name="' . $val['path'] . '_authority[]" value="' . $v['authority'] . '" />' . $v['name'] . '</label></dt>';
//                                            foreach ($v['son'] as $va) {
//                                                echo '<label><input type="checkbox" name="' . $val['path'] . '_authority[]" value="' . $va['authority'] . '" />' . $va['name'] . '</label>';
//                                            }
//                                        }
//                                    }
//                                }
//                            }
//                        }
            ?>
                                </dl>           
                            </dd>
            
                        </dl>-->

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
