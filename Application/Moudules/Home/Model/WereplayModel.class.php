<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * 微信文本内容判断回复类
 *
 * @author luyanming
 */
class WereplayModel extends Model {
    
    private $text = ''; //接收到的文字内容
    
    public function replay($text){
        $this->text = $text;
        
        if( mb_strlen($text,'utf-8')<5 ) //如果是小于5个长度, 一般就是简单的打招呼之类的, 不需要记录什么
        {
            return $this->hello();
        }
    }
    
    //短的,简单问候回复
    private function hello()
    {
        if(preg_match('/您好|你好|hello/i', $this->text)){
            $d = date('d');
            if($d>=6 && $d<=9){  //6点开始, 10点之前, 都是早上
                return '早上好!';
            }
            if($d>9 && $d<12){  //10点开始, 12点之前, 属于上午
                return '上午好!';
            }
            if($d>=12 && $d<13){  //12~1, 中午时间
                return '中午好!';
            }
            if($d>=13 && $d<20){  // 1~7
                return '下午好!';
            }
            if($d>=20 && $d<24){  // 20~23
                return '晚上好!';
            }
            return '您好';
        }
    }
}
