<?php

// 图片管理
class ImageAction extends CommonAction {

    //图片列表
    public function index()
    {
        
        $count = $this->m->count();  //查询满足要求的总记录数

        import('ORG.Util.Page');    //导入分页类
        $Page	= new Page($count,$this->page_num);  //实例化分页类, 总记录数, 每页显示数
        $Page->rollPage = $this->page_roll;	//最多显示10个分页
        $show = $Page->show();  //分页显示输出

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数
        $nowPage = $this->_request('p') ? intval($this->_request('p')) : 1;
        $list = $this->m->order('id desc')->page($nowPage,$Page->listRows)->select();
        //echo $this->m->getLastSql();
                    
        $this->assign('page',$show);    //赋值分页输出
        $this->assign('list',$list);    //赋值数据集
        $this->display();   //输出模板
    }

    public function modify() {
        //获取
        if ($this->_get('id')) {

            $res = $this->m->find(intval($this->_request('id')));
            
            if ($res) {
                $this->assign('vo', $res);
            } else {
                $this->error('未找到数据.', U(MODULE_NAME . '/index'));
            }
        }

        if ($this->_post('subflag')) {
            
            //更新
            if ($this->_post('id')) {
                
                if ($this->m->create()) { //创建数据对象
                    
                    $this->m->timeline = strtotime($this->_post('timeline')); //字符串时间转换为时间戳

                    if ($this->m->save()) { // 把用户对象写入数据库
                        $this->success('更新成功', U(MODULE_NAME . '/index'));
                        exit;
                    } else {
                        $this->error('更新出错:' . $this->m->getError(), U(MODULE_NAME . '/modify', array('id' => $this->_post('id'))));
                    }
                } else {
                    $this->error('更新时创建数据模型出错.', U(MODULE_NAME . '/index'));
                }
                //添加
            } else {
                if ($this->m->create()) {
                    $this->m->timeline = strtotime($this->_post('timeline')); //字符串时间转换为时间戳
                    
                    if ($this->m->add()) {
                        $this->success('添加成功', U(MODULE_NAME . '/index'));
                        exit;
                    } else {
                        $this->error('更新出错', U(MODULE_NAME . '/modify', array('id' => $this->_post('id'))));
                    }
                } else {
                    $this->error('添加时创建数据模型出错.', U(MODULE_NAME . '/index'));
                }
            }
        }

        $this->display();
    }

    //上传文件
    public function uploadimg() {
        error_reporting(E_ALL);
        $config = array(
            'maxSize' => 1048576, // 上传文件的最大值 1mb
            'allowExts' => array('jpg', 'jpeg', 'png', 'gif'), // 允许上传的文件后缀 留空不作后缀检查
            'allowTypes' => array('jpg', 'jpeg', 'png', 'gif'), // 允许上传的文件类型 留空不做检查
            'thumbPath' => '', // 缩略图保存路径
            'thumbFile' => '', // 缩略图文件名
            'autoSub' => true, // 启用子目录保存文件
            'subType' => 'hash', // 子目录创建方式 可以使用hash date custom
            'subDir' => '', // 子目录名称 subType为custom方式后有效
            'hashLevel' => 1, // hash的目录层次
            'savePath' => '', // 上传文件保存路径
        );

        if (!$this->_post('module')) {
            $this->ajaxReturn(array('status' => 0, 'error' => '没有获取图片模块参数'));
        }
        if (!$this->_post('id')) {
            $this->ajaxReturn(array('status' => 0, 'error' => '没有获取图片ID参数'));
        }

        import('ORG.Net.UploadFile');

        $config = array(
            'maxSize' => 1048576, // 上传文件的最大值 1mb
            'allowExts' => array('jpg', 'jpeg', 'png', 'gif'), // 允许上传的文件后缀 留空不作后缀检查
            'savePath' => 'Public/Uploads/' . $this->_post('module') . '/', // 上传文件保存路径
            'autoSub' => true, // 启用子目录保存文件
            'subType' => 'custom', // 子目录创建方式 可以使用hash date custom
            'subDir' => $this->_post('id') . '/',
            'saveRule'  =>  $this->_post('id'), //如果没有此规则, 就当称文件名用了.
            
        );

        //删除目前目录下的图片
        $this->deldir( 'Public/Uploads/' . $this->_post('module') . '/'.$this->_post('id') );

        $f = new UploadFile($config);
        if ($f->upload($_FILES['file_upload'])) {
            $res = $f->getUploadFileInfo();
            //print_r($res);
            $imgurl = '/' . $res[0]['savepath'] . $res[0]['savename'];
            $this->ajaxReturn(array('status' => 1, 'imgname' => $imgurl));
            exit;
            $thumb_name = getimg($imgurl, $width, $height);
            if ($thumb_name !== false) {
                $this->ajaxReturn(array('status' => 1, 'imgname' => $thumb_name));
            } else {
                $this->ajaxReturn(array('status' => 0, 'error' => '缩略图生成出错 '));
            }
        } else {
            $this->ajaxReturn(array('status' => 0, 'error' => $f->getErrorMsg()));
        }
    }

    public function delimg() {
        $img = C('BASE_PATH') . $this->_get('img');
        $p = strrpos($img, '/');
        $img_dir = substr($img, 0, $p);

        if (is_dir($img_dir)) {
            if (rmdir($img_dir)) {
                $this->ajaxReturn(array('status' => 1, 'msg' => ''));
            } else {
                $this->ajaxReturn(array('status' => 0, 'msg' => '删除出错'));
            }
        } else {
            $this->ajaxReturn(array('status' => 0, 'msg' => '文件不存在'));
        }
    }

    private function deldir($dir) {
        //先删除目录下的文件：
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                if (!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }

        closedir($dh);
        //删除当前文件夹：
        if (rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }

}
