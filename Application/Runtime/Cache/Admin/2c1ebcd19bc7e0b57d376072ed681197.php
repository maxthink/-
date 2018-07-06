<?php if (!defined('THINK_PATH')) exit();?>

<html>
<head>
<meta charset="utf-8">
<title></title>
<link href="__PUBLIC__/admin/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/Base.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/CheckForm.js"></script>

<script type="text/javascript">
<!--
//指定当前组模块URL地址
var URL = '__ACTION__';
var ROOT_PATH = '';
var APP	 =	 '/index.php';
var STATIC = '/admin/Tpl/Default/Static';
var VAR_MODULE = 'm';
var VAR_ACTION = 'a';
var CURR_GROUP = '<?php echo (GROUP_NAME); ?>';
var CURR_MODULE = '<?php echo (MODULE_NAME); ?>';
var CURR_ACTION = '<?php echo (ACTION_NAME); ?>';

//定义JS中使用的语言变量
var CONFIRM_DELETE = '你确定要删除选择项吗？';
var AJAX_LOADING = '提交请求中，请稍候...';
var AJAX_ERROR = 'AJAX请求发生错误！';
var ALREADY_REMOVE = '已删除';
var SEARCH_LOADING = '搜索中...';
var CLICK_EDIT_CONTENT = '点击修改内容';
//-->
</script>
</head>
<body>
	<div class="cw-body">
		<div class="fb-title"><div><p><span>产品 > 列表 </span></p></div></div>
		<div class="fb-body">
			<table class="body-table" cellpadding="0" cellspacing="1" border="0">
				<tr>
					<td class="body-table-td">
						<div class="body-table-div">
							<script type="text/javascript" src="/admin/Tpl/Default/Static/Js/dataList.js"></script>
							<div class="handle-btns">
								<div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
								<div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this,'checkList','uid')" class="editAdmin"></p></div>
								
							</div>
							<!-- Think 系统列表组件开始 -->
<table id="checkList" class="table-list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="6" class="topTd" ></td></tr><tr class="row" ><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="../Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('title','<?php echo ($sort); ?>','index')" title="按照名称<?php echo ($sortType); ?> ">名称<?php if(($order) == "title"): ?><img src="../Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('intro','<?php echo ($sort); ?>','index')" title="按照简介<?php echo ($sortType); ?> ">简介<?php if(($order) == "intro"): ?><img src="../Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('time','<?php echo ($sort); ?>','index')" title="按照时间<?php echo ($sortType); ?> ">时间<?php if(($order) == "time"): ?><img src="../Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('status','<?php echo ($sort); ?>','index')" title="按照状态<?php echo ($sortType); ?> ">状态<?php if(($order) == "status"): ?><img src="../Public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr class="row" ><td><?php echo ($user["id"]); ?></td><td><a href="javascript:editData('<?php echo (addslashes($user["id"])); ?>')"><?php echo ($user["title"]); ?></a></td><td><?php echo ($user["intro"]); ?></td><td><?php echo ($user["time"]); ?></td><td><?php echo (getstatus($user["status"])); ?></td><td><a href="javascript:editData('<?php echo ($user["id"]); ?>')">编辑</a>&nbsp;<a href="javascript:showData('<?php echo ($user["id"]); ?>')">详情</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="6" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->

							<div class="pager"><?php echo ($page); ?></div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="ajax-loading"></div>
</body>
<script type="text/javascript">
jQuery(function($){
	updateBodyDivHeight();
	$(window).resize(function(){
		updateBodyDivHeight();
	});
});

function updateBodyDivHeight()
{
	jQuery(".body-table-div").height(jQuery(".cw-body").height() - 36);
	if(jQuery(".body-table-div").get(0).scrollHeight > jQuery(".body-table-div").height())
	{
		var width = jQuery(".body-table-div").width() - 16;
		jQuery(".body-table-div > *").each(function(){
			if(!$(this).hasClass('ajax-loading'))
			{
				$(this).width(width)
			}
		});
	}
}
</script>
</html>