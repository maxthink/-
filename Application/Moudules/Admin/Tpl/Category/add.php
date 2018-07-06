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
<div class="cw-body">
    <div class="fb-body">
        <div class="fb-title">
            <div><p><span>{$Think.const.MODULE_NAME} > {$Think.const.ACTION_NAME} </span></p></div>
        </div>
        <form method='post' id="form" name="form" action="{:U(MODULE_NAME.'/add')}</if>">
            <table cellpadding="4" cellspacing="0" cellspacing="1"  border="0" class="table-form">
                <tr <if condition="($Think.const.ACTION_NAME eq 'add')">style="display:none;"</if> >
                    <th width="200">编号</th>
                    <td><p>{$vo.id}</p></td>
                </tr>
                <tr>
				<th  width="200">上级类别</th>
                    <td>
                        <select name="pid">
                            <option value ="0">顶级</option>
                            <volist name='pcategory' id='v'>
                                <option value ="{$v.id}">{$v.name}</option>
                            </volist>
                        </select>
                    </td>
                </tr>
                <th  width="200">类别</th>
                    <td><input type="text" name="name" value="" /></td>
                </tr>
                <tr>
                    <th>是否显示</th>
                    <td>显示<input type="radio"  name="status" value="1" checked/>不显示<input type="radio"  name="status" value="0" /></td>
                </tr>
                <tr class="act">
                    <th>&nbsp;</th>
                    <td>
                        <input type="hidden" name="id" value="{$vo.id}"/>
                        <input type="hidden" name="subflag" value="1"/>
                        <input type="submit" class="submit_btn" value="确定" />
                        <input type="submit" class="reset_btn" value="取消" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
jQuery(function($){
    $("#form").submit(function(){
        if($.checkRequire($("#admin_pwd").val()))
        {
            if($("#admin_pwd").val() != $("#confirm_pwd").val())
            {
                alert(CONFIRM_ERROR);
                return false;
            }
        }
    });
});
</script>
<include file="Public:footer" />