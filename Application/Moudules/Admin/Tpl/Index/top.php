<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="__PUBLIC__/admin/style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.4.2.min.js"></script>
</head>
<body style="background:#99A2B3;padding:0">
<div class="cw-header">
	<div class="fh-top">
		<div class="fht-logo"><!--img src="__PUBLIC__/admin/images/logo.png"--></div>
		<div class="fht-links">
			<span>欢迎:{$admin_user}</span>
			<a class="edit-pwd" href="{:U('Public/modify')}" target="mainFrame">修改密码</a>
			<a href="/" target="_blank" target="_blank" >网站首页</a>
			<a href="{:U('Cache/system')}" target="mainFrame">更新缓存</a>
			<a href="{:U('Public/logout')}" target="_self" >退出</a>
		</div>
		<div class="fht-navs">
			<volist name="navs" id='nav'>
				<if condition="nav.id==1" > <div class="active"> <else /> <div class=""> </if>
					<p><a href='{:U("Index/left?id=$nav[id]")} ' target="leftFrame">{$nav.name}</a></p>
				</div>
			</volist>
		</div>
	</div>
	<div class="ajax-loading" style="top:36px; right:0;"></div>
</body>
<script type="text/javascript">
	//导航点击样式改变
	$(document).ready(function(){
		$(".fht-navs div").click(function(){
			$(".fht-navs div").removeClass("active");
			$(this).addClass("active");
			$('a',this).blur();
		});

		$(".fht-navs div:first ").addClass("active");

	});

	//时钟
	var timestamp = {$_SERVER['REQUEST_TIME']};
	function gettime(){
	return new Date(parseInt(timestamp) * 1000).toLocaleString(); 
	}
	function showtime(){
	timestamp++;
	document.getElementById('clock').innerHTML = gettime();
	setTimeout('showtime()',1000);
	}
	//showtime();
</script>

</body>
</html>