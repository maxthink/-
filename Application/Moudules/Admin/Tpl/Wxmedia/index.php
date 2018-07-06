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
        <div class="fb-title"><div><p><span>图文素材 > 列表 </span></p></div></div>
        <div class="fb-body">
            <table class="body-table" cellpadding="0" cellspacing="1" border="0">
                <tr>
                    <td class="body-table-td">
                        <div class="body-table-div">
                            <script type="text/javascript" src="/Public/admin/js/dataList.js"></script>
                            <div class="handle-btns">
                                <div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="获取图文消息列表" onclick="getallmes()" class="addAdmin"></p></div>
                                <!--div class="img-button "><p><input type="button" id="addAdmin" name="addAdmin" value="添加" onclick="addData()" class="addAdmin"></p></div>
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
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>author</th>
                                        <th>简要</th>
                                        <th>封面</th>
                                        <th>所属分类</th>
                                        <th>发布时间</th>
                                        <th>操作</th>
                                    </tr>
                                    <foreach name="list" item="val" >
                                        <tr class="row">
                                            <td>{$val.id}</td>
                                            <td><a href="{$val.url}" target="_blank" >{$val.title}</a></td>
                                            <td>{$val.author}</td>
                                            <td>{$val.digst}</td>
                                            <td style="height:100px; overflow: hidden;" ><img width="100" src="/{$val.cover_dir|getimg=150}" /></td>
                                            <td>
                                                <?php foreach($atype as $type): ?>
                                                <?php if( $type['id'] & intval($val['type']) ){ echo '<span>'.$type['name'].'</span>'; } ?>
                                                <?php endforeach; ?>
                                                
                                                <a href="javascript:void(0)" class="type_choose" data-id="{$val.id}" data-type="{$val.type}" > 选择分类</a>
                                            </td>
                                            <td>{$val.update_time|date='Y-m-d H:i',###}</td>
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
    
    <div id="from_type">
        <form name="types" id="from_types" >
        <?php foreach($atype as $type): ?>
        <p><input type="checkbox" name="type[]" value="{$type.id}" id="type_{$type.id}" class="typeid" /><label for="type_{$type.id}" >{$type.name}</label><p>
        <?php endforeach; ?>
        <input type="hidden" name="id" id="from_id" />
        <p><span class="submit" onclick="sub()">OK<span/></p>
        </form>
    </div>
    
</body>
<script type="text/javascript">

    //显示分类选择框, 初始化数据
    $('.type_choose').click(function(){
        
        $('#from_type').css("top", $(this).offset().top + 30 );
        if( ( $('#from_type').offset().top + $('#from_type').height() ) > $(document).height()  ){
            $('#from_type').css("top",  $(document).height() - $('#from_type').height()   );
        }
        
        $('#from_type').css("left", $(this).offset().left + 30 );
        
        $('#from_id').val( $(this).attr('data-id') );
        
        var type = $(this).attr('data-type');
        
        $('.typeid').each(function(key,val){
            if( $(this).val() & type){
                $(this).attr('checked','true');
            }else{
                $(this).removeAttr("checked");
            }
        });
        
        $('#from_type').show();
        
    })
    
    function sub(){
        
        $.ajax({
            url: "{:U('settype')}",
            data: $('#from_types').serialize(),
            dataType:'json',
            success: function(res){
                if(res.status==1){
                    location.href = location.href;
                }else{
                    alert(res.msg);
                }
            }
        });
        
    }
    function getallmes()
    {
        $.ajax({
            url: "{:U('getallmes')}",
            dataType: 'json',
            success: function(res){
                if(res.status==1){
                    alert(res.msg);
                }else{
                    alert(res.msg);
                }
            }
        });

    }
</script>

<style>
    #from_type{ z-index:1000; position: absolute; display: none; width:300px; color:#000; border:1px solid #333; background-color: #fff; padding:5px;  }
    #from_type p {width:33%; float:left; font-size: 16px; text-align: inherit; }
    #from_type p .typeid { border:1px #333 solid; width:20px; height:20px; }
    #from_type p label { line-height: 28px; }
    #from_type .submit{width:100px; height:30px; line-height: 30px; text-align: center; background-color: #aaa; display: block; cursor: pointer; border:1px solid #ccc;  }
</style>
</html>