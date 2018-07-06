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
		<div class="fb-title"><div><p><span>类别 > 管理 </span></p></div></div>
		<div class="fb-body">
			<table class="body-table" cellpadding="0" cellspacing="1" border="0">
				<tr>
					<td class="body-table-td">
						<div class="body-table-div">
							<!--script type="text/javascript" src="/Public/admin/js/dataList.js"></script-->
							<div class="handle-btns">
								<!-- <div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="全选" onclick="CheckAll()" class="addAdmin"></p></div> -->
								<div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
								<div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this,'checkList','id')" class="editAdmin"></p></div>
								<div class="img-button "><p><input type="button" id="removeAdmin" name="removeAdmin" value="删除" onclick="removeData(this,'checkList')" class="removeAdmin"></p></div>
								
							</div>
							<div style='padding-left:50px; padding-top:50px;'>
								
								<div class='clear'></div>
								<ul id="tree"><li id="0"><span data-id="0" >网站<span></li></ul>
							</div>
							
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div class="modify_form" id="modify_form" >
		<div id="move_tag"></div>
		<form id="form1" name="form1" >
			<table>
			<input type="hidden" name="id" id="id" />
			<input type="hidden" name="p_id" id="p_id" />
			<input type="hidden" name="option" id="option" />
			<tr><td>名称:</td><td><input name="name" id="name" /></td></tr>
                        <tr><td>类别:</td><td>类型 <input type="radio" name="type" id="type_1" value="1" /> 文章 <input type="radio" name="type" id="type_2" value="2" /></td></tr>
			<tr><td>状态:</td><td>可用 <input type="radio" name="status" id="status_1" value="1" /> 不可用 <input type="radio" name="status" id="status_0" value="0" /></td></tr>
			<tr><td>排序:</td><td><input type="text" name="order" id="show_1" /></td>
			<tr><td></td><td><input type="button" id="ok" value="编辑" ></td></tr>
			</table>
		</form>
	</div>

<style>
	.title li {float:left; margin-right:30px; size:16px; font-weight:bold; margin-bottom: 15px; }
	#tree ul{ padding-left:50px; padding-top:5px; border-left:#ccc thin dashed;  }
	#tree span{ cursor:pointer; }
	.true{ color:#111; }
	.false{ color:#aaa; }
	#move_tag{ width:100%; height:20px; border-bottom:1px solid; background: #ccc; }
	#form1{ padding:10px;}
	.modify_form{ display:none; position:absolute; left:50%;top:50%; z-index:1000; border:1px solid; }
	.modify_form p{padding-bottom: 5px; }
</style>
<script type="text/javascript" >
	
	//菜单树状处理, 不放开的字体为淡
	var tree = eval('({$list})');
	$.each(tree,function(key,val){
		if($('#tree_'+val.p_id).length ===0 ){
			$('#'+val.p_id).append('<ul id="tree_'+val.p_id+'"></ul>');
		}
		if(val.status==='1'){
			$('#tree_'+val.p_id).append('<li id="'+val.id+'"><span class="true" data-id='+val.id+' >'+val.name+'</span></li>');
		}else{
			$('#tree_'+val.p_id).append('<li id="'+val.id+'"><span class="false" data-id='+val.id+' >'+val.name+'</span></li>');
		}
	});
	
	//隐藏显示树表, 节点单击处理
	$(function(){
		$('#tree ul').hide();	
		$('#tree span').bind('click',function(){
			$('#tree span').css('background-color','#fff');
			$(this).css('background-color','#ccc');
			$('#id').val($(this).attr('data-id'));
			$('#p_id').val($(this).parent().parent().siblings('span').attr('data-id'));
			$(this).siblings('ul').toggle(300);
                        $('#tree span').bind('dbclick',editData());
		});
		$("#0").children('ul').show();
	});
	

function addData(){
	document.form1.reset();
	$('#ok').val('添加');
	$('#option').val('add');
	$(".modify_form").show();
	var id = $("#id").val();
	$.ajax({
		url: '/'+CURR_GROUP+'/'+CURR_MODULE+'/modify',
		data:{'id':id},
		dataType: 'json',
		success: function(res){
			if(res.status==1){
				$("#p_id").val(res.data.id);
				$("#name").val(res.data.name);
				$("#order").val(res.data.order);
			}
		}
	});
}

//数据修改
function editData(){
	document.form1.reset();
	$('#ok').val('修改');
	$('#option').val('edit');
	$(".modify_form").show();
	var id = $("#id").val();
	$.ajax({
		url: '/'+CURR_GROUP+'/'+CURR_MODULE+'/modify',
		data:{'id':id},
		dataType: 'json',
		success: function(res){
			if( parseInt(res.status)===1 ){
				$("#name").val(res.data.name);
				$("#order").val(res.data.order);
                                $("#type_"+res.data.type).attr("checked",true);
				$("#status_"+res.data.status).attr("checked",true);
			}else{
				alert(data.msg);
			}
		}
	});
}

$('#ok').click(function(){
	
	$.ajax({
		Type: 'POST',
		url: '/'+CURR_GROUP+'/'+CURR_MODULE+'/modify',
		data: $("#form1").serialize(),
		dataType: 'json',
		success: function(data){
			if(data.status==1){
				location.href = location.href;
			}
		}
	});
	
});

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


//鼠标移动
$("#move_tag").mousedown(function(){   
	var offset=$("#modify_form").offset();
	x1=event.clientX-offset.left;   
	y1=event.clientY-offset.top;
	$("#move_tag").bind("mousemove",function(){   
		$("#modify_form").css("left",(event.clientX-x1)+"px");   
		$("#modify_form").css("top",(event.clientY-y1-2)+"px");   
	});   
	$("#move_tag").mouseup(function(){
		$("#move_tag").unbind("mousemove");   
	});
});

</script>
</body>
</html>