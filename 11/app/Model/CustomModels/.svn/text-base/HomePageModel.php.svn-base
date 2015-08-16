<?php

require 'UserGroupLike.php';

/**
 * 
 */
class HomePageModel {
	
	private $userID;
	
	function __construct($userID) {
		$this->userID = $userID;
	}
	
	function getUserLikeGroup(){
		$useLikeMap = new UserGroupLike;
		return $useLikeMap->getUserLikeGroupInfo($this->userID);
	}
	
	function getHomePageCommonData(){
		$homeData = $this->getHomePageCommDataFromCache();
		if(!isset($homeData)){
			$homeActicleModel = new HomeArticleCategory();
			$homeData = $homeActicleModel->find('all');
			LOG_DEBUG($homeData);			
		}
		LOG_DEBUG();
	}
	
	function getHomePageCommDataFromCache(){
		
	}
	
	
	function getHomePageData(){
		$userLikeGroups = $this->getUserLikeGroup();
		$commDatas = $this->getHomePageData();
	}
	
	
}
