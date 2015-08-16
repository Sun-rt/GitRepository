<?php
App::uses('AppModel', 'Model');
/**
 * UserRelation Model
 *
 */
class UserRelation extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_relation';
	
	public $name = 'UserRelation';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'userid';

	public function getUserFansAndFollowers($userId){
		$userInfo = $this->find('first',array('conditions'=>array('userid'=>$userId)));
		return $userInfo;
	}

	public function storeUserFansAndFollowers($userId,$fansInfo,$followesInfo){
		if ($userId){
			$data = array('UserRelation'=>array('userid'=>$userId));
			if (is_string($fansInfo)){
				$data['UserRelation']['fans'] = $fansInfo;
			}
			if (is_string($followesInfo)){
				$data['UserRelation']['followers'] = $followesInfo;
			}
			$this->save($data);
		}
	}
}
