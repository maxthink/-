<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.4.2.min.js"></script>
	<link href="__PUBLIC__/admin/style/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="background:#fff;padding:0;">
	<div class="cw-change" rel="left"></div>

<script type="text/javascript">
	jQuery(function($){
		$(".cw-change").click(function(){
			var rel = this.getAttribute("rel");
			if(rel == 'left')
			{
				rel = 'right';
				$(this).addClass("cw-change-right");
				window.parent.document.getElementById("bodyFrameset").cols = "0,14,*";
			}
			else
			{
				rel = 'left';
				$(this).removeClass("cw-change-right");
				window.parent.document.getElementById("bodyFrameset").cols = "190,14,*";
			}
			
			this.setAttribute("rel",rel);
		});
	});
</script>

</body>
</html>