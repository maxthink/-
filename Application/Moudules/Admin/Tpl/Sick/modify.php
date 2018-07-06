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
<link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css">
<script charset="utf-8" src="__PUBLIC__/uploadify/jquery.uploadify.min.js"></script>

<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/zh_CN.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/kindeditor/prettify.js"></script>
<script charset="utf-8" src="__PUBLIC__/admin/js/wdatepicker/WdatePicker.js"></script>
<script type="text/javascript" >
    KindEditor.ready(function (K) {
        var editor1 = K.create('textarea[name="content"]', {
            //cssPath: '__PUBLIC__/admin/js/kindedit/prettify.css',
            uploadJson: '__PUBLIC__/kindeditor/upload_json.php',
            fileManagerJson: '__PUBLIC__/kindeditor/file_manager_json.php',
            allowFileManager: true,
            afterCreate: function () {
                var self = this;
                K.ctrl(document, 13, function () {
                    self.sync();
                    K('form[name=form1]')[0].submit();
                });
                K.ctrl(self.edit.doc, 13, function () {
                    self.sync();
                    K('form[name=form1]')[0].submit();
                });
            }
        });
        prettyPrint();
    });</script>
</head>
<div class="cw-body">
    <div class="fb-title"><div><p><span>文章 > 编辑</span></p></div></div>
    <div class="fb-body">
        <form method='post' id="form1" name="form1" action="{:U(MODULE_NAME.'/modify')}">
            <table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr>
                    <th width="200">编号</th>
                    <td><p>{$vo.id}</p></td>
                </tr>
                <tr>
                    <th  width="200">标题</th>
                    <td><input type="text"  name="title"  value="{$vo.title}" style="width:300px;font-size: 18px;" /></td>
                </tr>
                
                <tr>
                    <th>封面图片<div style="text-align:left; width:80px; margin:10px 0 0 120px; "><input id="file_upload" type="file"></div></th>
                    <td>
                        <div id="uploaded">
                            <if condition="($vo.coverimg != '')">
                                <img src="{$vo.coverimg}" />
                                <input type="hidden" name="coverimg" value="{$vo.coverimg}">
                            </if>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th  width="200">简介</th>
                    <td><textarea type="text"  name="summary"  style="width:600px; height:80px; font-size: 16px; " />{$vo.summary}</textarea></td>
                </tr>

                <tr>
                    <th  width="200">所属分类</th>
                    <td><select name="atype" >
                            <?php foreach($atype as $type){ ?>
                            <option value="<?php echo $type['id']; ?>" <?php if($type['id']==$vo['atype']) echo 'selected'; ?> >{$type.name}</option>
                            </foreach>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th  width="200">微信地址</th>
                    <td>
                        <textarea type="text"  name="wxurl"  style="width:800px; height:50px; font-size: 16px; " />{$vo.wxurl}</textarea>
                        <if condition="$vo.wxurl != ''" >
                            <a href="{$vo.wxurl}" target="_blank">{$vo.wxurl}</a>
                        </if>
                    </td>
                </tr>
                
                <tr>
                    <th  width="200">内容</th>
                    <td><textarea  name="content" id="content" cols="50" rows="10" style="width:900px;height:500px;visibility:hidden;">{$vo.content}</textarea></td>
                </tr>
                
                <tr>
                    <th  width="200">发布时间{$vo.timeline|date='y-m-d'}</th>
                    <td><input class="Wdate" type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" name="timeline"  value="{$vo.timeline|date='Y-m-d H:i',###}" /></td>
                </tr>

                <tr>
                    <th>状态</th>
                    <td>
                        上线<input type="radio"  name="status" value="1" <if condition="($vo.status eq 1)"> checked</if> />
                        下线<input type="radio"  name="status" value="0" <if condition="($vo.status eq 0)"> checked</if> />
                    </td>
                </tr>
                <tr class="act">
                    <th>&nbsp;</th>
                    <td>
                        <input type="hidden" name="id" id="aid" value="{$vo.id}"/>
                        <input type="hidden" name="subflag" value="1"/>
                        <input type="submit" class="submit_btn" value="确定" />
                        <input type="button" class="submit_btn" value="取消" onclick="javascript:history(-1);"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div id="cover" style="position:fixed; left:50%; top:50%; margin-left:-250px; margin-top:-100px; width:500px; height:200px; z-index: 999; background-color: #999; opacity: 0.9; display:none; ">
    <div>
        
        <tr>
            <th  width="200">标题</th>
            <td><input type="text"  name="title"  value="{$vo.title}" style="width:300px;font-size: 18px;" /></td>
        </tr>
    
    </div>
</div>
<script type="text/javascript">
    

    var t = $("#aid");
    if( t.val() == '' )
    {
        $("#cover").show();
    }else
    {
            
        var ID = t.val();

        $("#file_upload").uploadify({

            'swf': '/Public/uploadify/uploadify.swf',
            'formData' : {'module' : CURR_MODULE, 'id' : ID },
            'uploader': '/admin/article/uploadimg',
            //'buttonImg': '/Public/uploadify/browseBtn.png',//替换上传钮扣
            'buttonText': '选择图片', //通过文字替换钮扣上的文字
            'cancelImg': '/Public/uploadify/uploadify-cancel.png', //单个取消上传的图片
            //'script': '/admin/public/uploadimg', //实现上传的程序
            'auto': true, //自动上传
            'multi': true, //是否多文件上传
            //'checkScript': 'js/check.php',//验证 ，服务端的
            'displayData': 'speed', //进度条的显示方式
            //'fileDesc': 'Image(*.jpg;*.gif;*.png)',//对话框的文件类型描述
            'fileExt': '*.jpg;*.jpeg;*.gif;*.png', //可上传的文件类型
            'sizeLimit': 1024 * 1024, //限制上传文件的大小
            //'simUploadLimit' :3, //并发上传数据 
            'queueSizeLimit': 1, //可上传的文件个数
            'width': 80, //buttonImg的大小
            'height': 24, //
            //'rollover': true,//button是否变换
            'onUploadSuccess': function (file, data, response) {

                if (response == true) {
                    var res = eval('(' + data + ')');
                    getResult(res);
                } else {
                    alert('文件上传出错');
                }
            },
            'onError': function (errorObj) {
                alert(errorObj.info + " " + errorObj.type);
            }
        });
    
    }

//图片上传成功, 处理结果
    function getResult(res) {
        //alert('状态:'+res.status +' 图片名:'+ res.imgname);
        if (res.status == 1)
        {
            //quxiao();
            var html = '<img width="150" src="' + res.imgname + '" /><input type="hidden" id="coverimg" name="coverimg" value="' + res.imgname + '" /><>';
            $('#uploaded').html(html);
        }
        else if (res.status == 0)
        {
            alert('图片上传成功,但服务器处理出错, 错误原因: ' + res.error);
        }
    }

//取消图片
    function quxiao()
    {
        var imgdata = $('#coverimg').val();
        $.ajax({
            url: '/admin/article/delimg',
            data: {'img': imgdata},
            success: function (res) {
                $('#uploaded').html('');
            },
            error: function () {
                alert('图片删除出错');
            }
        });
    }

</script>
<include file="Public:footer" />