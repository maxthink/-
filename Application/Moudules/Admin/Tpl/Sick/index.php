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
        <div class="fb-title"><div><p><span>病人 > 列表 </span></p></div></div>
        <div class="fb-body">
            <table class="body-table" cellpadding="0" cellspacing="1" border="0">
                <tr>
                    <td class="body-table-td">
                        <div class="body-table-div">
                            <script type="text/javascript" src="/Public/admin/js/dataList.js"></script>
                            <div class="handle-btns">
                                    <!--div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="全选" onclick="CheckAll()" class="addAdmin"></p></div>
                                    <div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
                                    <div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this,'checkList','id')" class="editAdmin"></p></div>
                                    <div class="img-button "><p><input type="button" id="removeAdmin" name="removeAdmin" value="删除" onclick="removeData(this,'checkList')" class="removeAdmin"></p></div-->
                                
                            </div>

                            <table id="checkList" class="table-list" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td height="5" colspan="8" class="topTd"></td>
                                    </tr>
                                    <tr class="row">
                                        <th>ID</th>
                                        <th>姓名</th>
                                        <th>联系地址</th>
                                        <th>联系方式</th>
                                        <th>建档时间</th>
                                        <th>操作</th>
                                    </tr>
                                    <foreach name="list" item="val" >
                                    <tr class="row">
                                        <td>{$val.id}</td>
                                        <td>{$val.title}</td>
                                        <td>
                                            <foreach name='atype' item='type'>
                                                <if condition="$val.atype eq $type.id ">{$type.name}</if>
                                            </foreach>
                                        </td>
                                        <td>{$val.timeline|date='Y-m-d H:i',###}</td>
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

</script>
</html>