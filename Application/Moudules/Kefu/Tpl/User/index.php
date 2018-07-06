{// 引入标签库 }
<tagLib name="html" />
{// 加载头部公共文件 }
<include file="Public:header" />

<script type="text/javascript">
<!--
//指定当前组模块URL地址 
    var URL = '__ACTION__';
    var ROOT_PATH = '';

    var STATIC = '/kefu/Tpl/Default/Static';
    var VAR_MODULE = 'm';
    var VAR_ACTION = 'a';
    var CURR_GROUP = '{$Think.const.GROUP_NAME}';
    var CURR_MODULE = '{$Think.const.MODULE_NAME}';
    var CURR_ACTION = '{$Think.const.ACTION_NAME}';

//-->
</script>
</head>
<body style="background:#DEE4ED;padding:0; overflow:hidden; overflow-y:scroll;">
<div>
        <div class="cw-menu" valign="top">

                <foreach name="navs" item='nav'>
                <dl>
                        <if condition="$nav['show']" >
                        <dt><div><strong>{$nav.name}</strong></div></dt>
                        <foreach name="nav['sub_navs']" item='sub_nav'>
                        <if condition="$sub_nav['show']" >
                        <dd><p><a href={:U( $sub_nav['action']."/".$sub_nav['option'] ) } target="mainFrame">{$sub_nav.name}</a></p></dd>
                        </if>
                        </foreach>
                        </if>
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