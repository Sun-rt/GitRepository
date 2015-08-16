<?php

App::uses('AdminAppController', 'Controller');
App::import('Controller', 'Home');


// app/Controller/UsersController.php
class AdminsController extends AdminAppController 
{
	public function index()
	{
		$this->loadModel('AdminUser');
		$this->set('articleInfo',$this->AdminUser->find('all'));
	}
	
	public function login() {
		$title_for_layout = '登录 - 达人吧';
		$this->set('title_for_layout', $title_for_layout);
		if ($this->request->is('post')) {
			$username = $this->data['AdminUser']['username'];
			$userpass = $this->data['AdminUser']['password'];
			if (empty($username) || empty($userpass))
			{
				echo "<script>alert('请输入用户名和密码')</script>";
			}
			else {
				$this->loadModel('AdminUser');
				$userinfo = $this->AdminUser->findByUsername($username);
				if (empty($userinfo)) {
					echo "<script>alert('用户不存在')</script>";
				}
			    else {
					if ($username == $userinfo['AdminUser']['username'] &&
					md5($userpass) == $userinfo['AdminUser']['password']) {
						$this->Cookie->write('adminUserId',$userinfo['AdminUser']['id'],true,24*60*60*30);
						$this->Cookie->write('adminUserName',$userinfo['AdminUser']['username'],true,24*60*60*30);
						$this->Cookie->write('adminPassword',md5($userpass),true,24*60*60*30);
						$this->Session->write('adminUserId',$userinfo['AdminUser']['id']);
						$this->Session->write('adminUserName',$userinfo['AdminUser']['username']);
						$this->redirect(array('action' => 'index'));
					} 
					else {
						echo "<script>alert('用户名或密码错误')</script>";
					}
				}
			}
		}
	}

/**
*	期刊管理（view）
*
*/
	public function homejournals()
	{
		$dbdata = $this->_gethomelinks('HomeJournals');
		$this->set('journalsArray',$dbdata);
	}

/**
*	期刊管理（add && del）
*
*/
	public function homejournalsmanager()
	{
		$op = $this->request->data['op'];
		$name = $this->request->data['name'];
		$link = $this->request->data['link'];
		
		$this->_homelinks('HomeJournals',$op,$name,$link);
		
		$this->redirect(array('controller' => 'Admins','action' => 'homejournals'));
	}
	
/**
*	常用链接管理（view）
*
*/
	public function homelinks()
	{
		$dbdata = $this->_gethomelinks('HomeLinks');
		$this->set('homeLinksArray',$dbdata);
	}
	
/**
*	常用链接管理（add && del）
*
*/
	public function homelinksmanager()
	{
		$op = $this->request->data['op'];
		$name = $this->request->data['name'];
		$link = $this->request->data['link'];
		
		$this->_homelinks('HomeLinks',$op,$name,$link);
		
		$this->redirect(array('controller' => 'Admins','action' => 'homelinks'));
	}
/**
*	inner首页链接管理（add && del）
*
*/
	public function _gethomeLinks($recordType)
	{
		//load
		$this->loadModel('HomeArticleCategory');
		$dbdata = $this->HomeArticleCategory->getArticleInfos($recordType);
		
		// decode to array	
		$dataArray = array();
		if ($dbdata){
			$dataArray = json_decode($dbdata['HomeArticleCategory']['articleinfos'],true);
		}
		return $dataArray;
	}
	
/**
*	inner首页链接管理（add && del）
*
*/
	public function _homeLinks($recordType,$op,$name,$link)
	{
		if($op == "add")
		{
			// valid
			if(!$name || strlen(trim($name)) <= 0 || !$link || strlen(trim($link)) <= 0)
			{
				return ;
			}
			//测试生成数据
			$this->loadModel('HomeArticleCategory');
			$journalInHome = $this->HomeArticleCategory->getArticleInfos($recordType);
			
			// decode to array	
			$journalInHomeArray = array();
			if ($journalInHome){
				$journalInHomeArray = json_decode($journalInHome['HomeArticleCategory']['articleinfos'],true);
			}
			// in array
			$existFlag = false;
			$arrCount = count($journalInHomeArray);
			for($i = 0; $i< $arrCount; ++$i)
			{
				if($journalInHomeArray[$i]['name'] == $name)
				{
					$existFlag = true;
					break;
				}
			}
			// add to array
			if(!$existFlag)
			{
				$data = array();
				$data['name'] = $name;
				$data['link'] = $link;
				
				array_push($journalInHomeArray,$data);
			}
			// sotre
			$jsonData = json_encode($journalInHomeArray);
			$this->HomeArticleCategory->storeAriticleInfos($recordType,$jsonData);
		}
		else
		{
			// valid
			if(!$name || strlen(trim($name)) <= 0)
			{
				return ;
			}
			// load
			$this->loadModel('HomeArticleCategory');
			$journalInHome = $this->HomeArticleCategory->getArticleInfos($recordType);
			
			// decode to array	
			$journalInHomeArray = array();
			if ($journalInHome){
				$journalInHomeArray = json_decode($journalInHome['HomeArticleCategory']['articleinfos'],true);
			}
			// in array
			$arrCount = count($journalInHomeArray);
			for($i = 0; $i< $arrCount; ++$i)
			{
				if($journalInHomeArray[$i]['name'] == $name)
				{
					array_splice($journalInHomeArray, $i,1);
					break;
				}
			}
			// sotre
			$jsonData = json_encode($journalInHomeArray);
			$this->HomeArticleCategory->storeAriticleInfos($recordType,$jsonData);
		}
	}
	
	public function homebanner () {
		if ($this->request->is('post')){
			$path = WWW_ROOT.'upload/homepageimg/';
// 			echo var_dump($this->request->data);
			// 没有图片就是用default
			$this->ImageUpload = $this->Components->load('ImageUpload');
			$uploadedFiles = $this->ImageUpload->uploadFile($path,array("gif","jpeg","png","jpg"),1000*200*32);
			
// 			if (!is_array($uploadedFiles)){
// 				echo "<script>alert('".$uploadedFiles."')</script>";
// 				return ;
// 			}
				
// 			if (count($this->request->data) != 3 || !is_array($uploadedFiles) || count($uploadedFiles) != 3){
// 				return ;
// 			}
				
			//移除文件
			$this->_removeFileInPath();
			
			$data = $this->request->data;
			
			$index = 0;
			for ($i = 0; $i < count($data); $i++)
			{
				if ($data[$i]['carouselurl'] == 'changed')
				{
					$carousel[$index] = $i;
					$index++;
				}
			}
				
			for($i = 0; $i < $index; $i++){
				$uploadFile = $uploadedFiles[$i];
				
				if ($uploadFile['error'] == 0){
					$data[$carousel[$i]]['carouselurl'] = '/app/webroot/upload/homepageimg/'.$uploadFile['name'];
				}
// 				else{
// 					$data[$i]['carouselurl'] = '/app/webroot/img/group_default_portrait.png';
// 				}
			}
			
// 			echo var_dump($data);
			
			$this->loadModel('HomeArticleCategory');
			$jsonRecom = json_encode($data);
			$this->HomeArticleCategory->storeAriticleInfos('HomePageBanner',$jsonRecom);
			$this->redirect($this->request->referer());
		}
		else
		{
			$this->loadModel('HomeArticleCategory');
			$result = $this->HomeArticleCategory->getArticleInfos('HomePageBanner');
			$result = json_decode($result['HomeArticleCategory']['articleinfos'], true);
			$this->set('bannerImageInfos', $result);
		}
	}
	
	public function _removeFileInPath($path = null){
		
	}
	
	//首页推荐文件轮播图配置
	public function recommendpic () {
		if ($this->request->is('post')){
			$path = WWW_ROOT.'upload/homepageimg/';
			// 没有图片就是用default
			$this->ImageUpload = $this->Components->load('ImageUpload');
			$uploadedFiles = $this->ImageUpload->uploadFile($path,array("gif","jpeg","png","jpg"),200*200*32);
			
// 			if (!is_array($uploadedFiles)){
// 				echo "<script>alert('".$uploadedFiles."')</script>";
// 				return ;
// 			}
			
// 			if (count($this->request->data) != 3 || !is_array($uploadedFiles) || count($uploadedFiles) != 3){
// 				return ;
// 			}
			
			//移除文件
			$this->_removeFileInPath();
			
			$data = $this->request->data;
			
			$index = 0;
			for ($i = 0; $i < count($data); $i++)
			{
				if ($data[$i]['carouselurl'] == 'changed')
				{
					$carousel[$index] = $i;
					$index++;
				}
			}
				
			for($i = 0; $i < $index; $i++){
				$uploadFile = $uploadedFiles[$i];
				
				if ($uploadFile['error'] == 0){
					$data[$carousel[$i]]['carouselurl'] = '/app/webroot/upload/homepageimg/'.$uploadFile['name'];
				}
// 				else{
// 					$data[$i]['carouselurl'] = '/app/webroot/img/group_default_portrait.png';
// 				}
			}
			
			$this->loadModel('HomeArticleCategory');
			$jsonRecom = json_encode($data);
			$this->HomeArticleCategory->storeAriticleInfos(RecommendCarousel,$jsonRecom);
			$this->redirect($this->request->referer());
		}
		else
		{
			$this->loadModel('HomeArticleCategory');
			$result = $this->HomeArticleCategory->getArticleInfos(RecommendCarousel);
			$result = json_decode($result['HomeArticleCategory']['articleinfos'], true);
			$this->set('recommendArticleCarousels', $result);
		}
	}
	
	//推荐文章配置
	public function recommendarticle () {
		if ($this->request->is('post')){
			//必须=3
			if (count($this->data) != 3){
				$this->autoRender = false;
				return ;
			}
			$this->loadModel('HomeArticleCategory');
			$jsonRecom = json_encode($this->data);
			$this->HomeArticleCategory->storeAriticleInfos(RecommendArticles,$jsonRecom);
			$this->redirect($this->request->referer());
		}
		else
		{
			$this->loadModel('HomeArticleCategory');
			$result = $this->HomeArticleCategory->getArticleInfos(RecommendArticles);
			$result = json_decode($result['HomeArticleCategory']['articleinfos'], true);
			$this->set('recommendArticleInfos', $result);
		}
	}
	
	public function statpvuv(){
		
		$beginTime = null;
		$endTime = null;
		if ($this->request->is('post')){
			$beginTime = $this->request->data['beginTime'];
			$endTime = $this->request->data['endTime'];
		}
		
		if (!$beginTime || !$endTime){
			$beginTime = date('Y-m-d',time());
			$endTime = date('Y-m-d',time());			
		}
		
		$bbTime = $beginTime.' 00:00:00';
		$bbTime = "'$bbTime'";
		$eeTime = $endTime.' 23:59:59';
		$eeTime = "'$eeTime'";
		$condition = '`time` between '.$bbTime.' and '.$eeTime;
		$sql = "SELECT count(id), date_format(`time`,'%y-%m-%d') sdate FROM `pv_uv` where $condition group by sdate";
		$this->loadModel('StatPvUv');
		$data = $this->StatPvUv->query($sql);
		//uv	
		$returnData = array();
		$rdata = array();
		$dateArray = array();
		for ($i = 0; $i < count($data); $i++){
			$rdata[] = $data[$i][0]["count(id)"];
			$dateArray[] = $data[$i][0]['sdate'];
		}
		$returnData[] = array('name'=>'pv','data'=>$rdata);
		$realPvData = json_encode(array('series' => $returnData),JSON_NUMERIC_CHECK);
		$this->set('statValue',$realPvData);
		$this->set('statDate',json_encode($dateArray));
	}
	
	public function statarticle() {
		$beginTime = null;
		$endTime = null;
		if ($this->request->is('post')){
			$beginTime = $this->request->data['beginTime'];
			$endTime = $this->request->data['endTime'];
		}
		
		if (!$beginTime || !$endTime){
			$beginTime = date('Y-m-d',time());
			$endTime = date('Y-m-d',time());
		}
		
		$bbTime = $beginTime.' 00:00:00';
		$bbTime = "'$bbTime'";
		$eeTime = $endTime.' 23:59:59';
		$eeTime = "'$eeTime'";
		$condition = '`time` between '.$bbTime.' and '.$eeTime;
		$sql = "SELECT count(id), date_format(`time`,'%y-%m-%d') sdate FROM `article_stat` where $condition group by sdate";
		$this->loadModel('StatArticle');
		$data = $this->StatArticle->query($sql);
		//uv
		$returnData = array();
		$rdata = array();
		$dateArray = array();
		for ($i = 0; $i < count($data); $i++){
			$rdata[] = $data[$i][0]["count(id)"];
			$dateArray[] = $data[$i][0]['sdate'];
		}
		$returnData[] = array('name'=>'articleCreate','data'=>$rdata);
		$realPvData = json_encode(array('series' => $returnData),JSON_NUMERIC_CHECK);
		$this->set('statValue',$realPvData);
		$this->set('statDate',json_encode($dateArray));
	}
	
	public function statbar() {
		$beginTime = null;
		$endTime = null;
		if ($this->request->is('post')){
			$beginTime = $this->request->data['beginTime'];
			$endTime = $this->request->data['endTime'];
		}
		
		if (!$beginTime || !$endTime){
			$beginTime = date('Y-m-d',time());
			$endTime = date('Y-m-d',time());
		}
		
		$bbTime = $beginTime.' 00:00:00';
		$bbTime = "'$bbTime'";
		$eeTime = $endTime.' 23:59:59';
		$eeTime = "'$eeTime'";
		$condition = '`time` between '.$bbTime.' and '.$eeTime;
		$sql = "SELECT count(id), date_format(`time`,'%y-%m-%d') sdate FROM `group_stat` where $condition group by sdate";
		$this->loadModel('StatGroup');
		$data = $this->StatGroup->query($sql);
		//uv
		$returnData = array();
		$rdata = array();
		$dateArray = array();
		for ($i = 0; $i < count($data); $i++){
			$rdata[] = $data[$i][0]["count(id)"];
			$dateArray[] = $data[$i][0]['sdate'];
		}
		$returnData[] = array('name'=>'groupCreate','data'=>$rdata);
		$realPvData = json_encode(array('series' => $returnData),JSON_NUMERIC_CHECK);
		$this->set('statValue',$realPvData);
		$this->set('statDate',json_encode($dateArray));
	}
}