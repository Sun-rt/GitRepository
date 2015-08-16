<?php

define('EventParticipantTypeEvent', 0);
define('EventParticipantTypeParticipant', 1);

class EventParticipant extends AppModel
{
	public $name = 'EventParticipant';
	public $useTable = 'event_participants';
	
	public function getParticipants($eventid){
		if ($eventid) {
			$event = $this->find('first',array('conditions' => array('entityid' => $eventid, 'type' => EventParticipantTypeEvent)));
			return $event;
		}
	}
	
	public function getParticipation($userid){
		if ($userid) {
			$event = $this->find('first',array('conditions' => array('entityid' => $userid, 'type' => EventParticipantTypeParticipant)));
			return $event;
		}
	}

}