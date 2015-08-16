<?php

App::uses('AppController', 'Controller');

class TestsController extends AppController {
	
	public $name = 'Tests';  
    public $helpers = array('Html', 'Form');
	
	public function index($id) {
		$this->loadModel('Article');
		$this->Article->recursive = 1;
		$this->set('id',$id);
		 $this->set('articleInfo',$this->Article->findById($id));
	}
	
	//获取首页的数据
	function _setHomePageData(){
		$userLikeGroups = $this->_getUserLikeGroup();
		$commDatas = $this->_getHomePageCommonData();
		$this->set('userLikeGroups',$userLikeGroups);
		$this->set('newArticleDatas',$commDatas[0]);
		$this->set('newEventDatas',$commDatas[1]);
		$this->set('hotArticleDatas',$commDatas[2]);
		$this->set('recommendArticleDatas',$commDatas[3]);
		$this->set('hotGroupDatas',$commDatas[4]);
		$this->set('hotTagDatas',$commDatas[5]);
	}
	
	//获取用户喜欢的达人吧
	function _getUserLikeGroup(){
		$this->loadModel("UserGroupLike");
		$userLikeGroup = $this->UserGroupLike->getUserLikeGroupInfo(1);
		if ($userLikeGroup) {
			return $userLikeGroup;
		} else {
			return array();
		}
	}
	
	//获取首页公共的数据
	function _getHomePageCommonData(){
		$homeData = $this->_getHomePageCommDataFromCache();
		if(!isset($homeData)){
			$this->loadModel("Article");
			//最新文章
			$newArticleDatas = $this->Article->fetchHomePageLastestAriticles(3);
			if (!is_array($newArticleDatas)) {
				$newArticleDatas = array();
			}
			//最新活动
			$this->loadModel("Event");
			$newEventDatas = $this->Event->fetchHomePageLastestEvents(2);
			if (!is_array($newEventDatas)) {
				$newEventDatas = array();
			}
			// 热榜
			$hotArticleDatas = $this->Article->fetchHomePageHotArticles(10);
			if (!is_array($hotArticleDatas)) {
				$hotArticleDatas = array();
			}
			// 推荐文章
			$recommendArticleDatas = $this->Article->fetchHomePageRecommendArticles(10);
			if (!is_array($recommendArticleDatas)) {
				$recommendArticleDatas = array();
			}
			//热门达人吧
			$this->loadModel("Group");
			$hotGroupDatas = $this->Group->fetchHomePageHotGroup(6);
			if (!is_array($hotGroupDatas)) {
				$hotGroupDatas = array();
			}
			//热门标签
			$this->loadModel("Tag");
			$hotTagDatas = $this->Tag->fetchHomePageHotTag(12);
			if (!is_array($hotTagDatas)) {
				$hotTagDatas = array();
			}
			
			$homeData = array(  array('最新文章', $newArticleDatas),
								array('最新活动', $newEventDatas),
								array('热榜', $hotArticleDatas),
								array('推荐文章', $recommendArticleDatas),
								array('热门吧', $hotGroupDatas),
								array('热门标签', $hotTagDatas));
		}
		return $homeData;
	}

	//从缓存中获取首页公共的数据
	function _getHomePageCommDataFromCache(){
		
	}
	
	function _storeHomePageCommDataToCache(){
		
	}
	
}
