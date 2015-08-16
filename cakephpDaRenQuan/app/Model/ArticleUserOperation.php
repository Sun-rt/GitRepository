<?php
class ArticleUserOperation extends AppModel
{
	public $name = 'ArticleUserOperation';
	public $useTable = 'article_user_operation';
	
	public $primaryKey = 'articleid';
	
	public function loadAndCheckExistUserOperation($articleid){
		if ($articleid){
			$count = $this->find('count',array('conditions' => array('ArticleUserOperation.articleid' => $articleid)));
			if ($count == 0){
				$this->create();
				$data = array('ArticleUserOperation' => array('articleid' => $articleid,'vistitlist'=>'','supportlist'=>''));
				$this->save($data);		
			}
		}
	}
	
	public function getArticleUserOperation($articleid){
		if ($articleid){
			$this->loadAndCheckExistUserOperation($articleid);
			return $this->findByArticleid($articleid);
		}
	}
	
	public function storeArticleUserOperation($articleid,$visitInfo,$supportInfo){
		if ($articleid && is_string($visitInfo) && is_string($supportInfo)){
			$data = array('ArticleUserOperation' => array('articleid' => $articleid,'vistitlist' => $visitInfo,'supportlist'=>$supportInfo));
			$this->save($data);
		}
	}
}