<include file="Public:header" />
<script type="text/javascript" src="/script/jquery.masonry.min.js"></script>
<div class="continer">
	<div class="feil_left">
		<ul class="mh_tabs" id="m_sample_01_tabs">
			<foreach name="cate" item="vo">
				<h3><i>{$vo.name_en}</i>{$vo.name}</h3>
				<if condition="isset($vo['sub'])" >
				<foreach name="vo.sub" item="sub">
					<li><a  href="/category/{$sub.id}"  >{$sub.name} {$sub.name_en}</a></li>
				</foreach>
				</if>
			</foreach>
	
		</ul>
	</div>
	
	<div class="feil_c" id="product_list">
		<ul class="image_list" >
			<foreach name="list" item="vo">
			<li class="item">
				<div class="image">
					<a href="{:U(MODULE_NAME.'/'.$vo['id'])}"  >
						<img src="{$vo.img}" width="270" />
					</a>
				</div>
				<div class="txt">
					<a href="{:U(MODULE_NAME.'/'.$vo['id'])}" >{$vo.intro}</a>
				</div>
			</li>
			</foreach>
		</ul>
	</div>
	
	<div class="feil_right">
		<ul>
			<foreach name="ad" item="vo">
			<li>
				<if condition="$vo.img != ''">
				<div class="image"><a href="{$vo.link}" ><img src="image/4.jpg" width="150" height="150" /></a></div>
				</if>
				<div class="text"><a href="{$vo.link}" >{$vo.title}</a></div>
			</li>
			</foreach>
		</ul>
	</div>
	
</div>
<script type="text/javascript">

$(document).ready(function(){
	///*

	//alert($(".image_list").width());
	//alert($(".image_list").height());
	var $container = $(".image_list");
	$container.masonry({
	  // options
	  columnWidth: 290,
	  itemSelector: '.item',
	  animate: true,
	});
	//*/
	$(".image_list li").mouseenter(function(){
		$(this).find(".txt").css("display","block");
	});
	$(".image_list li").mouseleave(function(){
		$(this).find(".txt").css("display","none");
	});
});
</script>
<include file="Public:footer" />
