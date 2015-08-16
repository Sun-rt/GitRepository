<?php
// app/Model/User.php

define('FavorUserType', 1);
define('FavorArticleType', 0);

class UserFavorActicle extends AppModel {
    public $name = 'UserFavorActicle';
    
    public $useTable = 'user_favor_acticle';  
    
    public function getUserFavorArticles($userId){
		if ($userId) {
			$event = $this->find('first',array('conditions' => array('entityid' => $userId, 'type' => FavorUserType)));
			return $event;
		}
	}
	
	public function getArticleFavored($articleId){
		if ($articleId) {
			$event = $this->find('first',array('conditions' => array('entityid' => $articleId, 'type' => FavorArticleType)));
			return $event;
		}
	}
	
	public function storeArticleFavored($articleId,$favorInfos){
		if ($articleId && $favorInfos)
		{
			$data = array('UserFavorActicle' => array('entityid'=>$articleId,'favorInfos' => $favorInfos,
													  'type' => FavorArticleType));
            $this->save($data);
		}
	}
	
	public function storeUserFavorArticles($userId,$favorInfos){
		if ($userId && $favorInfos)
		{
			$data = array('UserFavorActicle' => array('entityid'=>$userId,'favorInfos' => $favorInfos,
													  'type' => FavorUserType));

            $this->save($data);
		}
	}
}