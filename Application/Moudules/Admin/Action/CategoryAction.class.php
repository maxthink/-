<?php
//节目
class CategoryAction extends CommonAction {

    function index()
	{
		$name = $this->getActionName();
		$m = M($name); // 实例化Data数据对象
		import('ORG.Util.Page');// 导入分页类
		$map = array('status'=>1);
		$count      = $m->where($map)->count();
		$Page       = new Page($count,10);
		$Page->rollPage = 20;	//最多显示20个分页

		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数, 使用 $_GET[p]获取
		$nowPage = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
		$offect = ($nowPage-1)*$Page->listRows;

		$sql = 'select cl.id, cl.name_en, cl.name  from '.getTableName($name).' as cl left join '.getTableName($name).' as cr on cl.pid=cr.id
				where cl.status=1
				order by cl.pid
				limit '.$offect.','.$Page->listRows;


		$list = $m->query( $sql );

		$show = $Page->show();
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

	public function edit() {
        
        if ($this->_get('id')) {
            $m = M('Category');
            $condition['id'] = $this->_get('id');
            $res = $m->where($condition)->select();
            
            if($res){
                $this->assign('vo', $res[0]); 
            }
        }else{
            $this->ajaxReturn(0, '非法进入', 0);
        }

        $this->display();
    }
    
    
    public function update(){
        
        if($_POST['subflag']){
            $id = $this->_post('id');
            $data['name'] = $this->_post('name');
            $data['is_show'] = $this->_post('is_show');
            
            $sql = "update ciwen_category set name='".$data['name']."' ,is_show=".$data['is_show']." where id=".$id;
            $Model = new Model(); 
            $result = $Model->execute($sql); 
            if($result) {
                $this->success('操作成功！',"index");
            }else{
                $this->error('写入错误！');
            }
        }
    }

    
    
    public function add(){
        
        if($_POST['subflag']){
                $data['name'] = $this->_post('name');
                $data['is_show'] = $this->_post('is_show');
                $sql = "insert into ciwen_category set name='".$data['name']."' ,is_show=".$data['is_show'];
                $Model = new Model(); 
                $result = $Model->execute($sql); 
                if($result) {
                    $this->success('操作成功！',"index");
                    exit();
                }else{
                    $this->error('写入错误！');
                    exit();
                }

            }
            $this->assign('type', 'add'); 
            $this->display("edit");
    }
	
}