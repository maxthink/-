<?php
//产品
class AcategoryAction extends CommonAction {
	
	protected $table_name = 'article_category';       //表名

	public function index()
	{
		$map = array();
		$list = $this->m->where($map)->order('p_id asc, `order` asc')->select();
		//var_dump($list); exit;
		$this->assign('list',json_encode($list));
		$this->display();
	}

	public function modify()
	{
		//添加
		if($this->_request('option')=='add'){
			$data['name'] = $this->_request('name');
			$data['status'] = intval($this->_request('status'));
			$data['order'] = intval($this->_request('order'));
			$data['p_id'] = $this->_request('p_id');
                        $data['type'] = $this->_request('type');
			//if($data['level'] >2) $this->ajaxReturn(array('status'=>0,'msg'=>'权限层数过多了'));
			$result = $this->m->add($data);
			if($result) {
                            $this->ajaxReturn(array('status'=>1));
                        }else{
                            $this->ajaxReturn(array('status'=>0,'msg'=>'数据创建错误'));
                        }
		//修改
		}elseif($this->_request('option')=='edit'){
			$data['id']	=	$this->_request('id');
			$data['name'] = $this->_request('name');
			$data['status'] = intval($this->_request('status'));
			$data['order'] = intval($this->_request('order'));
                        $data['type'] = $this->_request('type');
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
					$data = array('status'=>1,'data'=>$data);
				}else{
					$data = array('status'=>0,'msg'=>'未找到数据');
				}
			}else{
				$data = array('status'=>0,'msg'=>'未获取参数');
			}
			$this->ajaxReturn ($data);
		}
	}
    
}