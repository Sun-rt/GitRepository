<?php
// app/Model/User.php

class ArticleTagMap extends AppModel {
	
    public $name = 'ArticleTagMap';
    public $useTable = 'article_tag_map';  
	
	public $belongsTo = array(
        'Article' => array(
        	'className' => 'Article',
        	'foreignKey' => 'articleid'
		) , 
        'Tag' => array(
        	'className' => 'Tag',
        	'foreignKey' => 'tagid'
		)
    );
}