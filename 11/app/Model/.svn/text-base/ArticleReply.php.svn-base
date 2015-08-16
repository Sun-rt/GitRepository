<?php
class ArticleReply extends AppModel
{
	public $name = 'ArticleReply';
	public $useTable = 'article_reply';
	
	public $belongsTo = array(  
/*
        'Article' => array(  
            'className' => 'Article',   
            'conditions' => '',   
            'order' => 'time desc',   
            'foreignKey' => 'belongid'  
        ),
*/
        'Parent' => array(
            'className' => 'ArticleReply',
            'foreignKey' => 'pid'
        )
    );
    
    public $hasMany = array(
        'Children' => array(
            'className' => 'ArticleReply',
            'foreignKey' => 'pid'
        )
    );
		
}