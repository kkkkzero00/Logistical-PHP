<?php
namespace Home\Model;
use Think\Model;
class DetailModel extends BaseModel{
	public function getRNav($category_id){
        
    }
    public function getAList($category_id){
        $list = $this->alias('d')
            ->join('man_category AS c ON d.category_id = c.id')
            ->where(array('d.status'=>array("eq",1),'d.category_id'=>$category_id ? $category_id : array('gt',0)))
            ->field('d.id,d.title,category_id,d.update_time')
            ->order('update_time desc')
            ->page($_GET['p'],C('INDEX_ARTICLE_NUM'))
            ->select();
        //dump($list);
        return $list;
    }
    public function ArticlePage($category_id){
        $arr=$this
            ->where(array('category_id'=>$category_id,'status'=>1))
            ->order('update_time desc')
            ->select();
        $count=count($arr);
        $Page = new \Think\Page($count,C('INDEX_ARTICLE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
        $Page -> setConfig('header','共%TOTAL_ROW%条');
        $Page -> setConfig('first','首页');
        $Page -> setConfig('last','共%TOTAL_PAGE%页');
        $Page -> setConfig('prev','上一页');
        $Page -> setConfig('next','下一页');
        $Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
        $Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show       = $Page->show();// 分页显示输出
        //dump($show);
        return $show;
    }
    public function getArticle($a_id,$category_id){
        $a_create_time=$this->where(array('id'=>array('eq',$a_id)))->getField('update_time');
        $gtCount=$this
            ->where(array('category_id'=>array('eq',$category_id),'update_time'=>array('gt',$a_create_time),'status'=>array('eq',1)))
            ->order('create_time desc')
            ->count();
       
        $detail=$this
            ->where(array('category_id'=>array('eq',$category_id),'status'=>array('eq',1)))
            ->order('update_time desc')
            ->limit($gtCount?$gtCount-1:$gtCount,$gtCount?3:2)
            ->select();
        
        $this->where(array('id'=>array('eq',$a_id)))->setInc('hit',1);
        $list=array('last'=>$detail[0],'current'=>$detail[1],'next'=>$detail[2]);
        if($gtCount==0){
            $list['last']=null;
            $list['current']=$detail[0];
            $list['next']=$detail[1];
        }
        return $list;
    }
    public function get_first_img($id){
        $content_arr = $this->alias('d')
            ->where(array(
                'd.status'=>array('eq',1),
                'd.category_id'=>array('eq',$id)
            ))->order('d.create_time desc')->field('d.category_id,d.id,d.content,d.title')->select();

        foreach($content_arr as $k=>$v){
            
            $result = preg_match('/<img.*?src="(.*?)".*?>/is', $v['content'], $img_arr);
            if($result){
                $img_arrs[$k]['url'] = $img_arr[0];
                $img_arrs[$k]['content_id'] = $v['id'];
                $img_arrs[$k]['category_id'] = $v['category_id'];
                $img_arrs[$k]['title'] = $v['title'];
                $img_arrs[$k]['content']=strip_tags($v['content']);
            }
            
        }

        $img = array();
        foreach($img_arrs as $k=>$v){
            $img[] = $v;
        }
        $img_arrs = array();
        foreach($img as $k=>$v ){
            if($k<5)
                $img_arrs[] = $v;
            else break;
        }
       
        return $img_arrs;
    }

    public function getRecord($name,$id){
        $where['name'] = $name;
        $where['idcard'] = $id;
        $where['status'] = 1;
        return M('record_manage')->where($where)->select();
    }
}