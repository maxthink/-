<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>{$Businesses.name} - 微行<neq name="area" value="" >{$area}</neq></title>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="">
<meta name="Description" content="">
<!-- Mobile Devices Support @begin -->         
<meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
<meta content="no-cache" http-equiv="pragma">
<meta content="0" http-equiv="expires">
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<!-- Mobile Devices Support @end -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/news2.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/plugmenu.css" />
<script src="__PUBLIC__/zuheti/js/audio.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
 
<script type="text/javascript">
      audiojs.events.ready(function() {
        audiojs.createAll();
      });
</script>
<style>
#cate6 .mainmenu li.li0:nth-child(5) .menumesg {
    background-color: #990000;
}
#cate6 .mainmenu li.li0:nth-child(1) .menumesg {
    background-color: #01AA0A;
}
#cate6 .mainmenu li.li0:nth-child(9) .menumesg {
    background-color: #8B4500;
}

#cate8 .mainmenu li .menubtn {
    border-radius: 5px;
}
#cate8 .mainmenu li div img {
    border-radius: 5px;
}
.themeStyle{background:#DE270B}
.conectfangshi{
font-size: 12px;
color: #8c8c8c;
margin: 0;
padding: 0px;
}
.tupian{width:90%; margin:0 auto; }
.tupian img{width:90%; margin-top:10px; margin-bottom:10px; }
</style>
</head>
<body id="news2" >
	<div id="ui-header">
		<div class="fixed">
			<!--a class="ui-title" id="popmenu"><font  style="font-size: 18px;">选择分类</font> </a-->
			<a class="ui-btn-left_pre" href="javascript:" onclick="window.history.go(-1)"></a>
			<a class="ui-btn-right_home" href="/m/index/index/aid/{$aid}" ></a>
		</div>
	</div>
	<div id="overlay"></div>
	<div class="Listpage">
		<div class="top46"></div>
		<div class="page-bizinfo">
			<div class="header" style="position: relative;">
				<h1 id="activity-name">{$Businesses.name}</h1>
				<span id="post-date">时间：{$Businesses.create_time} | 浏览：100</span>
			</div>
			<div class="tupian" >
				<?php 
					foreach($Businesses['pics'] as $key=>$pic){
						if(!empty($pic)) echo '<img src="'.$pic.'">';
					}
				?>
			<div class="text" id="content">{$Businesses.intro}</div>
		</div>
	</div>

	<div class="list">
		<div id="recommend"><span>与TA联系</span></div>
		<div id="oldlist">
			<div style="width:100%;height:285px;border:#ccc solid 1px;" id="dituContent"></div>
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
								var point = new BMap.Point({$Businesses.hzb},{$Businesses.zzb});//定义一个中心点坐标
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
							var markerArr = [{title:"<?php echo $Businesses[name];?>",content:"电话：<?php echo $Businesses[phone];?><br/>地址：<?php echo $Businesses[address];?>",point:"<?php echo $Businesses[hzb];?>|<?php echo $Businesses[zzb];?>",isOpen:1,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}];

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

		</div>	
	</div>

<style type="text/css">
button{width:100%;text-align:center;border-radius:3px;}
.button2{font-size:16px;padding:8px 0;border:1px solid #adadab;color:#000000;background-color: #e8e8e8;background-image:linear-gradient(to top, #dbdbdb, #f4f4f4);background-image:-webkit-gradient(linear, 0 100%, 0 0, from(#dbdbdb),to(#f4f4f4));box-shadow: 0 1px 1px rgba(0,0,0,0.45), inset 0 1px 1px #efefef; text-shadow: 0.5px 0.5px 1px #ffffff;}
.button2:active{background-color: #dedede;background-image: linear-gradient(to top, #cacaca, #e0e0e0);background-image:-webkit-gradient(linear, 0 100%, 0 0, from(#cacaca),to(#e0e0e0));}
#mess_share{margin:15px 0;}
#share_1{float:left;width:49%;}
#share_2{float:right;width:49%;}
#mess_share img{width:22px;height:22px;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;right:18px;top:5px;z-index:19999;}
#guide img{width:260px;height:180px;}

</style>

	<div class="list">
		<div id="recommend"><span>与TA联系</span></div>
		<div id="oldlist">
			<ul>
				<!--li class="newsmore">
					<a >
						<div class="olditem">
							<div class="title">联系人: {$Businesses.contact_user}</div> 
						</div>
					</a>
				</li-->
				<li class="newsmore">
					<a href="tel:{$Businesses.phone}">
						<div class="olditem">
							<div class="title">电话: {$Businesses.phone}</div> 
						</div>
					</a>
				</li>
				<!--li class="newsmore">
					<a >
						<div class="olditem">
							<div class="title">qq: {$Businesses.qq}</div> 
						</div>
					</a>
				</li-->
				<li class="newsmore">
					<a >
						<div class="olditem">
							<p style="margin-left: 0;color: #535353;font-size: 14px;padding-right: 20px;" >联系地址: {$Businesses.address}</p> 
						</div>
					</a>
				</li>

			</ul>
			<!--a class="more" href="">更多精彩内容</a-->
		</div>
		<div id="mess_share">
			<div id="share_1">
				<button class="button2" onclick="_system._guide(true)"><img src="/Public/zuheti/image/themes/icon_msg.png">&nbsp;发送给朋友</button>
			</div>
			<div id="share_2">
				<button class="button2" onclick="_system._guide(true)"><img src="/Public/zuheti/image/themes/icon_timeline.png">&nbsp;分享到朋友圈</button>
			</div>
			<div class="clr"></div>
		</div>
	</div>
	
	<script src="pwximg/play.js" type="text/javascript"></script>
<script type="text/javascript">
    var _system={
        $:function(id){return document.getElementById(id);},
   _client:function(){
      return {w:document.documentElement.scrollWidth,h:document.documentElement.scrollHeight,bw:document.documentElement.clientWidth,bh:document.documentElement.clientHeight};
   },
   _scroll:function(){
      return {x:document.documentElement.scrollLeft?document.documentElement.scrollLeft:document.body.scrollLeft,y:document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop};
   },
   _cover:function(show){
      if(show){
     this.$("cover").style.display="block";
     this.$("cover").style.width=(this._client().bw>this._client().w?this._client().bw:this._client().w)+"px";
     this.$("cover").style.height=(this._client().bh>this._client().h?this._client().bh:this._client().h)+"px";
  }else{
     this.$("cover").style.display="none";
  }
   },
   _guide:function(click){
      this._cover(true);
      this.$("guide").style.display="block";
      this.$("guide").style.top=(_system._scroll().y+5)+"px";
      window.onresize=function(){_system._cover(true);_system.$("guide").style.top=(_system._scroll().y+5)+"px";};
  if(click){_system.$("cover").onclick=function(){
         _system._cover();
         _system.$("guide").style.display="none";
 _system.$("cover").onclick=null;
 window.onresize=null;
  };}
   },
   _zero:function(n){
      return n<0?0:n;
   }
}
</script>

	<div class="page-content"></div>
</div>

<a class="footer"  onclick="javascript:window.history.go(-1);" target="_self"><span class="top">返回</span></a>
<script src="pwximg/zepto.min.js" type="text/javascript"></script>
<script src="pwximg/plugmenu.js" type="text/javascript"></script>

</body>
</html>
<div id="cover"></div>
<div id="guide"><img src="/Public/zuheti/image/themes/guide.png"></div>