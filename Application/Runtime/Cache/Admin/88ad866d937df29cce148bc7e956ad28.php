<?php if (!defined('THINK_PATH')) exit();?>

<html>
<head>
<meta charset="utf-8">
<title></title>
<link href="__PUBLIC__/admin/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/Base.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/CheckForm.js"></script>

<script type="text/javascript">
<!--
//指定当前组模块URL地址 
    var URL = '__ACTION__';
    var ROOT_PATH = '';
    var APP = '/';
    var STATIC = '/admin/Tpl/Default/Static';
    var VAR_MODULE = 'm';
    var VAR_ACTION = 'a';
    var CURR_GROUP = '<?php echo (GROUP_NAME); ?>';
    var CURR_MODULE = '<?php echo (MODULE_NAME); ?>';
    var CURR_ACTION = '<?php echo (ACTION_NAME); ?>';

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
        <div class="fb-title"><div><p><span>文章 > 列表 </span></p></div></div>
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
                                        <th>标题</th>
                                        <th>所属分类</th>
                                        <th>发布时间</th>
                                        <th>是否可用</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php if(is_array($list)): foreach($list as $key=>$val): ?><tr class="row">
                                        <td><?php echo ($val["id"]); ?></td>
                                        <td><?php echo ($val["title"]); ?></td>
                                        <td>
                                            <?php if(is_array($atype)): foreach($atype as $key=>$type): if($val["atype"] == $type["id"] ): echo ($type["name"]); endif; endforeach; endif; ?>
                                        </td>
                                        <td><?php echo (date('Y-m-d H:i',$val["timeline"])); ?></td>
                                        <td>
                                            <?php if($val["status"] == 1 ): ?><img src="/Public/admin/images/status-1.gif" border="0" alt="正常" onclick="getStatus()">
                                            <?php else: ?>
                                                <img src="/Public/admin/images/status-0.gif" border="0" alt="正常" onclick="getStatus()"><?php endif; ?>
                                        </td>
                                        <td><a href="javascript:modifyData('<?php echo ($val["id"]); ?>')">编辑</a></td>
                                    </tr><?php endforeach; endif; ?>
                                </tbody>
                            </table>
                            <div class="pager"><?php echo ($page); ?></div>
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