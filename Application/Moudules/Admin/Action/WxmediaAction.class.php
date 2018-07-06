<?php

/*
 * 微信图文管理
 * author luyanming 2015/8/4
 * 
 */
class WxmediaAction extends WxAction {

    protected $table_name = 'wxmedianews';
    protected $page_num = 10;         //每页显示数
    
    
    //列表
    public function index()
    {
        //$map = array('status'=>1);
        $count = $this->m->where($map)->count();  //查询满足要求的总记录数

        import('ORG.Util.Page');    //导入分页类
        $Page	= new Page($count,$this->page_num);  //实例化分页类, 总记录数, 每页显示数
        $Page->rollPage = $this->page_roll;	//最多显示10个分页
        $show = $Page->show();  //分页显示输出

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数
        $nowPage = $this->_request('p') ? intval($this->_request('p')) : 1;
        $list = $this->m->where($map)->order('id desc')->page($nowPage,$Page->listRows)->select();
        //echo $this->m->getLastSql();
        
        $m = M('wxmedianews_type');
        $category = $m->where(array('status'=>1))->order(' ord asc ')->select();
        
        $this->assign('atype', $category);
        $this->assign('page',$show);    //赋值分页输出
        $this->assign('list',$list);    //赋值数据集
        $this->display();   //输出模板
    }
    
    
    //编辑 (对应更新update方法)
    public function modify()	
    {
	//获取
        if ( $this->_get('id') ) {

            $res = $this->m->find( intval($this->_get('id')) );
            //var_dump($res);
            
            if($res){
                $m = M('wxmedianews_type');
                $category = $m->where(array('status'=>1))->order(' ord asc ')->select();
                $this->assign('atype', $category);
                $this->assign('vo', $res); 
            }else{
                $this->error('未找到数据.', U(MODULE_NAME.'/index') );
            }
        }
        
        if( $this->_post('subflag') ) {
            //更新
            if( $this->_post('id') ) {
                
                if( $this->m->create() ) { //创建数据对象
                    //print_r($_POST['type']);
                    $this->m->type = array_sum($_POST['type']);
                    if( $this->m->save() ){ // 把用户对象写入数据库
                        $this->success('更新成功', U(MODULE_NAME.'/index')); exit;
                    }else{
                        $this->error('更新出错', U(MODULE_NAME.'/modify',array('id'=>$this->_post('id') )));
                    }
                }else{
                    $this->error('更新时创建数据模型出错.',U(MODULE_NAME.'/index'));
                }
                    //添加
            }else{
                if( $this->m->create() ) {
                    if( $this->m->add() ) {
                        $this->success('添加成功', U(MODULE_NAME.'/index')); exit;
                    }else{
                        $this->error('更新出错', U(MODULE_NAME.'/modify',array('id'=>$this->_post('id') )));
                    }
                }else{
                    $this->error('添加时创建数据模型出错.',U(MODULE_NAME.'/index'));
                }
            }
        }
            
        $this->display();
    }
    
    //
    public function settype(){
        $data['type'] = array_sum($this->_request('type'));
        $data['id'] = $this->_request('id');
        $k = $this->m->save($data);
        if($k){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>0,'msg'=>''));
        }
        
    }
    
    public function getallmes()
    {
        set_time_limit(20);
        $offset = 0;    //初始化获取图文偏移位置
        $m = M('wxmedianews');

        //循环获取图文素材
        do{
            $res = $this->weObj->getForeverList('news',$offset,20); //获取20条图文

            if(isset($res['total_count']) && $res['total_count']>0 && $offset<$res['total_count']){
                if($res['total_count']>20 && $offset<$res['total_count'] ){
                    $offset = $offset+20;   //图文总数大于20, 并且偏移量小于总数, 就可以继续循环下一次获取图文, 否则退出
                }else{
                    $offset = false;
                }
                
                foreach($res['item'] as $news){
                    
                    $dbnews = $m->where( array('mediaid'=>$news['media_id']) )->limit(1)->find();   //从库里查找同样media_id 的素材.

                    if( !isset($dbnews['update_time']) )    //如果没有该素材, 则添加该图文素材到库里.
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

                    if( isset($dbnews['update_time']) && $dbnews['update_time'] != $news['update_time'])    //如果库里有该素材,则看更改时间, 时间不同,说明修改过,就重新入库
                    {
                        $data['id'] = $dbnews['id'];
                        $data['mediaid'] = $news['media_id'];
                        $data['update_time'] = $news['update_time'];
                        foreach($news['content']['news_item'] as $_data){
                            $data = array_merge($data,$_data);
                            $m->save($data);
                            $this->getimg($_data['thumb_media_id'], $data['id']);   //保存封面
                        }
                    }

                }
            }else{ 
                $offset = false;
                if(isset($res['errcode'])){ //记录错误动作, 做分析用
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
    
    //图文素材封面保存
    private function getimg($mediaid, $id){
        $media = $this->weObj->getForeverMedia_1($mediaid);   //获取的永久素材, 返回的不是 false 就是 图片内容
        
        if($media !== false){  //没错误再存
            $dirname = C('WXMEDIA.NEWS_COVER') . $id;   //获取设置的图文素材封面保存路径
            if (!file_exists($dirname)) {
                mkdir($dirname, 0777, true);
            }
            $medialink = $dirname . '/' . $id . '.jpg';
            echo '<br> medialink: '.$medialink;
            file_put_contents($medialink, $media);

            $this->m->save(array('id'=>$id,'cover_dir'=>$medialink));
        }
    }
    
    public function upimg()
    {
        $m = M('wxmedianews');
        $re = $m->select();
        
        foreach($re as $val){
            $this->getimg($val['thumb_media_id'], $val['id']);
        }
    }

}
