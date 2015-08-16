<?php
/**
 * 
 */
 
 define('AllCanJoin', 0); //任何人都可以加入
 define('ShouldAudit', 1);//审核可以加入
 
 
class Group extends AppModel {
	public $name = 'Group';
	public $useTable = 'group';
	
	public $hasMany = array(
        'TagGroupMap'  => array(
        	'className' => 'TagGroupMap',
        	'foreignKey' => 'groupid'
		),
		'Articles' => array(
			'className' => 'Article',
        	'foreignKey' => 'groupid',
        	'order' => 'Articles.time DESC'
		)
    );
	
	public $validate = array(
		'name' => array('rule' => array('minLength', 4),
						'message'=>'达人吧名称异常'),
		'info' => array('rule' => array('minLength', 4),
						'message'=>'达人吧简介异常')
	);
	
	function fetchHomePageHotGroup($limitCount){
		if ($limitCount <= 0) {
			return;
		}
		 $this->recursive = -1;
		$result = $this->find('all',array(
			'fields' => array('Group.id','Group.name', 'Group.portraiturl','Group.name'),
			'order' => array('Group.integration DESC'),
			'limit' => $limitCount
		));
		return $result;
	}
}
