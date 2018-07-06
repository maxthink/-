<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="__PUBLIC__/wx/default/style/style.css" rel="stylesheet" type="text/css" />
<style>
    a{cursor: pointer}
    table{boder:0px; padding:0px; margin:0px; border-spacing:0px; }
    .list{padding:10px; padding-left: 30px;}
    .list table{width: 100%; border:0px; }
    .list table tr{width: 100%; padding:3px; display: inline-table;}
    .list table tr td{ cursor: pointer;}
    .list table tr td .nickname{vertical-align: super;}
    .list table tr td .head{width:30px; overflow: hidden;}
    .list table tr .close{width:30px;}
    .close_talk{ width:30px; height:30px; text-align:center; line-height:30px; display:block;  }
    .have-msg{ width:10px; height: 10px; border-radius:3px; float:right; margin-right:0px; margin-top:12px; background-color: #f22; display: -webkit-inline-box;}
    .hide{ display:none; }
    .cur{background-color:#eed; background-clip: 3px; border-radius: 5px; }
</style>
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
<body style=" overflow:hidden; overflow-y:scroll;">

    <div class="list" id="list" valign="top">
        <table id="custom_list">
        <foreach name="list" item='val'>
            
            <tr >
                <td class="custom" data-openid="{$val.openid}" >
                    <img src="{$val.headimgurl}" class="head">
                    <span class='nickname'>{$val.nickname|mb_substr=0,5,'utf-8'}</span>
                    <span id="show_{$val.openid}" title="有消息未回复" class="have-msg <php>if($val['isreplay']==0) echo 'hide'; </php>" ></span>
                </td>
                <td class="close"><span class="close_talk hide" title="关闭对话" data-id="{$val.openid}" >X</span></td>
            </tr>
            
        </foreach>
        </table>
    </div>
    <input type="hidden" id="kfid" value="{$kfid}" />

<script type="text/javascript">

    $(".custom").live("click",function () {
        
        var openid = $(this).attr('data-openid');
        
        top.document.getElementById("mainFrame").src = '{:U("talk/index")}?openid='+openid;
        top.document.getElementById("ruleFrame").src = '{:U("user/index")}?openid='+openid;
        $(".custom").each(function () {
            $(this).parent().removeClass("cur");
        });
        $(this).parent().addClass("cur");
        
    });
    
    //鼠标划过样式
    $("tr").live("mouseover",function () {
        $(this).css("background-color","#eeeeee");
        $(this).children('.close').children('span').css('display','block');
    });
    
    $("tr").live("mouseout",function () {
        if($(this).hasClass('cur')){
            $(this).css("background-color","#eed");
        }else{
            $(this).css("background-color","#ffffff");
        }
        $(this).children('.close').children('span').hide();
    });
    
    //关闭对话
    $('.close_talk').live("click",function () {
        var openid = $(this).attr('data-id');
        var ddthis = $(this);
        $.ajax({
            url: '{:U(close)}',
            data: {openid: openid},
            dataType:'json',
            success: function(res){
                if(res.status==1){
                    //alert(ddthis.parent().parent().parent().html());
                    ddthis.parent().parent().remove();
                }else{
                    alert(res.msg);
                }
            }
        });
    })
    
    //隐藏红点, 算是一个接口, 聊天窗口会调用
    function setHide(openid){
        if( $('#show_'+openid).length > 0 ){
            $('#show_'+openid).addClass('hide');
        }
        
    }
    
    function showHide(openid){
        
        if( $('#show_'+openid).length > 0 ){
            $('#show_'+openid).removeClass('hide');
        }else{
            $.ajax({
                url: '{:U("info")}',
                data:{openid: openid},
                dataType:'json',
                success: function(res){
                    if(res.status==1){
                        var html =  '<tr >'+
                                '<td class="custom" data-openid="'+res.data.openid+'" >'+
                                    '<img src="'+res.data.headimgurl+'" class="head">'+
                                    '<span class="nickname">'+res.data.nickname+'</span>'+
                                    '<span id="show_'+res.data.openid+'" title="有消息未回复" class="have-msg" ></span>'+
                                '</td>'+
                                '<td class="close"><span class="close_talk hide" title="关闭对话" data-id="'+res.data.openid+'" >X</span></td>'+
                            '</tr>';
                            
                        $("#custom_list").append(html);
                    }else{
                        
                    }
                }
            });
            
        }
    }


</script>

</body>
</html>