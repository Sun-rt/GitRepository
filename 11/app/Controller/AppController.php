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
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $helpers = array(
        'Session',
        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
    );

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'user', 'action' => 'login'),
            'logoutRedirect' => array('controller' => 'user', 'action' => 'login'),
            'authorize' => array('Controller')
        ),
        'Cookie',
    	'Statistic'
    );
    
    //统计pv uv
    public function logPVAndUV()
    {
	    $userId = $this->Session->read('userID');
	    $userId = ($userId) ? : '';
	    $userName = $this->Session->read('userName');
	    $userName = ($userName) ? : '';
	    $logs = array();
	    $logs['time'] = date('Y-m-d H:i:s',time());
	    $logs['browser'] = $_SERVER['HTTP_USER_AGENT'];
	    $logs['ip'] = $this->request->clientIp();
	    $logs['username'] = $userName;
	    $logs['userid'] = $userId;
	    $logs['url'] = FULL_BASE_URL.$this->request->here;
	    $this->Statistic->statPvUv($logs);
    }
    
    public function _logBaseDateLog($dir,$logs,$nextLine = true){
	    $filePath = TMP.'/logs/'.$dir.'/'.date("ymd").'.logs';
	    $file = new File($filePath, true, 0755);
	    if (!$file->exists()){
		    $file->create();
	    }
	    $file->append($logs);
	    if ($nextLine){
		    $file->append("\n");
	    }
    }

    public function beforeFilter() {
    	//检查是否已经登录
        if ($this->checkLogined()) {
        	$this->logPVAndUV();
            $this->Auth->allow($this->loginUserAuth());
        }
    }
    
    public function loginUserAuth()
    {
	    return array('index', 'view','home','display','add','logout');
    }
    
    public function _verifyUser($uname,$pwd)
    {
    	$host = '192.168.0.201:389';
    	$ldapconn = ldap_connect($host) or die("Could not connect to AD server.");        //连接ad服务
    	$set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);   
    	ldap_set_option ($ldapconn, LDAP_OPT_REFERRALS, 0 );
    	$bd = ldap_bind($ldapconn, $uname, $pwd)  or die ('Username or password error!');            //验证用户名和密码。
    	
    	if($bd){
    		$result = ldap_search($ldapconn,"OU=**,dc=explame,dc=com","(|(CN=$uname)(UserPrincipalName=$uname))") or die ("Error in query");    //根据条件搜索，我这边搜索的是要查看ad域中是否有改字段。这是一个相当于or的搜索
    		$info = ldap_get_entries($ldapconn, $result); //获取认证用户的信息
    		echo "您的相关信息：".var_dump($info);
    	} else {
    		echo "Username or password error!";
    	}
    	ldap_close($ldapconn);//关闭
    }
	
	public function checkLogined(){
		//看看session有没有值
		$islogin = $this->Session->check('userID');
		if (!$islogin) {
			//看看cookie有没有
			$userID = $this->Cookie->read('userID');
			$userName = $this->Cookie->read('userName');
			$password = $this->Cookie->read('password');
			if ($userID && $userName && $password) 
			{
				$this->loadModel('User');
				$userInfo = $this->User->findByName($userName);
				if ($userInfo['User']['password'] == $password){
					$this->Session->write('userID',$userID);
					$this->Session->write('userName',$userName);
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
			$this->Cookie->delete('userID');
			$this->Cookie->delete('userName');
			$this->Cookie->destroy();
			$this->Session->delete('userID');
			$this->Session->delete('userName');
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
		$usersInfo = array('User' => array('name' => $this->Session->read('userName'),
											'id' => $this->Session->read('userID')));
		$this->set('userInfo',$usersInfo);
		
		//顶部轮播图
		$this->loadHomePageBanner();
	}

	
	public function loadHomePageBanner(){
		//首页轮播图
		$this->loadModel('HomeArticleCategory');
		$carouselHomePageDBData = $this->HomeArticleCategory->getArticleInfos('HomePageBanner');
		$bannerHomePageData = null;
		if ($carouselHomePageDBData){
			$bannerHomePageData = json_decode($carouselHomePageDBData['HomeArticleCategory']['articleinfos'],true);
		}else{
			//生成默认数据
			$defaultHomePageData1 = array();
			$defaultHomePageData1['link'] = '#';
			$defaultHomePageData1['text'] = '';
			$defaultHomePageData1['carouselurl'] = 'http://localhost:8888/app/webroot/img/slider1.jpg';
		
			$defaultHomePageData2 = array();
			$defaultHomePageData2['link'] = '#';
			$defaultHomePageData2['text'] = '';
			$defaultHomePageData2['carouselurl'] = 'http://localhost:8888/app/webroot/img/slider2.jpg';
		
			$defaultHomePageData3 = array();
			$defaultHomePageData3['link'] = '#';
			$defaultHomePageData3['text'] = '';
			$defaultHomePageData3['carouselurl'] = 'http://localhost:8888/app/webroot/img/slider3.jpg';
		
			$bannerHomePageData = array($defaultHomePageData1,$defaultHomePageData2,$defaultHomePageData3);
			$jsonRecom = json_encode($bannerHomePageData);
			$this->HomeArticleCategory->storeAriticleInfos('HomePageBanner',$jsonRecom);
		}
		$bannerHomePageData = ($bannerHomePageData)?:array();
		$this->set('bannerHomePageData',$bannerHomePageData);
	}
}
