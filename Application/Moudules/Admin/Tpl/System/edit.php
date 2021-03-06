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
	<div class="fb-title"><div><p><span>菜单 > 编辑</span></p></div></div>
		<div class="fb-body">
			<form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/update')}">
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr>
					<th width="200">编号</th>
					<td><p>{$vo.id}</p></td>
				</tr>
				<tr>
					<th  width="200">名字</th>
					<td><input type="text"  name="name"  value="{$vo.name}" /></td>
				</tr>
				<tr>
					<th  width="200">上级</th>
					<td>

						<select id="role_id" name="pvalues" onchange="" ondblclick="" class="">
							<option  value="0-null">顶级</option>					
							<volist name='list' id='v'>
								<option <if condition="($v[id] eq $vo[id])"> selected="selected"</if> value="{$v.id}-{$v.level}">{$v.pname}—{$v.name}</option>
							</volist>
						</select>
					</td>
				</tr>

				<tr>
					<th  width="200">文件</th>
					<td><input type="text"  name="action"  value="{$vo.action}" /></td>
				</tr>
				<tr>
					<th  width="200">方法</th>
					<td><input type="text"  name="option"  value="{$vo.option}" /></td>
				</tr>
				<tr>
					<th  width="200">排序</th>
					<td><input type="text"  name="order"  value="{$vo.order}" /></td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
					上线<input type="radio"  name="status" value="1" <if condition="($vo.status eq 1)"> checked</if>/>
					下线<input type="radio"  name="status" value="0" <if condition="($vo.status eq 0)"> checked</if>/></td>
				</tr>
				<tr class="act">
					<th>&nbsp;</th>
					<td>
                        <input type="hidden" name="id" value="{$vo.id}"/>
						<input type="submit" name="submit" class="submit_btn" value="确定" />
						<input type="submit" name="submit" class="submit_btn" value="取消" />
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

$(document).ready(function() {
	
	$("#file_upload").uploadify({
		'swf'      : '/Public/uploadify/uploadify.swf',
		'uploader': '/admin/partner/uploadimg',//所需要的flash文件
		//'buttonImg': '/Public/uploadify/browseBtn.png',//替换上传钮扣
		'buttonText' :'选择图片',//通过文字替换钮扣上的文字
		'cancelImg': '/Public/uploadify/uploadify-cancel.png',//单个取消上传的图片
		'script': '/admin/partner/uploadimg',//实现上传的程序
		'auto': true,//自动上传
		'multi': true,//是否多文件上传
		//'checkScript': 'js/check.php',//验证 ，服务端的
		'displayData': 'speed',//进度条的显示方式
		//'fileDesc': 'Image(*.jpg;*.gif;*.png)',//对话框的文件类型描述
		'fileExt': '*.jpg;*.jpeg;*.gif;*.png',//可上传的文件类型
		'sizeLimit': 1024000 ,//限制上传文件的大小
		//'simUploadLimit' :3, //并发上传数据 
		'queueSizeLimit' :30, //可上传的文件个数
		'width': 80,//buttonImg的大小
		'height': 24,//
		//'rollover': true,//button是否变换
		'onUploadSuccess'  : function(file, data, response) {
			
			if(response == true){
				var res = eval('(' + data + ')');
				getResult(res);
			}else{
				alert('文件上传出错');
			}
		},
		'onError': function(errorObj) {
			alert(errorObj.info+" "+errorObj.type);
		}
	});

});
	
	//图片上传成功, 处理结果
	function getResult(res){
		//alert('状态:'+res.status +' 图片名:'+ res.imgname);
		if(res.status == 1)
		{
			quxiao();
			var html =	'<img src="/Public/Uploads/product'+res.imgname+'" /><input type="hidden" id="imgval" name="logo" value="'+res.imgname+'" />';
			$('#uploaded').append(html);
		}
		else if(res.status == 0)
		{
			alert('图片上传成功,但服务器处理出错, 错误原因: '+ res.error );
		}
	}
	
	//取消图片
	function quxiao()
	{
		var imgdata = $('#imgval').val();
		$.ajax({
				url : '/admin/partner/delimg',
				data : {'img':imgdata},
				success: function(res){
					$('#uploaded').html('');
				},
				error: function(){
					alert('图片删除出错');
				}
			});
	}

</script>
<include file="Public:footer" />