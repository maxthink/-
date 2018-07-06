<?php

// 页面显示框架

class IndexAction extends Action {

	public function index(){
            
            
            $list = array(
                array('url'=>'ddd','cover'=>'llllll','title'=>'*****s雷迪克陆文杰类似可跨世纪','summary'=>'粝食空弹剑速率可达减肥离开家链接逻辑')
            );
            $this->assign('list',$list);
            $this->display();
	}
	
	
        
	

}