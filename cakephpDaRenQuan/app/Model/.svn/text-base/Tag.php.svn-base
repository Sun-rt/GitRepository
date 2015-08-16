<?php

//文章标签
define("ArticleTag", 1);
//达人吧tag
define("GroupTag", 0);

class Tag extends AppModel{
	public $name = 'Tag';
	public $useTable = 'tag';
	
	public $hasMany = array(
		'ArticleTagMap'  => array(
        	'className' => 'ArticleTagMap',
        	'foreignKey' => 'tagid'
		)
    );
	
	public $validate = array('name'=>array('rule' => 'isUnique',
        								   'required' => 'create'));
	
	function fetchHomePageHotTag($limitCount){
		if ($limitCount <= 0) {
			return;
		}
		$this->recursive = -1;
		$result = $this->find('all',array(
			'fields' => array('Tag.id','Tag.name', 'Tag.tagtype'),
			'limit' => $limitCount
		));
		return $result;
	}
	
	function fetchAllGroupTags(){
		return $this->fetchAllTagsWithType(GroupTag);
	}
	function fetchAllArticleTags(){
		return $this->fetchAllTagsWithType(ArticleTag);
	}
	function fetchAllTagsWithType($tagtype){
		if (isset($tagtype) && ($tagtype == 0 || $tagtype == 1)) {
			$this->recursive = -1;
			$result = $this->find('all',array(
			'fields' => array('Tag.id','Tag.name', 'Tag.tagtype'),
			'condition' => array('Tag.tagtype' => $tagtype)));
			return $result;
		}
	}
}