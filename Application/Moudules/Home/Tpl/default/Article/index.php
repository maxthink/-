<include file="Public:header" />

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

    <foreach name="list" item="val">

        <div class="article-item">
            <a href="{$val.wxurl}">
                <div class="item-cover">
                    <img src="/Public/wx/default/image/logo.png" data-original="{$val.coverimg}" title="{$val.title}" style="display: inline; height:76px;" class="lazy" >
                </div>
                <div class="item-text">
                    <div class="item-title">{$val.title}</div>
                    <div class="item-content">
                        <div class="item-summary">{$val.summary}</div>
                        <div class="item-timeline">{$val.timeline|date='n-d',###}</div>
                    </div>
                </div>
            </a>
        </div>

    </foreach>

</div>

<div class="get-more" id="getmore">
    <if condition="($page.totalPages gt 1)" >
        <button id="get-newmore-btn" onclick="shownextpage({$page.nowPage})">显示下{$page.listRows}篇</button>
    </if>
</div>

<script type="text/javascript">

    wx.ready(function () {
        var shareObject = {
            title: '福星小区',
            desc: '健康是你我共同的愿望，只要不放弃就有希望！ 您有任何关于癌症方面的问题都可以给我们留言，我们必将以最快的时间和最专业的素质为您答疑解惑！',
            imgUrl: 'http://{$Think.server.host}__PUBLIC__/wx/default/image/logo.png',
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
        var apiurl = '/wx/article/page';
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

<include file="Public:footer" />
