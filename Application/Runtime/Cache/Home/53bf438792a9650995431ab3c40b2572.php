<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>福星小区</title>

<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="apple-mobile-web-app-title" content="福星小区" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />
<link rel="apple-touch-icon-precomposed" href="__PUBLIC__/wx/default/image/logo.png" />

<meta name="keywords"  content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/wx/default/style/style.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js" ></script>
<script type="text/javascript" src="__PUBLIC__/js/easySlider1.7.js" ></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.lazyload.min.js" ></script>

<base target="_self" />
</head>
<body>

    <div class="top-container">
        <div class="avatar">
            <a href="/wx"><img src="__PUBLIC__/wx/default/image/logo.png" alt="头像" /></a>
        </div>
        <div class="account-info">
                <h1 class="name">福星小区</h1>
            <h2 class="desc">
                <a href="/wx/us/fllow" class="button-follow">+&nbsp;关注</a>
                <!--span class="button-follow-container"><a href=""><img src="__PUBLIC__/wx/default/image/info_32.png"></a></span-->
            </h2>
        </div>
    </div>
    
    

<!--div class="nav-sub-container">
    <div class="nav-sub-item current"><a href="/wx">综合</a></div>
    <div class="nav-sub-item " style="margin: 0 5%;"><a href="/wx/article/read">阅读排行</a></div>
    <div class="nav-sub-item "><a href="/wx/article/last">最新</a></div>
</div-->

<script type="text/javascript">
    $(function () {

        //event: "click",  
        // 配合timer进行定时加载  
        // event: "sporty",  
        // 提前多少像素(px)加载  
        // threshold : 200,  
        $("img.lazy").lazyload({
            effect: "fadeIn",
            threshold : 200,
            
        });
    });
</script>
<div class="list-container" id="list-container" >

    <?php if(is_array($list)): foreach($list as $key=>$val): ?><div class="article-item">
            <a href="<?php echo ($val["wxurl"]); ?>">
                <div class="item-cover">
                    <img src="/Public/wx/default/image/logo.png" data-original="<?php echo ($val["coverimg"]); ?>" title="<?php echo ($val["title"]); ?>" style="display: inline; height:76px;" class="lazy" >
                </div>
                <div class="item-text">
                    <div class="item-title"><?php echo ($val["title"]); ?></div>
                    <div class="item-content">
                        <div class="item-summary"><?php echo ($val["summary"]); ?></div>
                        <div class="item-timeline"><?php echo (date('n-d',$val["timeline"])); ?></div>
                    </div>
                </div>
            </a>
        </div><?php endforeach; endif; ?>

</div>

<div class="get-more" id="getmore">
    <?php if(($page["totalPages"] > 1)): ?><button id="get-newmore-btn" onclick="shownextpage(<?php echo ($page["nowPage"]); ?>)">显示下<?php echo ($page["listRows"]); ?>篇</button><?php endif; ?>
</div>

<script type="text/javascript">

    wx.ready(function () {
        var shareObject = {
            title: '福星小区',
            desc: '健康是你我共同的愿望，只要不放弃就有希望！ 您有任何关于癌症方面的问题都可以给我们留言，我们必将以最快的时间和最专业的素质为您答疑解惑！',
            imgUrl: 'http://<?php echo ($_SERVER['HOST']); ?>__PUBLIC__/wx/default/image/logo.png',
            link: ''
        }

        wx.onMenuShareAppMessage(shareObject);
        wx.onMenuShareTimeline(shareObject);
        wx.onMenuShareQQ(shareObject);
        wx.onMenuShareWeibo(shareObject);
    });
    
    //显示下一页内容
    function shownextpage(nowpage)
    {
        var apiurl = '/wx/index/page';
        var nextpage = nowpage+1;
        $.ajax({
            type: 'GET',
            url : apiurl,
            data: {p:nextpage},
            dataType: 'json',
            success: function(res){
                if(res.status==1){
                    
                    $.each(res.list, function(key,val){
                        var html = '<div class="article-item">'+
                            '<a href="'+val.wxurl+'">'+
                                '<div class="item-cover">'+
                                    '<img src="'+val.coverimg+'" title="'+val.title+'" style="display: inline; height: 76px;" class="lazy">'+
                                '</div>'+
                                '<div class="item-text">'+
                                    '<div class="item-title">'+val.title+'</div>'+
                                    '<div class="item-content">'+
                                        '<div class="item-summary">'+val.summary+'</div>'+
                                        '<div class="item-timeline">'+formatDate(val.timeline*1000)+'</div>'+
                                    '</div>'+
                                '</div>'+
                            '</a>'+
                        '</div>';
                
                        $('#list-container').append(html);
                        
                        
                    });
                    
                    if(res.page.nowPage>=res.page.totalPages){
                        $('#getmore').html('<button id="get-newmore-btn" >没有更多了</button>');
                    }else{
                        $('#getmore').html('<button id="get-newmore-btn" onclick="shownextpage('+res.page.nowPage+')">显示下'+res.page.listRows+'</button>');
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
        return   month+"-"+date;     
    }     

</script>


<!--公共底部-->


<div class="footer-retain"></div>
<!--div class="footer"><a href="/wx/us/company">版权归<strong style=" color: #44b549; margin: 0 2px; ">北京福星源道科技有限公司</strong>所有</a>&nbsp;&nbsp;&nbsp;&nbsp;</div-->
<div class="footer"><a >版权归<strong style=" color: #44b549; margin: 0 2px; ">北京福星源道科技有限公司</strong>所有</a>&nbsp;&nbsp;&nbsp;&nbsp; 京ICP备15018452号-2 </div>
<div class="footer-retain"></div>

<!--footer class="footer-toolbar">
    <div class="search-bar">
        <form action="" method="GET">
            <div class="side-txt">
                <input type="text" name="wd" class="side-txt-input" placeholder="搜索">
            </div>
            <div>
                <input type="submit" value="搜索" class="side-button">
            </div>
        </form>
    </div>
</footer-->


</body>
</html>