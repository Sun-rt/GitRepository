<?php
/**
 * 
 */
class TagGroupMap extends AppModel {
	
	public $name = 'TagGroupMap';
	public $useTable = 'tag_group_map';
	
	public $belongsTo = array(
        'Group' => array(
        	'className' => 'Group',
        	'foreignKey' => 'groupid'
		) , 
        'Tag' => array(
        	'className' => 'Tag',
        	'foreignKey' => 'tagid'
		)
    );
	
}
