{// 引入标签库 }
<tagLib name="html" />
{// 加载头部公共文件 }
<include file="Public:header" />

<script type="text/javascript">
<!--
//指定当前组模块URL地址 
    var URL = '__ACTION__';
    var ROOT_PATH = '';
    var APP = '/index.php';
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
        <div class="fb-title"><div><p><span>消息 > 最新消息 </span></p></div></div>
        <div class="fb-body">
            <table class="body-table" cellpadding="0" cellspacing="1" border="0">
                <tr>
                    <td class="body-table-td">
                        <div class="body-table-div">
                            <script type="text/javascript" src="/Public/admin/js/dataList.js"></script>
                            <div class="handle-btns">
                                <!--div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="全选" onclick="CheckAll()" class="addAdmin"></p></div>
                                <div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
                                <div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this, 'checkList', 'id')" class="editAdmin"></p></div>
                                <div class="img-button "><p><input type="button" id="removeAdmin" name="removeAdmin" value="删除" onclick="removeData(this, 'checkList')" class="removeAdmin"></p></div>
                                <form action="/admin/index.php">
                                    <span>标题</span>
                                    <input class="textinput" type="text" value="" name="user_name" size="10" />
                                    <input class="submit_btn" type="submit" value="搜索" />
                                    <input type="hidden" name="m" value="User" />
                                    <input type="hidden" name="a" value="index" />
                                </form-->
                            </div>
                            
                            <div class="pager">{$page}</div>

                            <table id="checkList" class="table-list" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td height="5" colspan="8" class="topTd"></td>
                                    </tr>
                                    <tr class="row">
                                        <th>用户</th>
                                        <th>消息类型</th>
                                        <th>消息键</th>
                                        <th>消息值</th>
                                        <th>内容</th>
                                        <th>时间</th>
                                        <th>回复</th>
                                    </tr>
                                    <foreach name="list" item="val" >
                                        <tr class="row">
                                            <td><img src="{$val.headimgurl}" width="50" />{$val.nickname}</td>
                                            <td>{$val.msgtype}</td>
                                            <td>{$val.event}</td>
                                            <td>{$val.eventkey}</td>
                                            <td><if condition="$val['msgtype']=='image' && $val['url']!=null ">
                                                <img src='/{$val.url}' width='80' style='height:100px; overflow-y: hidden; '>
                                                <else />
                                                {$val.content}</td>
                                                </if>
                                            <td>{$val.createtime|date='Y-m-d H:i',###}</td>
                                            <td><a href="javascript:modifyData('{$val.id}')">回复</a></td>
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