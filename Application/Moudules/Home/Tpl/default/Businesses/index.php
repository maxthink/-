<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title><neq name="catename" value="" >{$catename} - </neq>微行<neq name="area" value="" >{$area}</neq> </title>
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
<link rel="shortcut icon" href="">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/reset.css" media="all">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/snower.css" media="all">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/common.css" media="all">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/cate12_2.css" media="all">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/iscroll.css" media="all">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/plugmenu.css" media="all">
<script type="text/javascript" src="__PUBLIC__/zuheti/js/maivl.js"></script>
<script type="text/javascript" src="__PUBLIC__/zuheti/js/jQuery.js"></script>
<script type="text/javascript" src="__PUBLIC__/zuheti/js/jquery_min.js"></script>
<script type="text/javascript" src="__PUBLIC__/zuheti/js/idangerous_swiper.js"></script>
<script type="text/javascript" src="__PUBLIC__/zuheti/js/iscroll.js"></script>
<script type="text/javascript" src="__PUBLIC__/zuheti/js/swipe.js"></script>
<script type="text/javascript" src="__PUBLIC__/zuheti/js/zepto.js"></script>

<style>
	.body{ max-width:640px; margin:auto; }
	.themeStyle{background:#2BBA14!important; background-color:#2BBA14 !important; }
</style>
</head>
<body onselectstart="return true;" ondragstart="return false;" id="cate12">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/zuheti/style/font-awesome.css" media="all">

<script type="text/javascript">
	var myScroll;
	function loaded() {
		myScroll = new iScroll('wrapper', {
			snap: true,
			momentum: false,
			hScrollbar: false,
			onScrollEnd: function() {
				document.querySelector('#indicator > li.active').className = '';
				document.querySelector('#indicator > li:nth-child(' + (this.currPageX + 1) + ')').className = 'active';
			}
		});
	}
	document.addEventListener('DOMContentLoaded', loaded, false);
</script>

<div class="body">
	<!--幻灯片管理-->
	<div style="-webkit-transform:translate3d(0,0,0);">
		<div id="banner_box" class="box_swipe" style="visibility: visible;">
			<ul style="list-style: none; width: 1920px; transition: 0ms; -webkit-transition: 0ms; -webkit-transform: translate3d(-640px, 0, 0);">
				<foreach name="advlist" item="val">
				<li style="width: 640px; display: table-cell; vertical-align: top;">
					<a onclick="return false;">
						<img src="{$val.pic}" alt="{$val.title}" style="width:100%;">
					</a>
				</li>
				</foreach>
			</ul>
			<ol>
				<foreach name="advlist" item="val">
				<li class=""></li>
				</foreach>
			</ol>
		</div>
	</div>
<script type="text/javascript">
	$(function(){
		new Swipe(document.getElementById('banner_box'), {
			speed:500,
			auto:3000,
			callback: function(){
				var lis = $(this.element).next("ol").children();
				lis.removeClass("on").eq(this.index).addClass("on");
			}
		});
	});
</script>

		<div class="Category">
		<div class="cname">商家分类<a href="/m/index/index/aid/{$aid}" class="more" style="font-size:16px;color:#000000;margin-bottom:5px; margin-top:0px;">返回首页</a></div>
		<div class="clist clist2 swiper-container">
			<div class="swiper-wrapper" style="width: 614.390625px;">
				<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 614.390625px;">
					<ul>
						<li>
							<a href="/m/Businesses/index/catid/2/aid/{$aid}">
								<div><img src="__PUBLIC__/zuheti/image/A1.jpg"></div>
								<span>服务便民</span>
							</a>
						</li>
						<li>
							<a href="/m/Businesses/index/catid/3/aid/{$aid}">
								<div><img src="__PUBLIC__/zuheti/image/A2.jpg"></div>
								<span>生活购物</span>
							</a>
						</li>
						<li>
							<a href="/m/Businesses/index/catid/4/aid/{$aid}">
								<div><img src="__PUBLIC__/zuheti/image/A3.jpg"></div>
								<span>休闲娱乐</span>
							</a>
						</li>
						<li>
							<a href="/m/Businesses/index/catid/5/aid/{$aid}">
								<div><img src="__PUBLIC__/zuheti/image/A4.jpg"></div>
								<span>宾馆餐馆</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="cpager">
				<span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span>
			</div>
			<script>
				$(function() {
					new Swiper('.clist2', {
						pagination: '.clist2 .cpager'
					});
				});
			</script>
		</div>
	</div>


	<!--商家-->
	<div id="insert1"></div>
	<neq name="r_list" value="" >
	<div class="Category">
		<div class="cname">推荐商家</div>
		<div class="clist clist1 swiper-container">
			<div class="swiper-wrapper" style="width: 614.390625px;">
				<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 614.390625px;">
					<ul>
						<foreach name="r_list" item="val">
						<li>
							<a href="/m/Businesses/show/id/{$val.id}/aid/{$aid}#weixin.qq.com">
								<div><img src="{$val.logo}"></div>
								<span>{$val.name}</span>
							</a>
						</li>
						</foreach>
					</ul>
				</div>
			</div>
			<div class="cpager">
				<span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span>
			</div>
			<script>
				$(function() {
					new Swiper('.clist1', {
						pagination: '.clist1 .cpager'
					});
				});
			</script>
		</div>
	</div>
	</neq>


	
	<neq name="list" value="" >
	<div class="Category">
		<div class="cname">商家列表</div>
		<div class="clist clist3 swiper-container">
			<div class="swiper-wrapper" style="width: 614.390625px;">
				<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 614.390625px;">
					<ul>
						<foreach name="list" item="val">
						<li>
							<a href="/m/Businesses/show/id/{$val.id}/aid/{$aid}#weixin.qq.com">
								<div><img src="{$val.logo}"></div>
								<span><?php echo str_replace($kw,'<p style="color:#ee3333;display:inline;">'.$kw.'</p>',$val['name']); ?></span>
							</a>
						</li>
						</foreach>
					</ul>
				</div>
			</div>
			<div class="cpager"><span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span></div>
			<script>
				$(function() {
					new Swiper('.clist3', {
						pagination: '.clist3 .cpager'
					});
				});
			</script>
		</div>
	</div>
	</neq>
	
	<neq name="page" value="" >
	<div class="Category">
		<div class="cname"></div>
		<div class="clist clist3 swiper-container">
			<div class="swiper-wrapper" style="width: 614.390625px;">
				<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 614.390625px;">
					<ul class="page" >
					{$page}
					</ul>
				</div>
			</div>
			<div class="cpager"><span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span></div>
			<script type="text/javascript">
				$(function() {
					new Swiper('.clist3', {
						pagination: '.clist3 .cpager'
					});
				});
			</script>
		</div>
	</div>
	</neq>

<style>
.button2{width: 80px; height: 30px;font-size:16px;padding:5px 0;border:1px solid #adadab;color:#000000;background-color: #e8e8e8;background-image:linear-gradient(to top, #dbdbdb, #f4f4f4);background-image:-webkit-gradient(linear, 0 100%, 0 0, from(#dbdbdb),to(#f4f4f4));box-shadow: 0 1px 1px rgba(0,0,0,0.45), inset 0 1px 1px #efefef; text-shadow: 0.5px 0.5px 1px #ffffff;}
.button2:active{background-color: #dedede;background-image: linear-gradient(to top, #cacaca, #e0e0e0);background-image:-webkit-gradient(linear, 0 100%, 0 0, from(#cacaca),to(#e0e0e0));}
</style>
	<div class="Category">
		<div class="cname"></div>
		<div class="clist clist4 swiper-container">
				<form action="/m/Businesses/index/aid/{$aid}" >
					<input id="kw" name="kw" value="" placeholder="输入商家名称搜索" style="margin-top:10px; font-size:16px; margin-bottom:10px; padding:2; "/>&nbsp;&nbsp;&nbsp;&nbsp;
					<input class="button2" type="submit" value="搜索商家" style="link" />
				</form>
				
			<!--div class="cpager"><span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span></div-->
			<script type="text/javascript">
				$(function() {
					new Swiper('.clist4', {
						pagination: '.clist4 .cpager'
					});
				});
			</script>
		</div>
	</div>

</div>

<script type="text/javascript">
	var count = document.getElementById("thelist").getElementsByTagName("img").length;
	for (i = 0; i < count; i++) {
		document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:" + document.body.clientWidth + "px";
	}

	document.getElementById("scroller").style.cssText = " width:" + document.body.clientWidth * count + "px";

	setInterval(
		function() {
			myScroll.scrollToPage('next', 0, 400, count);
		},
		3500
	);

	window.onresize = function() {
		for (i = 0; i < count; i++) {
			document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:" + document.body.clientWidth + "px";
		}
		document.getElementById("scroller").style.cssText = " width:" + document.body.clientWidth * count + "px";
	}
</script>
<footer style="overflow:visible;">
	<div class="weimob-copyright" style="padding-bottom:50px;">
		<a href="">微行<neq name="area" value="" >{$area}</neq>--微行中国技术支持</a>
	</div>
</footer>
</body>
</html>