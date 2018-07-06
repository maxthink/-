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
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
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
	<div class="fb-title"><div><p><span>商家 > 详情</span></p></div></div>
		<div class="fb-body">
			
			<table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr>
					<th width="200">编号</th>
					<td><p>{$vo.id}</p></td>
				</tr>
				<tr>
					<th  width="200">商家名</th>
					<td>{$vo.name}</td>
				</tr>
				<tr>
					<th  width="200">分类</th>
					<td>{$catname}</td>
				</tr>
				<tr>
					<th  width="200">地区</th>
					<td>{$areaname}</td>
				</tr>
				
				<tr>
					<th>logo:</th>
					<td><img src="{$vo.logo}">			<td>
				</tr>
				<tr>
					<th>图片:</th>
					<td><img src="{$vo.pic}"><td>
				</tr>
				<tr>
					<th>简介</th>
					<td>{$vo.intro}</td>
				</tr>
				<tr>
					<th  width="200">地址</th>
					<td>{$vo.address}</td>
				</tr>
				<tr>
					<th  width="200">电话</th>
					<td>{$vo.phone}</td>
				</tr>
				<tr>
					<th>地理位置:</th>
					<td>
						<div style="width:500px;height:280px;border:#ccc solid 1px;" id="dituContent"></div>
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
							
							//标注点数组
							var markerArr = [{title:"<?php echo $vo[name];?>",content:"电话：<?php echo $vo[phone];?><br/>地址：<?php echo $vo[address];?>",point:"<?php echo $vo[hzb];?>|<?php echo $vo[zzb];?>",isOpen:1,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}];

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

						<td>
				</tr>
				
				<tr>
					<th  width="200">发布时间</th>
					<td>{$vo.create_time}</td>
				</tr>
				<tr>
					<th  width="200">浏览次数</th>
					<td>{$vo.num}</td>
				</tr>
				<tr>
					<th>状态</th>
					<td><if condition="($vo.status eq 1)">上线<else />下线 </if></td>
				</tr>
				<tr>
					<th>是否推荐</th>
					<td><if condition="($vo.recommend eq 1)">是<else />否 </if></td>
				</tr>
				
				
			</table>
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