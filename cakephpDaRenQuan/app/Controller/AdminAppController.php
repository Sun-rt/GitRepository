<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AdminAppController extends Controller 
{
	public $layout = 'admin';
	public $components = array(
			'Session',
			'Cookie'
	);
	
    
	public function beforeFilter() {
		//检查是否已经登录
		$isLogin = $this->checkLogined();
		if ($this->request->params['action'] == 'login'){
			$this->layout = 'adminlogin';
			if ($isLogin){
				$this->layout = 'admin';
				$this->redirect(array('controller'=>'Admins','action' => 'index'));
			}
		}else{
			if (!$isLogin){
				$this->layout = 'adminlogin';
				$this->redirect(array('controller'=>'Admins','action' => 'login'));
			}
		}
	}
	
	public function checkLogined(){
		//看看session有没有值
		$islogin = $this->Session->check('adminUserId');
		if (!$islogin) {
			//看看cookie有没有
			$userID = $this->Cookie->read('adminUserId');
			$userName = $this->Cookie->read('adminUserName');
			$password = $this->Cookie->read('adminPassword');
			if ($userID && $userName && $password) 
			{
				$this->loadModel('AdminUser');
				$userInfo = $this->AdminUser->findByUsername($userName);
				if ($userInfo['AdminUser']['password'] == $password){
					$this->Session->write('adminUserId',$userID);
					$this->Session->write('adminUserName',$userName);
					$islogin = true;
				}
				else{
					$islogin = false;
				}
			}else{
				$islogin = false;
			}
			
		}
		
		//如果是未登录，则清楚所有
		if (!$islogin){
			$this->Cookie->delete('adminUserId');
			$this->Cookie->delete('adminUserName');
			$this->Cookie->destroy();
			$this->Session->delete('adminUserId');
			$this->Session->delete('adminUserName');
			$this->Session->renew();
		}
		
		return $islogin;
	}

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        $this->Session->setFlash(__('无权操作'));
        return false;
    }
        
	
	public function beforeRender() {
		
	}


}
