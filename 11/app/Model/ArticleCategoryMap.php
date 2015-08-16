<?php
// app/Model/User.php

class ArticleCategoryMap extends AppModel {
	
    public $name = 'ArticleCategoryMap';
    public $useTable = 'article_category_map';  
	
	public $belongsTo = array(
        'Article' => array(
        	'className' => 'Article',
        	'foreignKey' => 'articleid'
		) , 
        'ArticleCategory' => array(
        	'className' => 'ArticleCategory',
        	'foreignKey' => 'categoryid'
		)
    );
}