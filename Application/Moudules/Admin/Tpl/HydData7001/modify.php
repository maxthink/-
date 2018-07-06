{// 加载头部公共文件 }
<include file="Public:header" />

<script type="text/javascript">
<!--
//指定当前组模块URL地址 
    var URL = '__ACTION__';
    var ROOT_PATH = '';
    var APP = '/';
    var STATIC = '/admin/Tpl/Default/Static';
    var VAR_MODULE = 'm';
    var VAR_ACTION = 'a';
    var CURR_GROUP = '{$Think.const.GROUP_NAME}';
    var CURR_MODULE = '{$Think.const.MODULE_NAME}';
    var CURR_ACTION = '{$Think.const.ACTION_NAME}';
//定义JS中使用的语言变量
    var CONFIRM_DELETE = '你确定要删除选择项吗？';
    var AJAX_LOADING = '提交请求中，请稍候...';
    var AJAX_ERROR = 'AJAX请求发生错误！';
    var ALREADY_REMOVE = '已删除';
    var SEARCH_LOADING = '搜索中...';
    var CLICK_EDIT_CONTENT = '点击修改内容';
//-->
</script>

<script charset="utf-8" src="__PUBLIC__/admin/js/wdatepicker/WdatePicker.js"></script>

</head>
<body>
<div class="cw-body">
    <div class="fb-title"><div><p><span>二维码 > <php>if(isset($vo['id'])) echo '编辑'; else echo '添加'; </php></if></span></p></div></div>
    <div class="fb-body">
        <form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/modify')}">
            <table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr>
                    <th width="200">编号</th>
                    <td><p>{$vo.id}</p></td>
                </tr>
                <tr>
                    <th  width="200">区域名称</th>
                    <td><input type="text"  name="areaname"  value="{$vo.areaname}" style="width:300px;font-size: 18px;" /></td>
                </tr>
                
                <tr>
                    <th width="200" >二维码图片</th>
                    <td>
                        <img id='qrimg' src="{$vo.img}" />
                        <input type="hidden" name="img" id='img' value="{$vo.img}" />
                        <span onclick="getqrcode()" >获取二维码图片</span>
                    </td>
                </tr>

                <tr>
                    <th>状态</th>
                    <td>
                        使用<input type="radio"  name="status" value="1" <if condition="($vo.status eq 1)"> checked</if> />
                        停止<input type="radio"  name="status" value="0" <if condition="($vo.status eq 0)"> checked</if> />
                    </td>
                </tr>
                <tr class="act">
                    <th>&nbsp;</th>
                    <td>
                        <input type="hidden" name="id" id="aid" value="{$vo.id}"/>
                        <input type="hidden" name="subflag" value="1"/>
                        <input type="submit" class="submit_btn" value="确定" />
                        <input type="button" class="submit_btn" value="取消" onclick="javascript:history(-1);"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div id="cover" style="position:fixed; left:50%; top:50%; margin-left:-250px; margin-top:-100px; width:500px; height:200px; z-index: 999; background-color: #999; opacity: 0.9; display:none; ">
    <div>
        
        <tr>
            <th  width="200">区域名称</th>
            <td><input type="text"  name="areaname" style="width:300px;font-size: 18px;" /></td>
        </tr>
    
    </div>
</div>
<script type="text/javascript">
    

    var id = $("#aid").val();
    if( id== '' )
    {
        $("#cover").show();
    }else
    {
            
        //var ID = t.val();

        
    
    }
    
    function getqrcode()
    {
        if( id !== '' )
        {
            //var url = "{:U('wxqrcode/getqrcode')}";
            var url = "{:U('wxqrcode/getlogoqrcode')}";
            
            $.ajax({
                url: url,
                type: 'GET',
                data: {id:id},
                dataType: 'json',
                success: function(res){
                    if(res.status==1){
                        $('#qrimg').attr('src',res.img);
                        $('#img').val(res.img);
                    }else{
                        alert(res.msg);
                    }
                }
            });
        }else{
            
        }
    }

</script>
<include file="Public:footer" />