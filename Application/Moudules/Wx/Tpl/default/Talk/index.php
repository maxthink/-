<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="__PUBLIC__/admin/style/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" />
    <script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
    <script charset="utf-8" src="__PUBLIC__/uploadify/jquery.uploadify.min.js"></script>
</head>
<body>
    <div id="talk" style="width:100%; overflow-y: scroll; border: 1px solid #000">
        
        <div class="get-more" id="getmore">
            <!-- 更多消息 -->
        </div>
        
        <div id="msg-content">
            <ul id="msg">
                <!-- 消息 -->
                
            </ul>
        </div>
    </div>
    <input type='hidden' id='lastid' value='{$lastid}' />
    <input type="hidden" id="headimg" value="{$user.headimgurl}">
    <input type="hidden" id="nickname" value="{$user.nickname}">
        
    <form id='from1' name='from1' style='bottom:10px;position: fixed; '>
        <textarea style='width:400px; height:90px; font-size: 16px;display: block; float: left;' name='content' id='content' ></textarea>
        <input name='kfid' id="kfid" type='hidden' value='{$kfid}' />
        <input name='openid' id="openid" type='hidden' value='{$user.openid}' />
    </form>
        
    <input id="sendimage" type="file">
        
    <span id='send' >发送 (enter)</span>

</body>
<script type="text/javascript" >
    
    var openid = $('#openid').val();
    var kfid = $('#kfid').val();
        
    //发送图片消息
    $("#sendimage").uploadify({
        
        
        'swf': '/Public/uploadify/uploadify.swf',
        //'formData' : $('#from1').serialize(),
        'formData' : {openid:openid,kfid:kfid},
        'uploader': "{:U('kf/sendImage')}",
        //'buttonImg': '/Public/uploadify/browseBtn.png',//替换上传钮扣
        'buttonText': '图片', //通过文字替换钮扣上的文字
        //'cancelImg': '/Public/uploadify/uploadify-cancel.png', //单个取消上传的图片
        //'script': '/admin/public/uploadimg', //实现上传的程序
        'auto': true, //自动上传
        'multi': true, //是否多文件上传
        //'checkScript': 'js/check.php',//验证 ，服务端的
        'displayData': 'speed', //进度条的显示方式
        //'fileDesc': 'Image(*.jpg;*.gif;*.png)',//对话框的文件类型描述
        'fileExt': '*.jpg;*.jpeg;*.gif;*.png', //可上传的文件类型
        'sizeLimit': 1024 * 1024, //限制上传文件的大小
        //'simUploadLimit' :3, //并发上传数据 
        'queueSizeLimit': 1, //可上传的文件个数
        'width': 80, //buttonImg的大小
        'height': 24, //
        //'rollover': true,//button是否变换
        'onUploadSuccess': function (file, data, response) {

            if (response == true) {
                var res = eval('(' + data + ')');
                replayImageOk(res);
            } else {
                alert('文件上传出错');
            }
        },
        'onError': function (errorObj) {
            alert(errorObj.info + " " + errorObj.type);
        }
    });
        
        
    //发送消息
    $('#send').click(function(){
        
        if($("#content").val().length ==0){
            alert('内容不可为空');
            return;
        }
        $.ajax({
            type: 'POST',
            url: "{:U('kf/sendMsg')}",
            data: $('#from1').serialize(),
            dataType: 'json',
            success: function(re){
                if(re.status==1){
                    replayTextOk();
                    $("#lastid").val(re.inid);  //更新最后一条消息记录id
                    autoButtom();
                }else{
                    alert('error');
                }
            }
        });
    });
    
    //回复ok
    function replayTextOk(){
        var timestamp = (new Date()).valueOf();
        var head = '<p class="server" >客服 '+ formatDate(timestamp)+'</p>';
        var html = '<li>'+ head+ '<span class="content_text">'+$("#content").val()+'</span> </li>';
        $('#msg').append(html);
        $("#content").val('');
        
        window.parent.frames["leftFrame"].setHide( $('#openid').val() );
        
    }
    
    //回复 image ok
    function replayImageOk(res){
        if(res.status==1){
            var timestamp = (new Date()).valueOf();
            var head = '<p class="server" >客服 '+ formatDate(timestamp)+'</p>';
            var html = '<li>'+ head+ '<img src="/'+res.image+'" width="300" /> </li>';
            $('#msg').append(html);
            $("#content").val('');

            window.parent.frames["leftFrame"].setHide( $('#openid').val() );
        }
    }
    
    //历史消息显示处理
    function shownextpage(nowpage)
    {
        var apiurl = "{:U('page','openid='.$openid)}";
        var nextpage = nowpage+1;
        $.ajax({
            type: 'GET',
            url : apiurl,
            data: {p:nextpage},
            dataType: 'json',
            success: function(res){
                if(res.status==1){
                    
                    var head = '';
                    var con = '';
                    var nickname = $('#nickname').val();
                    $.each(res.list, function(key,val){
                        
                        if(val.openid== $("#openid").val() )
                        {
                            if(val.msgid==0){
                                head = '<p class="server" >客服 '+ formatDate(val.createtime*1000)+'</p>';
                                switch(val.msgtype)
                                {
                                    case 'text':
                                        con = '<span style="color: #000; font-size: 16px; margin:5px; ">' + val.content+'</span>';                            
                                        break;
                                    case 'image':
                                        con = '<img src="/'+val.dir+'" width="300" />';
                                        break;
                                    default:

                                }
                                
                            }else{
                                head = '<p style="color: #0055FF; font-size: 10px; margin-top: 5px; ">'+ nickname +' '+ formatDate(val.createtime*1000)+'</p>';
                                switch(val.msgtype)
                                {
                                    case 'text':
                                        con = '<span style="color: #000; font-size: 16px; margin:5px; ">'+ val.content+'</span>';                                
                                        break;
                                    case 'image':
                                        con = '<img src="/'+val.dir+'" width="300" />';
                                        break;
                                    default:

                                }
                            }
                            var html = '<li>'+ head + con + '</li>';
                            con = ''; //初始化, 以防下次循环没有内容而导致重复输出.

                            $('#msg').prepend(html);
                        }
                    });
                    
                    autoButtom();
                    
                    if(res.page.nowPage>=res.page.totalPages){
                        $('#getmore').html('<button id="get-newmore-btn" >没有更多了</button>');
                    }else{
                        $('#getmore').html('<button id="get-newmore-btn" onclick="shownextpage('+res.page.nowPage+')">显示更多历史消息</button>');
                    }
                }
            }
        });
    }
    
    //格式化时间戳
    function   formatDate(timeline)   {
        var   now = new   Date(timeline);     
        var   year=now.getYear();     
        var   month=now.getMonth()+1;     
        var   date=now.getDate();     
        var   hour=now.getHours();     
        var   minute=now.getMinutes();     
        var   second=now.getSeconds();     
        return   year+"-"+month+"-"+date+" "+hour+":"+minute+":"+second;     
    }
    
    //初始化查询最后一页记录
    shownextpage(0);
/*------------------------------监测窗口变化  ----------------------------*/
    $(window).resize(function(){
            updateTalkHeight();
    });
    
    function updateTalkHeight()
    {
        $("#talk").height( $(window).height() -130 );
        //console.log(h);
    }
    
    updateTalkHeight(); //打开窗口时, 先规划下窗口大小

/*------------------------------监测窗口变化  ----------------------------*/    
    
    
    
    //-------------------------------  通信 -----------------------------------//
    
    //请求客服所有消息
    function getAllMsg(){
        var timestamp = (new Date()).valueOf();
        //console.log("getAllMsg "+timestamp );
        lastid = $('#lastid').val();
        //if(lastid==0) return;  // 没有消息, 
        $.ajax({
            url : "{:U('talk/allmsg')}",
            data : {lastID:lastid},
            dataType: 'json',
            success: function(res){
                if(res.status==1){  //do 有新消息
                    var lastid = $("#lastid").val()
                    var head = '';
                    var con = '';
                    var nickname = $('#nickname').val();
                    
                    $.each(res.data, function(key,val){
                        
                        //是本客服的消息才能处理, 不是不处理
                        if(val.kfid== $("#kfid").val() && val.openid== $('#openid').val() )
                        {
                            if(val.msgid==0){
                                head = '<p class="server" >客服 '+ formatDate(val.createtime*1000)+'</p>';
                                con = '<span class="content_text" >'+ val.content+'</span>';       
                            }else{
                                head = '<p class="custom" >'+ nickname +' '+ formatDate(val.createtime*1000)+'</p>';
                                switch(val.msgtype)
                                {
                                    case 'text':
                                        con = '<span class="content_text" >'+ val.content+'</span>';                                
                                        break;
                                    case 'image':
                                        con = '<img src="/'+val.dir+'" width="300" />';
                                        break;
                                    default:

                                }
                            }
                            var html = '<li>'+ head + con + '</li>';

                            $('#msg').append(html);
                            
                        }else if( val.kfid== $("#kfid").val() ){
                            //别的用户有新消息了
                            window.parent.frames["leftFrame"].showHide( val.openid );
                        }
                        
                        $("#lastid").val(val.id);  //更新最后一条消息记录id    ,必须加啊
                        autoButtom();
                    });
                    setTimeout("getAllMsg()",5000);   //不用 setInterval, 因为是要等异步处理完再去请求下一个
                    
                }else if(res.status==2){
                    setTimeout("getAllMsg()",10000);   //没有更多消息, 延迟变长
                }else if(res.status==0){
                    location.href = location.href;  //出错, 应该是没有参数原因
                }
                
            },
            error: function(){
                setTimeout("getAllMsg()",20000);    //错误, 就减轻服务器压力
            }
            
        })
    }
    
    setTimeout("getAllMsg()",5000);
    //-------------------------------  通信 -----------------------------------//


//-------------------------------  滚动条自动到最底部 -----------------------------------//
  //原生代码实现滚动条自动到最底部
    function autoButtom()
    {
        var lct = $('#talk');
        lct.scrollTop( $("#msg-content").height()+$("#getmore").height()-$("#talk").height()+40 );
        
    }
    
    //测试滚动条位置用的.
//    var lct = $('#talk');
//    $("#talk").scroll(function() {
//        $('#kk').text( ' '+ $("#msg-content").height()+" "+ $("#getmore").height()+ ' ' + $("#talk").height()+' '  );
//        $('#kk').append( lct.scrollTop() );
//    });
                
//-------------------------------  滚动条自动到最底部 -----------------------------------//
</script>
<style>
    body{overflow-y: hidden; }
    #talk{min-width: 600px;}
    #msg-content{padding:20px; }
    #sendimage{ position: absolute; margin-left: 414px;  margin-top: 40px; }
    #send{display: block; width: 100px; height: 33px; text-align: center; line-height: 36px; border:1px #440 solid; background-color: #EEEEDD; float: left; margin-top:66px; margin-left:414px; cursor: pointer; }
    .server{color: #01AA0A; font-size: 10px; margin-top: 5px;}
    .custom{color: #0055FF; font-size: 10px; margin-top: 5px;}
    .content_text{ color: #000; font-size: 16px; margin:5px;}
    
</style>

<span id="kk"></span>
</html>