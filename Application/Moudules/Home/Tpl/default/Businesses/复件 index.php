<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>微行<neq name="area" value="" >{$area}</neq></title>
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
				<li style="width: 640px; display: table-cell; vertical-align: top;">
					<a onclick="return false;">
						<img src="__PUBLIC__/zuheti/image/20131106135210_43610.jpg" alt="美食" style="width:100%;">
					</a>
				</li>
			</ul>
			<ol>
				<foreach name="advlist" item="val">
				<li class=""></li>
				</foreach>
				<li class=""></li>
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

	<!--商家-->
	<div id="insert1"></div>
	<div class="Category">
		<div class="cname">推荐商家</div>
		<div class="clist clist1 swiper-container">
			<div class="swiper-wrapper" style="width: 614.390625px;">
				<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 614.390625px;">
					<ul>
						<foreach name="r_list" item="val">
						<li>
							<a href="/Businesses/show/id/{$val.id}">
								<div><img src="{$val.logo}"></div>
								<span>{$val.name}</span>
							</a>
						</li>
						</foreach>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="Category">
		<div class="cname">商家列表</div>
		<div class="clist clist2 swiper-container">
			<div class="swiper-wrapper" style="width: 614.390625px;">
				<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 614.390625px;">
					<ul>
						<foreach name="list" item="val">
						<li>
							<a href="/Businesses/show/id/{$val.id}">
								<div><img src="{$val.logo}"></div>
								<span>{$val.name}</span>
							</a>
						</li>
						</foreach>
					</ul>
				</div>
			</div>
		</div>
	</div>

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