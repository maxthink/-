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
        <div class="fb-title">
            <div><p><span>{$Think.const.MODULE_NAME} > {$Think.const.ACTION_NAME} </span></p></div>
        </div>
        <form method='post' id="form" name="form" action="<if condition="($Think.const.ACTION_NAME eq 'add')"> {:U(MODULE_NAME.'/save')}<else />{:U(MODULE_NAME.'/update')}</if>">
            <table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr <if condition="($Think.const.ACTION_NAME eq 'add')">style="display:none;"</if> >
                    <th width="200">编号</th>
                    <td><p>{$vo.id}</p></td>
                </tr>
                <tr>
				<th  width="200">广告文字标题</th>
                    <td><input type="text" name="title" value="{$vo.title}" class="long-input" /></td>
                </tr>
                <th  width="200">广告链接</th>
                    <td><input type="text" name="link" value="{$vo.link}" class="long-input" /></td>
                </tr>
                <tr>
					<th>上传图片:
                    	<div style="text-align:left; width:80px; margin:10px 0 0 120px; ">
                        	<input id="file_upload" name="img" type="file" />
                        </div>
                    </th>
					<td>
						<div id="uploaded"></div>
                    <td>
				</tr>
				
                <tr>
                    <th>是否显示</th>
                    <td>显示<input type="radio"  name="status" value="1" <if condition="($vo.is_show eq 1)"> checked</if>/>不显示<input type="radio"  name="status" value="0" <if condition="($vo.is_show eq 0)"> checked</if>/></td>
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
		'uploader': '/admin/public/uploadimg?action=advert&width=150',
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