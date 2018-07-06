<include file="Public:header" />
<style>
body{ font-size:12px; font-family:"verdana,Arial";  margin:0px; padding:0px; color:#404040; }
.main{ text-align:center; height:30px; color:#333; line-height:30px; font-size:14px;}
body{background:#fff; font-size:12px; font-family:"verdana,Arial";  margin:0px; padding:0px; color:#404040;}
div{margin:0 auto; padding:0;}
h1,h2,h3,h4,h5,h6,ul,li,dl,dt,dd,form,img,p{margin:0; padding:0; border:none; list-style-type:none;}
a{ color:#4e6a81;}
a:hover{ color:#ff9600;}

#info{ position:absolute; right:2px; top:2px; border:#ccc 2px solid; padding:10px 5px; background:#fff; font-weight:bold; color:#f30; display:none;}

/*自动高对齐*/
.clearfix:after{content:"."; display:block; height:0; clear:both; visibility:hidden;}
*html .clearfix{ height:1%;}
*+html .clearfix{ height:1%;}

.blank5{ clear:both; height:5px; overflow:hidden; visibility:visible}
.blank10{ clear:both; height:10px; overflow:hidden; visibility:visible}

/* 公共样式 */
.button{
background:none repeat scroll 0 0 #4e6a81;
border-color:#dddddd #000000 #000000 #dddddd;
border-style:solid;
border-width:2px;
color:#FFFFFF;
cursor:pointer;
letter-spacing:0.1em;
overflow:visible;
padding:3px 15px;
width:auto;
cursor:pointer;
text-decoration:none;
}

.tip_span{ color:#ff9600;;}
.currentbtn{
background:none repeat scroll 0 0 #4e6a81;
border-color:#000000 #dddddd #dddddd #000000;
border-style:solid;
border-width: 2px 2px 2px 2px;
color:#FFFFFF;
cursor:pointer;
letter-spacing:0.1em;
overflow:visible;
padding:3px 15px;
width:auto;
cursor:pointer;
text-decoration:none;
}

.change_password{ width:450px;}
.textbox{ padding:4px; color:#666;}
.textarea{  font-size:12px; padding:4px; color:#666; width:300px; height:150px;}
.require{ border-left:#f30 solid 2px;}
.is_effect{ cursor:pointer;}

.page{ text-align:right; padding:5px 0px;}
.item_title{ text-align:right; width:130px; color:#000; background:#e2e8eb;}
.item_input{ text-align:left;}
.back_list{ font-size:12px; font-weight:normal; }
#set_sort{ border:#ccc solid 1px; font-size:12px; padding:4px; color:#666; width:20px;}

/* 提示消息 */
.message{ width:400px; padding-top:100px; }
.message table{ width:100%;}
.message td{ text-align:center; padding:5px 0px;}
.title_row{ font-size:14px; font-weight:bold; padding:10px 0px;;}
.message_row{ font-size:12px; color:#f30; font-weight:bold; padding:10px 0px; }

.main{ padding:10px; }
.main_title{ border:#ccc solid 1px; background:#D2DBEA; color:#fff; padding:5px 15px; font-size:14px; font-weight:bolder;}
.search_row{ border:#ccc solid 1px; background:#D2DBEA; color:#fff; padding:5px 15px; font-size:14px; font-weight:bolder;}

/* 数据表 */
.dataTable{ width:100%; border-top:#ccc solid 1px; border-left:#ccc solid 1px; background:#fff;}
.dataTable th{ height:25px; text-align:center; background:#edf3f7; line-height:25px;  border-right:#ccc solid 1px; border-bottom:#ccc solid 1px;}
.dataTable td{ padding:5px; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px;}
.dataTable td.topTd, .dataTable td.bottomTd{ padding:0px;  height:5px; font-size:0px; line-height:0px;}


table.form{ width:100%; border-top:#ccc solid 1px; font-size:14px; border-left:#ccc solid 1px; background:#fff;}
table.form th{ height:25px; text-align:center; background:#edf3f7; line-height:25px;  border-right:#ccc solid 1px; border-bottom:#ccc solid 1px;}
table.form td{ height:30px; line-height:30px; padding:5px; border-right:#ccc solid 1px; border-bottom:#ccc solid 1px;}
table.form .topTd, table.form .bottomTd{ height:5px; font-size:0px; padding:0px;}

table.access_list td{ padding:8px; border:none; border-bottom:dotted 1px #ccc;}
table.access_list td label{ display:inline-block; padding:0px 10px;}
table.access_list td.access_left{ border-right:dotted 1px #ccc; text-align:right;}


table.form .ke-container { border:1px solid #ccc; padding:0px;}
table.form .ke-content { border:0px; padding:0px;}
table.form .ke-container td,.ke-container th{ padding:0px; border:0px; }
table.form .ke-bottom{ border:0px; padding:0px;}
table.form .ke-bottom td,table.form .ke-bottom th{ border:0px; padding:0px;}

.none_border table.ke-container { border:0px solid #ccc; padding:0px; background:#fff;}
.none_border table.ke-content { border:0px; padding:0px;}
.none_border table.ke-container td,.ke-container th{ padding:0px; border:0px; }
.none_border table.ke-bottom{ border:0px; padding:0px;}
.none_border table.ke-bottom td,table.form .ke-bottom th{ border:0px; padding:0px;}
.none_border table{ border:0px;}

#region_conf div{ padding:5px 0px;}
.cfg_title{ display:inline-block; float:left; width:100px;}
.cfg_content{ display:inline-block; float:left; }
table.no_border td{ border:0px;}

#filter_row{ display:none; }

.topic_image{ width: 100px; height:100px; overflow:hidden; position:relative; float:left; border:#ccc solid 1px; display:inline-block; margin:5px;}
.topic_image img{ width:98px; height:98px;}
.topic_image span{ position:absolute; width:20px; height:20px; background:#f30; text-align:center; line-height:20px; border:#fff solid 1px; color:#fff; left:2px; top:2px; cursor:pointer;}


.SHOW_YOUHUI_ADV{ display:none}
</style>
<div class="main">
	<div class="main_title">网站管理平台 首页	</div>
	<div class="blank5"></div>
	<table class="form" cellpadding="0" cellspacing="0">
		<tbody><tr>
			<td colspan="2" class="topTd"></td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				当前版本			</td>
			<td class="item_input">
				系统版本:1.2 <span id="version_tip"></span>
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				时间信息			</td>
			<td class="item_input">
				系统当前时间： <span id="clock"></span></td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				总注册会员数			</td>
			<td class="item_input">				
				0人			</td>
		</tr>
		
		
		
	</tbody></table>	
	</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="ajax-loading"></div>
</body>
<script type="text/javascript">
jQuery(function($){
	updateBodyDivHeight();
	$(window).resize(function(){
		updateBodyDivHeight();
	});
});

function updateBodyDivHeight()
{
	jQuery(".body-table-div").height(jQuery(".fanwe-body").height() - 36);
	if(jQuery(".body-table-div").get(0).scrollHeight > jQuery(".body-table-div").height())
	{
		var width = jQuery(".body-table-div").width() - 16;
		jQuery(".body-table-div > *").each(function(){
			if(!$(this).hasClass('ajax-loading'))
			{
				$(this).width(width)	
			}
		});
	}
}

var timestamp = {$Think.NOW_TIME};
function gettime(){
return new Date(parseInt(timestamp) * 1000).toLocaleString(); 
}
function showtime(){
timestamp++;
document.getElementById('clock').innerHTML = gettime();
setTimeout('showtime()',1000);
}
showtime();


</script>
</html>