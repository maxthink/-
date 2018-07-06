<?php

/*
 * 
 * author luyanming 2015/9/3
 * 
 */
class CustomAction extends WxAction {

    //客服服务的用户列表
    public function index() {
        
        $m = M('kf_talking'); // 实例化Data数据对象
        import('ORG.Util.Page'); // 导入分页类
        $map = array('status' => 1);
        $count = $m->where($map)->count();
        $Page = new Page($count, 20);
        $Page->rollPage = 20; //最多显示20个分页
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
        $nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
        $offect = ($nowPage - 1) * $Page->listRows;

        $sql = 'select talk.*, user.headimgurl, user.nickname from kf_talking talk 
            left join wxuser user on user.openid=talk.openid
            where talk.kfid='.session('account').' and talk.isshow=1
            order by id desc
            limit ' . $offect . ',' . $Page->listRows;

        $list = $m->query($sql);
        //echo $m->getLastSql();
        //$page = $Page->show();
        
        $this->assign('kfid',session('account'));
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display();
    }
    
    public function info(){
        $openid = $this->_get('openid');

        //用户信息
        $m = M('wxuser');
        $user = $m->where(array('openid'=>$openid))->find();      

        echo json_encode(array('status'=>1,'data'=>$user));
    }
    
    //关闭对话
    public function close(){
        $openid = $this->_get('openid');
        //$kfid = $this->_get('kfid');  //以openid为主键, 只需openid, 即可知道要关闭哪条
        $m = M('kf_talking');
        $data = array(
            'openid'=>$openid,
            'isshow'=>0,
        );
        $re = $m->save($data);

        if($re==1){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>0,'msg'=>'error'));
        }
    }

}
