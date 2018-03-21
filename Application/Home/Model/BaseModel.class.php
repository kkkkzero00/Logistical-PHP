<?php
namespace Home\Model;
use Think\Model;
class BaseModel extends Model{
   
   protected $dbPrex = '';
   protected function _initialize(){
   		$this->dbPrex = C('DB_PREFIX');
   }
}
