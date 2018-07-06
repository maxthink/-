<?php

// 新闻
Load('extend');

class IndexAction extends Action {

    
    public function index() {
        
        $m = M('wxmedianews');
        import('ORG.Util.Page'); // 导入分页类
        
        $count = $m->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 20); // 实例化分页类 传入总记录数
        
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;

        $list = $m->cache('M_index_index',60)->where($map)->order('update_time desc')->page($nowPage . ',' . $Page->listRows)->select();
        //$Page->setConfig('theme', '%upPage% %downPage% %prePage% %linkPage% %nextPage%');
        $page = $Page->getdata(); // 分页显示输出
        //print_r($page);
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->display();
    }
    
    public function index1() {
        
        $m = M('wxmedianews');
        import('ORG.Util.Page'); // 导入分页类
        
        $count = $m->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 20); // 实例化分页类 传入总记录数
        
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = $this->_get('p');
        if($nowPage==NULL) $nowPage=1;
        
        $c_type = $this->_get('type');
        $where = '';
        if($c_type){
            $where .= ' type&'.$c_type;
        }

        $list = $m->cache(true,6000,'file')->where($where)->order('update_time desc')->page($nowPage . ',' . $Page->listRows)->select();
        //$Page->setConfig('theme', '%upPage% %downPage% %prePage% %linkPage% %nextPage%');
        $page = $Page->getdata(); // 分页显示输出

        $m = M('wxmedianews_type');
        $category = $m->cache(true,6000,'file')->where(array('status'=>1))->order(' ord asc ')->select();
        
        
        $this->assign("types", $category);
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->display();
    }
    
    
    public function page()
    {
        $m = M('wxmedianews');
        import('ORG.Util.Page'); // 导入分页类
        
        //$map = array('status'=>1);
        $count = $m->where($map)->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 20); // 实例化分页类 传入总记录数
        
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;

        $list = $m->where($map)->order('update_time desc')->page($nowPage . ',' . $Page->listRows)->select();
        $page = $Page->getdata(); // 分页显示输出
        foreach($list as $k=>$val){
            $list[$k]['cover_dir'] = getimg($val['cover_dir'], 150);    //处理封面
        }
        
        $this->ajaxReturn(array('status'=>1,'list'=>$list,'page'=>$page),'JSON');

    }

    //显示详细
    public function show() {
        
    }

}
