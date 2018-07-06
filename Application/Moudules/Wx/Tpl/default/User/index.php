<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="__PUBLIC__/wx/default/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
</head>
<body>
    <p>openid: {$user.openid}</p>
    <p>昵称: {$user.nickname}</p>
    <p>地址: {$user.country} / {$user.provice} / {$user.city}</p>
    <p>用户类型: 
        <foreach name="types" item="type" >
            <if condition="$type.id & intval($user['type'])">{$type.name}</if>
        </foreach>
        <span id="modify_type" data-type="{$user.type}" class="span_button">修改</span>
    </p>
    <h4>患者数据: </h4>
    <p>姓名: </p>
    <p>性别: </p>
    <p>出生日期: </p>
    <p>籍贯: </p>
    <p>民族: </p>
    <p>身高/体重: </p>
    <p>婚姻状况: </p>
    <p>宗    教: </p>
    <p>最高学历: </p>
    <p>常住地址: </p>
    <p>座机/手机: </p>
    <p>QQ: </p>
    <p>微信: </p>
    <p>邮箱: </p>
    <p>资料创建时间: </p>
    
    <p>备注: </p>
    
    
    <php> if($patients):</php> 
        
        <p> 症状类别: 
            <select name="">
                <option value="自己" selected ></option>
                <option>肺癌</option>
                <option>结肠</option>
                <option>淋巴癌</option>
                <option>食道癌</option>
                <option>肝癌</option>
            </select>
        </p>

        <>
        <p> T 大小 
            <select name="">
                <option value="TX" selected >TX: 不能检测到主要肿瘤(信息不可用)</option>
                <option value="T0" >T0: 无主要肿瘤</option>
                <option value="T1a" >T1a: 肿瘤直径为4 cm (约1.12英寸)或更小，且仅限于肾脏</option>
                <option value="T1b" >T1b: 肿瘤直径大于4 cm，小于7 cm (约2.75英寸)，且仅限于肾脏</option>
                <option value="T2" >T2: 肿瘤直径大于7 cm，但仍仅限于肾脏</option>
                <option value="T3a" >T3a: 肿瘤已扩散至肾上腺或已进入肾脏附近的脂肪组织，但未侵入肾脏周围靠近脂肪组织</option>
                <option value="T3b" >T3b:肿瘤已扩散至导出肾脏的大静脉部分(肾静脉)，及/或导入心脏（腔静脉），位于腹腔内的大静脉部分</option>
                <option value="T3c" >T3c：肿瘤已扩散至位于胸腔内的腔静脉部分或已侵入腔静脉壁</option>
                <option value="T4" >T4：肿瘤已扩散至肾筋膜外（位于肾脏和肾脏周围脂肪组织附近的纤维组织）</option>                
            </select>
        </p>
    
        <p> N 区域淋巴结有无感染肿瘤
            <select name="">
                <option value="NX" selected >NX：不能检测到区域淋巴结(信息不可用)。</option>
                <option value="N0" >N0：无癌细胞转移区域淋巴结</option>
                <option value="N1" >N1：癌细胞转移至一个区域淋巴结(邻近肿瘤区域)</option>
                <option value="N2" >N2：癌细胞转移至多个区域淋巴结(邻近肿瘤区域)。有远距离癌细胞转移（M）</option>
            </select>
        </p>
    
        
        <p> M 转移范围
            <select name="">
                <option value="MX" selected >MX：不能检测是否存在远距离癌细胞转移(信息不可用)</option>
                <option value="M0" >M0：无远距离癌细胞转移</option>
                <option value="M1" >M1：存在远距离癌细胞转移；转移区域包括非肿瘤区域（非肾脏附近区域）淋巴结及/或其它器官（如肺，骨骼或大脑）</option>
            </select>
        </p>
    
    <php>endif;</php>

    
<div class="move_div" id="div_type">
    <div class="move_div_close"><span class="span_close">×</span></div>
    <div class="move_div_data">
    <foreach name="types" item="type" >
        <p><input type='checkbox' class='checkbox data_type' id="type_{$type.id}" value='{$type.id}' <if condition="$type.id & intval($user['type'])">checked</if> ><label for='type_{$type.id}'>{$type.name}</label></p>
    </foreach>
    </div>
    <span class="span_button" id="span_submit_type" >OK</span>
</div>
    
<script type="text/javascript">
    //显示分类选择框, 初始化数据
    $('#modify_type').click(function(){
        
        var div_type = $('#div_type');
        div_type.css("top", $(this).offset().top + 30 );
        if( ( div_type.offset().top + div_type.height() ) > $(document).height()  ){
            div_type.css("top",  $(document).height() - div_type.height()   );
        }
        
        div_type.css("left", $(this).offset().left + 30 );
        
        var type = $(this).attr('data-type');
        
        $('.data_type').each(function(key,val){
            if( $(this).val() & type){
                $(this).attr('checked','true');
            }else{
                $(this).removeAttr("checked");
            }
        });
        
        div_type.show();
        
    })
    
    $("#span_submit_type").click(function(){
        var userid = $().val();
    });

    $(".span_close").click(function(){
        $(this).parent().parent().hide();
    })
    
</script>
    
</body>
</html>