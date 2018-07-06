
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>购物分享管理系统 - 系统登录</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/style/login.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
<!--
//指定当前组模块URL地址 
var AJAX_LOADING = '提交请求中，请稍候...';
var AJAX_ERROR = 'AJAX请求发生错误！';
//-->
</script>
</head>
<body>
<form method='post' name="login" id="login"  >
<div id="login-box">
	<div id="resultMsg"></div>
	<input type="text" name="account" id="admin_name" />
	<input type="password" name="password" id="admin_pwd" />
	<input type="text" name="verifycode" id="verify" />
	<img id="verifyImg" src="{:U('Public/verifycode')}"  align="absmiddle" alt="点击刷新验证码" title="点击刷新验证码" width="100" height="40">
	<input type="image" id="loginBtn" src="__PUBLIC__/Admin/images/login_btn.png" />
	<input type="hidden" name="ajax" value="1">
</div>
</form>
</body>
<script type="text/javascript">
	
jQuery(function($){
	if(top.location != self.location)
	{
		top.location.href = self.location.href;
		return;
	}
	
	$('.reload').click(function(){
		$('.verifyimg').attr("src","{:U('Public/verifycode')}");
	});
	
	$(document).keypress(function(e){
		if(e.keyCode == 13)
		{
			verify();
		}
	});

	$(document).keypress(function(e){
		$('#showmsg').hide();
	});

});


	function verify()
	{
		if($('#account').val() == '')
		{
			showerror('请输入账户!');
			$('#account').focus();
			return;
		}

		if($('#password').val() == '')
		{
			showerror('请输入密码!');
			$('#password').focus();
			return;
		}

		if($('#verifycode').val() == '')
		{
			showerror('请输入验证码!');
			$('#verifycode').focus();
			return;
		}

		$.ajax({
			type: 'POST',
			url: "{:U('Public/verify')}",
			data: $('#login').serialize(),
			dataType: 'json',
			success: function(res){
				if(res.status ==1)
				{
					document.location = '__GROUP__';
				}
				else
				{
					showerror(res.info);
				}
			},
			error: function(){
				alert('error');
			}
		});
	}

	function showerror(msg)
	{
		$('#showmsg').html(msg);
		$('#showmsg').show();		
	}


</script>
</html>