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
	<div class="fb-title"><div><p><span>信息 > 添加 </span></p></div></div>
		<div class="fb-body">
			<form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/add')}">
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
				
				<tr>
					<th  width="200">标题</th>
					<td><input type="text"  name="title"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">分类</th>
					<td>
						<select name="catid" width="155" style="width: 155px">
                            <volist name='type' id='v'>
                                <option value ="{$v.id}">{$v.name}</option>
                            </volist>
                        </select>
				</tr>
				<if condition="($group eq 1)">
				<tr>
					<th  width="200">地区</th>
					<td>
						<select name="province" id="province" onchange="getList (this.value,'city',1)">
						<option value="-1" selected="selected">请选择</option>
						</select> 

						<select name="city" id="city"  onchange="getList (this.value,'eare1',2)">
						<option value="-1" selected="selected">请选择</option>
						</select>

						<select name="aid" id="eare1">
						<option value="-1" selected="selected">请选择</option>
						</select>
					</td>
				</tr>
				</if>
				<tr>
					<th  width="200">联系人</th>
					<td><input type="text"  name="contact_user"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">手机</th>
					<td><input type="text"  name="mobile"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">固话</th>
					<td><input type="text"  name="phone"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">QQ</th>
					<td><input type="text"  name="qq"  value="" /></td>
				</tr>

				<tr>
					<th>内容</th>
					<td><textarea  name="content" id="content" cols="50" rows="10" style="width:700px;height:200px;visibility:hidden;"></textarea></td>
				</tr>
				<tr>
					<th  width="200">发布时间</th>
					<td><input class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" name="create_time"  value="" /></td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
					上线<input type="radio"  name="status" value="1" checked>
					下线<input type="radio"  name="status" value="0"  ></td>
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
<script type="text/javascript">
<!--
var ids = ['province','city','eare1']; //默认要操作的三个ID，注意先后顺序，不可颠倒。
// 参数说明:pid是关联 的id (第二个参数) 的父级,n表示是第几级,(如第一级，第二级，第三级),selected 默认被选中的选择的主键
function getList (pid,id,n,selected) {
	var list = document.getElementById(id);
	$.post ('/Admin/Public/getArea',{'pid':pid},function  (data) {
		var temp1 = eval('('+ data +')');    //把传过来的字符串转化成一个JSON对象。
		var leng = temp1.length;

		var  n = (n > ids.length ) ?  ids.length : n;
		n = (n < 0 ) ?  0 : n;
		for (var j = n ; j < ids.length ; j++)
		{
			var t = 'temp'+j
			t = document.getElementById(ids[j]);
			t.options.length = 1;
			t.options[0]=new Option('请选择',-1);    
		}

		if (leng > 0) {
			list.length = leng + 1;
			for (var i=0;i < temp1.length ;i++ )
			{
				list.options[i+1]=new Option(decodeURI(temp1[i].aName),temp1[i].id);
				if (temp1[i].id == selected ) {
					list.options[i+1].selected = 'selected';
				}
			}        
		}

	});
}

$(function () {
	getList ('0','province',1,0);
	//        getList (13,'city',2,190);
	//        getList (190,'eare1',2,1601);
	//三个都写是为了修改的时候，请三个框中默认的都有选中的值,一般增加的时候只写第一个就可以了。
});
//-->
</script>
<include file="Public:footer" />