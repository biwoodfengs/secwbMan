<div id="leftside" >
    <div id="sidebar_s" >
        <div class="collapse " >
            <div class="toggleCollapse"><div></div></div>
        </div>
    </div>
    <div id="sidebar" > <!-- 要与E:\wamp\www\ydr\dwz\themes\css\core.css中 #splitBar的left一致 #sidebar的width一致 -->
        <div class="toggleCollapse "><h2>菜单栏</h2><div>收缩</div></div>
		
		<!-- 搜索框开始-->
		<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="__URL__" method="post">
			<div class="searchBar">
				<ul class="searchContent">
					<li>
						设备名：<input type="text" name="account" value=""/>		
					</li>
				</ul>
				<div class="subBar">
						<ul>
							<li ><div class="buttonActive"><div class="buttonContent"><button type="submit">查询</button></div></div></li>
						</ul>
				</div>
				
			</div>
		</form>
		<!-- 搜索框结束-->
		
		<div class="tabs" currentIndex="0" eventType="click">
			<div class="tabsHeader">
				<div class="tabsHeaderContent">
					<ul>
						<li ><a href="javascript:;"><span>全部<?php echo "(13)"?></span></a></li>
						<li ><a href="javascript:;"><span>在线<?php echo "(8)" ?></span></a></li>
						<li ><a href="javascript:;"><span>离线 <?php echo "(5)" ?></span></a></li><!-- class="j-ajax" -->
					</ul>
				</div>
			</div>
			<div class="tabsContent" style="height:60%;">
				<div >
					<div class="accordionHeader">
						<h2><span></span>设备名</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree ">
							<?php foreach ($list->results as $value) { ?>
								<li><a href="javascript:" target="navTab" rel=<?php echo $value->password; ?> ><?php echo $value->did; ?></a></li>
							<?php } ?>
						</ul>
					</div>		
				</div>
				
				<div>	
				</div>
				
				<div>			
				</div>
			</div>
			
			<div class="tabsFooter">
				<div class="tabsFooterContent">
						
				</div>
			</div>
			
		</div>	
		<div class="panelBar">
			<div class="pages"><span></span></div>
			<div class="pagination" targetType="navTab" totalCount=100 numPerPage=10 pageNumShown=1 currentPage=1></div>
		</div>

    </div>
</div>