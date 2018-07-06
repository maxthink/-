<?php

// 页面显示框架

class IndexAction extends Action {

	public function index(){
            if(!session('account'))
            {
                exit( '<script type="text/javascript"> top.location="'.U('Public/login').'" </script>' );
            }
            $this->display();
	}
	
	//管理后台顶部显示菜单控制
	public function top(){

            $m=M('admin_module');
            $nav = $m->where('level=0 and status=1')->order('id asc')->select();
            $this->assign('navs',$nav);
            $this->display();
	}
	
	//左侧可显示菜单控制
	public function left(){
            
            $navid = $this->_get('id') ? $this->_get('id') : 1;
			
            $m = M('admin_module');
            $navs = $m->where(' p_id = '.$navid.' and status=1 ')->order('level asc')->select();

            foreach($navs as $key=>$val)
            {
                    $sub_navs = $m->where(' p_id = '.$val['id'].' and status=1 ')->order('`order` asc')->select();
                    $navs[$key]['sub_navs'] = $sub_navs;
            }
            
            $this->assign('navs',$navs);
            $this->display();
	}

	public function main(){
		
            $this->display();
	}

	public function change(){
            $this->display();
	}

	public function footer()
	{
            $this->display();
	}
	

}