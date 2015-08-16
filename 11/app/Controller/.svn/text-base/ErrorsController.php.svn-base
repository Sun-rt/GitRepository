<?php

App::uses('AppController', 'Controller');

abstract class BasicEnum {
    private static $constCacheArray = NULL;

    private static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }
}

abstract class Error extends BasicEnum{
	const ViewArticleGroupPowerDeny = 1; //查看圈子的文章没有权限
	const ViewEventGroupPowerDeny = 2; 	 //查看圈子的活动没有权限
	const NextVersionExpect = 3;		 //下期开发中
	const HTTP404 = 404;
}

class ErrorsController extends AppController 
{
	
	public function loginUserAuth()
    {
	    $array = array();
	    $array[] = 'error';
	    return  $array;
    }
    
    public function _errorArray()
    {
	    return array(Error::ViewArticleGroupPowerDeny => array('errImgUrl' => '/app/webroot/img/lock.png','errMainText'=>'您没有权限','errSubText'=>'您需要关注本吧才能查看该文章'),
	    			 Error::ViewEventGroupPowerDeny => array('errImgUrl' => '/app/webroot/img/lock.png','errMainText'=>'您没有权限','errSubText'=>'您需要关注本吧才能参与本活动'),
	    			 Error::NextVersionExpect => array('errImgUrl' => '/app/webroot/img/uc.jpg','errMainText'=>'敬请期待','errSubText'=>'二期开发中...'),
	    			 Error::HTTP404 => array('errImgUrl' => '/app/webroot/img/404.png','errMainText'=>'页面未找到','errSubText'=>'该页无法显示')
	    			);
    }
    
    public function error($errNum = 0){
	    $errorArray = array();
	    $errNum = intval($errNum);
	    if (Error::isValidValue($errNum)){
		    $errorArray = $this->_errorArray()[$errNum];
	    }
	    else{
		    $errorArray = $this->_errorArray()[Error::HTTP404];
	    }
	    $this->set('errorInfo',$errorArray);
    }
}