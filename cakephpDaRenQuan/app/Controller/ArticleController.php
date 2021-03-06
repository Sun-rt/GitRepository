<?php

App::uses('AppController', 'Controller');
/**
 * Articles Controller
 *
 * @property Article $Article
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ArticleController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $paginate = array();     
	public $name = 'Article';
	
	//重载父类
	public function loginUserAuth()
    {
	    $array = parent::loginUserAuth();
	    $array[] = 'support';
	    $array[] = 'favorArticle';
	    $array[] = 'commentArticle';
	    $array[] = 'emailShare';
	    $array[] = 'edit';
	    return  $array;
    }
	
	//获取所有文章
	public function index() {
		//获取达人吧文章(分页取)
		$this->Article->recursive = 0;
		$this->paginate = array('Article' => array('model' => 'Article',
												   'limit' => 20,
												   'order' => array('Article.time' =>'DESC'),
												   'recursive' => 0,
												   'fields' => array('Article.id','Article.title','Article.content',
													'Article.groupid','Article.time','Article.easyintro','Article.replycount',
													'Article.autorid','Article.autorname',
													'Article.istop','Article.supportcount')));						
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
	}
	

//获取当前用户的最近文章
	private function _getCurrentUserLatestArticle($exceptArticleID,$authorID,$limit)
	{
		if ($limit < 0 || !$exceptArticleID || !$authorID){
			return ;
		}
		$this->Article->recursive = 0;
		$conditions = array('Article.autorid' => $authorID,'Article.id !=' => $exceptArticleID);
		$lastestArticle = $this->Article->find('all',array('conditions' => $conditions,'limit' => $limit,'fields' => array('id','title'),'order' => 'time DESC'));
        return $lastestArticle;
	}
	
	public function view($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}
		//文章		
		var_dump($id);
		$title_for_layout = '文章';
		$this->set('title_for_layout', $title_for_layout);
		$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
		$this->Article->recursive = -1;
		$article = $this->Article->find('first', $options);
		
		//查看当前访问的用户是否关注了这个圈子
		$groupId = $article['Article']['groupid'];
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
			$this->autoRender = false;
			echo "<script>";
			echo "if (confirm('关注本吧才能查看文章，是否进入本吧？'))";
			echo "{window.location = '/groups/view/".$groupId."'}";
			echo "else { window.history.go(-1); }";
			echo "</script>";


			// $this->redirect('/errors/error/1');
			return ;
		}	
		$this->Article->recursive = 1;
		$article = $this->Article->find('first', $options);
		$this->set('articleInfo', $article);
		
		//是否是作者
		$this->set("isAuthor",($currentUserID == $article['Article']['autorid']));
		
		$this->loadModel("User");
		$user = $this->User->findById($article['Article']['autorid']);
		$this->set("author",$user);
		
		//标签
		$this->loadModel('ArticleTagMap');
		$this->ArticleTagMap->recursive = 1;
		$articleTags = $this->ArticleTagMap->find('all',array('conditions' => 
									array('ArticleTagMap.articleid' => $id),'fields'=>array('ArticleTagMap.articleid','Tag.name','Tag.id')));
		$this->set('articleTags',$articleTags);
		//加载评论
		$this->loadModel('ArticleReply');
		$this->ArticleReply->recursive = 0;
		$this->paginate = array('ArticleReply' => array('model' => 'ArticleReply',
												   'limit' => 10,
												   'order' => array('ArticleReply.time' =>'DESC'),
												   'recursive' => 1,
												   'conditions' => array('ArticleReply.belongid'=>$article['Article']['id'])));						
		$this->Paginator->settings = $this->paginate;
		$replies = $this->Paginator->paginate('ArticleReply');
		$this->set('articleReplies',$replies);
		
		//获取用户最近文章
		$lastestArticle = $this->_getCurrentUserLatestArticle($id,$article['Article']['autorid'],5);
		$lastestArticle = ($lastestArticle) ? : array();
		$this->set('latestArticles',$lastestArticle);
		
		
		$aritcleOtherInfo = array();
		$currentUserID = $this->Session->read('userID');
		
		//获取用户操作数据
		$this->loadModel('ArticleUserOperation');
		$userOperation = $this->ArticleUserOperation->getArticleUserOperation($id);
		$supportList = json_decode($userOperation['ArticleUserOperation']['supportlist'],true);
		$visitList = json_decode($userOperation['ArticleUserOperation']['vistitlist'],true);
		//添加访问
		$visitList[] = array('id' => $currentUserID,'name' => $this->Session->read('userName'),'time' => date('Y-m-d H:i:s',time()));
		$newJson = json_encode($visitList);
		$this->ArticleUserOperation->id = $id;
		$this->ArticleUserOperation->storeArticleUserOperation($id,$newJson,$userOperation['ArticleUserOperation']['supportlist']);
		
		
		$aritcleOtherInfo = array();
		//check当前用户是否赞过
		$aritcleOtherInfo['supported'] = false;
		if ($supportList) {
			foreach ($supportList as $userid){
				if ($currentUserID == $userid) {
					$aritcleOtherInfo['supported'] = true;
					break;
				}
			}
		}
		//是否收藏过
		$this->loadModel('UserFavorActicle');			
		$favors = $this->UserFavorActicle->getArticleFavored($id);
        $favorUsers = json_decode($favors['UserFavorActicle']['favorInfos'],true);
        $favorUsers = ($favorUsers) ? : array();
        $this->set('favored',in_array($currentUserID, $favorUsers));
		//相关阅读
		$aritcleOtherInfo['relatedAriticles'] = array();
		
		$this->updateArticleCount($id,count($supportList),count($replies),count($visitList),count($favorUsers));
		
		$this->set("articleOtherInfo",$aritcleOtherInfo);
	}
	
	public function updateArticleCount($id,$supportCount,$replyCount,$visitCount,$favorCount = -1){
		if (is_numeric($id)){
			$updateValues = $this->Article->findById($id);
			if ($supportCount >= 0){
				$updateValues['Article']['supportcount'] = $supportCount;
			}
			if ($replyCount >= 0){
				$updateValues['Article']['replycount'] = $replyCount;
			}
			if ($visitCount >= 0){
				$updateValues['Article']['visitcount'] = $visitCount;
			}
			if ($favorCount >= 0){
				$updateValues['Article']['favorcount'] = $favorCount;
			}
			$this->Article->save($updateValues);
		}
	}
	
	//文章评论
	public function commentArticle(){
		if ($this->request->is('post')) {
			$currentUserID = $this->Session->read('userID');
			$currentUserName = $this->Session->read('userName');
			//其他必要信息
			$data = $this->request->data;
			$mysqltime = date('Y-m-d H:i:s',time());
			$data['ArticleReply']['time'] = $mysqltime;
			$data['ArticleReply']['autorid'] = $currentUserID;
			$data['ArticleReply']['autorname'] = $currentUserName;
			$this->loadModel("User");
			$data['ArticleReply']['autorportraiturl'] = $this->User->findById($currentUserID)['User']['portraiturl']; 
			$this->loadModel('ArticleReply');
			
			//更新积分
			$this->ArticleReply->recursive = -1;
			$count = $this->ArticleReply->find('count',array('conditions'=>array('belongid' => $data['ArticleReply']['belongid'],
																		'autorid' => $currentUserID)));
			if ($count == null || $count == 0){
				$this->_saveUserIntegration($currentUserID, 2);
			}
			
			$this->ArticleReply->id = NULL;
			$this->ArticleReply->create();
			$this->set('commentSuccess', ($this->ArticleReply->save($data)) ? true : false );
			$id = $data['ArticleReply']['belongid'];
			//更新数量
			if (array_key_exists('replyCount', $data['ArticleReply'])){
				$this->updateArticleCount($id,-1,$data['ArticleReply']['replyCount']+1,-1,-1);
			}
			
			//加载评论
			$this->loadModel('ArticleReply');
			$this->ArticleReply->recursive = 0;
			$this->autoRender = false;
			header('Content-type: text/plain; charset=utf-8');
			$this->paginate = array('ArticleReply' => array('model' => 'ArticleReply',
													   'limit' => 10,
													   'order' => array('ArticleReply.time' =>'DESC'),
													   'recursive' => 1,
													   'conditions' => array('ArticleReply.belongid'=>$data['ArticleReply']['belongid'])));						
			$this->Paginator->settings = $this->paginate;
			$replies = $this->Paginator->paginate('ArticleReply');
			
			$newJson = json_encode($replies);
		
			echo $newJson;
		}
	}
	
	//楼中楼
	public function commentReply(){
		if ($this->request->is('post')) {
			$currentUserID = $this->Session->read('userID');
			$currentUserName = $this->Session->read('userName');
			//其他必要信息
			$data = $this->request->data;
			$mysqltime = date('Y-m-d H:i:s',time());
			$data['ArticleReply']['time'] = $mysqltime;
			$data['ArticleReply']['autorid'] = $currentUserID;
			$data['ArticleReply']['autorname'] = $currentUserName;
			$id = $data['articleId'];
			$this->loadModel('ArticleReply');
			$this->ArticleReply->create();
			$this->set('commentSuccess', ($this->ArticleReply->save($data)) ? true : false );
			//更新数量
			if (array_key_exists('replyCount', $data['ArticleReply'])){
				$this->updateArticleCount($id,-1,$data['ArticleReply']['replyCount']+1,-1,-1);
			}
		}
	}
	
	private function _favorArticle($articleid,$articletitle){
		if (!is_numeric($articleid)){
			return ;
		}
		else{
			$currentUserID = $this->Session->read('userID');
			$this->loadModel('UserFavorActicle');
			
			//存储用户的收藏的信息
			$userFavors = $this->UserFavorActicle->getUserFavorArticles($currentUserID);
			$userFavorArticles = json_decode($userFavors['UserFavorActicle']['favorInfos'],true);
			$userFavorArticles = ($userFavorArticles)?:array();
			if (!in_array($articleid, $userFavorArticles)){
				$userFavorArticles[] = $articleid;
				if ($userFavors){
					$this->UserFavorActicle->id = $userFavors['UserFavorActicle']['id'];
				}else{
					$this->UserFavorActicle->id = null;
				}
				$this->UserFavorActicle->storeUserFavorArticles($currentUserID,json_encode($userFavorArticles));
			}
            //存储文章被xx收藏的信息
            $favors = $this->UserFavorActicle->getArticleFavored($articleid);
            $favorUsers = json_decode($favors['UserFavorActicle']['favorInfos'],true);
            $favorUsers = ($favorUsers) ? : array();
            if (!in_array($currentUserID, $favorUsers)){
	            $favorUsers[] = $currentUserID;
	            if ($favors){
	            	$this->UserFavorActicle->id = $favors['UserFavorActicle']['id'];
				}else{
	            	$this->UserFavorActicle->id = null;
            	}
				$this->UserFavorActicle->storeArticleFavored($articleid,json_encode($favorUsers));
            }
            //存储数量
            $this->updateArticleCount($articleid,-1,-1,-1,count($favorUsers));
            $this->set('favorSuccess',true);
            return count($favorUsers);
		}
	}
	
	//收藏文章	
	public function favorArticle(){
		if ($this->request->is('post')){
			$articleid = $this->request->data['id'];
			$articleTitle = $this->request->data['title'];
			$this->autoRender = false;
			//收藏count
			$favorCount = $this->_favorArticle($articleid,$articleTitle);
			
			//以utf-8的文本模式输出
			header('Content-type: text/plain; charset=utf-8');
			
			// 输出整理后的数据
			$retturnData='{"isFavor":"'.'1'.'","favorCount":"'.$favorCount.'"}';
			echo $retturnData;
		}
	}
	
	//顶的接口
	public function support($articleID){
		if (!is_numeric($articleID)){
			$this->set('supportSuccess',false);
			return ;
		}
		// 禁止自动Render，免去为此Action去建View的烦扰
		$this->autoRender = false;
		$aid = $articleID;
		//拿到用户操作的数据
		$this->loadModel('ArticleUserOperation');
		$userOperation = $this->ArticleUserOperation->getArticleUserOperation($aid);
		$supportList = json_decode($userOperation['ArticleUserOperation']['supportlist'],true);
		$supportList = ($supportList) ? : array();
		$currentUserID = $this->Session->read('userID');
		$isSupported = false;
		
		foreach ($supportList as $userid){
			if ($currentUserID == $userid) {
				$isSupported = true;
				break;
			}
		}
		
		//是否已经定过
		if ($isSupported){
			if(($key = array_search($currentUserID, $supportList)) !== false) {
				unset($supportList[$key]);
				$isSupported = false;
			}
		}
		else{
			$supportList[] = $currentUserID;
			$isSupported = true;
		}
		
		$newJson = json_encode($supportList);
		$this->ArticleUserOperation->id = $aid;
		$this->ArticleUserOperation->saveField('supportlist',$newJson);
		$this->updateArticleCount($articleID,count($supportList),-1,-1);
		$this->set('supportSuccess',true);
		
		//以utf-8的文本模式输出
		header('Content-type: text/plain; charset=utf-8');

		/*您的程序*/
		
		// 输出整理后的数据
		$retturnData='{"isZan":"'.($isSupported?'1':'0').'","supportCount":"'.count($supportList).'"}';
		echo $retturnData;
	}
	
	public function _saveArticleTagsMap($articleid = null,$tagNames = null){
		if (!$articleid || !$tagNames || count($tagNames) == 0){
			return;
		}
		
		$tagUniNames = array_unique($tagNames); 
		
		$this->loadModel('Tag');
		$tagIDs = array();
		foreach ($tagUniNames as $tagName) {
			$tagObj = $this->Tag->findByName($tagName);
			if ($tagObj) {
				$tagIDs[] = $tagObj['Tag']['id'];
			}else{
				$data = array();
				$data['Tag']['name'] = $tagName;
				$data['Tag']['createdate'] = date('Y-m-d H:i:s',time());;
				$this->Tag->create();
				$this->Tag->save($data);
				$tagIDs[] = $this->Tag->id;
			}
		}
		
		if (count($tagIDs) > 0) {
			foreach ($tagIDs as $tagID) {
				$this->loadModel('ArticleTagMap');
				$this->ArticleTagMap->create();
				$data = array();
				$data['ArticleTagMap']['articleid'] = $articleid;
				$data['ArticleTagMap']['tagid'] = $tagID;
				$this->ArticleTagMap->save($data);
			}
		}
	}
	
	//存储用户的积分
	public function _saveUserIntegration($id,$offset)
	{
		if (is_numeric($id) && is_numeric($offset))
		{
			$this->loadModel('User');
			$user = $this->User->find('first',array('conditions'=>array('id'=>$id),'fields'=>array('id','integration')));
			if ($user){
				$userNewIntegration = intval($user['User']['integration']) + $offset;
				$this->User->id = $id;
				$this->User->saveField('integration',''.$userNewIntegration.'');
			}			
		}
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
			$mysqltime = date('Y-m-d H:i:s',time());
			$data['Article']['time'] = $mysqltime;
			$data['Article']['autorid'] = $currentUserID;
			$data['Article']['autorname'] = $currentUserName;
			$data['Article']['easyintro'] = mb_substr(strip_tags($data['Article']['content']), 0,200);
			$tagArray = explode(' ', $data['Article']['tags']);
			$this->Article->create();
			$group = $this->Article->save($data);
			if ($group) {
				//日志统计
				$logs = array();
				$logs['time'] = time();
				$logs['username'] = $currentUserName;
				$logs['userid'] = $currentUserID;
				$logs['articleid'] = $group['Article']['id'];
				$logs['articletitle'] = $group['Article']['title'];
				$logs['gid'] = trim($data['Article']['groupid']);
				$logs['gname'] = trim($data['Article']['gName']);
				$logs['stat_type'] = 'create';
				$logsComponent = $this->Components->load('Statistic');
				$logsComponent->statArticleCreate($logs);
				
				//存储标签
				$this->_saveArticleTagsMap($this->Article->id, $tagArray);
				//添加积分
				/*$this->_saveUserIntegration($currentUserID, 10);
				$this->loadModel('Group');
				$group = $this->Group->findById($data['Article']['groupid']);
				$newIntegration = intval($group['Group']['integration']) + 15;
				$this->Group->id = $data['Article']['groupid'];
				$this->Group->saveField('integration',''.$newIntegration.'');*/
				
				$path = WWW_ROOT.'upload/userfile/';
				$this->_checkFile($path);

				//重定向
				return $this->redirect(array('action' => 'view',$this->Article->id));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'));
			}
		}
		else{
			if (!$groupid) {
				$this->redirect($this->referer());
				return;
			}
			//所有的类别
			$this->loadModel('ArticleCategory');
			$this->ArticleCategory->recursive = -1;
			$categories = $this->ArticleCategory->find('all');
			$this->set('categories',$categories);
			//获取圈子信息
			$this->loadModel('Group');
			$this->Group->recursive = 0;
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $groupid));
			$group = $this->Group->find('first', $options);
			$this->set('group', $group);
		}
		
	}

public function _checkFile($path,$allowExt = array("txt"),$maxSize=2097152)
	{
		if(!$_FILES){
			return ;
		}
		if(!file_exists($path)){
			mkdir($path,0777,true);
		}
		if($_FILES['userUploadFile']['error']===UPLOAD_ERR_OK){
			
			//检测文件的扩展名
			$array = explode(".",$_FILES['userUploadFile']['name']);
			$ext= end($array);			
			if(!in_array($ext,$allowExt)){
				exit("非法文件类型");
			}
			
			//上传文件的大小
			if($_FILES['userUploadFile']['size']>$maxSize){
				exit("上传文件过大");
			}
			if(!is_uploaded_file($_FILES['userUploadFile']['tmp_name'])){
				exit("不是通过HTTP POST方式上传上来的");
			}
			//$filename=$this->getUniName().".".$ext;
			$destination=$path."/".$_FILES['userUploadFile']['name'];
			if(!move_uploaded_file($_FILES['userUploadFile']['tmp_name'], $destination)){
				exit("转移文章失败");
			}
		}
	}
	
	
/**
 * 编辑文章的接口
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('无效的文章'));
		}
		
		$currentUserID = $this->Session->read('userID');
		$currentUserName = $this->Session->read('userName');
		
		if ($this->request->is('post')) {
			
			//其他必要信息
			$data = $this->request->data;
			$mysqltime = date('Y-m-d H:i:s',time());
			$data['Article']['time'] = $mysqltime;
			$data['Article']['autorid'] = $currentUserID;
			$data['Article']['autorname'] = $currentUserName;
			$data['Article']['easyintro'] = mb_substr(strip_tags($data['Article']['content']), 0,200);
			$tagArray = explode(' ', $data['Article']['tags']);
			$group = $this->Article->save($data);
			
			if ($group){
				$this->_saveArticleTagsMap($this->Article->id, $tagArray);
			}
			
			return $this->redirect(array('action' => 'view',$this->Article->id));
		} else {
			$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
			$group = $this->Article->find('first', $options);
			if ($group['Article']['autorid'] == $currentUserID){
				$this->request->data = $group;
				$this->set('group', $group);

				$this->loadModel('ArticleTagMap');
				$this->ArticleTagMap->recursive = 1;
				$articleTags = $this->ArticleTagMap->find('all',array('conditions' => 
											array('ArticleTagMap.articleid' => $id),'fields'=>array('ArticleTagMap.articleid','Tag.name','Tag.id')));
				$this->set('articleTags',$articleTags);

			}else{
				throw new NotFoundException(__('无效的文章'));
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
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('The article has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
/**
* mail share method
*
* @return true or false
*/
	public function emailShare(){
		
		// request data
		$articleID = $this->request->data['articleID'];
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
		if (!$this->Article->exists($articleID)) {
			throw new NotFoundException(__('Invalid article'));
		}
		$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $articleID));
		$shardedArticle = $this->Article->find('first', $options);
		
		//加载评论
		$this->loadModel('ArticleReply');

		$options = array(  'limit' => 3,
							'order' => array('time' =>'DESC'),
							'recursive' => -1,
							'conditions' => array('belongid'=>$articleID) );
												   
		$sharedArticleReply =  $this->ArticleReply->find('all',$options);									   
		
		// maile
		$this->emailComponent = $this->Components->load('email');
		$this->emailComponent->shareArticle('hemuzilove',$to,$subject,$shardedArticle,$sharedArticleReply,$why);
	
		echo true;
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Article->recursive = 0;
		$this->set('articles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}
		$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
		$this->set('article', $this->Article->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('The article has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('The article has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
			$this->request->data = $this->Article->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('The article has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
