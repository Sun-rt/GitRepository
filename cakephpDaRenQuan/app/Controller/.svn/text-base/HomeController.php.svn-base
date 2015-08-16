<?php

App::uses('AppController', 'Controller');

class HomeController extends AppController {
	
	public $name = 'Home';
	
	public function index() {
		$title_for_layout = '达人吧';
		$this->set('title_for_layout', $title_for_layout);
		$this->_setHomePageData();
	}
	
	//获取首页的数据
	function _setHomePageData(){
		$userLikeGroups = $this->_getUserLikeGroup();
		if ($userLikeGroups){
			$userLikeGroups['UserGroupLike']['likeinfos'] = json_decode($userLikeGroups['UserGroupLike']['likeinfos'],true);
		}
		$commDatas = $this->_getHomePageCommonData();
		$this->set('userLikeGroups',$userLikeGroups ? : array());
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
		$userLikeGroup = $this->UserGroupLike->getUserLikeGroupInfo($this->Session->read('userID'));
		if ($userLikeGroup) {
			return $userLikeGroup;
		}
	}
		
	//获取首页公共的数据
	function _getHomePageCommonData(){
		$homeData = $this->_getHomePageCommDataFromCache();
		if(!isset($homeData)){
			$this->loadModel("Article");
			//最新文章
			$newArticleDatas = $this->Article->fetchHomePageLastestAriticles(5);
			if (!is_array($newArticleDatas)) {
				$newArticleDatas = array();
			}
			//最新活动
			$this->loadModel("Event");
			$newEventDatas = $this->Event->fetchHomePageLastestEvents(3);
			if (!is_array($newEventDatas)) {
				$newEventDatas = array();
			}
			// 热榜
			$hotArticleDatas = $this->Article->fetchHomePageHotArticles(5);
			if (!is_array($hotArticleDatas)) {
				$hotArticleDatas = array();
			}
			// 推荐文章
			$limitForRecommend = 3;
			$recommendArticleDatas = null;
			$this->loadModel('HomeArticleCategory');
			$recommendArticleInHome = $this->HomeArticleCategory->getArticleInfos(RecommendArticles);
			$recommendArticleDatas = null;
			if ($recommendArticleInHome){
				$recommendArticleDatas = json_decode($recommendArticleInHome['HomeArticleCategory']['articleinfos'],true);
			}
			if (!$recommendArticleDatas || (count($recommendArticleDatas) != $limitForRecommend)){
				$recommendArticleDatas = $this->Article->fetchHomePageRecommendArticles($limitForRecommend);
				//测试生成数据
				$array = array();
				foreach ($recommendArticleDatas as $recommendArticle){
					$inArray = array('Article' => array(),'Group'=>array());
					$inArray['link'] = "http://localhost:8888/article/view/43";
					$inArray['title'] = $recommendArticle['Article']['title'];
					$inArray['easyintro'] = $recommendArticle['Article']['easyintro'];
					$array[] = $inArray;
 				}
				$jsonRecom = json_encode($array);
				$this->HomeArticleCategory->storeAriticleInfos(RecommendArticles,$jsonRecom);
			}
			if (!is_array($recommendArticleDatas)) {
				$recommendArticleDatas = array();
			}
			
			//文章轮播图
			$carouselDBData = $this->HomeArticleCategory->getArticleInfos(RecommendCarousel);
			$carouselData = null;
			if ($carouselDBData){
				$carouselData = json_decode($carouselDBData['HomeArticleCategory']['articleinfos'],true);
			}
			else{
				//生成默认数据
				// $testData = array();
				// $testData['link'] = 'http://localhost:8888/article/view/41';
				// $testData['text'] = '哈哈测试';
				// $testData['carouselurl'] = '/app/webroot/upload/other/event.jpg';
				
				// $testData2 = array();
				// $testData2['link'] = 'http://localhost:8888/article/view/42';
				// $testData2['text'] = '哈哈测试';
				// $testData2['carouselurl'] = '/app/webroot/upload/other/game.jpg';
				
				// $testData3 = array();
				// $testData3['link'] = 'http://localhost:8888/article/view/43';
				// $testData3['text'] = '哈哈测试';
				// $testData3['carouselurl'] = '/app/webroot/upload/other/girl.jpg';
				
				// $carouselData = array($testData,$testData2,$testData3);
				// $jsonRecom = json_encode($carouselData);
				// $this->HomeArticleCategory->storeAriticleInfos(RecommendCarousel,$jsonRecom);
			}
			
			$carouselData = ($carouselData)?:array();
			$this->set('carouselData',$carouselData);
			
			// 首页期刊
			$journalsDBData = $this->HomeArticleCategory->getArticleInfos(HomeJournals);
			$journalsArray = array();
			if ($journalsDBData){
				$journalsArray = json_decode($journalsDBData['HomeArticleCategory']['articleinfos'],true);
			}
			$this->set('journalsArray',$journalsArray);
			
			// 首页常用链接
			$homeLinksDBData = $this->HomeArticleCategory->getArticleInfos(HomeLinks);
			$homeLinksArray = array();
			if ($homeLinksDBData){
				$homeLinksArray = json_decode($homeLinksDBData['HomeArticleCategory']['articleinfos'],true);
			}
			$this->set('homeLinksArray',$homeLinksArray);
			
			//热门达人吧
			$this->loadModel("Group");
			$hotGroupDatas = $this->Group->fetchHomePageHotGroup(6);
			if (!is_array($hotGroupDatas)) {
				$hotGroupDatas = array();
			}
			$this->loadModel("UserGroupLike");
			for($i= 0; $i< count($hotGroupDatas); ++$i)
			{
				$count = $this->Article->find('count',array('conditions' => array('groupid'=>$hotGroupDatas[$i]['Group']['id'])));
				$hotGroupDatas[$i]['Group']['articleCount'] = $count;
// 				$groupdata['Group']['memberCount'] = $this->Articel->find('count',array('conditions' => array('groupid'=>$groupdata['Group']['id'])));
				$groupMembers = json_decode($this->UserGroupLike->getMembersOfGroup($hotGroupDatas[$i]['Group']['id'])['UserGroupLike']['likeinfos'],1);
				$hotGroupDatas[$i]['Group']['memberCount'] = count($groupMembers);
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

			$this->_storeHomePageCommDataToCache($homeData);
		}
		return $homeData;
	}

	//从缓存中获取首页公共的数据
	function _getHomePageCommDataFromCache(){
		
	}
	
	function _storeHomePageCommDataToCache($homeData){
		
	}
	
}
