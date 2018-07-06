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
<div class="cw-body">
	
		<div class="fb-body">
			<form method='post' id="form" name="form" action="<if condition="($type eq 'add')"> {:U(MODULE_NAME.'/add')}<else />{:U(MODULE_NAME.'/update')}</if>">
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                            <tr <if condition="($type eq 'add')">style="display:none;"</if> >
					<th width="200">编号</th>
					<td><p>{$vo.id}</p></td>
				</tr>
				<tr>
					<th  width="200">名称</th>
					<td><input type="text"  name="title" value="{$vo.title}" /></td>
				</tr>
                                <tr>
					<th  width="200">英文名称</th>
					<td><input type="text"  name="title_en" value="{$vo.title_en}" /></td>
				</tr>
                                <tr>
					<th  width="200">格式</th>
					<td><input type="text"  name="form" value="{$vo.form}" /></td>
				</tr>
                                <tr>
					<th  width="200">时间长度</th>
					<td><input type="text"  name="time_length" value="{$vo.time_length}" /></td>
				</tr>
                                <tr>
					<th  width="200">集数</th>
					<td><input type="text"  name="set_number" value="{$vo.set_number}" /></td>
				</tr>
                                <tr>
					<th  width="200">类别</th>
					<td><input type="text"  name="category_id" value="{$vo.title}" /></td>
				</tr>
                                <tr>
					<th  width="200">出品</th>
					<td><input type="text"  name="produce" value="{$vo.produce}" /></td>
				</tr>
                                <tr>
					<th  width="200">合作伙伴</th>
					<td><input type="text"  name="partner_id" value="{$vo.partner_id}" /></td>
				</tr>
				<tr>
					<th>简介</th>
					<td><textarea  name="intro" cols="50" rows="10" >{$vo.intro}</textarea></td>
				</tr>
				
				<tr>
					<th>状态</th>
					<td>上线<input type="radio"  name="status" value="1" <if condition="($vo.status eq 1)"> checked</if>/>下线<input type="radio"  name="status" value="0" <if condition="($vo.status eq 0)"> checked</if>/></td>
				</tr>
				<tr class="act">
					<th>&nbsp;</th>
					<td>
                                                <input type="hidden" name="id" value="{$vo.id}"/>
                                                <input type="hidden" name="subflag" value="1"/>
						<input type="submit" class="submit_btn" value="确定" />
						<input type="submit" class="submit_btn" value="取消" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
jQuery(function($){
	$("#form").submit(function(){
		if($.checkRequire($("#admin_pwd").val()))
		{
			if($("#admin_pwd").val() != $("#confirm_pwd").val())
			{
				alert(CONFIRM_ERROR);
				return false;
			}
		}
	});
});
</script>
<include file="Public:footer" />