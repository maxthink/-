<?php

class WxmenuAction extends WxAction {

    public function index() {

        $m = M('wxmenu'); // 实例化Data数据对象

        $sql = 'select * from wxmenu
                where status&1
                order by level asc ,ord asc';

        $list = $m->query($sql);

        $menu = array();
        foreach ($list as $key => $val) {
            if ($val['level'] == 1) {
                $menu[$val['ord']] = $val;
                //print_r($menu);
                unset($list[$key]);
                if ($val['type'] == '') {
                    foreach ($list as $sub_key => $sub_val) {
                        if ($sub_val['pid'] == $val['id']) {
                            $menu[$val['ord']]['sub'][$sub_val['ord']] = $sub_val;
                            unset($list[$sub_key]);
                        }
                    }
                }
            }
        }

        //print_r($menu);
        $this->assign('list',json_encode($list));
        $this->display();
    }

    public function modify() {
        //添加
        if ($this->_request('type') == 'add') {
            $data['name'] = $this->_request('name');
            $data['action'] = $this->_request('action');
            $data['option'] = $this->_request('option');
            $data['status'] = intval($this->_request('status'));
            $data['show'] = intval($this->_request('show'));
            $data['order'] = intval($this->_request('order'));
            $data['level'] = intval($this->_request('level')) + 1;
            $data['p_id'] = $this->_request('p_id');
            if ($data['level'] > 2)
                $this->ajaxReturn(array('status' => 0, 'msg' => '权限层数过多了'));
            $result = $this->m->add($data);
            if ($result) {
                $this->ajaxReturn(array('status' => 1));
            } else {
                $this->ajaxReturn(array('status' => 0, 'msg' => '数据创建错误'));
            }
            //修改
        } elseif ($this->_request('type') == 'edit') {
            $data['id'] = $this->_request('id');
            $data['name'] = $this->_request('name');
            $data['action'] = $this->_request('action');
            $data['option'] = $this->_request('option');
            $data['status'] = intval($this->_request('status'));
            $data['show'] = intval($this->_request('show'));
            $data['order'] = intval($this->_request('order'));
            $result = $this->m->save($data);
            if ($result) {
                $this->ajaxReturn(array('status' => 1));
            } else {
                $this->ajaxReturn(array('status' => 0, 'msg' => '数据更新出错'));
            }
            //获取
        } else {
            if ($this->_request('id')) {
                $data = $this->m->find($this->_request('id'));
                if ($data) {
                    $data = array_merge(array('isok' => 1), $data);
                } else {
                    $data = array('isok' => 0, 'msg' => '未找到数据');
                }
            } else {
                $data = array('isok' => 0, 'msg' => '未获取参数');
            }
            $this->ajaxReturn($data);
        }
    }

    public function submenu() {

        $m = M('wxmenu'); // 实例化Data数据对象

        $sql = 'select * from wxmenu
                where status&1
                order by level asc ,ord asc';

        $list = $m->query($sql);
        //echo '<pre>';

        $menu = array();
        foreach ($list as $key => $val) {
            if ($val['level'] == 1) {

                if ($val['type'] == '') {

                    unset($list[$key]);
                    foreach ($list as $sub_key => $sub_val) {
                        if ($sub_val['pid'] == $val['id']) {
                            switch ($sub_val['type']) { //检查菜单类型
                                case 'view' : $value = 'url';
                                    break;
                                case 'view_limited' : $value = 'media_id';
                                    break;
                                case 'media_id' : $value = 'media_id';
                                    break;
                                default: $value = 'key';
                            }
                            $sub_button[] = array(
                                        'type' => $sub_val['type'],
                                        'name' => $sub_val['name'],
                                        $value => $sub_val['value'],
                            );
                            unset($list[$sub_key]);
                        }
                    }
                    $menu[] = //拼接主菜单内容
                            array(
                                'name' => $val['name'],
                                'sub_button' => $sub_button,
                    );
                    unset($sub_button);
                } else {  //主菜单无子菜单
                    switch ($val['type']) { //检查菜单类型
                        case 'view' : $value = 'url';
                            break;
                        case 'view_limited' : $value = 'media_id';
                            break;
                        case 'media_id' : $value = 'media_id';
                            break;
                        default: $value = 'key';
                    }
                    $menu[] = //拼接主菜单内容
                            array(
                                'type' => $val['type'],
                                'name' => $val['name'],
                                $value => $val['value'],
                    );
                }
            }
        }

        //print_r($menu);
        $data = array('button' => $menu);
        $re = $this->weObj->createMenu($data);
        if($re){
            echo json_encode(array('status'=>1));
        }else
        {
            echo json_encode(array('status'=>0,'msg'=>$this->weObj->errMsg));
        }
    }

}
