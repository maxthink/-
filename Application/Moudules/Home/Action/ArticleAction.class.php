<?php

// 新闻
Load('extend');

class ArticleAction extends Action {

    //综合排名....
    public function index() {
        
        $m = M('article');
        import('ORG.Util.Page'); // 导入分页类
        
        $map = array('status'=>1);
        $count = $m->where($map)->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 10); // 实例化分页类 传入总记录数
        
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;

        $list = $m->where($map)->order('timeline desc')->page($nowPage . ',' . $Page->listRows)->select();
        //$Page->setConfig('theme', '%upPage% %downPage% %prePage% %linkPage% %nextPage%');
        $page = $Page->getdata(); // 分页显示输出
        //print_r($page);
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->display();
    }
    
    public function page()
    {
        $m = M('article');
        import('ORG.Util.Page'); // 导入分页类
        
        $map = array('status'=>1);
        $count = $m->where($map)->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 10); // 实例化分页类 传入总记录数
        
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;

        $list = $m->where($map)->order('timeline desc')->page($nowPage . ',' . $Page->listRows)->select();
        $page = $Page->getdata(); // 分页显示输出
        //var_dump($page);
        $this->ajaxReturn(array('status'=>1,'list'=>$list,'page'=>$page),'JSON');

    }
    
    //阅读数
    public function read()
    {
        $m = M('article');
        import('ORG.Util.Page'); // 导入分页类
        
        $map = array('status'=>1);
        $count = $m->where($map)->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 10); // 实例化分页类 传入总记录数
        $Page->rollPage = 20; //最多显示20个分页
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;

        $list = $m->where($map)->order('timeline desc')->page($nowPage . ',' . $Page->listRows)->select();
        $Page->setConfig('theme', '%upPage% %downPage% %prePage% %linkPage% %nextPage%');
        $page = $Page->show(); // 分页显示输出

        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->display();
    }
    
    //最新
    public function last()
    {
       
    }

    //显示详细新闻
    public function show() {
        $id = $this->_get('id');
        $m = M('News');
        $new = $m->find($id);
        // $new['content'] = htmlspecialchars($new['content']);
        $this->assign('new', $new); // 赋值数据集
        $this->display();
    }

}
