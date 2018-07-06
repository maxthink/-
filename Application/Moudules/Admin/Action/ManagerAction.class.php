<?php
//产品
class ManagerAction extends CommonAction {
	
	protected $table_name = 'admin_user';
	
	public function index(){
		
        $map = array('status'=>1);
        $count = $this->m->where($map)->count();  //查询满足要求的总记录数

        import('ORG.Util.Page');    //导入分页类
        $Page	= new Page($count,$this->page_num);  //实例化分页类, 总记录数, 每页显示数
        $Page->rollPage = $this->page_roll;	//最多显示10个分页
        $show = $Page->show();  //分页显示输出

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数
        $nowPage = $this->_request('p') ? intval($this->_request('p')) : 1;
        //$list = $this->m->join->('admin_group')->where($map)->order('id desc')->page($nowPage,$Page->listRows )->select();
        //echo $this->m->getLastSql();
        $this->assign('page',$show);    //赋值分页输出
        $this->assign('list',$list);    //赋值数据集
        $this->display();   //输出模板		
	}
	
	public function modify()
	{
		//编辑获取数据
		if ($this->_get('id')) {
            $res = $this->m->find( intval($this->_get('id')) );
            if($res){
				//获取组
				$sql = 'select * from '.getTableName('admin_group');
				$glist = $this->m->query( $sql );
				$this->assign('glist',$glist);
                $this->assign('vo', $res);
				$this->display();
            }else{
				$this->error('未找到数据');
			}
			
		//添加修改提交
		}elseif($this->_post('subflag')){
			$this->m->create();
            $this->m->password=md5($_POST['password']);
			if($this->_post('id'))
				$result = $this->m->save();
			else
				$result = $this->m->add();
            if($result) {
                $this->success('操作成功！',"index");
            }else{
                $this->error('写入错误！',"index");
            }
			
            //添加显示页面
            }else{
                    //获取用户组数据 
                    $sql = 'select * from '.getTableName('admin_group');
                    $glist = $this->m->query( $sql );

                    $this->assign('glist',$glist);
                    $this->display('edit');
            }
	}

//更新
	public function update()
	{
		if($_POST['submit']=='确定'){
			$name =admin_user;
			if(empty($_POST['password']))unset($_POST['password']);
		
            $this->m->create();
            if(!empty($_POST['password']))$this->m->password=md5($_POST['password']);
	        $result = $this->m->save();
	        
	        if($result) {
	            $this->success('操作成功！',"index");
	            exit();
	        }else{
	            $this->error('写入错误！',"index");
	            exit();
	        }
	    }else{
	    	$this->success('操作成功！',"index");
	    }
	}

	public function remove()
    {
        //删除指定记录
        $result = array('isErr'=>0,'content'=>'');
        $id = $_REQUEST['id'];

        if($id==1){
        	$result['isErr'] = 1;
            $result['content'] = '管理员不能删除';
            die(json_encode($result));
        }

        if(!empty($id))
        {
            $pk = $this->m->getPk ();
            $map = array ($pk => array ('in', explode ( ',', $id ) ) );
            $ids = explode (',',$id);

            foreach($ids as $aid)
            {
                $map['id'] = $aid;
                $res = $this->m->where($map)->delete();
            }

        }
        else
        {
            $result['isErr'] = 1;
            $result['content'] = L('ACCESS_DENIED');
        }

        die(json_encode($result));
    }
}