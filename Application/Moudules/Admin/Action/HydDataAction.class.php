<?php

//检测数据
class HydDataAction extends CommonAction {

    
    
    //列表
    public function index()
    {
        //$map = array('status'=>1);
        $count = $this->m->where($map)->count();  //查询满足要求的总记录数

        import('ORG.Util.Page');    //导入分页类
        $Page	= new Page($count,$this->page_num);  //实例化分页类, 总记录数, 每页显示数
        $Page->rollPage = $this->page_roll;	//最多显示10个分页
        $show = $Page->show();  //分页显示输出

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数
        $nowPage = $this->_request('p') ? intval($this->_request('p')) : 1;
        $list = $this->m->where($map)->order('id desc')->page($nowPage,$Page->listRows)->select();
        
        $sql = 'SELECT d.id,h.id hid,h.name,machineType, g_id, ttrue,msampleno,mtype,d.timeline,d.ip FROM `hyd_data` d LEFT JOIN hospital h on d.hid=h.id order by d.id desc limit '.(($nowPage-1)*$Page->listRows).','.$Page->listRows;
        $list = $this->m->query($sql);
//echo $this->m->getLastSql();
        $this->assign('page',$show);    //赋值分页输出
        $this->assign('list',$list);    //赋值数据集
        $this->display();   //输出模板
    }

}
