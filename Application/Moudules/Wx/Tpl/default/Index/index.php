<include file="Public:header" />

<div class="list-container" id="list-container" >

    <foreach name="list" item="val">

        <div class="product-item">
            <a href="{$val.url}">
                <div class="item-cover">
                    <img src="/Public/wx/default/image/logo.png" data-original="" title="{$val.title}" style="display: inline; height:76px;" class="lazy" >
                </div>
                <div class="item-text">
                    <div class="item-title">{$val.title}</div>
                    <div class="item-content">
                        <div class="item-summary">{$val.summary}</div>
                        <div class="item-timeline">{$val.update_time|date='n-d',###}</div>
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
    
    

</script>

<include file="Public:footer" />
