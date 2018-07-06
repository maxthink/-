<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> 网站 - 管理中心 </title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>

<frameset rows="75,*,22" cols="*" frameborder="no" border="0" framespacing="0">
	<frame src="<?php echo U('Index/top');?>" name="topframe" scrolling="No" noresize="noresize" id="topframe" title="topframe" charset="utf-8"/>
	<frameset cols="190,14,*" id="bodyFrameset" frameborder="no" border="0" framespacing="0">
		<frame src="<?php echo U('Index/left');?>" name="leftFrame" noresize="noresize" id="leftFrame" title="leftFrame" charset="utf-8"/>
		<frame src="<?php echo U('Index/change');?>" name="changeFrame" noresize="noresize" id="changeFrame"  frameborder="no"  scrolling="no" marginwidth="0" marginheight="0"/>
		<frame src='' name="mainFrame" id="mainFrame" title="mainFrame" charset="utf-8"/>
	</frameset>
	<frame src="<?php echo U('Index/footer');?>" name="bottomFrame" scrolling="no" noresize="noresize" charset="utf-8"/>
</frameset>

<noframes>
<body style="padding:0">
</body>
</noframes>

</html>