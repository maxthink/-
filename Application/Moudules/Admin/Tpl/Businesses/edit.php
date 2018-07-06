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
	getList ('0','province',1,{$aresult[ffid]});
   	getList ({$aresult[ffid]},'city',2,{$aresult[fId]});
   	getList ({$aresult[fId]},'eare1',3,{$aresult[id]});
	//三个都写是为了修改的时候，请三个框中默认的都有选中的值,一般增加的时候只写第一个就可以了。
});
//-->
</script>
<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/zh_CN.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/prettify.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/wdatepicker/WdatePicker.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
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
	<div class="fb-title"><div><p><span>商家 > 编辑</span></p></div></div>
		<div class="fb-body">
			<form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/edit')}">
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr>
					<th width="200">编号</th>
					<td><p>{$vo.id}</p></td>
				</tr>
				<tr>
					<th  width="200">商家名</th>
					<td><input type="text"  name="name"  value="{$vo.name}" /></td>
				</tr>
				<tr>
					<th  width="200">分类</th>
					<td>
						<select name="catid" width="155" style="width: 155px">
                            <volist name='type' id='v'>
                                <option value ="{$v.id}" <if condition="($v[id] eq $vo[catid])"> selected="selected"</if>>{$v.name}</option>
                            </volist>
                        </select>
					</td>
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
						<div id="uploaded">
							<div class="imgorder" id="img0">
								<img src="{$vo.logo}">
								<input type="hidden" id="imgval0" name="img" value="{$vo.logo}">
								<!-- <input type="button" value="取消" onclick="quxiao(0)"> -->
							</div>
						</div>
                    <td>
				</tr>
				<tr>
					<th>图片:
                    	<div style="text-align:left; width:80px; margin:10px 0 0 120px; ">
                        	<input id="file_upload2" type="file" />
                        </div>
                    </th>
					<td>
						<div id="uploaded2">
							<foreach name="vo.pics" item="pic" key="key">
							<div class="imgorder" id="d_pic{$key}">
								<img src="{$pic}">
								<input type="hidden" id="i_pic{$key}" name="pics[]" value="{$pic}">
								<input type="button" value="删除" onclick="pics_quxiao({$key})">
							</div>
							</foreach>
						</div>
                    <td>
				</tr>
				<tr>
					<th>简介</th>
					<td><textarea  name="intro" id="intro" cols="50" rows="10" style="width:700px;height:200px;visibility:hidden;">{$vo.intro}</textarea></td>
				</tr>
				<tr>
					<th  width="200">地址</th>
					<td><input type="text"  name="address"  value="{$vo.address}" /></td>
				</tr>
				<tr>
					<th  width="200">电话</th>
					<td><input type="text"  name="phone"  value="{$vo.phone}" /></td>
				</tr>
				<tr>
					<th>地理位置:</th>
					<td>
						<!--p>坐标:<input type="text"  name="zb"  value="{$vo.zb}" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://api.map.baidu.com/lbsapi/getpoint/" target="_blank" >坐标获取地址</a></p><br/-->
						<p><a href="http://api.map.baidu.com/lbsapi/getpoint/" target="_blank" >坐标获取地址</a></p><br/>
						<p>横坐标:<input type="text"  name="hzb"  value="{$vo.hzb}" /></p><br/>
						<p>纵坐标:<input type="text"  name="zzb"  value="{$vo.zzb}" /></p><br/>
						<div style="width:500px;height:280px;border:#ccc solid 1px;" id="dituContent"></div>
						<script >
							//标注点数组
							var markerArr = [{title:"<?php echo $vo[name];?>",content:"电话：<?php echo $vo[phone];?><br/>地址：<?php echo $vo[address];?>",point:"<?php echo $vo[hzb];?>|<?php echo $vo[zzb];?>",isOpen:1,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}];
						</script>

                    <td>
				</tr>
				
				<tr>
					<th  width="200">发布时间</th>
					<td><input class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" name="create_time"  value="{$vo.create_time}" /></td>
				</tr>
				<tr>
					<th  width="200">浏览次数</th>
					<td><input type="text"  name="num"  value="{$vo.num}" /></td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
					上线<input type="radio"  name="status" value="1" <if condition="($vo.status eq 1)"> checked</if>/>
					下线<input type="radio"  name="status" value="0" <if condition="($vo.status eq 0)"> checked</if>/></td>
				</tr>
				<tr>
					<th>是否推荐</th>
					<td>
					是<input type="radio"  name="recommend" value="1" <if condition="($vo.recommend eq 1)"> checked</if>/>
					否<input type="radio"  name="recommend" value="0" <if condition="($vo.recommend eq 0)"> checked</if>/></td>
				</tr>
				<tr>
					<th  width="200">竞价金额</th>
					<td><input type="text"  name="price"  value="{$vo.price}" /></td>
				</tr>
				<tr class="act">
					<th>&nbsp;</th>
					<td>
						<input type="hidden" name="subflag" value="1" />
                        <input type="hidden" name="id" value="{$vo.id}"/>
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
	
	//logo上传
	$("#file_upload").uploadify({
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
				getLogoResult(res);
			}else{
				alert('文件上传出错');
			}
		},
		'onError': function(errorObj) {
			alert(errorObj.info+" "+errorObj.type);
		}
	});
	

	//图片上传
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
				getPicsResult2(res);
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
	function getLogoResult(res){

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
	function getPicsResult2(res){

		if(res.status == 1)
		{
			var len = $('#uploaded2 .imgorder').size();
			var html =	'<div class="imgorder" id="d_pic'+len+'" >'+
								'<img src="'+res.imgname+'" />'+
							'<input type="hidden" id="i_pic'+len+'" name="pics[]" value="'+res.imgname+'" />'+
							'<input type="button" value="删除" onclick="pics_quxiao('+len+')">'+
						'</div>';

			$('#uploaded2').append(html);
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
<script type="text/javascript">
	
	//创建和初始化地图函数：
	function initMap(){
		createMap();//创建地图
		setMapEvent();//设置地图事件
		addMapControl();//向地图添加控件
		addMarker();//向地图中添加marker
	}
	
	//创建地图函数：
	function createMap(){
		var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
		var point = new BMap.Point({$vo.hzb},{$vo.zzb});//定义一个中心点坐标
		map.centerAndZoom(point,17);//设定地图的中心点和坐标并将地图显示在地图容器中
		window.map = map;//将map变量存储在全局
	}
	
	//地图事件设置函数：
	function setMapEvent(){
		map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
		map.enableScrollWheelZoom();//启用地图滚轮放大缩小
		map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
		map.enableKeyboard();//启用键盘上下左右键移动地图
	}
	
	//地图控件添加函数：
	function addMapControl(){
		//向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_ZOOM});
	map.addControl(ctrl_nav);
				}
	
	

	//创建marker
	function addMarker(){
		for(var i=0;i<markerArr.length;i++){
			var json = markerArr[i];
			var p0 = json.point.split("|")[0];
			var p1 = json.point.split("|")[1];
			var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
			var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
			map.addOverlay(marker);
			label.setStyle({
						borderColor:"#808080",
						color:"#333",
						cursor:"pointer"
			});
			
			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
					this.openInfoWindow(_iw);
				});
				_iw.addEventListener("open",function(){
					_marker.getLabel().hide();
				})
				_iw.addEventListener("close",function(){
					_marker.getLabel().show();
				})
				label.addEventListener("click",function(){
					_marker.openInfoWindow(_iw);
				})
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
		}
	}
	//创建InfoWindow
	function createInfoWindow(i){
		var json = markerArr[i];
		var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
		return iw;
	}
	//创建一个Icon
	function createIcon(json){
		var icon = new BMap.Icon("http://openapi.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
		return icon;
	}
	
	initMap();//创建和初始化地图
</script>

<include file="Public:footer" />