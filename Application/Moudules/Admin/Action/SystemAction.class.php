<?php
//产品
class SystemAction extends CommonAction {

	
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

	//接收上传图片
	public function uploadimg()
	{

		import('ORG.Net.UploadFile');

		$config = array(
			'maxSize'           =>  1048576,    // 上传文件的最大值 1mb
			'allowExts'         =>  array('jpg','jpeg','png','gif'),    // 允许上传的文件后缀 留空不作后缀检查
			'savePath'          =>  'Public/Uploads/program/',// 上传文件保存路径
			'autoSub'			=>	true,
			'subType'			=>	'unique',
        );

		$f = new UploadFile($config);
		if( $f->upload($_FILES['file_upload']) )
		{
			$res = $f->getUploadFileInfo();
			$imgdir = C('BASE_PATH').'/Public/Uploads/program/'.$res[0]['savename'];
			$thumb_name = getimg( $imgdir,500,376);

			if($thumb_name !== false)
			{
				$thumb_name = getimg( $imgdir,100,100);
				$this->ajaxReturn( array('status'=>1,'imgname'=>str_replace('/Public/Uploads/program','',$thumb_name)) );
			}else{
				$this->ajaxReturn( array('status'=>0,'error'=>'缩略图生成出错 ' ) );
			}
		}else{
			$this->ajaxReturn( array('status'=>0,'error'=>$f->getErrorMsg() ) );
		}
	}

	//删除图片
	public function delimg()
	{
		$img = $this->_get('img');

		$deldir = substr($img,0,18);	//得到目录名, 把这个目录都删了

		echo C('BASE_PATH').'/Public/Uploads/program'.$deldir;

		unlink( C('BASE_PATH').'/Public/Uploads/program'.$deldir );
	}

}