<?php
/**
 * 文章分类模型
 * @author max
 */
class ArticleModel extends Model {
    
    public function getlist(){
        $M = M('atype');
        //$sql = 'select * from atype where status=1 order by id  asc ';
        $res = $M->where(array('status'=>1))->order(' id asc')->select();
        //print_r($res);
        return $res;
    }
}
