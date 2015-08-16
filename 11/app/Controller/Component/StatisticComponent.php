<?php

class StatisticComponent extends Component
{	
	public $statGroupModel = null;
	public $statArticleModel = null;
	public $statPvUvModel = null;
	
	//统计pvuv
	public function statPvUv($data){
		$fullData = array('StatPvUv' => $data);
		$this->registerPvUvModel();
		$this->statPvUvModel->create();
		$this->statPvUvModel->save($fullData);
	}
	
	//统计圈子的创建
	public function statGroupCreate($data){
		$data['stat_type'] = 0;
		$data['time'] = date('Y-m-d H:i:s',time());
		$fullData = array('StatGroup' => $data);
		$this->registerGroupModel();
		$this->statGroupModel->create();
		$this->statGroupModel->save($fullData);
	}
	
	//统计文章的创建
	public function statArticleCreate($data){
		$data['stat_type'] = 0;
		$data['time'] = date('Y-m-d H:i:s',time());
		$fullData = array('StatArticle' => $data);
		$this->registerArticleModel();
		$this->statArticleModel->create();
		$this->statArticleModel->save($fullData);
	}
	
	public function registerGroupModel(){
		if (!$this->statGroupModel){
			$this->statGroupModel = ClassRegistry::init('StatGroup');;
		}
	}
	
	public function registerArticleModel(){
		if (!$this->statArticleModel){
			$this->statArticleModel = ClassRegistry::init('StatArticle');;
		}
	}
	
	public function registerPvUvModel(){
		if (!$this->statPvUvModel){
			$this->statPvUvModel = ClassRegistry::init('StatPvUv');;
		}
	}
}