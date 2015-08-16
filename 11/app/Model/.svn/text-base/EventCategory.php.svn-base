
<?php
class EventCategory extends AppModel {
    
    public $name = 'EventCategory';
	public $useTable = 'event_category';
	
	public $hasMany = array(
		'Event'  => array(
        	'className' => 'Event',
        	'foreignKey' => 'categoryid'
		)
	);
	
	public $validate = array(
			'name' => array(
					'rule' => array('minLength', 4),
					'required' => true,
					'message' => '名称异常'
			)
	);
}

