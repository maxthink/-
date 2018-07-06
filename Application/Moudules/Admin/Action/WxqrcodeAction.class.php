<?php

//产品
class WxqrcodeAction extends WxAction {

    //列表
    //获取二维码图片
    public function getqrcode() {
        if ($this->_get('id')) {
            $sid = $this->_get('id');

            $res = $this->weObj->getqrcode($sid, 1); //获取永久二维码
            if (isset($res['ticket'])) {
                $qr = $this->weObj->getQRUrl($res['ticket']);
                echo json_encode(array('status' => 1, 'img' => $qr));
            } else {
                echo json_encode(array('status' => 0, 'msg' => 'ticket获取错误'));
            }
        } else {
            echo json_encode(array('status' => 0, 'msg' => '没有获取到id'));
        }
    }

    //生成带logo图标的二维码
    public function getlogoqrcode() {
        if ($this->_get('id')) {
            $sid = $this->_get('id');

            $res = $this->weObj->getqrcode($sid, 1);
            if (isset($res['ticket'])) {
                $qr = $this->weObj->getQRUrl($res['ticket']);
                
                $img = 'qrcode/' . $sid . '.jpg';
                import('ORG.Net.Http');
                Http::curlDownloadNew($qr, getcwd().'/'.$img);

                import('ORG.Util.Image');
                $k = Image::weixinLogo( getcwd().'/'.$img, getcwd().'/logo_li.png');
                
                echo json_encode(array('status' => 1, 'img' => $img));
            } else {
                echo json_encode(array('status' => 0, 'msg' => 'ticket获取错误'));
            }
        } else {
            echo json_encode(array('status' => 0, 'msg' => '没有获取到id'));
        }
    }
    
    
}