<?php

//内部原创
define('InternalArticles', 0);
//外部转帖
define('ExternalArticles', 1);


//文章的model
class Article extends AppModel
{
	public $name = 'Article';
	public $useTable = 'article';
	
	public $validate = array(
			'title' => array(
				'rule' => array('minLength', 4),
				'required' => true,
				'message' => '文章的标题不能<4或者>100'
			)
	);
	
	public $belongsTo = array(  
        'Group' => array(  
            'className' => 'Group',   
            'conditions' => '',   
            'order' => '',   
            'foreignKey' => 'groupid'  
        ),
        'ArticleCategory' => array(  
            'className' => 'ArticleCategory',   
            'conditions' => '',   
            'order' => '',   
            'foreignKey' => 'categoryid'  
        )   
    );
	
	public $hasMany = array(
		'ArticleTagMap'  => array(
        	'className' => 'ArticleTagMap',
        	'foreignKey' => 'articleid'
		)
/*
		'ArticleReply' => array(
			'className' => 'ArticleReply',
        	'foreignKey' => 'belongid')
*/
        	);
	
	//获取最新的文章
	function fetchHomePageLastestAriticles($limitCount){
		if ($limitCount <= 0) {
			return;
		}
		$this->recursive = -1;
		$result = $this->find('all',array(
			'fields' => array('Article.id','Article.title','Article.replycount','Article.autorid','Article.supportcount','Article.autorname','Article.time','Article.easyintro','Article.thumimageurl'),
			'order' => array('Article.time desc'),
			'limit' => $limitCount
		));
		return $result;
	}
	
	function fetchHomePageHotArticles($limitCount){
		if ($limitCount <= 0) {
			return;
		}
		$this->recursive = 1;
		$result = $this->find('all',array(
			'fields' => array('Article.id','Article.title','Article.supportcount','Article.replycount','Article.autorname','Article.time', 'Article.groupid','Group.name'),
			'order' => array('Article.replycount desc','Article.favorcount desc','Article.supportcount desc','Article.visitcount desc'),
			'limit' => $limitCount
		));
		return $result;
	}
	
	function fetchHomePageRecommendArticles($limitCount){
		if ($limitCount <= 0) {
			return;
		}
		$this->recursive = 1;
		$result = $this->find('all',array(
			'fields' => array('Article.id','Article.title','Article.time','Article.easyintro', 'Article.groupid','Group.name'),
			'order' => array('Article.time desc'),
			'limit' => $limitCount
		));
		return $result;
	}
}