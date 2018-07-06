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
        $this->weObj = new Wechat(C('WX_CONFIG'));
    }

}
