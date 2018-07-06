<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<link href="__PUBLIC__/Admin/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.4.2.min.js"></script>
<style type="text/css">
.from { margin:10px 0 0 10px; }
.from p { margin:8px 0 0 5px; font-size:16px; }
.from .text {width:250px; height:24px; padding:3px; line-height:24px; border:1px solid #D4D4D4; }
.from .verifycode {width:100px; height:24px; padding:3px; line-height:24px; border:1px solid #D4D4D4; }
.from .verifybutton { width:100px; height:30px; color:#FFFFFF; font-size:16px; line-height:30px; background-color: #348FD4; border:0px; margin-left:65px; }
.from .verifybutton:hover { background-color: #2F81BF; border:0px;}
.from .verifyimg { margin-left:65px; }
</style>
</head>
<body>

		<div style="position:absolute; top:50%; left:50%; margin-top:-180px; margin-left:-330px; width:660px; height:290px; border:solid 5px #cccccc ">
			<div style="float:left; width:250px; height:250px;">
			</div>
			<div style="float:left; width:350px; height:250px;">
				<form id="login" name="login" class="from" >
					<div id="showmsg" style=" margin:10px 0 0 70px; position:absolute; color:#ef6666; font-size:14px; width:190px; height:20px; display:none; "></div>
					<div id="fromcontent" style="position:absolute; margin:30px 0 0 0;">
						<p>用户名　<input type="text" class="text" id="account" name="account" /></p>
						<p>密　码　<input type="password" class="text" id="password" name="password" /></p>
						<p>验证码　<input type="text" class="verifycode" id="verifycode" name="verifycode" class="verify"> 
									<a href="javascript:void(0)" class="reload">换一张?</a></p>
						<p><img src="<?php echo U('Public/verifycode');?>" title="点击刷新" class="verifyimg reload" style="margin-left:65px;"/></p>
						<p><input type="button" class="verifybutton" onclick="verify()" value="登 陆" class="submit"></p>
					</div>
				</form>
			</div>
		</div>

<script type="text/javascript">
	
jQuery(function($){
	if(top.location != self.location)
	{
		top.location.href = self.location.href;
		return;
	}
	
	$('.reload').click(function(){
		$('.verifyimg').attr("src","<?php echo U('Public/verifycode');?>");
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
			url: "<?php echo U('Public/verify');?>",
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
</body>
</html>