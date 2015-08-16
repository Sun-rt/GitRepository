<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $paginate = array(
        'limit' => 20,
        'order' => array(
            'Event.time' => 'desc'
        )
    );



	//重载父类
	public function loginUserAuth()
    {
	    $array = parent::loginUserAuth();
	    $array[] = 'apply';
	    $array[] = 'commentevent';
	    $array[] = 'commentreply';
	    $array[] = 'export';
	    $array[] = 'unapply';
	    $array[] = 'emailShare';
	    $array[] = 'edit';
	    return  $array;
    }

/**
 * index method
 *
 * @return void
 */
	public function index()
	 {
		$this->Event->recursive = 1;
		$this->set('events', $this->Paginator->paginate());
	}
	
	//取消报名接口
	public function unapply($eventid =null){
		if ($eventid && is_numeric($eventid)){
			$currentUserID = $this->Session->read('userID');
			$this->loadModel('EventParticipant');
			
			//存储用户的报名的活动
			$userFavors = $this->EventParticipant->getParticipation($currentUserID);
			if ($userFavors){
				$userApplyes = json_decode($userFavors['EventParticipant']['participantsInfo'],true);
				$userApplyes = ($userApplyes) ? : array();
				$userApplyes = array_removeObject($userApplyes,$eventid);
				
				$this->EventParticipant->id = $userFavors['EventParticipant']['id'];
				$data = array('EventParticipant' => array('entityid' => $currentUserID,'participantsInfo' => json_encode($userApplyes),
							'type' => EventParticipantTypeParticipant));
				$this->EventParticipant->save($data);
			}
			
			//活动测参加者
			$participate = $this->EventParticipant->getParticipants($eventid);
			$participants = null;
			if ($participate){
				$participants = json_decode($participate['EventParticipant']['participantsInfo'],true);
				$participants = ($participants) ? : array();
				
				$participants = array_removeObject($participants,$currentUserID);
				$this->EventParticipant->id = $participate['EventParticipant']['id'];
				$data = array('EventParticipant' => array('entityid' => $eventid,'participantsInfo' => json_encode($participants),
											'type' => EventParticipantTypeEvent));
				$this->EventParticipant->save($data);
			}
			//更新数量
			$this->Event->id = $eventid;
			$this->Event->saveField("applycount", count($participants));
			// $this->redirect($this->referer());

			$this->set('unApplySuccess',true);
        
	        $this->autoRender = false;
	        header('Content-type: text/plain; charset=utf-8');
	        
	        echo count($participants);
		}
	}
	
	//报名的接口
	public function apply($eventid){
		if (!is_numeric($eventid) || !$this->Event->exists($eventid)){
			return ;
		}
		
		$currentUserID = $this->Session->read('userID');
		$this->loadModel('EventParticipant');
		
		//存储用户的报名的活动
		$userFavors = $this->EventParticipant->getParticipation($currentUserID);
		$userApplyes = json_decode($userFavors['EventParticipant']['participantsInfo'],true);
		$userApplyes = ($userApplyes) ? : array();
		if (!in_array($eventid, $userApplyes)){
			$userApplyes[]= $eventid;
			if ($userFavors){
				$this->EventParticipant->id = $userFavors['EventParticipant']['id'];
			}else{
				$this->EventParticipant->id = null;
			}
			$data = array('EventParticipant' => array('entityid' => $currentUserID,'participantsInfo' => json_encode($userApplyes),
												  'type' => EventParticipantTypeParticipant));

			$this->EventParticipant->save($data);

		}        
        //活动测参加者
        $participate = $this->EventParticipant->getParticipants($eventid);
        $participants = json_decode($participate['EventParticipant']['participantsInfo'],true);
        $participants = ($participants) ? : array();
        if (!in_array($currentUserID, $participants)){
	        $participants[] = $currentUserID;
	        if ($participate){
            	$this->EventParticipant->id = $participate['EventParticipant']['id'];
        	}else{
            	$this->EventParticipant->id = null;
        	}
			$data = array('EventParticipant' => array('entityid' => $eventid,'participantsInfo' => json_encode($participants),
													  'type' => EventParticipantTypeEvent));
            $this->EventParticipant->save($data);
        }
        
        $this->Event->id = $eventid;
        $this->Event->saveField("applycount", count($participants));
        $this->set('applySuccess',true);
        
        $this->autoRender = false;
        header('Content-type: text/plain; charset=utf-8');
        
        echo count($participants);
	}
	
	public function updateEventCount($id,$supportCount,$replyCount,$visitCount,$applyCount){
		if (is_numeric($id)){
			$updateValues = array('Event'=>array());
			if ($supportCount >= 0){
				$updateValues['Event']['supportcount'] = $supportCount;
			}
			if ($replyCount >= 0){
				$updateValues['Event']['replycount'] = $replyCount;
			}
			if ($visitCount >= 0){
				$updateValues['Event']['visitcount'] = $visitCount;
			}
			if ($applyCount >= 0){
				$updateValues['Event']['applycount'] = $applyCount;
			}
			if (count($updateValues['Event']) > 0){
				$this->Event->id = $id;
				$this->Event->save($updateValues);
			}
		}
	}

//活动评论
	public function commentevent(){
		if ($this->request->is('post')) {
			$currentUserID = $this->Session->read('userID');
			$currentUserName = $this->Session->read('userName');
			//其他必要信息
			$data = $this->request->data;
			$mysqltime = date('Y-m-d H:i:s',time());
			$data['EventReply']['time'] = $mysqltime;
			$data['EventReply']['autorid'] = $currentUserID;
			$data['EventReply']['autorname'] = $currentUserName;
			$this->loadModel("User");
			$data['EventReply']['autorportraiturl'] = $this->User->findById($currentUserID)['User']['portraiturl'];
			$this->loadModel('EventReply');
			$this->EventReply->create();
			$this->set('commentSuccess', ($this->EventReply->save($data)) ? true : false );
			
			//加载评论
			$this->loadModel('EventReply');
			$this->EventReply->recursive = 0;
			$this->autoRender = false;
			header('Content-type: text/plain; charset=utf-8');
			$this->paginate = array('EventReply' => array('model' => 'EventReply',
													   'limit' => 10,
													   'order' => array('EventReply.time' =>'DESC'),
													   'recursive' => 1,
													   'conditions' => array('EventReply.belongid'=>$data['EventReply']['belongid'])));						
			$this->Paginator->settings = $this->paginate;
			$replies = $this->Paginator->paginate('EventReply');
			
			$newJson = json_encode($replies);
		
			echo $newJson;
		}
	}
	
	//楼中楼
	public function commentreply(){
		if ($this->request->is('post')) {
			$currentUserID = $this->Session->read('userID');
			$currentUserName = $this->Session->read('userName');
			//其他必要信息
			$data = $this->request->data;
			$mysqltime = date('Y-m-d H:i:s',time());
			$data['EventReply']['time'] = $mysqltime;
			$data['EventReply']['autorid'] = $currentUserID;
			$data['EventReply']['autorname'] = $currentUserName;
			$this->loadModel('EventReply');
			$this->EventReply->create();
			$this->set('commentSuccess', ($this->EventReply->save($data)) ? true : false );
		}
	}
	
	
	/**
	 * 判断是否为活动的创建者
	 * @param string $id
	 * @return boolean
	 */
	public function isEventCreator($id = null){
		$currentUserID = $this->Session->read('userID');
		if (!$currentUserID || !$id)
			return false;
		if (!isset($this->Event)){
			$this->loadModel('Event');
		}
		$count = $this->Event->find('count',array('conditions' => array('Event.id'=>$id,'Event.autorid'=>$currentUserID)));
		return ($count != 0);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->Event->recursive = -1;
		$event = $this->Event->find('first', $options);
		$this->Event->id = $id;
		
		//查看当前访问的用户是否关注了这个圈子
		$groupId = $event['Event']['groupid'];
		$this->loadModel('UserGroupLike');
		$groupMembers = json_decode($this->UserGroupLike->getMembersOfGroup($groupId)['UserGroupLike']['likeinfos'],1);
		$followed = false;
		$currentUserID = $this->Session->read('userID');
		$roleInGroup = null;
		$groupCreator = null;
		if ($groupMembers) {
			foreach ($groupMembers as $groupMemeber)
			{
				if ($groupMemeber['userID'] == $currentUserID) 
				{
					$followed = true;
					// break;
				}

				if ($groupMemeber['userID'] == $currentUserID) {
					$roleInGroup = $groupMemeber;
				}
				if ($groupMemeber['power'] == GroupCreator){
					$groupCreator = $groupMemeber;
				}
				
				if ($groupCreator && $roleInGroup){
					// break;
				}
			}
		}
		$this->set('followed',$followed);
		$isGroupCreator = ($groupCreator['userID'] == $currentUserID);
		$this->set('isGroupCreator',$isGroupCreator);
		if (!$followed){
			$this->redirect('/errors/error/2');
			return ;
		}	

		$this->loadModel("User");
		$user = $this->User->findById($currentUserID);
		$this->set("author",$user);
		
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->Event->recursive = 1;
		$event = $this->Event->find('first', $options);
		$this->Event->id = $id;
		
		$this->set('isAuthor',($currentUserID == $event['Event']['autorid']));

		$this->set('isEventCreator',$this->isEventCreator($id));
		
		//存储浏览次数
		$this->set('event', $event);
		$vcount = $event['Event']['visitcount'];
		$this->updateEventCount($id,-1,-1,$vcount+1,-1);
		
		$eventOtherInfo = array();
		
		//加载评论
		$this->loadModel('EventReply');
		$this->EventReply->recursive = 0;
		$this->paginate = array('EventReply' => array('model' => 'EventReply',
												   'limit' => 10,
												   'order' => array('EventReply.time' =>'DESC'),
												   'recursive' => 1,
												   'conditions' => array('EventReply.belongid'=>$id)));						
		$this->Paginator->settings = $this->paginate;
		$replies = $this->Paginator->paginate('EventReply');
		$this->set('eventReplies',$replies);
		
		//报名人数
		$this->loadModel('EventParticipant');
		$event = $this->EventParticipant->getParticipants($id);
		$participants = json_decode($event['EventParticipant']['participantsInfo'],true);
		$eventOtherInfo['participantCount'] = count($participants);
		//是否报名
		$participants = ($participants) ? : array();
		$eventOtherInfo['applied'] = in_array($currentUserID, $participants);
		//报名的人
		$this->loadModel('User');
		$users = $this->User->find('all',array('conditions'=>array('User.id'=>$participants),'fields'=>array('id','name','portraiturl')));
		$eventOtherInfo['participants'] = $users;
		
		//
		$this->set('eventOtherInfo',$eventOtherInfo);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($groupid = null) {
		if ($this->request->is('post')) {
			$currentUserID = $this->Session->read('userID');
			$currentUserName = $this->Session->read('userName');
			//其他必要信息
			$data = $this->request->data;

			// 没有图片就是用default
			$path = WWW_ROOT.'upload/event/';
			$this->ImageUpload = $this->Components->load('ImageUpload');
			//如果有文件需要上传
			if ($this->ImageUpload->hasFileUpload()){
				$uploadedFiles = $this->ImageUpload->uploadFile($path,array("gif","jpeg","png","jpg"),160*160*32);
				if (!is_array($uploadedFiles)){
					echo "<script>alert('".$uploadedFiles."')</script>";
					return ;
				}
				if (is_array($uploadedFiles) && count($uploadedFiles) == 1 && $uploadedFiles[0]['error'] == 0){
					$data['Event']['eventimageurl'] = '/app/webroot/upload/event/'.$uploadedFiles[0]['name'];
				}
				else{
					$data['Event']['eventimageurl'] = '/app/webroot/img/group_default_portrait.png';
				}
			}
			else{
				$data['Event']['eventimageurl'] = '/app/webroot/img/group_default_portrait.png';
			}
			
			$beginTime = strtotime($data['Event']['begintime']);
			$endTime = strtotime($data['Event']['endtime']);
			$applyTime = strtotime($data['Event']['applyendtime']);
			if ($applyTime < $beginTime && $beginTime <= $endTime){
				$mysqltime = date('Y-m-d H:i:s',time());
				$data['Event']['time'] = $mysqltime;
				$data['Event']['autorid'] = $currentUserID;
				$data['Event']['autorname'] = $currentUserName;
				$this->Event->create();
				if ($this->Event->save($data)) {
					return $this->redirect(array('action' => 'view',$this->Event->id));
				} else {
					$this->Session->setFlash(__('The Event could not be saved. Please, try again.'));
				}
			}
			else{
				$this->redirect(array('action'=>"add",$this->request->data['Event']['groupid']));
			}
		}
		else{
			//所有的类别
			$this->loadModel('EventCategory');
			$this->EventCategory->recursive = -1;
			$this->set('categories',$this->EventCategory->find('all'));
			
			$this->loadModel('Group');
			$this->Group->recursive = 0;
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $groupid));
			$group = $this->Group->find('first', $options);
			$this->set('group', $group);
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if ($id && !$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		
		$currentUserID = $this->Session->read('userID');
		
		if ($this->request->is('post')) {
			$currentUserName = $this->Session->read('userName');
			//其他必要信息
			$data = $this->request->data;
			
			// 没有图片就是用default
			$path = WWW_ROOT.'upload/event/';
			$this->ImageUpload = $this->Components->load('ImageUpload');
			//如果有文件需要上传
			if ($this->ImageUpload->hasFileUpload()){
				$uploadedFiles = $this->ImageUpload->uploadFile($path,array("gif","jpeg","png","jpg"),160*160*32);
				if (!is_array($uploadedFiles)){
					echo "<script>alert('".$uploadedFiles."')</script>";
					return ;
				}
				if (is_array($uploadedFiles) && count($uploadedFiles) == 1 && $uploadedFiles[0]['error'] == 0){
					$data['Event']['eventimageurl'] = '/app/webroot/upload/event/'.$uploadedFiles[0]['name'];
				}
				else{
					$data['Event']['eventimageurl'] = '/app/webroot/img/group_default_portrait.png';
				}
			}
			
			$beginTime = strtotime($data['Event']['begintime']);
			$endTime = strtotime($data['Event']['endtime']);
			$applyTime = strtotime($data['Event']['applyendtime']);
			if ($applyTime < $beginTime && $beginTime <= $endTime){
				$mysqltime = date('Y-m-d H:i:s',time());
				$data['Event']['time'] = $mysqltime;
				$this->Event->id = $data['Event']['id'];
				$this->Event->save($data);
				return $this->redirect(array('action' => 'view',$data['Event']['id']));
			}
			else{
				$this->redirect(array('action'=>"view",$data['Event']['id']));
			}
		 }
		 else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$event = $this->Event->find('first', $options);
			
			if ($event['Event']['autorid'] == $currentUserID){
				$this->set('event',$event);
				$this->loadModel('EventCategory');
				$this->EventCategory->recursive = -1;
				$this->set('categories',$this->EventCategory->find('all'));
				
				$this->loadModel('Group');
				$this->Group->recursive = 0;
				$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $event['Event']['groupid']));
				$group = $this->Group->find('first', $options);
				$this->set('group', $group);
			}
			else{
				throw new NotFoundException(__('不是作者'));
			}
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Event->delete()) {
			return $this->flash(__('The event has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The event could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	
/**
*
*/
	public function export()
	{
		$eventid = $this->request->data['eventid'];
		// valid
		
		// header
		$filepath_part = '/events/event'.$eventid.'.xml';
		$filePath = TMP.$filepath_part;
		Header("Location: http://km.glodon.com/app/tmp/".$filepath_part);
		
		// followed user
		if (!$this->Event->exists($eventid)) {
			throw new NotFoundException(__('Invalid event'));
		}
		
		//报名人数
		$this->loadModel('EventParticipant');
		$event = $this->EventParticipant->getParticipants($eventid);
		
		$participants = json_decode($event['EventParticipant']['participantsInfo'],true);
		//是否报名
		$participants = ($participants) ? : array();
		//报名的人
		$this->loadModel('User');
		$users = $this->User->find('all',array('conditions'=>array('User.id'=>$participants),'fields'=>array('id','name')));
		
		$user_array = array();
		foreach($users as $user)
		{
			array_push($user_array, array("用户ID"=>$user['User']['id'], "用户名"=>$user['User']['name']));
		}

		$dom = new DOMDocument('1.0', 'UTF-8');  
		$dom->formatOutput = true;  
		$rootelement = $dom->createElement("报名名单");  
		foreach ($user_array as $key=>$value)  
		{  
		    $article = $dom->createElement("用户");  
		    $title = $dom->createElement("用户ID", $value['用户ID']);  
		    $link = $dom->createElement("用户名", $value['用户名']);  
		    $article->appendChild($title);  
		    $article->appendChild($link);  
		    $rootelement->appendChild($article);  
		}  
		$dom->appendChild($rootelement);  
		$filename = $filePath;  
		echo $dom->save($filename);
	}

/**
* mail share method
*
* @return true or false
*/
	public function emailShare(){

		// request data
		$articleID = $this->request->data['eventID'];
		$to = $this->request->data['to'];
		$why = $this->request->data['why'];
		$subject = $this->request->data['subject'];
		
		// ajax
		$this->autoRender = false;
		header('Content-type: text/plain; charset = utf-8');
		
		// user
		$currentUserID = $this->Session->read('userID');
		$currentUserName = $this->Session->read('userName');
		
		// load article
		if (!$this->Event->exists($articleID)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $articleID));
		$shardedArticle = $this->Event->find('first', $options);
		
		//加载评论
		$this->loadModel('EventReply');

		$options = array(  'limit' => 3,
							'order' => array('time' =>'DESC'),
							'recursive' => -1,
							'conditions' => array('belongid'=>$articleID) );
												   
		$sharedArticleReply =  $this->EventReply->find('all',$options);									   
		
		// maile
		$this->emailComponent = $this->Components->load('email');
		$this->emailComponent->shareEvent('hemuzilove',$to,$subject,$shardedArticle,$sharedArticleReply,$why);
	
		return true;
	}
}
