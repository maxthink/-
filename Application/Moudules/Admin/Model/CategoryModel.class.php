<?php
// 本类由系统自动生成，仅供测试用途
class CategoryModel extends Model {

	public function getcate()
	{
		//获取分类
		$M = M('category');
		$map=array('status'=>1);
		$res = $M->where($map)->order('pid')->select();
		$cate = array();
		foreach($res as $val)
		{
			if($val['pid']==0)
				$cate[$val['id']]=$val;
			else
				$cate[$val['pid']]['sub'][$val['id']] = $val;
		}
		return $cate;
	}


}

