{// 引入标签库 }
<tagLib name="html" />
{// 加载头部公共文件 }
<include file="Public:header" />

<script type="text/javascript">
<!--
//指定当前组模块URL地址 
var URL = '__ACTION__';
var ROOT_PATH = '';
var APP	 =	 '/index.php';
var STATIC = '/admin/Tpl/Default/Static';
var VAR_MODULE = 'm';
var VAR_ACTION = 'a';
var CURR_GROUP = '{$Think.const.GROUP_NAME}';
var CURR_MODULE = '{$Think.const.MODULE_NAME}';
var CURR_ACTION = '{$Think.const.ACTION_NAME}';

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
		<div class="fb-title"><div><p><span>管理员 > 列表 </span></p></div></div>
		<div class="fb-body">
			<table class="body-table" cellpadding="0" cellspacing="1" border="0">
				<tr>
					<td class="body-table-td">
						<div class="body-table-div">
							<script type="text/javascript" src="/Public/admin/js/dataList.js"></script>
							<div class="handle-btns">
								<!-- <div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="全选" onclick="CheckAll()" class="addAdmin"></p></div> -->
								<div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
								<div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this,'checkList','id')" class="editAdmin"></p></div>
								<div class="img-button "><p><input type="button" id="removeAdmin" name="removeAdmin" value="删除" onclick="removeData(this,'checkList')" class="removeAdmin"></p></div>
								<form action="/admin/index.php">
									<span>标题</span>
									<input class="textinput" type="text" value="" name="user_name" size="10" />
									<input class="submit_btn" type="submit" value="搜索" />
									<input type="hidden" name="m" value="User" />
									<input type="hidden" name="a" value="index" />
								</form>
							</div>
							<html:list
							id="checkList"
							name="user"
							style="table-list"
							action="true"
							datasource="list"
							show="id:编号,account:用户名,group:权限组,phone:电话,email:邮箱,status|getStatus:状态" 
							actionlist="editData:编辑,showData:详情,deleteData:删除:id" />
							<div class="pager">{$page}</div>
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

function showData(obj,id,pk)
{
	var fun = function(){
		var url = "{:U('News/show',array('id'=>'111111'))}";
		location.href = url.replace("111111",id);
	};
	
	setTimeout(fun,1);
}
function addData(){

	var fun = function(){
		var url = "{:U('News/add')}";
		location.href = url;
	};
	
	setTimeout(fun,1);
}
</script>
</html>