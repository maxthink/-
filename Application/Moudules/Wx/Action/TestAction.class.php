<?php

/**
 * 客服接口
 * @author luyanming
 * @link http://www.**.com
 */
class TestAction extends Action {

    private $weObj;
    private $openid;

    public function _initialize() {

        import('ORG.Net.Wechat');
        $this->weObj = new Wechat(C('WX_CONFIG'));
    }

    //测试 msgmodel issetmsgid
    public function msgid(){
        $m = M('wxmsgall');
        $re = $m->order('id desc')->limit(1)->find();
        echo $m->getLastSql();
        var_dump($re);
        $m = D('msg');
        var_dump($m->issetMsgid($re['msgid']));
        var_dump($m->issetMsgid($re['msgid'],$re['openid']));
        
    }
   
}
