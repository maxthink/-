<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link href="__PUBLIC__/admin/style/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.4.2.min.js"></script>
</head>
<body style=" overflow:hidden; overflow-y:scroll;">
	<div>
		<div class="cw-menu" valign="top">

			<foreach name="list" item='val'>
			<dl>
				<dt><div><strong></strong></div></dt>
				
				<dd><p><img src="{$val.headimgurl}" width="50" style="height:50px; overflow:hidden;"><a href="" target="mainFrame">{$val.nickname}</a></p></dd>
				
			</dl>
			</foreach>
		</div>
	</div>

	<script type="text/javascript">
		
		

		//点击样式
		if($("a:first").attr("href"))
		{
			top.document.getElementById("mainFrame").src = $("a:first").attr("href");
			$("a:first").parent().parent().addClass("cur");
		};
		
		$("a").click(function(){
			$("a").each(function(){
				$(this).parent().parent().removeClass("cur");
			});
			$(this).parent().parent().addClass("cur");
			$(this).blur();
		});
	</script>
</body>
</html>