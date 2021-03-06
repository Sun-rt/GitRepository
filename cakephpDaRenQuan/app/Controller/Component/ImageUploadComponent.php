<?php

//这个组件主要用于处理图片的

class ImageUploadComponent extends Component
{
	
	//判断是否有文件上传
	public function hasFileUpload()
	{
		if (!$_FILES){
			return false;
		}
		
		foreach ($_FILES as $v){
			if (!empty($v['tmp_name'])){
				return true;
			}
			else{
				return false;
			}
		}
	}
	
	public function buildInfo(){
		if(!$_FILES){
			return ;
		}
		$i=0;
		$files = array();
		// 	echo var_dump($_FILES);
		foreach($_FILES as $v){
			//单文件
			if(is_string($v['name'])){
				$files[$i]=$v;
				$i++;
			}else{
				//多文件
				foreach($v['name'] as $key=>$val){
					$files[$i]['name']=$val;
					$files[$i]['size']=$v['size'][$key];
					$files[$i]['tmp_name']=$v['tmp_name'][$key];
					$files[$i]['error']=$v['error'][$key];
					$files[$i]['type']=$v['type'][$key];
					$i++;
				}
			}
		}
		return $files;
	}
	
	public function getExt($filename){
		$array = explode(".",$filename);
		$fileExt = end($array);
		return strtolower($fileExt);
	}
	public function getUniName(){
		return md5(uniqid(microtime(true),true));
	}
	public function uploadFile($path,$allowExt=array("gif","jpeg","png","jpg","wbmp"),$maxSize=2097152,$imgFlag=true){
		if(!file_exists($path)){
			mkdir($path,0777,true);
		}
		$i=0;
		$files=$this->buildInfo();
		if(!($files&&is_array($files))){
			return ;
		}
		$uploadedFiles = array();
		foreach($files as $file){
			if($file['error']===UPLOAD_ERR_OK){
				$ext=$this->getExt($file['name']);
				//检测文件的扩展名
				if(!in_array($ext,$allowExt)){
					exit("非法文件类型");
				}
				//校验是否是一个真正的图片类型
				/*if($imgFlag){
					if(!getimagesize($file['tmp_name'])){
						exit("不是真正的图片类型");
					}
				}*/
				//上传文件的大小
				if($file['size']>$maxSize){
					exit("上传文件过大");
				}
				if(!is_uploaded_file($file['tmp_name'])){
					exit("不是通过HTTP POST方式上传上来的");
				}
				$filename=$this->getUniName().".".$ext;
				$destination=$path."/".$filename;
				if(move_uploaded_file($file['tmp_name'], $destination)){
					$file['name']=$filename;
					unset($file['tmp_name'],$file['size'],$file['type']);
					$uploadedFiles[$i]=$file;
					$i++;
				}
			}else{
				$mes = '';
				switch($file['error']){
					case 1:
						$mes="超过了配置文件上传文件的大小";//UPLOAD_ERR_INI_SIZE
						break;
					case 2:
						$mes="超过了表单设置上传文件的大小";			//UPLOAD_ERR_FORM_SIZE
						break;
					case 3:
						$mes="文件部分被上传";//UPLOAD_ERR_PARTIAL
						break;
					case 4:
						$mes="没有文件被上传";//UPLOAD_ERR_NO_FILE
						break;
					case 6:
						$mes="没有找到临时目录";//UPLOAD_ERR_NO_TMP_DIR
						break;
					case 7:
						$mes="文件不可写";//UPLOAD_ERR_CANT_WRITE;
						break;
					case 8:
						$mes="由于PHP的扩展程序中断了文件上传";//UPLOAD_ERR_EXTENSION
						break;
				}
				return $mes;
			}
		}
		return $uploadedFiles;
	}
	
	
}