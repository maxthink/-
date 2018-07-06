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
                var editor1 = K.create('textarea[name="intro"]', {
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
	<div class="fb-title"><div><p><span>商家 > 添加 </span></p></div></div>
		<div class="fb-body">
			<form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/add')}">
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
				
				<tr>
					<th  width="200">商家名</th>
					<td><input type="text"  name="name"  value="" /></td>
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
					<th>logo:
                    	<div style="text-align:left; width:80px; margin:10px 0 0 120px; ">
                        	<input id="file_upload" name="logo" type="file" />
                        </div>
                    </th>
					<td>
						<div id="uploaded"></div>
                    <td>
				</tr>
				<tr>
					<th>图片:
                    	<div style="text-align:left; width:80px; margin:10px 0 0 120px; ">
                        	<input id="file_upload2" name="pic" type="file" />
                        </div>
                    </th>
					<td>
						<div id="uploaded2"></div>
                    <td>
				</tr>
				<tr>
					<th>简介</th>
					<td><textarea  name="intro" id="intro" cols="50" rows="10" style="width:700px;height:200px;visibility:hidden;"></textarea></td>
				</tr>
				<tr>
					<th  width="200">地址</th>
					<td><input type="text"  name="address"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">联系人</th>
					<td><input type="text"  name="connecter"  value="" /></td>
				</tr>
				<tr>
					<th width="200">座机号 </th>
					<td><input type="text"  name="tel"  value="" style="width:400px;" /><br />(多个号码用英文逗号隔开, 不会的可以复制: , )</td>
					<!--td><input type="text"  name="tel"  value="" style="width:400px;" /><input id="addnum" value=" +添加" class="submit_btn" /></td-->
				</tr>
				<tr>
					<th  width="200">手机</th>
					<td><input type="text"  name="phone"  value="" style="width:400px;" /><br />(多个号码用英文逗号隔开, 不会的可以复制: , )</td>
				</tr>
				<tr>
					<th>地理位置:</th>
					<td>
						<!--p>坐标:<input type="text"  name="zb"  value="{$vo.zb}" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://api.map.baidu.com/lbsapi/getpoint/" target="_blank" >坐标获取地址</a></p><br/-->
						<p><a href="http://api.map.baidu.com/lbsapi/getpoint/" target="_blank" >坐标获取地址</a></p><br/>

						<p>横坐标:<input type="text"  name="hzb"  value="{$vo.hzb}" /></p><br/>
						<p>纵坐标:<input type="text"  name="zzb"  value="{$vo.zzb}" /></p><br/>

                    <td>
				</tr>
				
				<tr>
					<th  width="200">发布时间</th>
					<td><input class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" name="create_time"  value="" /></td>
				</tr>
				<tr>
					<th  width="200">浏览次数</th>
					<td><input type="text"  name="num"  value="" /></td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
					上线<input type="radio"  name="status" value="1" checked>
					下线<input type="radio"  name="status" value="0"  ></td>
				</tr>
				<tr>
					<th>是否推荐</th>
					<td>
					是<input type="radio"  name="recommend" value="1" >
					否<input type="radio"  name="recommend" value="0" checked ></td>
				</tr>
				<tr>
					<th  width="200">竞价金额</th>
					<td><input type="text"  name="price"  value="{$vo.price}" /></td>
				</tr>
				<tr class="act">
					<th>&nbsp;</th>
					<td>
						<input type="hidden" name="subflag" value="1" />
						<input type="submit" class="submit_btn" value="确定" />&nbsp;
						<a href="{:U(MODULE_NAME/'index')}" class="a_btn" >取消</a>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css">
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
		'uploader': '/admin/public/uploadimg?action={$Think.const.MODULE_NAME}&width=200',
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

	$("#file_upload2").uploadify({
		'swf'      : '__PUBLIC__/uploadify/uploadify.swf',//所需要的flash文件
		'uploader': '/admin/public/uploadimg?action={$Think.const.MODULE_NAME}&width=640',
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
				getResult2(res);
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
							'<input type="hidden" id="imgval'+len+'" name="logo" value="'+res.imgname+'" />'+
						'</div>';
			$('#uploaded').html(html);
		}
		else if(res.status == 0)
		{

			alert('图片上传成功,但服务器处理出错, 错误原因: '+ res.error );
		}
	}
	//图片上传成功, 处理结果
	function getResult2(res){

		if(res.status == 1)
		{
			var len = $('#uploaded2 imgorder').size();
			var html =	'<div class="imgorder" id="img'+len+'" >'+
								'<img src="'+res.imgname+'" />'+
							'<input type="hidden" id="imgval'+len+'" name="pic" value="'+res.imgname+'" />'+
						'</div>';
			$('#uploaded2').append(html);
		}
		else if(res.status == 0)
		{

			alert('图片上传成功,但服务器处理出错, 错误原因: '+ res.error );
		}
	}

	
</script>
<include file="Public:footer" />