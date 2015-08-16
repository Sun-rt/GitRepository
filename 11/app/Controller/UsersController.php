<?php

// app/Controller/UsersController.php
class UsersController extends AppController {

	public $name = 'Users';  
    public $helpers = array('Html', 'Form');  
    
    //重载父类
	public function loginUserAuth()
    {
	    $array = parent::loginUserAuth();
	    $array[] = 'article';
	    $array[] = 'userinfo';
	    $array[] = 'favors';
	    $array[] = 'group';
	    $array[] = 'follow';
	    $array[] = 'unfollowarticle';
	    return  $array;
    }   


    public function index() {
    }
    
    public function _loadCommDatas($id){
	    $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $currentUserID = $this->Session->read('userID');

        //用户个人信息读取
        $user = $this->User->read(null, $id);
        //处理访问者
        $visitors = json_decode($user['User']['visitor'],true);
        $newVistiros = null;
        if ($id != $currentUserID){
        	$currentVisitor = array('userId' => $currentUserID, 'time'=>time());
        	if (!$visitors){
        		$visitors = array();
        		$visitors[] = $currentVisitor;
        	}
        	else{
        		$find = false;
                $findVisitor = nil;
        		for ($i = 0; $i < count($visitors); $i++){
        			if ($visitors[$i]['userId'] == $currentUserID){
                        $findVisitor = $visitors;
                        break;
        			}
        		}
                $newVistiros = array_removeObject($visitors,$findVisitor);
                array_unshift($newVistiros,$currentVisitor);
        	}
        	if ($newVistiros) {
                $this->User->id = $id;
                $this->User->saveField('visitor',json_encode($newVistiros));
            }
        }
        $visitorArray = array();
        $limit = (count($visitors) > 9) ? 9 : count($visitors);
        for ($i = 0; $i < $limit; $i++){
        	$tmpVisitor = $this->User->find('first',array('conditions'=>array('id'=>$visitors[$i]['userId']),'fields'=>array('id','name','portraiturl')));
        	$visitorArray[] = $tmpVisitor;
        }
        $this->set('user', $user);
        $this->set('visitors',$visitorArray);
        //是不是自己
        $this->set('isSelf',$id == $currentUserID); 
        //----人与人之间关注信息------
        $this->loadModel('UserRelation');
        $userRelation = $this->UserRelation->getUserFansAndFollowers($id); 
	    $userFollowers = json_decode($userRelation['UserRelation']['followers'],true);
	    $userFans = json_decode($userRelation['UserRelation']['fans'],true);
	    $userFans = ($userFans)? : array();
	    $userFollowers = ($userFollowers) ? : array();
        //是否关注
        if ($id != $currentUserID){
	        //用户的关注
		    $this->set('followed',in_array($currentUserID, $userFans));
        }else{
	        $this->set('followed',true);
        }
        $this->set('fansCount',count($userFans));
        $this->set('followersCount',count($userFollowers));
        //用户关注的圈子
        $this->loadModel('UserGroupLike');
        $userGroupLike = $this->UserGroupLike->getUserLikeGroupInfo($id);
        $likeInfoArray = NULL;
        $previousLikeInfos = $userGroupLike['UserGroupLike']['likeinfos'];
		if ($previousLikeInfos) {
			$likeInfoArray = json_decode($previousLikeInfos,true);
		}
		$likeInfoArray = ($likeInfoArray) ? : array();
		//吧信息
		$this->loadModel('Group');
		for ($i = 0; $i < count($likeInfoArray); $i++){
			$likeInfoArray[$i]['powerString'] = $this->UserGroupLike->getPowerString($likeInfoArray[$i]['power']);
			$groupMembers = $this->UserGroupLike->getMembersOfGroup($likeInfoArray[$i]['groupID']);
			$groupMembers = json_decode($groupMembers['UserGroupLike']['likeinfos'],true);
			$groupMembers = ($groupMembers)?:array();
			foreach ($groupMembers as $groupMember){
				if ($groupMember['power'] == GroupCreator){
					$likeInfoArray[$i]['creatorName'] = $groupMember['userName'];
					$likeInfoArray[$i]['creatorID'] = $groupMember['userID'];
					break;
				}
			}
			$likeInfoArray[$i]['memberCount'] = count($groupMembers);
			//吧头像
			$conditions = array('Group.id' => $likeInfoArray[$i]['groupID']);
			$groupResult = $this->Group->find('first',array(
				'conditions' => $conditions,
				'fields' => array('Group.portraiturl'),
				'limit' => 1));
			$likeInfoArray[$i]['groupportraiturl'] = $groupResult['Group']['portraiturl'];
			
		}
		$this->set('followGroups',$likeInfoArray);
		//用户的文章
		$this->loadModel('Article');
		$this->Article->recursive = 1;
		$conditions = array('Article.autorid' => $id);
		$articles = $this->Article->find('all',array('conditions' => $conditions,'fields' => 	
						array('id','title', 'autorname', 'easyintro','lastreply','replycount','visitcount','supportcount',
						'time','ArticleCategory.name'),'order' => 'time DESC'));
        $this->set('articles',$articles);
        //用户的活动
        $this->loadModel('Event');
        $this->Event->recursive = 1;
        $conditions = array('Event.autorid' => $id);
        $events = $this->Event->find('all',array('conditions' => $conditions,'fields'=>array('id','title',
        'replycount','visitcount','supportcount','applycount','time','Category.name'),'order' => 'time DESC'));
        $this->set('events',$events);
        //我的收藏
        $this->loadModel('UserFavorActicle');
        $userFavors = $this->UserFavorActicle->getUserFavorArticles($currentUserID);
		$userFavorArticles = json_decode($userFavors['UserFavorActicle']['favorInfos'],true);
		$userFavorArticles = ($userFavorArticles) ? : array();
		if (count($userFavorArticles))
		{
			$this->Article->recursive = 0;
			$favorArticleCondtions = array('Article.id'=>$userFavorArticles);
			$fields = array('id','title','time','replycount','supportcount','easyintro','autorid','autorname','ArticleCategory.name');
			$userFavorArticles = $this->Article->find('all',array('conditions'=>$favorArticleCondtions,'fields'=>$fields));
			$this->set('favorArticles',$userFavorArticles);
		}
		else{
			$this->set('favorArticles',array());
		}
    }

    public function view($id = null) {
	    $this->_loadCommDatas($id);
    }
 //用户的文章
    public function article($id)
    {
	    $this->_loadCommDatas($id);
    }
 //用户的资料   
    public function userinfo($id)
    {
	    $this->_loadCommDatas($id);
    }
//收藏的文章
	public function favors($id)
    {
	    $this->_loadCommDatas($id);
    }

//用户的圈子
	public function group($id)
    {
	    $this->_loadCommDatas($id);
    }
    
    public function unfollowarticle($articleId = null){
    	if ($articleId && is_numeric($articleId)){
    		$currentUserId = $this->Session->read('userID');
    		
    		//当前用户关注的文章
    		$this->loadModel('UserFavorActicle');
    		$userFavors = $this->UserFavorActicle->getUserFavorArticles($currentUserId);
    		
    		if ($userFavors){
    			$userFavorArticles = json_decode($userFavors['UserFavorActicle']['favorInfos'],true);
    			$userFavorArticles = array_removeObject($userFavorArticles,$articleId);
    			$this->UserFavorActicle->id = $userFavors['UserFavorActicle']['id'];
    			$this->UserFavorActicle->storeUserFavorArticles($currentUserId,json_encode($userFavorArticles));
    		}
    		
    		//文章
    		$favors = $this->UserFavorActicle->getArticleFavored($articleId);
    		$favorUsers = null;
    		if ($favors){
    			$favorUsers = json_decode($favors['UserFavorActicle']['favorInfos'],true);
    			$favorUsers = ($favorUsers) ? : array();
    			$favorUsers = array_removeObject($favorUsers,$currentUserId);
    			$this->UserFavorActicle->id = $favors['UserFavorActicle']['id'];
    			$this->UserFavorActicle->storeArticleFavored($articleId,json_encode($favorUsers));
    		}
    		
    		$this->loadModel('Article');
    		$this->Article->id = $articleId;
    		$this->Article->saveField('favorcount',count($favorUsers));
    		
    		$this->redirect($this->referer());
    	}
    	else{
    		
    	}
    }
    
    //关注与取消关注
    public function follow($followId){
	    if (is_numeric($followId)){
		    $currentUserId = $this->Session->read('userID');
		    
		    if ($followId == $currentUserId){
			    return ;
		    }
		    $this->autoRender = false;
		    
		    $this->loadModel('UserRelation');
		    $userRelation = $this->UserRelation->getUserFansAndFollowers($followId);
		    $cUserRelation = $this->UserRelation->getUserFansAndFollowers($currentUserId); 
		    
		    //用户的粉丝
		    $userFans = json_decode($userRelation['UserRelation']['fans'],true);
		    $userFans = ($userFans) ? : array();
		    //用户的关注
		    $cUserFollowers = json_decode($cUserRelation['UserRelation']['followers'],true);
		    $cUserFollowers = ($cUserFollowers) ? : array();
		    
		    //检查当前用户是否关注了他
		    $isFollowed = in_array($followId,$cUserFollowers);
		    		    
		    //说明是取消关注
		    if ($isFollowed){
			    if(($key = array_search($currentUserId, $userFans)) !== false) {
					unset($userFans[$key]);
				}
				if(($key = array_search($followId, $cUserFollowers)) !== false) {
					unset($cUserFollowers[$key]);
				}
		    }
		    else{ //关注
			    $cUserFollowers[] = $followId;
			    $userFans[] = $currentUserId;
			    array_unique($userFans);
		    }
		    
		    //存储值
		    $this->UserRelation->storeUserFansAndFollowers($currentUserId,null,json_encode($cUserFollowers));
		    $this->UserRelation->storeUserFansAndFollowers($followId,json_encode($userFans),null);
		    
		    header('Content-type: text/plain; charset=utf-8');
		    //返回是否已经关注
		    echo in_array($followId,$cUserFollowers);
	    }
    }


    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function beforeFilter() {
        if (!$this->checkLogined()) {
            $this->Auth->allow('login');
        }else{
        	if ($this->request->params['action'] == 'login') {
				$this->redirect('/');
			}
  			parent::beforeFilter();
        }
    }

    public function login() {
    	$title_for_layout = '登录 - 达人吧';
		$this->set('title_for_layout', $title_for_layout);
		
        if ($this->request->is('post')) {
			$username = $this->data['User']['name'];
			$userpass = $this->data['User']['password'];
			if (empty($username) || empty($userpass))
			{
				echo "<script>alert('请输入用户名和密码')</script>";
			}
			else {
				$userinfo = $this->_getUserInfo($username);
				
				if (empty($userinfo)) {
					echo "<script>alert('用户不存在')</script>";
				} else {
					if ($username == $userinfo['User']['name'] && 
					 	md5($userpass) == $userinfo['User']['password']) {
							$this->Cookie->write('userID',$userinfo['User']['id'],true,24*60*60*30);
							$this->Cookie->write('userName',$userinfo['User']['name'],true,24*60*60*30);
							$this->Cookie->write('password',md5($userpass),true,24*60*60*30);
							$this->Session->write('userID',$userinfo['User']['id']);
							$this->Session->write('userName',$userinfo['User']['name']);
							$this->redirect('/');
					} else {
						echo "<script>alert('用户名或密码错误')</script>";
					}
				}
			}
			/*
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }*/
        }
    }

    public function logout() {
    	$this->Cookie->delete('userID');
		$this->Cookie->delete('userName');
		$this->Cookie->destroy();
		$this->Session->delete('userID');
		$this->Session->delete('userName');
		$this->Session->renew();
        $this->redirect('/');
    }
	
	//获取用户的信息
	//结果结构是results['User']['name']  results['User']['password']...
	public function _getUserInfo($username){
		if (isset($username)){
			return $this->User->findByName($username);			
		}
	}
        
}
