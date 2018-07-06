<?php
//权限模块
class ModuleAction extends CommonAction {
	
	protected $table_name = 'admin_module';       //表名
	
	public function index()
	{
		$map = array();
		$list = $this->m->where($map)->order('p_id asc, `order` asc')->select();
		
		$this->assign('list',json_encode($list));
		$this->display();
	}

	public function modify()
	{
		//添加
		if($this->_request('type')=='add'){
			$data['name'] = $this->_request('name');
			$data['action'] = $this->_request('action');
			$data['option'] = $this->_request('option');
			$data['status'] = intval($this->_request('status'));
			$data['show'] = intval($this->_request('show'));
			$data['order'] = intval($this->_request('order'));
			$data['level'] = intval($this->_request('level'))+1;
			$data['p_id'] = $this->_request('p_id');
			if($data['level'] >2) $this->ajaxReturn(array('status'=>0,'msg'=>'权限层数过多了'));
			$result = $this->m->add($data);
			if($result) {
	            $this->ajaxReturn(array('status'=>1));
	        }else{
	            $this->ajaxReturn(array('status'=>0,'msg'=>'数据创建错误'));
	        }
		//修改
		}elseif($this->_request('type')=='edit'){
			$data['id']	=	$this->_request('id');
			$data['name'] = $this->_request('name');
			$data['action'] = $this->_request('action');
			$data['option'] = $this->_request('option');
			$data['status'] = intval($this->_request('status'));
			$data['show'] = intval($this->_request('show'));
			$data['order'] = intval($this->_request('order'));
			$result = $this->m->save($data);
			if($result) {
	            $this->ajaxReturn(array('status'=>1));
	        }else{
	            $this->ajaxReturn(array('status'=>0,'msg'=>'数据更新出错'));
	        }
		//获取
		}else{
			if($this->_request('id')){
				$data = $this->m->find( $this->_request('id') );
				if($data){
					$data = array_merge(array('isok'=>1),$data);
				}else{
					$data = array('isok'=>0,'msg'=>'未找到数据');
				}
			}else{
				$data = array('isok'=>0,'msg'=>'未获取参数');
			}
			$this->ajaxReturn ($data);
		}
	}
	
	public function remove()
	{
		
	}

}