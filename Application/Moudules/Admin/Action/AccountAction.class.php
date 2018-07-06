<?php
//产品
class AccountAction extends CommonAction {

	public function index()
	{
		$name = $this->getActionName();
		$m = M($name); // 实例化Data数据对象
		import('ORG.Util.Page');// 导入分页类
		$map = array('status'=>1);
		$count      = $m->where($map)->count();
		$Page       = new Page($count,10);
		$Page->rollPage = 20;	//最多显示20个分页

		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
		$nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
		$offect = ($nowPage-1)*$Page->listRows;

		$sql = 'select p.id,p.title,p.intro,c.name as category,p.time,p.status from '.getTableName($name).' as p left join '.getTableName('category').' as c on p.category=c.id
				where 1
				order by p.id desc
				limit '.$offect.','.$Page->listRows;

		$list = $m->query( $sql );
		$show = $Page->show();
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}
	
	public function add()
	{
		//获取节目类别
		$M = D('Category');
		$category = $M->getcate();
		$this->assign('category', $category);
		$this->display();
	}

    public function edit()
	{
        if ($this->_request('id')) {
			$name = $this->getActionName();
			$m = M($name);
            $res = $m->find( intval($this->_request('id')) );
            if($res){
				 //获取节目类别
				$M = D('Category');
				$category = $M->getcate();
                $this->assign('res', $res);
				$this->assign('category', $category);
				$this->display();
            }else{
				$this->error('未找到数据.', U(MODULE_NAME.'/index') );
			}
        }else{
            $this->ajaxReturn(0, '非法进入', 0);
        }
    }

	//修改自己的账户密码
	public function modify()
	{
		
	}

}