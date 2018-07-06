<?php

/*
 * 客服聊天
 * @用户发来的消息带 msgid, 客服回复的消息没msgid, 可以区分是用户还是客服的消息
 * author luyanming 2015/8/4
 * 
 */
class TalkAction extends WxAction {
    
    //客服聊天记录窗口
    public function index()
    {
        $openid = $this->_get('openid');

        //最后一条消息
        $m=M('wxmsg');
        $lastid = $m->field('id')->order('id desc')->limit(1)->find();
        
        //用户信息
        $m = M('wxuser');
        $user = $m->where(array('openid'=>$openid))->find();      

        $this->assign('user', $user);
        $this->assign('kfid', session('account'));
        $this->assign('lastid',$lastid['id']);
        $this->display();
    }
    
    public function page()
    {
        $openid = $this->_get('openid');
        $m = M('wxmsg');
        import('ORG.Util.Page'); // 导入分页类
        $count = $m->count();
        $Page = new Page($count, 20);
        $Page->rollPage = 20; //最多显示20个分页
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
        $nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
        $offect = ($nowPage - 1) * $Page->listRows;

        $list = $m->order('createtime desc')->page($nowPage,$Page->listRows)->select();
        
        $page = $Page->getdata(); // 分页显示输出
        
        $this->ajaxReturn(array('status'=>1,'list'=>$list,'page'=>$page),'JSON');

    }
    
    //客服消息获取
    public function allmsg(){
        $lastID = $this->_request('lastID');
        if($lastID){
            $m=M('wxmsg');
            $re = $m->where('id >'.$lastID)->order('id asc')->select();
            if($re){
                echo json_encode( array('status'=>1,'data'=>$re) );
            }else{
                echo json_encode( array('status'=>2,'msg'=>'没有更多消息') );
            }
        }  else {
            echo json_encode( array('status'=>0,'msg'=>'参数缺失') );
        }
    }
    

}
