<?php
/**
 * 消息
 * @author max
 */
class MsgModel  {
    
    
    private function _initialize(){
        $this->name = 'msg';
        $this->trueTableName = 'wxmsgall';
    }
    /*
     *  查询是否存在重复 msgid  , 有openid最好,可以用上索引      
     */
    public function issetMsgid($msgid, $openid=null){
        $m = M('wxmsgall');
        if($openid==null){
            $re = $m->where( array('msgid'=>$msgid) )->find();
        }else{
            $re = $m->where( array( 'openid'=>$openid,'msgid'=>$msgid ) )->find();
        }
        print_r($re);
    }
    
}
