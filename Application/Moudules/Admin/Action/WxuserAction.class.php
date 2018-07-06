<?php

/*
 * 微信消息管理
 * author luyanming 2015/8/4
 * 
 */
class WxuserAction extends WxAction {

    public function index() {
        
        $m = M('wxuser'); // 实例化Data数据对象
        import('ORG.Util.Page'); // 导入分页类
        $map = array('status' => 1);
        $count = $m->where($map)->count();
        $Page = new Page($count, 20);
        $Page->rollPage = 20; //最多显示20个分页
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
        $nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
        $offect = ($nowPage - 1) * $Page->listRows;

        $sql = 'select u.*,qr.areaname from wxuser u
                left join wxqrcode qr on u.qrscene_id = qr.id
                where 1
                order by u.createtime desc
                limit ' . $offect . ',' . $Page->listRows;

        $list = $m->query($sql);
        $page = $Page->show();
        
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display();
    }
    
    public function getuserinfo()
    {
        $id = intval($_REQUEST['id']);
        $U = M('wxuser');
        $usr = $U->find($id);
        if($usr){
            $userinfo = $this->weObj->getUserInfo($usr['openid']);
            
            if($userinfo!=false){
                $userinfo['id'] = $id;
                if ( $U->save($userinfo) )
                {
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0,'msg'=>'用户信息没有改变'));
                }
            }else{
                echo json_encode(array('status'=>0,'msg'=>'获取用户信息出错'));
            }
        }else{
            echo json_encode(array('status'=>0,'msg'=>'未找到该用户'));
        }
    }
    
    //获取所有用户
    public function getalluser()
    {
        do{
            $res = $this->weObj->getUserList();
            //print_r($userList);
            $m = new Model('wxuser');
            if( $res['count']>0 ){
                foreach($res['data']['openid'] as $openid){
                    $re = $m->where('openid=\''.$openid.'\'' )->find();
                    if(!$re){
                        $data = array('openid'=>$openid);
                        $m->add($data);
                    }
                }
            }else{
                break;
            }
            
        }while (false);
    }

}
