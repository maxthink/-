{// 引入标签库 }
<tagLib name="html" />
{// 加载头部公共文件 }
<include file="Public:header" />

<script type="text/javascript">
<!--
//指定当前组模块URL地址
var URL = '__ACTION__';
var ROOT_PATH = '';
var APP	 =	 '/index.php';
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
</head>
<body>
    <div class="cw-body">
        <div class="fb-title"><div><p><span>产品 > 列表 </span></p></div></div>
        <div class="fb-body">
            <table class="body-table" cellpadding="0" cellspacing="1" border="0">
                <tr>
                    <td class="body-table-td">
                        <div class="body-table-div">
                            <script type="text/javascript" src="/admin/Tpl/Default/Static/Js/dataList.js"></script>
                            <div class="handle-btns">
                                    <div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
                                    <div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this,'checkList','uid')" class="editAdmin"></p></div>

                            </div>
                            <table id="checkList" class="table-list" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td height="5" colspan="8" class="topTd"></td>
                                </tr>
                                <tr class="row">
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>描述</th>
                                    <th>发布时间</th>
                                    <th>是否可用</th>
                                    <th>操作</th>
                                </tr>
                                <foreach name="list" item="val" >
                                <tr class="row">
                                    <td>{$val.id}</td>
                                    <td>{$val.name}</td>

                                    <td>{$val.intro}</td>

                                    <td>{$val.time|date='Y-m-d H:i',###}</td>
                                    <td>
                                        <if condition="$val.status eq 1 ">
                                            <img src="/Public/admin/images/status-1.gif" border="0" alt="正常" onclick="getStatus()">
                                        <else />
                                            <img src="/Public/admin/images/status-0.gif" border="0" alt="正常" onclick="getStatus()">
                                        </if>
                                    </td>
                                    <td><a href="javascript:modifyData('{$val.id}')">编辑</a></td>
                                </tr>
                                </foreach>
                            </tbody>
                        </table>
                        <div class="pager">{$page}</div>

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
	jQuery(".body-table-div").height(jQuery(".cw-body").height() - 36);
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
</script>
</html>