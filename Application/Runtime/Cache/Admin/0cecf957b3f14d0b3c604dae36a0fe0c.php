<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link href="__PUBLIC__/admin/style/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.4.2.min.js"></script>
</head>
<body style="background:#DEE4ED;padding:0; overflow:hidden; overflow-y:scroll;">
	<div>
		<div class="cw-menu" valign="top">

			<?php if(is_array($navs)): foreach($navs as $key=>$nav): ?><dl>
				<?php if($nav['show']): ?><dt><div><strong><?php echo ($nav["name"]); ?></strong></div></dt>
				<?php if(is_array($nav['sub_navs'])): foreach($nav['sub_navs'] as $key=>$sub_nav): if($sub_nav['show']): ?><dd><p><a href=<?php echo U( $sub_nav['action']."/".$sub_nav['option'] ) ;?> target="mainFrame"><?php echo ($sub_nav["name"]); ?></a></p></dd><?php endif; endforeach; endif; endif; ?>
			</dl><?php endforeach; endif; ?>
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