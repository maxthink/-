<?php

class IndexAction extends Action {

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
    
    
    public function test()
    {
        $a = 'ab';
        $b = 'wkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbkwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcbwkajkdjpavakljvkjblkdiakxnbrkjewksjcxnabdjfiucjdbajdjcb';
        
        G('begin');        
        $re = preg_match_all('/a.*b/iU',$b,$match);
        print_r($re);
        //print_r($match);
        G('end');
        echo G('begin','end').'s';
        
        
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

    //显示详细
    public function show() {
        
    }

}
