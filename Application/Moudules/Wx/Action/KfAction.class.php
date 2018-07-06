<?php

/**
 * 客服接口
 * @author luyanming
 * @link http://www.**.com
 */
class KfAction extends Action {

    private $weObj;
    private $openid;

    public function _initialize() {

        import('ORG.Net.Wechat');
        $this->weObj = new Wechat(C('WX_CONFIG'));
    }

    //客服发送文本消息给用户
    public function sendMsg(){
        $openid = $this->_request('openid');
        $kfid = $this->_request('kfid');
        $content = $this->_request('content');
        
        $data = array(
            'touser'=>$openid,
            'msgtype'=>'text',
            'text'=>array(
                'content'=>$content,
            ),
            'customservice'=>array(
                //'kf_account'=> $this->getKf($kfid),
                'kf_account'=> 'kefu01@fuxingxiaoqu'
            ),
        );
        
        $res = $this->weObj->sendCustomMessage($data);
        
        if(isset($res['errcode']) && $res['errcode']==0){   //发送成功, 处理储存
            $data = array(
                'openid'=>$openid,
                'kfid'=>$kfid,
                'msgtype'=>'text',
                'content'=>$content,
                'createtime'=>time(),
            );
            $m=M('wxmsg');
            $inid = $m->add($data);
            
            //do  更新用户是否回复状态
            $m=M('kf_talking');
            $data = array(
                'openid'=>$openid,
                'isreplay'=>0,
            );
            $m->save($data);
            
            $return = array('status'=>1,'inid'=>$inid );
        }elseif( isset($res['errcode']) ){
            $return  = array('status'=>0,'msg'=>$res['errcode']);
        }else{
            $return  = array('status'=>2,'msg'=>print_r($res,1));
        }
        echo json_encode($return);
    }
    
    //发送图片
    public function sendImage(){
        set_time_limit(0);
        error_reporting(E_ALL);
        
        $openid = $this->_request('openid');
        $kfid = $this->_request('kfid');
        
        import('ORG.Net.UploadFile');

        $config = array(
            'maxSize' => 1048576, // 上传文件的最大值 1mb
            'allowExts' => array('jpg', 'jpeg', 'png', 'gif'), // 允许上传的文件后缀 留空不作后缀检查
            'savePath' => C('WXMEDIA.TEMP'), // 上传文件保存路径
            'thumbPath' => '', // 缩略图保存路径
            'autoSub' => false, // 启用子目录保存文件
            'subType' => 'custom', // 子目录创建方式 可以使用hash date custom
            'subDir' => '',
            'saveRule'  =>  'time', //如果没有此规则, 就当称文件名用了.
        );

        $f = new UploadFile($config);
        if ($f->upload($_FILES['Filename'])) {
            $res = $f->getUploadFileInfo();
            //print_r($res);
            $imgurl = $res[0]['savepath'] . $res[0]['savename'];
            
            $m = M('wxmedia_temp');
            $inid = $m->add(  array( 'type'=>'image',  'dir'=>$imgurl, 'timeline'=>time() )  );
            
            
            /**
                * 上传临时素材，有效期为3天(认证后的订阅号可用)
                * 注意：上传大文件时可能需要先调用 set_time_limit(0) 避免超时
                * 注意：数组的键值任意，但文件名前必须加@，使用单引号以避免本地路径斜杠被转义
                * 注意：临时素材的media_id是可复用的！
                * @param array $data {"media":'@Path\filename.jpg'}
                * @param type 类型：图片:image 语音:voice 视频:video 缩略图:thumb
                * @return boolean|array
            */
            $data = array('media'=>'@'.$imgurl);
            $res = $this->weObj->uploadMedia($data,'image');
            
            //Array (
            //    [type] => image
            //    [media_id] => i-HJLIvXHOtpj0OZiiu5Aq7evu6GHrX7yVEd7W-7AG5IZoqrRgjab9m5uexV9Gc8
            //    [created_at] => 1442919343
            //)
            if(is_array($res) && isset($res['type']) && $res['type']=='image' ){
                
                //@todo 保存media_id,和生成时间
                $m->save( array('id'=>$inid,'media_id'=>$res['media_id'],'created_at'=>$res['created_at'] ));
                
                //@todo 发送图片消息给用户
                $data = array(
                    'touser'=>$openid,
                    'msgtype'=>'image',
                    'image'=>array('media_id'=>$res['media_id'])
                );
                $re = $this->weObj->sentKFmsg($data);
                if( isset($re['errcode']) && $re['errcode']==0 ){
                    
                    //@todo 添加聊天记录
                    $data = array(
                        'openid'=>$openid,
                        'kfid'=>$kfid,
                        'msgtype'=>'image',
                        'dir'=>$imgurl,
                        'createtime'=>time(),
                    );
                    $m = M('wxmsg');
                    $m->add($data);
                    
                    //@todo  返回成功, 图片数据
                    $this->ajaxReturn(array('status' => 1, 'image' => '/' . $imgurl));
                }else{
                    $this->ajaxReturn(array('status' => $this->weObj->errCode , 'msg' => $this->weObj->errMsg ));
                }
            }else{
                $this->ajaxReturn(array('status' => $this->weObj->errCode , 'msg' => $this->weObj->errMsg ));
            }

//           // $thumb_name = getimg($imgurl, $width, $height);
//            if ($thumb_name !== false) {
//                $this->ajaxReturn(array('status' => 1, 'imgname' => $thumb_name));
//            } else {
//                $this->ajaxReturn(array('status' => 0, 'error' => '缩略图生成出错 '));
//            }
        } else {
            $this->ajaxReturn(array('status' => 0, 'msg' => $f->getErrorMsg()));
        }
    }
    
    //获取客服
    private function getKf($kfid)
    {
        return M('wx_uer')->field('account')->find($kfid);
    }
    
    
    

}
