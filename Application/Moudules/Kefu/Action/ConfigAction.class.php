<?php
// 商家
class ConfigAction extends Action {
    
	 public function index()
    {
        $name = $this->getActionName();
        $m = M($name); // 实例化Data数据对象
        import('ORG.Util.Page');// 导入分页类
        //$map = array('status'=>1);
        if(session('group') != 1)$map = array('aid'=>$_SESSION['aid']);
        $count      = $m->where($map)->count();
        $Page       = new Page($count,10);
        $Page->rollPage = 20;   //最多显示20个分页

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
        $nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
        $offect = ($nowPage-1)*$Page->listRows;
        if(session('group') != 1){
            $sql = 'select * from '.getTableName($name).'
                    where  aid='.session('areaid').'
                    limit '.$offect.','.$Page->listRows;
        }else{
            $sql = 'select * from '.getTableName($name).'
                    where 1 
                    limit '.$offect.','.$Page->listRows;
        }
        $list = $m->query( $sql );
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }

    public function edit() {
        $name = $this->getActionName();
        $m=M($name);
        $this->assign('group', session('group'));

        if($_POST['subflag']){
            $m->create();
           // $m->create_time = !empty($_POST['create_time'])?$_POST['create_time']:date('Y-m-d H:i:s');
            $result = $m->save();

            if($result) {
                $this->success('操作成功！',"index");
            }else{
                $this->error('写入错误！',"index");
            }
           
        }else{
        
            if ($this->_get('id')) {
                //商家分类
                $type = getCategorys(1);
                $this->assign('type', $type); 
                //邯郸各个县
                $area = getAreas();
                $this->assign('area', $area);
                
                $condition['id'] = $this->_get('id');
                if(session('group') != 1)$condition['aid'] =session('areaid');
                $res = $m->where($condition)->select();

                if($res){
                    $this->assign('vo', $res[0]); 
                }
            }else{
                echo 111;exit;
                $this->ajaxReturn(0, '非法进入', 0);
            }
            $this->display();
        }
    }
  

    
    
    public function add(){
        
        if($_POST['subflag']){
        	$name = $this->getActionName();
            $m=M($name);
            $m->create();
            $m->create_time = !empty($_POST['create_time'])?$_POST['create_time']:date('Y-m-d H:i:s');
            if(session('group') != 1)$m->aid =session('areaid');
            $result = $m->add();
            if($result) {
                $this->success('操作成功！',"index");
                exit(0);
            }else{
                $this->error('写入错误！',"index");
                exit(0);
            }
        }

        //商家分类
        $type = getCategorys(1);
        $this->assign('type', $type); 
        //邯郸各个县
        $area = getAreas();
        $this->assign('area', $area);
        $this->assign('group', session('group'));
        $this->display();
    }
    
    public function show() {
        
        if ($this->_get('id')) {
            $m = M('Businesses');
            $condition['id'] = $this->_get('id');
            $res = $m->where($condition)->select();
            $catname =  showCategory($res[0]['catid']);
            $areaname =  showArea($res[0]['aid']);
            if($res){
                $this->assign('vo', $res[0]); 
                $this->assign('catname', $catname); 
                $this->assign('areaname', $areaname); 
            }
        }else{
            $this->ajaxReturn(0, '非法进入', 0);
        }


        $this->display();
    }
	

}

