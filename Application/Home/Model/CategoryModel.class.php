<?php
namespace Home\Model;
use Think\Model;
class CategoryModel extends BaseModel{
   public function getNav(){
   		$arr = $this->where(array('status'=>array('eq',1),'switch'=>array('eq',1)))->order('id')->select();

   		foreach ($arr as $k => $v) {
   			if($v['pid'] == 0){
   				foreach($arr as $k1 => $v1){
   					if($v1['pid'] == $v['id']){
   						$v['c'][] = $v1;
   					}
   				}
   				$arr1[] = $v; 
   			}
   		}
   		return $arr1;
   }
   public function getLeftNav($categoryId){
   		$fistLine = $this
   			->where(array('status'=>array('eq',1),'id'=>array('eq',$categoryId)))
   			->find();
   		$group = $this
   			->where(array('status'=>array('eq',1),'pid'=>array('eq',$fistLine['pid'])))
   			->select();
   		//将当前点击链接的categoryId的导航排序到最前面
   		foreach ($group as $k => $v) {
   			if( $v[id]==$categoryId ){
   				$temp = $v;
   				for($i=$k;$i>0;$i--){
   					$group[$i] = $group[$i-1];
   				}
   				$group[$i] = $temp;
   				break;
   			}
   		}
   		$navTop = $this
   			->where(array('id'=>array('eq',$fistLine[pid])))
			->field('name,flag')
			->find();
   		array_unshift($group,$navTop['name']);
   		return $group;
   }
	public function getTopNav($categoryId){
   		$categotyName = $this
   			->where(array('status'=>array('eq',1),'id'=>array('eq',$categoryId)))
			->field('id,name,pid,flag')
   			->find();
   		$categotyFatherName = $this
   			->where(array('id'=>array('eq',$categotyName[pid])))
			->field('id,name,pid,flag')
			->find();
		if( $categotyFatherName['pid']==0 ){
			$categotyFatherName['id']=$categotyName['id'];
			$categotyFatherName['flag']=$categotyName['flag'];
		}
		$arr = array(
			'categoryName'=>$categotyName,
			'categoryFatherName'=>$categotyFatherName
		);
		//dump($arr);
   		return $arr;
   }
}