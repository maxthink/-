<?php

/*
 * 客服资料
 * author luyanming 2015/9/20
 * 
 */
class UserAction extends WxAction {
    
    //客户信息
    public function index()
    {
        $openid = $this->_get('openid');
        if(!$openid && isset($_COOKIE['openid']) ){
            $openid = $_COOKIE['openid'];
        }
        
        if($openid){
            //用户信息
            $m = M('wxuser');
            $user = $m->where(array('openid'=>$openid))->find();      
            //print_r($user);
            $this->assign('user', $user);
        }else{
            
        }
        
        //用户类型
        $m = M('wxuser_type');
        $types = $m->select();
        $this->assign('types', $types);
        
        //该用户有关系的患者
        $m = M('patient');
        $patients = $m->where(array('openid'=>$user['openid']))->select();
        $this->assign('patients', $patients);
        
        
        $this->display();
    }
    
    

}
