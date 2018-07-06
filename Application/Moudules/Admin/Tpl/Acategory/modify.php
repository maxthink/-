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
	<div class="fb-title"><div><p><span>文章类别 > 编辑</span></p></div></div>
		<div class="fb-body">
			<form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/modify')}">
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr>
					<th width="200">编号</th>
					<td><p>{$vo.id}</p></td>
				</tr>

				<tr>
					<th  width="200">用户名</th>
					<td><input type="text"  name="username"  value="{$vo.username}" /></td>
				</tr>
                                <tr>
					<th  width="200">职业</th>
					<td><input type="text"  name="property"  value="{$vo.property}" /></td>
				</tr>

				<tr>
					<th  width="200">借款金额</th>
					<td><input type="text"  name="money"  value="{$vo.money}" />万</td>
				</tr>

				<tr>
					<th  width="200">借款目的</th>
					<td><input type="text"  name="for"  value="{$vo.for}" /></td>
				</tr>
				
                                <tr>
                                    <th  width="200">还款方式</th>
                                    <td>
                                        <select name="repayment" id="repayment">
                                            <option value="">-请选择-</option>
                                            <option <if condition="($vo.repayment eq '按月还息,到期还本')"> selected </if> value="按月还息,到期还本">按月还息,到期还本</option>
                                            <option <if condition="($vo.repayment eq '等额本金')"> selected </if> value="等额本金">等额本金</option>
                                            <option <if condition="($vo.repayment eq '等额本息')"> selected </if> value="等额本息">等额本息</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
					<th  width="200">愿付利息(年息)</th>
					<td><input type="text" name="interest" id="interest" value="{$vo.interest}" >%</td>
				</tr>
                                
				<tr>
					<th  width="200">借款期限</th>
					<td><input type="text"  name="deadline"  value="{$vo.deadline}" />个月</td>
				</tr>
                                
                                <tr>
                                    <th class="td_right">抵押物所在地 :</th>
                                    <td>&nbsp;&nbsp;&nbsp;
                                        省: <select name="collateral_pro" id="province" onchange="getList(this.value,'city',1)"></select>&nbsp;&nbsp;&nbsp;
                                        市: <select name="collateral_city" id="city" disable="disable"></select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th class="td_right">抵押物位置 :</th>
                                    <td>
                                        <input type="text" name="collateral_position" id="collateral_position" value="{$vo.collateral_position}" >
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th class="td_right">抵押物类别说明 :</th>
                                    <td><input type="text" name="collateral_type" id="collateral_type" value="{$vo.collateral_type}" ><span> (比如 房产,车辆等)</span></td>
                                </tr>
                                
                                <tr>
                                    <th class="td_right">联系电话 :</th>
                                    <td><input type="text" name="phone" id="phone" value="{$vo.phone}" ><span>请正确填写您的电话号码,方便我们与您联系</span></td>
                                </tr>
                                
                                <tr>
                                    <th class="td_right">备注信息 :</th>
                                    <td><textarea name="comment" rows="6" cols="55" >{$vo.comment}</textarea></td>
                                </tr>

				<tr>
					<th  width="200">发布时间</th>
					<td><input class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" name="timeline"  value="{$vo.timeline}" /></td>
				</tr>
				
				<tr>
					<th>状态</th>
					<td>
					上线<input type="radio"  name="status" value="1" <if condition="($vo.status eq 1)"> checked</if> />
					下线<input type="radio"  name="status" value="0" <if condition="($vo.status eq 0)"> checked</if> /></td>
				</tr>
				<tr class="act">
					<th>&nbsp;</th>
					<td>
                                                <input type="hidden" name="id" value="{$vo.id}"/>
                                                <input type="hidden" name="subflag" value="1"/>
						<input type="submit" class="submit_btn" value="确定" />
                                                <input type="button" class="submit_btn" value="取消" onclick="javascript:history(-1);"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
    
<!--
var ids = ['province','city','eare']; //默认要操作的三个ID，注意先后顺序，不可颠倒。
// 参数说明:pid是关联 的id (第二个参数) 的父级,n表示是第几级,(如第一级，第二级，第三级),selected 默认被选中的选择的主键
function getList (pid,id,n,selected) {
	var list = document.getElementById(id);
        list.innerHTML="";
	$.ajax({
            type: 'GET',
            url: '/Public/getArea',
            data: {'p_id':pid},
            dataType: 'json',
            success: function  (temp1) {
		//var temp1 = eval('('+ data +')');    //把传过来的字符串转化成一个JSON对象。
		var leng = temp1.length;

		var  n = (n > ids.length ) ?  ids.length : n;
		n = (n < 0 ) ?  0 : n;
		for (var j = n ; j < ids.length ; j++)
		{
			var t = 'temp'+j
			t = document.getElementById(ids[j]);
			//t.options.length = 1;
			//t.options[0]=new Option('请选择',-1);
		}

		if (leng > 0) {
                        
			//list.length = leng + 1;
			for (var i=0;i < temp1.length ;i++ )
			{
				list.options[i]=new Option(decodeURI(temp1[i].region_name),temp1[i].id);
				if (temp1[i].id == selected ) {
					list.options[i].selected = 'selected';
				}
			}        
		}
            }
	});
}

$(function () {
	getList ('0','province',1,{$vo.collateral_pro|default=0});
        getList ({$vo.collateral_pro|default=1},'city',2,{$vo.collateral_city|default=0} );
	//        getList (190,'eare1',2,1601);
	//三个都写是为了修改的时候，请三个框中默认的都有选中的值,一般增加的时候只写第一个就可以了。
});
//-->
    
    
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