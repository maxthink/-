<?php

// 页面显示框架

class AdminPowerAction extends Model {
	
	public function index(){
		$this->show();
	}

	public function top(){
		$m=M('admin_power');
		$nav = $m->where('category=0')->select();
		$this->display('nav',$nav);
	}

	public function left(){
		$this->show();
	}

	public function main(){
		$this->show();
	}

	public function change(){
		$this->show();
	}

	public function footer()
	{
		$this->display();
	}

}