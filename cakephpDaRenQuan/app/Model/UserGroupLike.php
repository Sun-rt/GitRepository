<?php
/**
 * 
 */

 //UserGroupLike存储的是用户喜欢的达人吧信息 
define("UserGroupLikeUserType",0);
// UserGroupLike存储的是达人吧的成员信息
define("UserGroupLikeGroupType",1);
//达人吧的权限信息
define('GroupCreator',0); //创建者
define('GroupAdmin',1);   //管理员
define('GroupMember',2);  //成员

 
class UserGroupLike extends AppModel {
	
	public $name = 'UserGroupLike';
	public $useTable = 'user_group_like';
	
	public function getUserLikeGroupInfo($userID){
		return $this->findUserGroupInfo($userID,UserGroupLikeUserType);
	}
	
	public function getMembersOfGroup($groupID){
		return $this->findUserGroupInfo($groupID,UserGroupLikeGroupType);
	}
	
	function findUserGroupInfo($id,$type=UserGroupLikeUserType){
		if (isset($id) && $id >= 0) {
			return $this->find('first',array('conditions' => array(
			"UserGroupLike.entityid"=>$id,"UserGroupLike.type"=>$type)
			));
		}
	}
	
	
	public function getPowerString($power){
		if ($power == GroupCreator){
			return '创建者';
		}
		else if($power == GroupAdmin){
			return '管理员';
		}
		else if($power == GroupMember){
			return "成员";
		}
	}	
}
