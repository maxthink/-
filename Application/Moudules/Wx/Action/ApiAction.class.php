<?php

/**
 * 微信公众平台API
 * 
 * @author maojianlw@139.com
 * @link http://www.eaglephp.com
 */
class ApiAction extends Action {

    private $weObj;
    private $openid;
    private $kfid;      //客服id
    private $data;      //消息数据
    const RESTTIME = '对不起, 现在是非工作时间, 我们会保留信息, 待工作时间开始再回复您!';
    const HOUR_REPLAY = '你好，我们的专家服务时间是周一~周五上午9：00~18:00。
其余时间只接受不回复，为避免不必要的麻烦，请您按照时间安排咨询。';
    

    public function _initialize() {

        import('ORG.Net.Wechat');
        $this->weObj = new Wechat(C('WX_CONFIG'));
    }

    //接收到消息
    public function index() {
        //$this->weObj->valid();    //验证时用一下
        ob_start();
        $this->weObj->getRev(); //获取消息
        $this->openid = $this->weObj->getRevFrom();
        if( $this->openid == 0 && $this->openid == null) exit;
        $this->savemes();       //保存消息
        
        $type = $this->weObj->getRevType();
        if($type==Wechat::MSGTYPE_EVENT){
            $this->mesevent();
        }else{
            
            switch ($type) {
                
                case Wechat::MSGTYPE_TEXT:  
                    $this->mestext();   //文本消息
                    break;
                case Wechat::MSGTYPE_IMAGE:
                    $this->mesimg();    //图片消息
                    break;
                case Wechat::MSGTYPE_VOICE:
                    $this->mesvoice();  //语音消息
                    break;
                case Wechat::MSGTYPE_VIDEO:
                    $this->mesvideo();  //视频消息
                    break;
                case Wechat::MSGTYPE_SHORT_VIDEO:
                    $this->mesvideo();  //小视频消息 跟视频数据一样, 只是类型参数不一样
                    break;
                case Wechat::MSGTYPE_LOCATION:
                    $this->meslocation();    //地理位置消息
                    break;
                case Wechat::MSGTYPE_LINK:
                    $this->meslink();    //链接消息
                    break;
                default:
                    ob_end_clean();
                    header('HTTP/1.1 200 OK');
                    echo '';   //不知道什么东西就回复空
                    break;
            }
        }
        
    }

    //获取到 文字 处理
    private function mestext() {

        $event = $this->getevent();
        ob_end_clean();
        switch ($event) {
            case 'zixun':
                if( $this->isworktime() ){
                    $this->delevent();
                    //$this->weObj->text( '您的问题已收到, 系统为您安排专业人士为您解答.' )->reply();
                    $this->weObj->transfer_customer_service()->reply();
                    //$this->kefu();
                }else{
                    $this->weObj->text( self::RESTTIME )->reply();
                }
                
                break;
            case 'feedback':
                $this->delevent();
                $this->savefeedback();
                $this->weObj->text('您的反馈已收到, 非常感谢您对我们的关注.')->reply();
                break;

            default :
                if( $this->isworktime() ){
                    $this->weObj->transfer_customer_service()->reply(); //暂时直接转到多客服去.
                    //$this->kefu();
                }else{
                    if($event=='default'){
                        header('HTTP/1.1 200 OK');
                        echo '';   //固定时间内不回复消息
                    }else{
                        $this->setevent('default', 1800); //30分钟内不重复回复
                        $this->weObj->text( self::RESTTIME )->reply();
                    }
                }
                break;

        }
    }
    
    //获取到 图片 处理
    private function mesimg() {
//Array
//(
//    [mediaid] => AA80SDGK_untopnSt7G0nyhDjFzc6udyDhfmtRJK3BdNNK53BJnCXeXHJOO4tz1J
//    [picurl] => http://mmbiz.qpic.cn/mmbiz/5YicBIJRicFicBDtk5viaODYCemR0zvmlEwyLJIbNCNWQ4JUalWxBubWdODFMloicOOpb4PTveIMbt9ylPaKol6UKVg/0
//)
        $imginfo = $this->weObj->getRevPic();
        $media = $this->weObj->getimg($imginfo['mediaid']);

        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);    //求出文件格式
        $fileExt = $extmatches[1];
        $filename = time() . rand(100, 999) . '.' . $fileExt;
        $dirname = C('WXMEDIA.TALKING') . $this->openid;
        
        if (!file_exists($dirname)) {
            mkdir($dirname, 0777, true);
        }
        $medialink = $dirname . '/' . $filename;
        file_put_contents($medialink, $media['mediaBody']);

        $mesid = $this->weObj->getRevID();
        $k = new Model();
        $k->execute('update wxmsg set dir=\'' . $medialink . '\' where msgid=' . $mesid);

        $this->weObj->transfer_customer_service()->reply();
        //$this->weObj->text('图片已收到')->reply();
    }
    
    /*语音消息
     * 消息可能很大, 不直接加载了.
     */
    private function mesvoice()
    {
        
    }
    
    //视频
    private function mesvideo()
    {
        
    }

    //获取到 事件 处理
    private function mesevent() {
        switch (strtolower($this->weObj->getRevEventOnly())) {
            case 'subscribe' :  //关注事件
                $this->subscribe();
                break;
            case 'click':

                $key = $this->weObj->getRevEventkey();
                switch ($key) {
                    case 'zixun':
                        if( $this->isworktime() ){
                            $this->setevent();
                            $this->weObj->text('点击左下角的键盘图标，在文字框输入问题或病例图片，我们会以最专业的态度为您服务。')->reply();
                        }else{
                            $this->weObj->text( self::RESTTIME )->reply();
                        }
                        
                        break;
                    case 'feedback':
                        $this->setevent();
                        $this->weObj->text('点击左下角键盘图标，在文字框输入您的建议, 我们会尽快回复您!')->reply();

                    default:;
                }
                break;
            case 'kf_create_session':   //接入多客服
                break;
            case 'kf_close_session':
                break;
            case 'kf_switch_session':
                break;
            case 'scan':    //扫描带场景值的二维码, 自动回复欢迎
                header('HTTP/1.1 200 OK');
                $this->weObj->text('欢迎回到福星小区, 点击菜单"学知识",看看我们都有什么新东西吧!')->reply();
                break;
            case 'pic_photo_or_album':
                break;
                        
        }
    }

    /*
     *  处理用户信息连接到客服
     */
    public function kf()
    {
        $m = M('kf_talking');
        if( $re = $m->find( $this->openid ) ) //有对话记录, 就更新状态
        {
            $this->kfid = $re['kfid'];
            
            //file_put_contents('kk.html',$this->kfid );
            $data = array(
                'openid'=>$this->openid,
                'isreplay'=>1,
                'isshow'=>1,
                'timeline'=>time(),     //创建对话时间, 没定好
            );
            $m->save($data);
            
        }else{                          //没有对话记录, 查询客服系统, 创建对话
            
            $this->kfid = $this->getRestKFid();
            $data = array(
                'openid'=>$this->openid,
                'kfid'=>$this->kfid,
                'isreplay'=>1,
                'isshow'=>1,
                'timeline'=>time()  //创建对话时间
            );
            $m->add($data);
        }
        
    }
    
    /*
     * 查找最闲置的客服
     * 查找规则: 1,无接待客户的, 2,都在接待的情况下, 找接待少的,
     * return int  kfid
     */
    private function getRestKFid()
    {
        return 1;
    }
    
    /*  创建客服会话    /最初的方式,直接抛给微信自带的多客服系统 已放弃不用
     * 
     */
    public function kefu()
    {
        // do 查找用户是否已接入客服
        $sql = 'select kfsession from wxuser where openid=\''.$this->openid.'\'';
        
        $m=new Model();
        $kfsession = $m->execute($sql);
        if($kfsession==0){
            // do 创建客服会话
            $re = $this->weObj->createKFSession($this->openid,'kefu01@fuxingxiaoqu');
            if($re['errcode']==0){
                $sql = 'update wxuser set kfsession=1 where openid=\''.$this->weObj->getRevFrom().'\'';
                $m= new Model();
                $m->execute($sql);
            }
        }
    }
    
    //关闭客服会话      /最初的方式  已放弃
    private function closekf()
    {
        $re = $this->weObj->closeKFSession($this->openid,'kefu01@fuxingxiaoqu');
    }
    

    //关注处理
    private function subscribe() {
        //获取添加用户信息
        $qrscene = explode('_', $this->weObj->getRevEventkey());
        $qrscene_id = $qrscene[1];
        $this->data = array(
          'openid' => $this->openid,
          'qrscene_id' => $qrscene_id,
          'createtime' => $this->weObj->getRevCtime(),
        );

        $_data = $this->weObj->getUserInfo($this->weObj->getRevFrom());
        $this->data = array_merge($this->data, $_data);

        $user = M('wxuser')->where(array('openid' => $this->openid))->select();
        if ($user) {  //已有该用户, 不更改用户信息
            //$this->data['id'] = $user['id'];
            //M('wxuser')->save($this->data);
        } else {
            M('wxuser')->add($this->data);
            M('wxqrcode')->execute('update wxqrcode set num=num+1 where id=' . $qrscene_id);
        }

        //返回关注后消息
        $re = M('wxsubscribe')->where(' status&1')->order('id desc')->limit(1)->find();

        $this->weObj->text($re['content'])->reply();
    }

    //保存反馈内容
    private function savefeedback()
    {
        $mesid = $this->weObj->getRevID();
        $k = new Model();
        $k->execute('update wxmsg set isfeedback=1 where msgid=' . $mesid);  
    }
    
    //设置动作标记, 目前支持: 咨询,反馈
    private function setevent($event = '', $expire = '') 
    {
        $key = 'eventkey_' . $this->openid;
        $time = $expire ? $expire : 1800;
        if ($event != '') {
            S($key, $event, $time);  //如果有指定事件, 就加指定事件
        } elseif ( $this->weObj->getRevEventkey() ) {
            S($key, $this->weObj->getRevEventkey(), $time);
        }
    }
    
    //获取动作
    private function getevent(){
        $key = 'eventkey_' . $this->openid;
        return S($key);
    }

    //删除动作标记
    private function delevent() 
    {
        $key = 'eventkey_' . $this->openid;
        S($key, NULL);
    }
    
    //返回是否在工作时间
    private function isworktime()
    {
        //return true;
        
        $week = date('w');
        $day = date('md');
        $time = date('Gi');

        //假期
        $rest = array('0903','0904','0905','0101','1001','1002','1003','1004','1005','1006','1007');

        if($week==0 || $week==6 || in_array($day,$rest)) {
            $status = false;
        } else if($time>=930 && $time < 1750) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

    //保存消息
    private function savemes() {
        
        $this->data = array(
          'msgid'   => $this->weObj->getRevID(),
          'openid'  => $this->openid,
          'to'      => $this->weObj->getRevTo(),
          'msgtype' => $this->weObj->getRevType(),
          'createtime' => $this->weObj->getRevCtime(),
          'content' => $this->weObj->getRevContent(),
          'mediaid' => $this->weObj->getMediaid(),
          'all'     => print_r($this->weObj->getRevData(), 1), //消息信息保存一份全的
        );
        
        //MsgModel::issetMsgid( $this->weObj->getRevID(), $this->openid );
        
        //$type = $this->weObj->getRevType();
        switch ($this->data['msgtype']){
            case Wechat::MSGTYPE_EVENT:
                
                $_data = $this->weObj->getRevEvent();
                $this->data = array_merge($this->data, $_data);
                
                switch ($this->weObj->getRevEventOnly()){
                    case Wechat::EVENT_LOCATION :   //获取到地理位置消息
                        $_data = $this->weObj->getRevEventGeo();
                        $this->data = array_merge($this->data, $_data);
                        break;
                }
                $this->mesevent();
                break;
            case Wechat::MSGTYPE_TEXT:
                break;
            case Wechat::MSGTYPE_IMAGE:
                $_data = $this->weObj->getRevPic();
                $this->data = array_merge($this->data, $_data);
                break;
            case Wechat::MSGTYPE_VOICE:
                $_data = $this->weObj->getRevVoice();
                $this->data = array_merge($this->data, $_data);
                break;
            case Wechat::MSGTYPE_VIDEO: //视频消息
                $_data = $this->weObj->getRevVideo();
                $this->data = array_merge($this->data, $_data);
                break;
            case Wechat::MSGTYPE_SHORT_VIDEO:   //小视频消息 跟视频数据一样, 只是类型参数不一样
                $_data = $this->weObj->getRevVideo();
                $this->data = array_merge($this->data, $_data);
                break;
            case Wechat::MSGTYPE_LOCATION:  //地理位置消息
                $_data = $this->weObj->getRevGeo();
                $this->data = array_merge($this->data, $_data);
                break;
            case Wechat::MSGTYPE_LINK:
                $_data = $this->weObj->getRevLink();
                $this->data = array_merge($this->data, $_data);
                break;
        }
        
        
        $msg = M('wxmsgall');
        $msg->add($this->data);

        if($this->weObj->getRevType()=='event')
        {
            $msg = M('wxevent');
            $msg->add($this->data);
        }else{

            $this->kf();  //客服处理
            $this->data = array_merge($this->data, array( 'kfid'=>$this->kfid ));
            $mes = M('wxmsg');
            $mes->add($this->data);
        }
        
    }

    //有定时任务每隔一个小时请求一次
    public function refreshtoken() {
        $token = $this->weObj->refreashtoken();
        $this->apido('refreshtoken', $token);
        
    }


    /*  获取客服聊天记录
     *  定时任务, 每天定时夜里获取客服聊天记录
     */
    public function getTalklist() {
        set_time_limit(0);
        //$zero = strtotime(date('Y-m-d'));
        $zero = time();
        //echo date('Y-m-d H:i:s',$zero);
        $p = 0;
        do {
            $goon = true;
            $p++;

            $this->data = array(
              'starttime' => $zero-3600,
              'endtime' => $zero,
              'pageindex' => $p,
              'pagesize' => 50,
            );
            //print_r($this->data);
            //$this->data 数据结构{"starttime":123456789,"endtime":987654321,"openid":"OPENID","pagesize":10,"pageindex":1,}
            $res = $this->weObj->getCustomServiceAllMessage($this->data);
            //print_r($res); exit;
            if ($res != false && isset($res['errcode']) && $res['errcode'] == 0 && count($res['recordlist']) > 0) {
                foreach ($res['recordlist'] as $mes) {
                    M('wxkefutalk')->add($mes);
                }
            } else {
                $goon = false;
            }
        } while ($goon);
        
        $this->apido('getkefutalk');
        exit;
    }
    
    //获取客服用户聊天记录, 
    public function getTalklist2()
    {
        set_time_limit(0);
        $zero = time();
        
        $sql = 'select openid from wxuser where kfsession=1';
        $m=new Model();
        $re = $m->query($sql);
        foreach($re as $v)
        {
            $p = 0;
            do {
                $goon = true;
                $p++;

                $this->data = array(
                    'starttime' => $zero-3600,
                    'endtime' => $zero,
                    'pageindex' => $p,
                    'pagesize' => 50,
                    'openid'=>$v['openid'],
                );
                //print_r($this->data);
                //$this->data 数据结构{"starttime":123456789,"endtime":987654321,"openid":"OPENID","pagesize":10,"pageindex":1,}
                $res = $this->weObj->getCustomServiceMessage($this->data);
                print_r($res);
                if ($res != false && isset($res['errcode']) && $res['errcode'] == 0 && count($res['recordlist']) > 0) {
                    foreach ($res['recordlist'] as $mes) {
                        M('wxkefutalk')->add($mes);
                    }
                } else {
                    $goon = false;
                }
            } while ($goon);
        }
    }
    
    /*
     * 获取刷新图文消息
     * 定时任务, 每天刷新两次 13点, 19点, 都是编辑做完的一个时间点
     */
    public function getNews()
    {
        set_time_limit(20);
        $offset = 0;
        $m = M('wxmedianews');
        
        do{
            $res = $this->weObj->getForeverList('news',$offset,20);

            if(isset($res['total_count']) && $res['total_count']>0 && $offset<$res['total_count']){
                if($res['total_count']>20 && $offset<$res['total_count'] ){
                    $offset = $offset+20;
                }else{
                    $offset = false;
                }
                
                foreach($res['item'] as $news){
                    
                    $dbnews = $m->where( array('mediaid'=>$news['media_id']) )->limit(1)->find();

                    if( !isset($dbnews['update_time']) )
                    {
                        $data['mediaid'] = $news['media_id'];
                        $data['update_time'] = $news['update_time'];
                        foreach($news['content']['news_item'] as $_data){
                            $data = array_merge($data,$_data);
                            $m->add($data);
                            $inid = $m->getLastInsID();
                            $this->getimg($_data['thumb_media_id'], $inid);
                            
                        }
                    }

                    if( isset($dbnews['update_time']) && $dbnews['update_time'] != $news['update_time'])
                    {
                        $data['id'] = $dbnews['id'];
                        $data['mediaid'] = $news['media_id'];
                        $data['update_time'] = $news['update_time'];
                        foreach($news['content']['news_item'] as $_data){
                            $data = array_merge($data,$_data);
                            $m->save($data);
                            $this->getimg($_data['thumb_media_id'], $data['id']);
                        }
                    }

                }
            }else{
                $offset = false;
                if(isset($res['errcode'])){
                    $data = array(
                        'type'=>'admin wxmeida get news',
                        'key'=>$this->weObj->errCode,
                        'val'=>$this->weObj->errMsg,
                    );
                    $m = M('wxapidorecord');
                    $m->add($data);
                }
            }
            //exit;
            
        }while ($offset);

    }
    
    //上面的获取图文消息附加的 获取封面图片用
    private function getimg($mediaid, $id){
        $media = $this->weObj->getForeverMedia_1($mediaid);   //获取的永久素材, 返回的不是 false 就是 图片内容
        
        if($media !== false){  //没错误再存
            $dirname = C('WXMEDIA.NEWS_COVER') . $id;
            if (!file_exists($dirname)) {
                mkdir($dirname, 0777, true);
            }
            $medialink = $dirname . '/' . $id . '.jpg';
            //echo '<br> medialink: '.$medialink;
            file_put_contents($medialink, $media);
            $m = M('wxmedianews');
            $m->save(array('id'=>$id,'cover_dir'=>$medialink));
        }
    }
    
    /*
     * 回复关注后没有主动打招呼的粉丝
     * 定时任务, 每半小时执行一下
     */
    public function autoReplaySubscribe()
    {
        $m=new Model();
        //找关注后超过一个小时没有主动打招呼的粉丝
        $horetime = time()-3600;
        $sql = 'select openid from wxmsg where createtime>'.$horetime.' and event=\'subscribe\' ';
        
        $re = $m->query($sql);
        var_dump($re);
        $newsub = array();
        if(count($re)>0){
            foreach($re as $sub){
                $sql = 'select count(*) tc from wxmsg where openid=\''.$sub['openid'].'\' and event=\'text\' ';
                echo $sql;
                $c = $m->query($sql);
                if($c[0]['tc']==0){
                    $newsub[] = $sub['openid'];
                }
            }
        }
        print_r($newsub);
        
        //批量回复
        if(count($newsub) >0){

            if( count($newsub)==1){ 
                $newsub[] ='oMumCvxQeKXwaonrKgs-IhiSXIbM'; //群发消息至少要俩人才发, 一个人不发.
            }
            $data = array(
              'touser'=>$newsub,
              'msgtype'=>'text',
              'text'=> array('content'=>'你好，我们的专家服务时间是周一~周五上午9：00~18:00。
其余时间只接受不回复，为避免不必要的麻烦，请您按照时间安排咨询。'),
            );
            print_r($data);
            $k = $this->weObj->sendMassMessage($data);
            var_dump($k);
            echo $this->weObj->errCode;
            echo $this->weObj->errMsg;
        }
    }

    //记录一些动作执行情况
    private function apido($key, $val = '') {
        $this->data = array(
          'type' => $key,
          'val' => $val,
          'time'=>time(),
        );
        M('wxapidorecord')->add($this->data);
    }

    //测试用, 查看token
    public function gettoken() {
        echo $this->weObj->showtoken();
    }
    
    public function test()
    {
        $data = array(
            'touser'=>'oMumCv4w1WjMMRlDdrcLUoJ7xa1Y',
            'msgtype'=>'text',
            'text'=>array('content'=>'kkkkkk'),
        );
        $this->weObj->sentKFmsg($data);
    }
    

}
