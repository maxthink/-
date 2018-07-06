<include file="Public:header" />

<!--广告栏-->
    <div id="slider">
        <ul>
            <li><img src="__PUBLIC__/home/image/slider.png" alt="" /></li>
        </ul>
    </div>
    <div class="clearboth" ></div>
    
    <!--推荐-->
    <div id="business">
        <ul id="b_list">
            <foreach name="list" item="val">
            <li class="b_list">
                <a href="/Businesses/show/id/{$val.id}" >
                    <ul>
                        <li class="b_left"><img src="{$val.pic}" ></li>
                        <li class="b_right">
                            <ul class="b_right_txt">
                                <li class="t1">{$val.title}</li>
                                <li class="t2">{$val.address}<span></span></li>
                                <li class="t3">{$val.intro|msubstr=0,50}</li>  
                            </ul>
                        <li>
                    </ul>
                </a>
                <div class="clearboth"></div>
            </li>
            </foreach>

        </ul>
    </div>
    <div class="clearboth" ></div>

    <div id="more">
        <div id="more_page">
            {$page}
        </div>
    </div>
        
<include file="Public:footer" />
