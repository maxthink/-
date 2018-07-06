{// 引入标签库 }
<tagLib name="html" />
{// 加载头部公共文件 }
<include file="Public:header" />

<script type="text/javascript">
<!--
//指定当前组模块URL


var URL = '__ACTION__';
var ROOT_PATH = '';
var APP	 =	 '/index.php';
var STATIC = '/admin/Tpl/Default/Static';
var VAR_MODULE = 'm';
var VAR_ACTION = 'a';
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

<!--<link rel="stylesheet" href="__PUBLIC__/admin/style/kindeditor/default.css" />
<link rel="stylesheet" href="__PUBLIC__/admin/style/kindeditor/prettify.css" />-->

<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/zh_CN.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/prettify.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/wdatepicker/WdatePicker.js"></script>
<script type="text/javascript" >
        KindEditor.ready(function(K) {
                var editor1 = K.create('textarea[name="content"]', {
                        cssPath : '__PUBLIC__/admin/style/kindedit/prettify.css',
                        uploadJson : '__PUBLIC__/kindeditor/upload_json.php',
                        fileManagerJson : '__PUBLIC__/kindeditor/file_manager_json.php',
                        allowFileManager : true,
                        afterCreate : function() {
                                var self = this;
                                K.ctrl(document, 13, function() {
                                        self.sync();
                                        K('form[name=form1]')[0].submit();
                                });
                                K.ctrl(self.edit.doc, 13, function() {
                                        self.sync();
                                        K('form[name=form1]')[0].submit();
                                });
                        }
                });
                prettyPrint();
        });
</script>
</head>
<div class="cw-body">
	<div class="fb-title"><div><p><span>菜单 > 添加 </span></p></div></div>
		<div class="fb-body">
			<form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/add')}">
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
				<tr>
					<th  width="200">名称</th>
					<td><input type="text"  name="name"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">上级</th>
					<td>
						<select id="role_id" name="pvalues" onchange="" ondblclick="" class="">
							<option selected="selected" value="0-null">顶级</option>
							<foreach name='list' item='v' key='k'>
								<option value="{$v.id}-{$v.level}">{$v.pname}—{$v.name}</option>
							</foreach>
						</select>
					</td>
				</tr>
				<tr>
					<th  width="200">排序</th>
					<td><input type="text"  name="order"  value="" /></td>
				</tr>
				
				<tr>
					<th  width="200">文件</th>
					<td><input type="text"  name="action"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">方法</th>
					<td><input type="text"  name="option"  value="" /></td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
					上线<input type="radio"  name="status" value="1" >
					下线<input type="radio"  name="status" value="0" checked ></td>
				</tr>
				<tr class="act">
					<th>&nbsp;</th>
					<td>
						<input type="hidden" name="subflag" value="1" />
						<input type="submit" class="submit_btn" value="确定" />&nbsp;
						<a href="{:U(MODULE_NAME/'index')}" class="submit_btn" >取消</a>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<include file="Public:footer" />