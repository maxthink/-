<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
    <style>
        body{margin:0px; padding:0px;overflow:hidden;}
        .navs{float:left; margin-top:5px; }
        .navs div{float: left;  overflow: hidden;}
        .navs div p{margin:0px; padding:10px; }
        .active{background-color: #eed;}
    </style>
<body>

<div class="navs">
    <div class="active"> 
        <p><a href='{:U("User/index")} ' target="ruleFrame">用户档案</a></p>
    </div>
    <div class=""> 
        <p><a href='{:U("Rule/index")} ' target="ruleFrame">聊天规则</a></p>
    </div>
</div>

<script type="text/javascript">

        
        if($("a:first").attr("href"))
        {
                top.document.getElementById("ruleFrame").src = $("a:first").attr("href");
                $("a:first").parent().parent().addClass("active");
        };

        //点击样式
        $("a").click(function(){
            $("a").each(function(){
                $(this).parent().parent().removeClass("active");
            });
            $(this).parent().parent().addClass("active");
            $(this).blur();
        });
</script>
</body>
</html>