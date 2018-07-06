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
        <div class="fb-title"><div><p><span>消息 > 记录 </span></p></div></div>
        <div class="fb-body">
            <table class="body-table" cellpadding="0" cellspacing="1" border="0">
                <tr>
                    <td class="body-table-td">
                        <div class="body-table-div">
                            <script type="text/javascript" src="/Public/admin/js/dataList.js"></script>
                            <div class="handle-btns">
                                <!--div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="全选" onclick="CheckAll()" class="addAdmin"></p></div-->
                                <div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="获取全部用户" onclick="getalluser()" class="addAdmin"></p></div>
                                <!--div class="img-button "><p><input type="button" id="editAdmin" name="editAdmin" value="编辑" onclick="editData(this, 'checkList', 'id')" class="editAdmin"></p></div>
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
                                        <th>头像</th>
                                        <th>昵称</th>
                                        <th>备注</th>
                                        <th>性别</th>
                                        <th>国家/省/市</th>
                                        <th>扫码地</th>
                                        <th>所属分组</th>
                                        <th>关注时间</th>
                                        <th> </th>
                                        <th> </th>
                                    </tr>
                                    <foreach name="list" item="val" >
                                        <tr class="row">
                                            <td><if condition="$val.headimgurl != null"><a href="{:U('wxusermsg/index')}?openid={$val.openid}"><img src="{$val.headimgurl}" width="60"/></a></if></td>
                                            <td><a href="{:U('wxusermsg/index')}?openid={$val.openid}">{$val.nickname}</a></td>
                                            <td>{$val.remark}</td>
                                            <td>
                                                <switch name="val.sex" >
                                                    <case value="1">男</case>
                                                    <case value="2">女</case>
                                                    <default />未知
                                                </switch>
                                            </td>
                                            <td>{$val.country} / {$val.province} / {$val.city}</td>
                                            <td>{$val.areaname}</td>
                                            <td>
                                                <foreach name='atype' item='type'>
                                                    <if condition="$val.atype eq $type.id ">{$type.name}</if>
                                                </foreach>
                                            </td>
                                            <td>{$val.subscribe_time|date='Y-m-d H:i:s',###}</td>
                                            
                                            <td><a href="javascript:modifyData('{$val.id}')">备注</a></td>
                                            <td><a href="javascript:void(0)" onclick="getuserinfo({$val.id})" >获取用户信息</a></td>
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
    
    function getuserinfo(uid)
    {
        $.ajax({
            url: '/index.php?s=admin/wxuser/getuserinfo',
            data: {id:uid},
            dataType: 'JSON',
            success: function(res)
                        {
                            if(res.status==1){
                                location.href= location.href;
                            }else{
                                alert(res.msg);
                            }
                        }
        })
    }
    
    function getalluser()
    {
        $.ajax({
            url: '/index.php?s=admin/wxuser/getalluser',
            dataType: 'JSON',
            success: function(res)
                        {
                            alert(res.status);
                            if(res.status==1){
                                location.href= location.href;
                            }else{
                                alert(res.msg);
                            }
                        }
        })
    }
    
</script>
</html>