<?php
//产品
class AdminuserAction extends CommonAction {

	public function index()
	{
		//$name = $this->getActionName();
		$name = 'admin_user';
		$m = M($name); // 实例化Data数据对象
		import('ORG.Util.Page');// 导入分页类
		$map = array('status'=>1);
		$count      = $m->where($map)->count();
		$Page       = new Page($count,50);
		$Page->rollPage = 20;	//最多显示20个分页

		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
		$nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
		$offect = ($nowPage-1)*$Page->listRows;

		$sql = 'select au.* from '.getTableName($name).' au left join '.getTableName('area').' a on au.areaid=a.id
				where 1
				limit '.$offect.','.$Page->listRows;
		$list = $m->query( $sql );
		$show = $Page->show();
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}
	
	public function add()
	{
		if($_POST['subflag']){
           	$name =admin_user;
			$m = M($name);
            $m->create();
            $m->password=md5($_POST['password']);
            $m->areaid = ($_POST[areaid]==-1)?$_POST[city]:$_POST[areaid];
            $result = $m->add();
            if($result) {
                $this->success('操作成功！',"index");
                exit();
            }else{
                $this->error('写入错误！',"index");
                exit();
            }
        }else{
        	
			//获取组
			$name =agroup;
			$mn = M($name);
			$sql = 'select * from '.getTableName($name);
			
			$glist = $mn->query( $sql );
			$this->assign('glist',$glist);
			$this->display();
		}
	}

    public function edit()
	{
        if ($this->_request('id')) {
			$name =admin_user;
			$m = M($name);
            $res = $m->find( intval($this->_request('id')) );
            if($res){

				//地区
                $aresult = getAreaList($res[areaid]);
                $this->assign('aresult', $aresult);

				//获取组
				$name =agroup;
				$mn = M($name);
				$sql = 'select * from '.getTableName($name);
				$glist = $mn->query( $sql );
				$this->assign('glist',$glist);
                $this->assign('vo', $res);
				$this->display();
            }else{
				$this->error('未找到数据.', U(MODULE_NAME.'/index') );
			}
        }else{
            $this->ajaxReturn(0, '非法进入', 0);
        }
    }

	
//更新
	public function update()
	{
		if($_POST['submit']=='确定'){
			$name =admin_user;
			if(empty($_POST['password']))unset($_POST['password']);
			$m = M($name);
            $m->create();
            if(!empty($_POST['password']))$m->password=md5($_POST['password']);
            $m->areaid = ($_POST[areaid]==-1)?$_POST[city]:$_POST[areaid];
	        $result = $m->save();
	        
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
            $m = M('admin_user');
            $pk = $m->getPk ();
            $condition = array ($pk => array ('in', explode ( ',', $id ) ) );
            $ids = explode (',',$id);
            if(session('group') != 1)$condition['areaid']=session('areaid');
            foreach($ids as $aid)
            {
                $condition['id'] = $aid;
                $res = $m->where($condition)->delete();
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