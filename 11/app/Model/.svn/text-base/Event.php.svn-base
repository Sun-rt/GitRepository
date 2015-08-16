<?php
class Event extends AppModel
{
	public $name = 'Event';
	public $useTable = 'event';
	
	
	public $belongsTo = array(  
        'Group' => array(  
            'className' => 'Group',     
            'foreignKey' => 'groupid'  
        ),
		'Category' => array(  
            'className' => 'EventCategory',     
            'foreignKey' => 'categoryid'  
        )
    );
	
	public $validate = array(
			'title' => array(
					'rule' => array('minLength', 4),
					'required' => true,
					'message' => '活动的标题标题不能>4或<100'
			)
	);
	
	//获取最新的文章
	function fetchHomePageLastestEvents($limitCount){
		if ($limitCount <= 0) {
			return;
		}
		$this->recursive = -1;
		$result = $this->find('all',array(
			'fields' => array('Event.id','Event.title','Event.content','Event.applyendtime','Event.begintime', 'Event.eventimageurl','Event.endtime','Event.replycount', 'Event.groupid'),
			'order' => array('Event.time desc'),
			'limit' => $limitCount
		));
		return $result;
	}
}