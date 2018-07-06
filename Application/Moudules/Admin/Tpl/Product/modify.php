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
	<div class="fb-title"><div><p><span>产品 &gt; 编辑 </span></p></div></div>
	<div class="fb-body">
		<form method='post' id="form" name="form"  action="{:U(MODULE_NAME.'/update')}" >
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
				<input type="hidden" name="id" value="{$res.id}">
				<tr>
					<th  width="200">名称</th> <td><textarea name="title" cols="80" rows="2" >{$res.title}</textarea></td>
				</tr>

				<tr>
					<th  width="200">类别</th>
					<td>
						<div align="left">

							<select name="category"  style="width:150px">
								<foreach name="category" item="vo">
								<optgroup label="{$vo.name_en} {$vo.name}">
									<foreach name="vo.sub" item="cat_sub">
									<if condition="cat_sub.id eq $res.category">
									<option value ="{$cat_sub.id}" selected >{$cat_sub.name}</option>
									<else/>
									<option value ="{$cat_sub.id}">{$cat_sub.name}</option>
									</if>
									</foreach>
								</optgroup>
								</foreach>
							</select>
						</div>
					</td>
				</tr>

				<tr>
					<th>简介</th>
					<td><textarea  name="intro" cols="80" rows="8" >{$res.intro}</textarea></td>
				</tr>

				<tr>
					<th>正文</th>
					<td><textarea  name="content"  >{$res.content}</textarea></td>
				</tr>

				<tr>
					<th  width="200">发布时间</th>
					<td><input class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" name="time"  value="{$res.time}" /></td>
				</tr>

				<tr>
					<th>上传图片:
                    	<div style="text-align:left; width:80px; margin:10px 0 0 120px; ">
                        	<input id="file_upload" name="imgs" type="file" />
                        </div>
                    </th>
					<td>
						<div id="uploaded">
							<div class="imgorder" id="img0">
								<img src="{$res.img}">
								<input type="hidden" id="imgval0" name="img" value="{$res.img}">
								<input type="button" value="取消" onclick="quxiao(0)">
							</div>
						</div>
                    <td>
				</tr>

				<tr>
					<th>状态</th>
					<td>
						上线<input type="radio"  name="status" value="1" <if condition="($res.status eq 1)" >checked</if> />
						下线<input type="radio"  name="status" value="0" <if condition="($res.status eq 0)" >checked</if> />
					</td>
				</tr>

				<tr class="act">
					<th>&nbsp;</th>
					<td>
						<input type="submit" class="submit_btn" value="确定" />&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{:U(MODULE_NAME.'/index')}" class="submit_btn">取消</a>
					</td>
				</tr>

			</table>
		</form>
	</div>
</div>
<!--<script type="text/javascript" src="__PUBLIC__/uploadify/swfobject.js"></script>-->
<script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css">


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
		'swf'      : '__PUBLIC__/uploadify/uploadify.swf',//所需要的flash文件
		'uploader': '/admin/public/uploadimg?action=product&width=220',
		//'buttonImg': '__PUBLIC__/uploadify/browseBtn.png',//替换上传钮扣
		'buttonText' :'选择图片',//通过文字替换钮扣上的文字
		'cancelImg': '__PUBLIC__/uploadify/uploadify-cancel.png',//单个取消上传的图片
		'script': '/admin/product/img_upload',//实现上传的程序
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

		if(res.status == 1)
		{
			var len = $('#uploaded imgorder').size();
			var html =	'<div class="imgorder" id="img'+len+'" >'+
								'<img src="'+res.imgname+'" />'+
							'<input type="hidden" id="imgval'+len+'" name="img" value="'+res.imgname+'" />'+
							'<input type="button" value="取消" onclick="quxiao('+len+')" />'+
						'</div>';
			$('#uploaded').html(html);
		}
		else if(res.status == 0)
		{

			alert('图片上传成功,但服务器处理出错, 错误原因: '+ res.error );
		}
	}

	//取消图片
	function quxiao(id)
	{
		var imgdata = $('#imgval'+id).val();
		$.ajax({
				url : '/admin/public/delimg',
				data : {'img':imgdata},
				dataType: 'json',
				success: function(res){
					if(res.status==1){
						$('#img'+id).html('');
					}else{
						alert(res.msg);
					}
				},
				error: function(){
					alert('图片删除出错');
				}
			});

	}


</script>
<include file="Public:footer" />