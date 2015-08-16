<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $paginate = array(); 
	public $allGroupMember = null;    


//重载父类
	public function loginUserAuth()
    {
	    $array = parent::loginUserAuth();
	    $array[] = 'follow';
	    $array[] = 'deletemember';
	    $array[] = 'editmemberpower';
	    $array[] = 'manage';
	    $array[] = 'viewevent';
	    $array[] = 'viewarticle';
	    $array[] = 'edit';
	    $array[] = 'setMemberToAdmin';
	    $array[] = 'setAdminToMember';
	    $array[] ='unfollow';
	    return  $array;
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Group->recursive = 0;
		
		$groups = $this->Paginator->paginate();
		//获取达人吧成员信息
		$this->loadModel('UserGroupLike');
		//获取达人吧文章(分页取)
		$this->loadModel('Article');
		
		$groupCount = count($groups);
		for($i = 0; $i < $groupCount;++$i)
		{
			$groupMembers = json_decode($this->UserGroupLike->getMembersOfGroup($groups[$i]['Group']['id'])['UserGroupLike']['likeinfos'],1);
			$groups[$i]['Group']['memberCount'] = count($groupMembers);
			
			//文章数
			$options = array('conditions' => array('Article.groupid' => $groups[$i]['Group']['id']));
			$groups[$i]['Group']['articleCount'] = $this->Article->find("count",$options);
		}
		$this->set('groups', $groups);
	}
	
	//设置为管理员
	public function setMemberToAdmin($memberId,$id){
		$this->autoRender = false;
		$this->editMemberPower($memberId, 1, $id);
	}
	//设置为成员
	public function setAdminToMember($adminId,$id){
		$this->autoRender = false;
		$this->editMemberPower($adminId, 2, $id);
	}
	
	//编辑用户的权限
	public function editMemberPower($memberId,$power,$id)
	{
		if (!is_numeric($power) || !is_numeric($id))
		{
			return ;
		}
		$currentUserID = $this->Session->read('userID');
		if ($memberId == $currentUserID){
			//不能编辑自己
			return ;
		}
		$this->loadModel('UserGroupLike');
		$memebers = $this->UserGroupLike->getMembersOfGroup($id);
		$groupMembers = json_decode($memebers['UserGroupLike']['likeinfos'],1);
		$groupMembers = ($groupMembers) ? : array();
		$currentUserAdminRole = null;
		$editUserRole = null;
		foreach ($groupMembers as $groupMemeber) {
			if ($groupMemeber['userID'] == $currentUserID){
				if (($groupMemeber['power'] == GroupCreator || $groupMemeber['power'] == GroupAdmin)){
					$currentUserAdminRole = $groupMemeber;
				}else{
					break;
				}
			}
			if ($groupMemeber['userID'] == $memberId){
				$editUserRole = $groupMemeber;
			}
		}
		
		if ($editUserRole['power'] == $power){
			return ;
		}
		
		if ($currentUserAdminRole && $editUserRole){
			if ($currentUserAdminRole['power'] == GroupCreator && ($power == GroupAdmin || $power == GroupMember)){
				if(($key = array_search($editUserRole, $groupMembers)) !== false) {
					$groupMembers[$key]['power'] = $power;
					$this->UserGroupLike->id = $memebers['UserGroupLike']['id'];
					$this->UserGroupLike->saveField('likeinfos',json_encode($groupMembers));
				}
			}
			else{
				//不能操作
			}
		}
		else{
			//当前用户不是管理员 或者 编辑的用户不存在
			if ($editUserRole){
				//权限不足
			}
			else{
				//删除的用户不是该圈子成员
			}
		}
	}
	
	public function deletemember($memberId,$id)
	{		
		if (!is_numeric($memberId) || !is_numeric($id))
		{
			return ;
		}
		
		//ajax
		$this->autoRender = false;
		header("Content-type : text/plain; charset = utf8");
		
		$this->loadModel('UserGroupLike');
		$currentUserID = $this->Session->read('userID');
		if ($memberId == $currentUserID){
			//不能删除自己
			return ;
		}
		$memebers = $this->UserGroupLike->getMembersOfGroup($id);
		$groupMembers = json_decode($memebers['UserGroupLike']['likeinfos'],1);
		$groupMembers = ($groupMembers) ? : array();
		
		//检查权限
		$currentUserAdminRole = null;
		$deleteUserRole = null;
		foreach ($groupMembers as $groupMemeber) {
			if ($groupMemeber['userID'] == $currentUserID){
				if (($groupMemeber['power'] == GroupCreator || $groupMemeber['power'] == GroupAdmin)){
					$currentUserAdminRole = $groupMemeber;
				}else{
					break;
				}
			}
			if ($groupMemeber['userID'] == $memberId){
				$deleteUserRole = $groupMemeber;
			}
			if ($currentUserAdminRole && $deleteUserRole){
				break;
			}
		}
		
		if ($currentUserAdminRole && $deleteUserRole){
			if ($currentUserAdminRole['power'] == GroupCreator){
				if(($key = array_search($deleteUserRole, $groupMembers)) !== false) {
					unset($groupMembers[$key]);
					$this->UserGroupLike->id = $memebers['UserGroupLike']['id'];
					$this->UserGroupLike->saveField('likeinfos',json_encode($groupMembers));
				}
			}
			else if ($currentUserAdminRole['power'] == GroupAdmin){
				if ($deleteUserRole['power'] == GroupMember){
					if(($key = array_search($deleteUserRole, $groupMembers)) !== false) {
						unset($groupMembers[$key]);
						$this->UserGroupLike->id = $memebers['UserGroupLike']['id'];
						$this->UserGroupLike->saveField('likeinfos',json_encode($groupMembers));
					}
				}else{
					//权限不足
					
				}
			}
			else{
				
			}
		}
		else{
			//当前用户不是管理员 or 删除的用户不是这个圈子的成员
			if ($deleteUserRole){
				//权限不足
			}
			else{
				//删除的用户不是该圈子成员
			}
		}
	}
	
	public function viewarticle($id = null){
		$this->_loadGroupCommdata($id);
		$this->_loadGroupArticle($id);
	}
	
	public function viewevent($id = null){
		$this->_loadGroupCommdata($id);
		$this->_loadGroupEvent($id);
	}

	public function view($id = null) {
		$this->_loadGroupCommdata($id);
		$this->_loadGroupArticle($id);
	}
	
	public function _loadGroupCommdata($id){
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('无效的达人吧'));
		}
		//获取达人吧信息
		$this->Group->recursive = 0;
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
		//访问者
		$this->_visitGroup($id);
		$this->set('visitors',$this->_getVisitors($id));
		//获取达人吧成员信息
		$this->loadModel('UserGroupLike');
		$currentUserID = $this->Session->read('userID');
		$groupMembers = json_decode($this->UserGroupLike->getMembersOfGroup($id)['UserGroupLike']['likeinfos'],1);
		//是否关注、管理员等
		$roleInGroup = null;
		$groupCreator = null;
		if ($groupMembers) {
			foreach ($groupMembers as $groupMemeber) {
				if ($groupMemeber['userID'] == $currentUserID) {
					$roleInGroup = $groupMemeber;
				}
				if ($groupMemeber['power'] == GroupCreator){
					$groupCreator = $groupMemeber;
				}
				
				if ($groupCreator && $roleInGroup){
					break;
				}
			}
		}
		$this->set('followed',($roleInGroup != null) ? true : false);
		$this->set('isManager',($roleInGroup != null && $roleInGroup['power'] < GroupMember) ? true : false);
		$isGroupCreator = ($groupCreator['userID'] == $currentUserID);
		$this->set('isGroupCreator',$isGroupCreator);
		$this->loadModel('User');
		$groupCreatorInfo = $this->User->findById($groupCreator['userID']);
		$groupCreator['portraiturl'] = $groupCreatorInfo['User']['portraiturl'];
		$this->set('groupCreator', $groupCreator);
		$this->set('groupMemebers', ($groupMembers) ? $groupMembers : array());
	}
	
	public function _loadGroupArticle($id){
		if ($id == null){
			return ;
		}
		//获取达人吧文章(分页取)
		$this->loadModel('Article');
		$this->Article->recursive = 0;
		$this->paginate = array('Article' => array('model' => 'Article',
				'limit' => 20,
				'order' => array('Article.time' =>'DESC'),
				'recursive' => 0,
				'conditions' => array('Article.groupid'=>$id),
				'fields' => array('Article.id','Article.title','Article.content',
						'Article.groupid','Article.time',
						'Article.autorid','Article.autorname','Article.replycount','Article.thumimageurl',
				'Article.istop,Article.supportcount,Article.visitcount,Article.favorcount')));
		$this->Paginator->settings = $this->paginate;
		$articles = $this->Paginator->paginate('Article');
		//所有的类别
		$this->loadModel('ArticleCategory');
		$articlesCount = count($articles);
		for($i = 0; $i < $articlesCount; ++$i)
		{
			$this->ArticleCategory->recursive = -1;
			$categories = $this->ArticleCategory->find('all');
			$articles[$i]['Article']['category'] = $categories;
		}
		$this->set('articles',$articles);
		//获取分类
		$this->loadModel('ArticleCategory');
		$this->set('categories',$this->ArticleCategory->find('all'));
	}
	
	public function _loadGroupEvent($id){
		//获取达人吧文章(分页取)
		$this->loadModel('Event');
		$this->Event->recursive = 0;
		$this->paginate = array('Event' => array('model' => 'Event',
				'limit' => 20,
				'order' => array('Event.time' =>'DESC'),
				'recursive' => 1,
				'conditions' => array('Event.groupid'=>$id)));
		$this->Paginator->settings = $this->paginate;
		$events = $this->Paginator->paginate('Event');
		$this->set('events',$events);
	}

	public function _visitGroup($groupId){
		
	}
	
	public function _getVisitors($groupID){
		return array();
	}

	public function follow(){
		if ($this->request->is('post')){
			$groupID = $this->request->data['groupId'];
			$groupName = $this->request->data['groupName'];
			$portraiturl = $this->request->data['portraitUrl'];
			$currentUserID = $this->Session->read('userID');
			$currentUserName = $this->Session->read('userName');
			$this->_followGroup($currentUserID,$currentUserName,$groupID,$groupName,$portraiturl,2);
			
			$this->autoRender = false;
			header('Content-type: text/plain; charset=utf-8');
        
			echo 1;
		}
	}
	
	public function unfollow(){
		
		if ($this->request->is('post')){
			$groupid = $this->request->data['groupId'];

			//取消关注
			$this->loadModel('UserGroupLike');
			$currentUserID = $this->Session->read('userID');
			$groupMemberInfo = $this->UserGroupLike->getMembersOfGroup($groupid);
			$groupMembers = json_decode($groupMemberInfo['UserGroupLike']['likeinfos'],1);
			$groupMembers = ($groupMembers)?:array();
			$findValue = null;
			foreach ($groupMembers as $groupMember){
				if ($groupMember['userID'] == $currentUserID){
					$findValue = $groupMember;
					break;
				}
			}
			
			$this->autoRender = false;

			if (!$findValue) {
				header('Content-type: text/plain; charset=utf-8');
					
				echo 0;
				return ;
			}
			
			if ($findValue['power'] == GroupCreator)
			{
				//创建者不能取消关注
				header('Content-type: text/plain; charset=utf-8');
					
				echo 0;
				return ;
			}

			$groupMembers = array_removeObject($groupMembers,$findValue);
			$this->UserGroupLike->id = $groupMemberInfo['UserGroupLike']['id'];
			$stringMembers = json_encode($groupMembers);
			$this->UserGroupLike->saveField('likeinfos',$stringMembers);
			
			//我关注的列表移除
			$userGroupLike = $this->UserGroupLike->getUserLikeGroupInfo($currentUserID);
			$previousLikeInfos = $userGroupLike['UserGroupLike']['likeinfos'];
			$likeInfoArray = NULL;
			if ($previousLikeInfos) {
				$likeInfoArray = json_decode($previousLikeInfos,true);
			}
			$likeInfoArray = ($likeInfoArray) ? : array();
			$existLikeInfo = null;
			foreach ($likeInfoArray as $likeInfo) {
				if ($likeInfo['groupID'] == $groupid) {
					$existLikeInfo = $likeInfo;
					break;
				}
			}

			if(!existLikeInfo){
				header('Content-type: text/plain; charset=utf-8');
					
				echo 0;
				return ;
			}
			
			$likeInfoArray = array_removeObject($likeInfoArray,$existLikeInfo);

			$this->UserGroupLike->id = $userGroupLike['UserGroupLike']['id'];
			//持久化
			$this->UserGroupLike->saveField('likeinfos',json_encode($likeInfoArray));
			
			header('Content-type: text/plain; charset=utf-8');
				
			echo 1;
		}
		
	}
	
	public function _getGroupAllMember($id){
		if ($this->allGroupMember){
			return $this->allGroupMember;
		} 
		$this->loadModel('UserGroupLike');
		$groupMember = $this->UserGroupLike->getMembersOfGroup($id);
		$groupMembers = json_decode($groupMember['UserGroupLike']['likeinfos'],1);
		$groupMembers = ($groupMembers)?:array();
		$this->allGroupMember = $groupMembers;
		return $groupMembers;
	}
	
	public function isMemberOfGroup($id,$userId){
		$gm = $this->_getGroupMember($id, $userId);
		return ($gm != null);
	}
	
	public function isGroupAdmin($id,$userId){
		$gm = $this->_getGroupMember($id, $userId);
		if ($gm && ($gm['power'] == GroupAdmin || $gm['power'] == GroupCreator)) {
			return true;
		}
		return false;
	}
	
	
	public function _getGroupMember($id,$userId){
		$groupMembers = $this->_getGroupAllMember($id);
		$existGroupMember = null;
		foreach ($groupMembers as $gm) {
			if ($gm['userID'] == $userId) {
				$existGroupMember = $gm;
				break;
			}
		}
		return $existGroupMember;
	}

	private function _addGroupMember($currentUserID,$currentUserName,$groupID,$power){
		//---达人吧的成员添加
		$groupMember = $this->UserGroupLike->getMembersOfGroup($groupID);
		$mysqltime = date('Y-m-d H:i:s',time());
		$likeInfos = array('userName'=>$currentUserName,
						   'userID' => $currentUserID,
						   'indate' => $mysqltime,
							'power' => $power);
		
		//达人吧没有任何关注者
		if (!$groupMember) {
			$this->UserGroupLike->create();
			$creatorInfo = array('UserGroupLike' => 
									array('entityid' => $groupID,
										  'likeinfos'=> json_encode(array($likeInfos)),
										  'type'=>UserGroupLikeGroupType));
			//保存创建者信息
			$userLike = $this->UserGroupLike->save($creatorInfo);
			return $userLike;
		}else{
			$groupMembers = json_decode($groupMember['UserGroupLike']['likeinfos'],1);
			$groupMembers = ($groupMembers) ? : array();
			$existGroupMember = null;
			foreach ($groupMembers as $gm) {
				if ($gm['userID'] == $currentUserID) {
					$existGroupMember = $gm;
					break;
				}
			}
			$this->UserGroupLike->id = $groupMember['UserGroupLike']['id'];
			if (!$existGroupMember) {
				//如果不是成员则加入
				$groupMembers[] = $likeInfos;
				return $this->UserGroupLike->saveField('likeinfos',json_encode($groupMembers));
			}else{
				if ($power != $existGroupMember['power']) {
					$existGroupMember['power'] = $power;
					return $this->UserGroupLike->saveField('likeinfos',json_encode($groupMembers));
				}
			}
		}
		return false;
	}
	
	private function _addUserFollowGroup($currentUserID,$groupID,$groupName,$portraiturl,$power){
		//获取用户关注的达人吧
		$userGroupLike = $this->UserGroupLike->getUserLikeGroupInfo($currentUserID);
		$mysqltime = date('Y-m-d H:i:s',time());
		$newLikeInfo = array('groupName' => $groupName,
				'groupID' => $groupID,
				'groupportraiturl' => ($portraiturl) ? : '',
				'power' => $power,
				'followdate' => $mysqltime);
		//用户之前有关注过某个达人吧
		if ($userGroupLike) {
			$previousLikeInfos = $userGroupLike['UserGroupLike']['likeinfos'];
			$likeInfoArray = NULL;
			if ($previousLikeInfos) {
				$likeInfoArray = json_decode($previousLikeInfos,true);
			}
			$likeInfoArray = ($likeInfoArray) ? : array();
			//之前是否关注过这个达人吧
			$existLikeInfo = null;
			foreach ($likeInfoArray as $likeInfo) {
				if ($likeInfo['groupID'] == $groupID) {
					$existLikeInfo = $likeInfo;
					break;
				}
			}
				
			if (!$existLikeInfo) {
				//之前没有关注过
				$likeInfoArray[] = $newLikeInfo;
				$this->UserGroupLike->id = $userGroupLike['UserGroupLike']['id'];
				//持久化
				return $this->UserGroupLike->saveField('likeinfos',json_encode($likeInfoArray));
			}
		}
		else{//用户之前未关注过任何达人吧
			$this->UserGroupLike->create();
			$likeInfoArray = array($newLikeInfo);
			$creatorInfo = array('UserGroupLike' =>
					array('entityid' => $currentUserID,
							'likeinfos'=> json_encode(array($newLikeInfo)),
							'type'=>UserGroupLikeUserType));
			return $this->UserGroupLike->save($creatorInfo);
		}
	}
	
	//某个人关注了某个达人吧
	private function _followGroup($currentUserID,$currentUserName,$groupID,$groupName,$portraiturl,$power){
		if (is_numeric($currentUserID) && $currentUserName && is_numeric($groupID) && $groupName && $power) {
			$this->loadModel('UserGroupLike');
			//把成员信息存储到达人吧下面
			$this->_addGroupMember($currentUserID, $currentUserName, $groupID, $power);
			//添加成员喜欢的达人吧
			$this->_addUserFollowGroup($currentUserID, $groupID,$groupName,$portraiturl, $power);
		}
	}
	

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$currentUserID = $this->Session->read('userID');
			$currentUserName = $this->Session->read('userName');
			$data = $this->request->data;
			
			if ($this->Group->findByName($data['Group']['name'])) {
				echo "<script>alert('达人吧名字已经存在')</script>";
				return;
			}
			
			$mysqltime = date('Y-m-d H:i:s',time());
			$data['Group']['createdate'] = $mysqltime;
			$path = WWW_ROOT.'upload/group/';
			
			// 没有图片就是用default
			$this->ImageUpload = $this->Components->load('ImageUpload');
			$uploadedFiles = $this->ImageUpload->uploadFile($path,array("gif","jpeg","png","jpg"),160*160*32);
			if (!is_array($uploadedFiles)){
				echo "<script>alert('".$uploadedFiles."')</script>";
				return ;
			}
			if (is_array($uploadedFiles) && count($uploadedFiles) == 1 && $uploadedFiles[0]['error'] == 0){
				$data['Group']['portraiturl'] = '/app/webroot/upload/group/'.$uploadedFiles[0]['name'];
			}
			else{
				$data['Group']['portraiturl'] = '/app/webroot/img/group_default_portrait.png';
			}
			$data['Group']['creatorid'] = $currentUserID;
						
			//创建新的达人吧
			$this->Group->create();
			$group = $this->Group->save($data);
			if ($group) {
				//存储创建者的信息
				$this->loadModel('UserGroupLike');
				//添加达人吧的创建者
				$this->_addGroupMember($currentUserID, $currentUserName, $this->Group->id, GroupCreator);
				//添加用户所关注的达人吧
				$this->_addUserFollowGroup($currentUserID, $this->Group->id,
				$data['Group']['name'], $data['Group']['portraiturl'], GroupCreator);
				//日志统计
				$logs = array();
				$logs['time'] = time();
				$logs['username'] = $currentUserName;
				$logs['userid'] = $currentUserID;
				$logs['gid'] = $group['Group']['id'];
				$logs['gname'] = $group['Group']['name'];
				$logs['stat_type'] = 'create';
				$logsComponent = $this->Components->load('Statistic');
				$logsComponent->statGroupCreate($logs);
				//重定向
				$this->redirect(array('controller' => 'Groups','action' => 'view',$this->Group->id));
			} 
			else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
		
	}
	

	public function edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if ($_FILES){
				$path = WWW_ROOT.'upload/group/';
				$this->ImageUpload = $this->Components->load('ImageUpload');
				$uploadedFiles = $this->ImageUpload->uploadFile($path,array("gif","jpeg","png","jpg"),160*160*32);
				if (is_array($uploadedFiles) && count($uploadedFiles) == 1 && $uploadedFiles[0]['error'] == 0){
					$data['Group']['portraiturl'] = '/app/webroot/upload/group/'.$uploadedFiles[0]['name'];
				}
				else{
					$data['Group']['portraiturl'] = '/app/webroot/img/group_default_portrait.png';
				}
			}
			// if (isset($data['Group']['name'])){
			// 	unset($data['Group']['name']);
			// }
			if ($this->Group->save($data)) {
				return $this->redirect(array('action' => 'manage',$data['Group']['id']));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
	}


	public function delete($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	//圈子管理接口
	public function manage($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('无效的吧'));
			return;
		}
		$currentUserID = $this->Session->read('userID');
		//当前用户的权限
		$gm = $this->_getGroupMember($id, $currentUserID);
		if ($gm['power'] == GroupCreator){ //创建者的权限
			$this->_loadGroupCommdata($id);
			$groupMemberArray = array();
			$groupMembers = $this->allGroupMember;
			foreach ($groupMembers as $gm){
				$power = $gm['power'];
				$personalInfo = array();
				$personalInfo['id'] = $gm['userID'];
				$personalInfo['name'] = $gm['userName'];
				$personalInfo['indate'] = $gm['indate'];
				if ($gm['userID'] == $currentUserID){
					$personalInfo['adminPower'] = false;
					$personalInfo['canBeDeleted'] = false;
				}
				else{
					$personalInfo['adminPower'] = true;
					$personalInfo['canBeDeleted'] = true;
				}
				$personalInfo['isAdmin'] = ($power == GroupAdmin);
				$personalInfo['category'] = $this->UserGroupLike->getPowerString($power);
				$groupMemberArray[] = $personalInfo;
			}
			$this->set('members',$groupMemberArray);
		}
		else if ($gm['power'] == GroupAdmin){
			$this->_loadGroupCommdata($id);
			$groupMemberArray = array();
			$groupMembers = $this->allGroupMember;
			foreach ($groupMembers as $gm){
				$power = $gm['power'];
				$personalInfo = array();
				$personalInfo['id'] = $gm['userID'];
				$personalInfo['name'] = $gm['userName'];
				$personalInfo['indate'] = $gm['indate'];
				$personalInfo['adminPower'] = false;
				$personalInfo['canBeDeleted'] = false;
				$personalInfo['isAdmin'] = ($power == GroupAdmin);
				if ($power == GroupMember){
					$personalInfo['canBeDeleted'] = true;
				}
				$personalInfo['category'] = $this->UserGroupLike->getPowerString($power);
				$groupMemberArray[] = $personalInfo;
			}
			$this->set('members',$groupMemberArray);
		}
		else{
			throw new NotFoundException(__('权限不足'));
			return;
		}
	}
}
