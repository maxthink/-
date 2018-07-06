<?php

/*
 * 后台通用模块, 普通单表版
 * 
 * 针对数据存放在单表内类型
 * 
 */
class CommonAction extends Action {
	
    protected $table_name = '';       //表名
    protected $primary_key = 'id';    //主键
    protected $m = '';                //数据库实例
    protected $page_num = 15;         //每页显示数
    protected $page_roll = 15;        //翻页显示10个


    public function _initialize(){

        if(!session('account'))
        {
            exit( '<script type="text/javascript"> top.location="'.U('Public/login').'" </script>' );
        }else{
            if (empty($this->table_name)) {
                    $this->table_name = $this->getActionName();
            }
            $this->m= D($this->table_name);

            //判断权限

        }
    }
	
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
        $this->assign('page',$show);    //赋值分页输出
        $this->assign('list',$list);    //赋值数据集
        $this->display();   //输出模板
    }

    //保存 (对应添加 add 方法)
    public function add()
    {
        if( $this->_request('id') ){

            if( $this->m->create() )
            {
                if( $this->m->add() ){
                    $this->success('保存成功', U(MODULE_NAME.'/index'));
                }else{
                    $this->error('保存错误', U(MODULE_NAME.'/add'));
                }
            }else{
                $this->error('创建新记录数据出错.', U(MODULE_NAME.'/add'));
            }
        }else{
            $this->display('modify');
        }

    }
	
    //编辑 (对应更新update方法)
    public function modify()	
    {
	//获取
        if ( $this->_get('id') ) {

            $res = $this->m->find( intval($this->_get('id')) );
            //var_dump($res);
            
            if($res){
                $this->assign('vo', $res); 
            }else{
                $this->error('未找到数据.', U(MODULE_NAME.'/index') );
            }
        }
        
        if( $this->_post('subflag') ) {
            //更新
            if( $this->_post('id') ) {
                var_dump($_POST); 
                if( $this->m->create() ) { //创建数据对象
                    
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
    /*
     * 删除操作
     * 两种方式删除, ajax 和 直接请求删除
     */
    public function remove(){
        if($this->isAjax()){
            
        }else{
            
        }
        
     }
    
    /*
     *  修改数据状态
     * 
     *     
     */
    public function status(){
        if( $this->_request('id') ){

            $this->m = M($name);
            if( $this->m->create() ){ //创建数据对象

                if( $this->m->save() ){ // 把用户对象写入数据库
                    $this->success('更新成功', U(MODULE_NAME.'/index'));
                }else{
                    $this->error('更新出错', U(MODULE_NAME.'/edit',array('id'=>$this->_post('id') )));
                }
            }else{
                $this->error('创建新记录数据出错.',U(MODULE_NAME.'/index'));
            }
        }else{
            $this->error('缺少请求条件.', U(MODULE_NAME.'/index'));
        }
        
    }
 
}
