<?php
class EventReply extends AppModel
{
	public $name = 'EventReply';
	public $useTable = 'event_reply';
		
	public $belongsTo = array(  
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