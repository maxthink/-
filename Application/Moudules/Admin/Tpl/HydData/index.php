{// 引入标签库 }
<tagLib name="html" />
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
</head>
<body>
    <div class="cw-body">
        <div class="fb-title"><div><p><span>化验数据 > 列表 </span></p></div></div>
        <div class="fb-body">
            <table class="body-table" cellpadding="0" cellspacing="1" border="0">
                <tr>
                    <td class="body-table-td">
                        <div class="body-table-div">
                            <script type="text/javascript" src="/Public/admin/js/dataList.js"></script>
                            <div class="handle-btns">
                                    <!--div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="全选" onclick="CheckAll()" class="addAdmin"></p></div-->
                                    <!--div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div-->
                                    <!--div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this,'checkList','id')" class="editAdmin"></p></div>
                                    <div class="img-button "><p><input type="button" id="removeAdmin" name="removeAdmin" value="删除" onclick="removeData(this,'checkList')" class="removeAdmin"></p></div-->
                                
                            </div>

                            <table id="checkList" class="table-list" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td height="5" colspan="8" class="topTd"></td>
                                    </tr>
                                    <tr class="row">
                                        <th>ID</th>
                                        <!--th>医院ID</th-->
                                        <th>医院名称</th>
                                        <th>检测项目</th>
                                        <th>客户端编号</th>
                                        <th>检测时间</th>
                                        <th>ip</th>
                                    </tr>
                                    <foreach name="list" item="val" >
                                    <tr class="row">
                                        <td>{$val.id}</td>
                                        <!--td>{$val.hid}</td-->
                                        <td>{$val.name}</td>
                                        <td><?php switch($val['machineType']){
                                                 case 1: echo "糖化"; break;
                                                 case 2: echo '同型'; break;
                                                 case 3: echo '胶体金'; break;
                                                 case 4: echo '血流变'; break;
                                                 case 5: echo '铁蛋白'; break;
                                                 } ?></td>
                                        <td>{$val.g_id}</td>
					<td>{$val.ttrue}</td>
                                        <td>{$val.ip}</td>
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

</script>
</html>