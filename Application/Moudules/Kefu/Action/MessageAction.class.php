<?php
class PublicAction extends Action {
    
	public function login()
	{
		$this->display();
	}

    // 登录检测
    public function verify() {
        if( md5($this->_post('verifycode')) == session('verify') )
		{
			if($this->_post('account') && $this->_post('password') )
			{
				$m = M('admin_user');
				$condition['account'] = $this->_post('account');
				$condition['password'] = $this->_post('password');
				$res = $m->where($condition)->select();
				if($res){
					session('account',$this->_post('account'));
					$this->ajaxReturn(1,'',1);
				}else{
					$this->ajaxReturn(0,'账号不存在或密码错误',0);
				}
			}else{
				$this->ajaxReturn(0,'账号或密码有问题',0);
			}
		}else{
			$this->ajaxReturn(0,'验证码错误',0);
		}
		      
    }

	/* 
	* 生成图片验证码 
	*/
	public function verifycode()
	{
		import('ORG.Util.Image');
        Image::buildImageVerify();
	}
	
	//退出
	public function logout()
	{
		session('account',null);
		echo '<script type="text/javascript">top.location = "/'.GROUP_NAME.'"</script>';
	}
    
}