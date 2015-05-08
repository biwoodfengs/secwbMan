<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php header("content-type:text/html;charset=utf-8"); ?>
        <title>后台管理</title>
        <title>后台管理</title>

        <link href="<?php echo base_url(); ?>dwz/themes/default/style.css?ver=4" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
        <link href="<?php echo base_url(); ?>dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>

        <script src="<?php echo base_url(); ?>dwz/js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/jquery.bgiframe.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>


        <script src="<?php echo base_url(); ?>dwz/js/dwz.core.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.util.date.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.validate.method.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.barDrag.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.drag.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.tree.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.accordion.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.ui.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.theme.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.switchEnv.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.alertMsg.js?var=1" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.contextmenu.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.navTab.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.tab.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.resize.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.dialog.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.dialogDrag.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.sortDrag.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.cssTable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.stable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.taskBar.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.ajax.js?ver=2" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.pagination.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.database.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.datepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.effects.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.panel.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.checkbox.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.history.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.combox.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/dwz.print.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>dwz/js/jquery.form.js" type="text/javascript"></script>
		
		<!-- 地图相关开始-->
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=0RpplW4vHWank4qZG2G7T2vY"></script> 
		<script type="text/javascript" src="<?php echo base_url(); ?>dwz/bin/LuShu_min.js"></script>	
		<!-- 地图相关结束-->

        <!-- 可以用dwz.min.js替换前面全部dwz.*.js (注意：替换是下面dwz.regional.zh.js还需要引入)
        <script src="bin/dwz.min.js" type="text/javascript"></script>
        -->
        <script src="<?php echo base_url(); ?>dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function(){
                DWZ.init("<?php echo base_url(); ?>dwz/dwz.frag.xml", {
                    //loginUrl:"login", loginTitle:"登录",	// 弹出登录对话框
                    loginUrl:"<?php echo site_url(); ?>/admin/login",	// 跳到登录页面
                    statusCode:{ok:200, error:300, timeout:301}, //【可选】
                    pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
                    debug:false,	// 调试模式 【true|false】
                    callback:function(){
                        initEnv();
                    }
                });
            });

        </script>
    </head>

    <body scroll="no">
        <div id="layout">
            <div id="header">
                <div class="headerNav">
                    <a class="logo" href="">标志</a>
                    <ul class="nav">
                        <li><a href="javascript:void()">您好，<?php echo $username; ?></a></li>
                        <!--<li><a href="javascript:void()">绑定邮箱</a></li>-->
                        <li><a href="<?php echo site_url('user/user/show_changeuserpwd'); ?>" target="dialog" width="600">设置</a></li>				
                        <li><a href="<?php echo site_url('admin/login/logout'); ?>">退出</a></li>
                    </ul>
                </div>
                <!-- navMenu -->	
            </div>