<?php

class WxAction extends CommonAction {

    public $weObj;

    public function _initialize() {

        if(!session('account'))
        {
            exit( '<script type="text/javascript"> top.location="'.U('Public/login').'" </script>' );
        }else{
            if (empty($this->table_name)) {
                    $this->table_name = $this->getActionName();
            }
            $this->m= D($this->table_name);

            //判断权限

        }
        
        import('ORG.Net.Wechat');
        $options = array(
            'appid' => 'wxd514157e7ad961b9', //填写你设定的key
            'appsecret' => '9edadd432467caed26d430e36b1078d3',
            'token' => 'qwer1234',
            'encodingaeskey' => 'HDuMC73rMl1uOq1YEJ4TpdDR7OewwKwXRi5GttjeFF2' //填写加密用的EncodingAESKey，如接口为明文模式可忽略
        );
        $this->weObj = new Wechat($options);
        
        
    }

}
