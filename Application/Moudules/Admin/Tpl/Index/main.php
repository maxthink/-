<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="__PUBLIC__/Admin/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
<!--
//指定当前组模块URL地址 
var URL = '/admin/index.php/Admin';
var ROOT_PATH = '';
var APP	 =	 '/admin/index.php';
var STATIC = '/admin/Tpl/Default/Static';
var VAR_MODULE = 'm';
var VAR_ACTION = 'a';
var CURR_MODULE = 'Admin';
var CURR_ACTION = 'index';

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
		<div class="fb-title"><div><p><span>管理员管理 > 管理员列表</span></p></div></div>
		<div class="fb-body">
			<table class="body-table" cellpadding="0" cellspacing="1" border="0">
				<tr>
					<td class="body-table-td">
						<div class="body-table-div">
							<div class="handle-btns">
								<div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
								<div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this,'checkList')" class="editAdmin"></p></div>
								<div class="img-button "><p><input type="button" id="removeAdmin" name="removeAdmin" value="删除" onclick="removeData(this,'checkList')" class="removeAdmin"></p></div>
							</div>
							<div class="search-box" style="position: relative; z-index: 1; width: 1208px;">
	
								<form action="/admin/index.php">

									<span>活动名称: </span>
									<input class="textinput" type="text" value="" name="title" id="title" size="8">
									<small></small>
									
									<span>活动类型: </span>
									<select name="type">
										<option value="">全部</option>
										<option value="0"></option><option value="1"></option>		</select>
									
									<input class="submit_btn" type="submit" value="搜索">
									<input type="hidden" name="m" value="Star">
									<input type="hidden" name="a" value="index">
								</form>
							</div>
<!-- Think 系统列表组件开始 -->
<table id="checkList" class="table-list list" cellpadding="0" cellspacing="0" border="0">
		<thead>
			<tr>
				<th width="30" class="first"><input type="checkbox" onclick="checkAll('checkList')"></th>
				<th width="50" ><a href="javascript:sortBy('id','1','index')" title="按照编号升序排列 ">编号<img src="/admin/Tpl/Default/Static/Images/desc.gif" align="absmiddle"></a></th>
				<th ><a href="javascript:sortBy('admin_name','1','index')" title="按照管理员帐号升序排列 ">管理员帐号</a></th>
				<th width="100" ><a href="javascript:sortBy('role_id','1','index')" title="按照所属权限组升序排列 ">所属权限组</a></th>
				<th width="140" ><a href="javascript:sortBy('last_login_time','1','index')" title="按照最后登录时间升序排列 ">最后登录时间</a></th>
				<th width="100" ><a href="javascript:sortBy('last_login_ip','1','index')" title="按照最后登录IP升序排列 ">最后登录IP</a></th>
				<th width="80" ><a href="javascript:sortBy('login_count','1','index')" title="按照登录次数升序排列 ">登录次数</a></th>
				<th width="140" ><a href="javascript:sortBy('create_time','1','index')" title="按照创建时间升序排列 ">创建时间</a></th><th width="140" ><a href="javascript:sortBy('update_time','1','index')" title="按照更新时间升序排列 ">更新时间</a></th>
				<th width="60" ><a href="javascript:sortBy('status','1','index')" title="按照状态升序排列 ">状态</a></th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<tr ="" class="">
				<td class="first"><input type="checkbox" name="key"	value="12"></td>
				<td >12</td>
				<td align="left" ><span class="pointer" module="Admin" href="javascript:;" onclick="textEdit(this,'12','admin_name')">wanmeinvhai</span></td><td >完美女孩</td>
				<td >2013-05-15 17:14:34</td>
				<td >119.57.36.6</td>
				<td >3</td>
				<td >2013-05-15 16:54:36</td>
				<td >2013-05-15 17:25:28</td>
				<td ><span class="pointer" module="Admin" href="javascript:;" onclick="toggleStatus(this,'12','status')"><img status="1" src="/admin/Tpl/Default/Static/Images/status-1.gif" /></span></td>
				<td><a href="javascript:;" onclick="editData(this,'12','id')">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="removeData(this,'12','id')">删除</a>&nbsp;&nbsp;</td>
			</tr>
			<tr ="" class="even">
				<td class="first"><input type="checkbox" name="key"	value="11"></td>
				<td >11</td>
				<td align="left" ><span class="pointer" module="Admin" href="javascript:;" onclick="textEdit(this,'11','admin_name')">评论</span></td>
				<td >评论管理</td>
				<td >2013-02-14 10:44:44</td>
				<td >58.68.226.148</td>
				<td >5</td>
				<td >2013-02-04 15:17:23</td>
				<td ></td>
				<td ><span class="pointer" module="Admin" href="javascript:;" onclick="toggleStatus(this,'11','status')"><img status="1" src="/admin/Tpl/Default/Static/Images/status-1.gif" /></span></td>
				<td><a href="javascript:;" onclick="editData(this,'11','id')">编辑</a>&nbsp;&nbsp;<a href="javascript:;" onclick="removeData(this,'11','id')">删除</a>&nbsp;&nbsp;</td>
			</tr>
		</tbody>
	</table>
<!-- Think 系统列表组件结束 -->

							<div class="pager"><strong>12</strong> 条记录&nbsp;│&nbsp;<strong>1</strong> / 1 页&nbsp;│&nbsp;</div>
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