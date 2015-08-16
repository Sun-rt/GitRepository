<?php

//文章类别的model

class ArticleCategory extends AppModel {
    
    public $name = 'ArticleCategory';
	public $useTable = 'article_category';
	
	public $hasMany = array(
		'Article'  => array(
        	'className' => 'Article',
        	'foreignKey' => 'categoryid'
		)
	);
	
	public $validate = array(
			'name' => array(
					'rule' => array('minLength', 4),
					'required' => true
			)
	);
}

