<?php

/*
 * 微信消息管理
 * author luyanming 2015/8/4
 * 
 */
class WxusermsgAction extends WxAction {

    public function index() {
        
        $openid = $this->_request('openid');
        $m = M('wxmsg'); // 实例化Data数据对象
        import('ORG.Util.Page'); // 导入分页类
        $map = array('openid' => $openid);
        $count = $m->where($map)->count();
        $Page = new Page($count, 20);
        $Page->rollPage = 20; //最多显示20个分页
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
        $nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
        $offect = ($nowPage - 1) * $Page->listRows;

        $sql = 'select msg.*,user.headimgurl,user.nickname from wxmsg msg 
            left join wxuser user on msg.openid=user.openid
            where msg.openid=\''.$openid.'\'
            order by id desc
            limit ' . $offect . ',' . $Page->listRows;

        $list = $m->query($sql);
        $page = $Page->show();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display();
    }

}
