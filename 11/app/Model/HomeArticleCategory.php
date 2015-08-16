<?php
	
define("RecommendArticles", "RecommendArticles");
define("RecommendCarousel", "RecommendCarousel");
define("HomeJournals", "HomeJournals");
define("HomeLinks", "HomeLinks");

class HomeArticleCategory extends AppModel
{
	public $name = 'HomeArticleCategory';
	public $useTable = 'home_article_category';
	
	public function cacheKey($id){
		$key = 'home_'.$id;
		return $key;
	}
	
	function getArticleInfos($type){
		if ($type && is_string($type)){
			$key = $this->cacheKey($type);
			$result = Cache::read($key);
			if (!$result){
				$result = $this->find('first',array('conditions' => array('HomeArticleCategory.name' => $type),'fields' => array('HomeArticleCategory.id','HomeArticleCategory.name','HomeArticleCategory.articleinfos')));
				Cache::write($key, $result);
			}
			return $result;
		}
	}
	
	function storeAriticleInfos($type,$infos){
		if ($type && $infos){
			$articleInfo = $this->getArticleInfos($type);
			if ($articleInfo){
				$this->id = $articleInfo['HomeArticleCategory']['id'];
				$this->saveField('articleInfos',$infos);
			}else{
				$this->id = null;
				$data = array('HomeArticleCategory' => array('name'=>$type,'articleInfos'=>$infos));
				$this->save($data);
			}
			Cache::delete($this->cacheKey($type));
		}
	}
}