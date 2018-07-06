<?php

/*
  Public模块拥有公共权限, 不受权限列表控制, 所有用户都可访问.
 */

class PublicAction extends Action {

    public function login() {
        $this->display();
    }

    // 登录检测
    public function verify() {
        if (md5(strtoupper($this->_post('verifycode'))) == session('verify')) {
            if ($this->_post('account') && $this->_post('password')) {
                $m = M('kf_user');
                $map['account'] = strtolower($this->_post('account'));
                $map['password'] = md5($this->_post('password'));
                $res = $m->field('id')->where($condition)->find();
                if ($res) {
                    session('account', $this->_post('account'));

                    //获取用户权限, 供操作判断用
//                    $power = M('admin_user')->field('powerid')->join('admin_group ON admin_group.id = admin_user.group ')->where(' admin_user.id=' . $res['id'])->find();
//                    session('powerid', $power['powerid']);

                    $this->ajaxReturn(array('status' => 1));
                } else {
                    $this->ajaxReturn(array('status' => 0, 'info' => '账号不存在或密码错误'));
                }
            } else {
                $this->ajaxReturn(array('status' => 0, 'info' => '账号或密码有问题'));
            }
        } else {
            $this->ajaxReturn(array('status' => 0, 'info' => '验证码错误'));
        }
    }

    /*
     * 生成图片验证码
     */

    public function verifycode() {
        import('ORG.Util.Image');
        Image::buildBigImageVerify();
        //Image::buildImageVerify();
    }

    //退出
    public function logout() {
        session('account', null);
        echo '<script type="text/javascript">top.location = "' . U('Public/login') . '"</script>';
    }

    //更改密码, 显示
    public function modify() {
        if (!session('account')) {
            exit('<script type="text/javascript"> top.location="' . U('Public/login') . '" </script>');
        } else {
            $this->show();
        }
    }

    //更改密码, 更改
    public function changePwd() {
        if (!session('account')) {
            exit('<script type="text/javascript"> top.location="' . U('Public/login') . '" </script>');
        } else {

            $m = M('kefu_user');
            $map['account'] = session('account');
            $account = $m->where($map)->find();

            if ($account) {
                if ($account['password'] == md5($this->_post('old_pwd'))) {
                    $data = array();
                    $data['password'] = md5($this->_post('new_pwd'));
                    if ($m->where($map)->save($data)) {
                        $this->success('保存成功', U(MODULE_NAME . '/index'));
                    } else {
                        $this->error('保存错误', U(MODULE_NAME . '/modify'));
                    }
                } else {
                    $this->error('原密码错误', U(MODULE_NAME . '/modify'));
                }
            } else {
                $this->error('没有获取到账户数据.', U(MODULE_NAME . '/modify'));
            }
        }
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
        
        //$width = $this->_get('width') ? $this->_get('width') : 999;
        //$height = $this->_get('height') ? $this->_get('height') : 999;


        import('ORG.Net.UploadFile');

        $config = array(
            'maxSize' => 1048576, // 上传文件的最大值 1mb
            'allowExts' => array('jpg', 'jpeg', 'png', 'gif'), // 允许上传的文件后缀 留空不作后缀检查
            //'savePath' => 'Public/Uploads/' . $this->_post('module') . '/'.$this->_post('id'), // 上传文件保存路径
            'savePath' => 'Public/Uploads/' . $this->_post('module').'/' , // 上传文件保存路径
            'autoSub' => true, // 启用子目录保存文件
            'subType' => 'custom', // 子目录创建方式 可以使用hash date custom
            'subDir' => $this->_post('id').'/',
        );

        $f = new UploadFile($config);
        if ($f->upload($_FILES['file_upload'])) {
            $res = $f->getUploadFileInfo();
            //print_r($res);
            $imgurl = '/'.$res[0]['savepath'] . $res[0]['savename'];
            $this->ajaxReturn(array('status' => 1, 'imgname' => $imgurl));
            exit;
            //$thumb_name = getimg(C('BASE_PATH') . '/Public/Uploads/' . $this->_post('module') . '/'.$this->_post('id'). '/' . $res[0]['savename'], $width, $height);
            if ($thumb_name !== false) {
                $this->ajaxReturn(array('status' => 1, 'imgname' => $thumb_name));
            } else {
                $this->ajaxReturn(array('status' => 0, 'error' => '缩略图生成出错 '));
            }
        } else {
            $this->ajaxReturn(array('status' => 0, 'error' => $f->getErrorMsg()));
        }
    }

    /**
     * 上传图片或文件验证(用flash上传)
     *
     * @param varchar $form_name 上传文件的名称，input框的name值
     * //@param unknown_type $dir  文件存放路径
     * @param unknown_type $size 文件大小限制
     * @param unknown_type $width 缩略图宽度
     * @param unknown_type $height 缩略图高度
     * @return unknown
     */
    public function img_upload() {

        $width = isset($_GET['width']) ? $_GET['width'] : 999;
        $height = isset($_GET['height']) ? $_GET['height'] : 999;
        /* 文件类型数组 */
        $file_exts = array('png', 'jpg', 'jpeg', 'gif');
        $upload_file = $_FILES["Filedata"];

        if ($upload_file['size'] > 1024000) {
            $this->error("图片不得超过 1024 KB");
        }
        //得到扩展名
        preg_match('|\.(\w+)$|', $upload_file['name'], $ext);
        $ext = strtolower($ext[1]);

        if (!in_array($ext, $file_exts)) {
            $this->error('文件类型不正确！');
        }

        /* 如果目标目录不存在，则创建它 */
        $name = $this->getActionName();
        if ($name) {

            $dir = C('BASE_PATH') . '/Public/Uploads/product/' . date('Ydmhis', $_SERVER['REQUEST_TIME']);
            if (!file_exists($dir)) {
                if (!mkdir($dir)) {
                    $this->error(' 创建' . $dir . '目录失败'); // 创建目录失败
                }
            }
        } else {
            $this->error('未获取当前模块名字');
        }

        $file_name = $SERVER['REQUEST_TIME'] . rand(10, 100) . '.' . $ext;

        if (move_uploaded_file($upload_file['tmp_name'], $dir . '/' . $file_name)) {
            $img = getimg($dir . '/' . $file_name, $width, $height); //自己规划的

            $img = str_replace(C('BASE_PATH'), '', $dir . '/' . $file_name); //返回文件地址
            echo json_encode(array('status' => 1, 'imgname' => $img));
        } else {
            //$this->error('文件上传失败，请重试！');
            echo json_encode(array('status' => 0, 'error' => '文件上传失败，请重试！'));
        }
    }

    /**
     *
     * 生成缩略图函数
     * @param unknown_type $big_img  大图文件所在路径
     * @param unknown_type $maxwidth  最大宽
     * @param unknown_type $maxheight 最大高
     * @param unknown_type $name	  保存小图的的路径名字
     * @param unknown_type $filetype
     * resizeImage($save_path.$file_name,$width,$height,$save_path.$file_name);
     */
    public function resizeImage($big_img, $maxwidth, $maxheight, $name, $filetype = '') {
        $imgage = getimagesize($big_img); //获取大图信息
        switch ($imgage[2]) {//判断图像类型
            case 1:
                $im = imagecreatefromgif($big_img);
                break;
            case 2:
                $im = imagecreatefromjpeg($big_img);
                break;
            case 3:
                $im = imagecreatefrompng($big_img);
                break;
        }
        $pic_width = imagesx($im);
        $pic_height = imagesy($im);

        if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
            if ($maxwidth && $pic_width > $maxwidth) {
                $widthratio = $maxwidth / $pic_width;
                $resizewidth_tag = true;
            }

            if ($maxheight && $pic_height > $maxheight) {
                $heightratio = $maxheight / $pic_height;
                $resizeheight_tag = true;
            }

            if ($resizewidth_tag && $resizeheight_tag) {
                if ($widthratio < $heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }

            if ($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if ($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;

            $newwidth = $pic_width * $ratio;
            $newheight = $pic_height * $ratio;

            if (function_exists('imagecopyresampled')) {
                $newim = imagecreatetruecolor($newwidth, $newheight);
                imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            } else {
                $newim = imagecreate($newwidth, $newheight);
                imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
            }

            //	$name = $name.$filetype;
            imagejpeg($newim, $name);
            imagedestroy($newim);
        } else {
            //	$name = $name.$filetype;
            imagejpeg($im, $name);
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

}
