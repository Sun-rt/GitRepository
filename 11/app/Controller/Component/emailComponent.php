<?php

//这个组件主要用于处理email
App::uses('CakeEmail', 'Network/Email');

class emailComponent extends Component
{
	public function shareArticle($user,$to,$subject,$article,$articleReply,$why){
		$email = new CakeEmail('test');
		
		// to ctp
		$email->viewVars(array( 'articleInfo' =>$article,'articleReplies' => $articleReply,'why' => $why));
		
		$email->template('article', 'article'); //recover是template， article是layout 
		$email->emailFormat('html'); //用html的格式发送，可选还有text,both
		
		$email->from(array($user.'@163.com' => $user)); 
		
		$toRawArray = explode(";",$to);
		$toArray = array();
		foreach($toRawArray as $toUser){
		    if(strpos($toUser,'@') === false){     //使用绝对等于
			    //不包含
			    $toArray[$toUser.'@163.com'] = $toUser;
			}else{
			    //包含
			    $subArray = explode("@",$toUser);
			    $toArray[$toUser] = $subArray[0];
			}
		}
		
		$email->to($toArray); 
		$email->subject($subject); 
		$email->send();
	}

	public function shareEvent($user,$to,$subject,$article,$articleReply,$why){
		$email = new CakeEmail('test');
		
		// to ctp
		$email->viewVars(array( 'articleInfo' =>$article,'articleReplies' => $articleReply,'why' => $why));
		
		$email->template('event', 'event'); //recover是template， article是layout 
		$email->emailFormat('html'); //用html的格式发送，可选还有text,both
		
		$email->from(array($user.'@163.com' => $user)); 
		
		$toRawArray = explode(";",$to);
		$toArray = array();
		foreach($toRawArray as $toUser){
		    if(strpos($toUser,'@') === false){     //使用绝对等于
			    //不包含
			    $toArray[$toUser.'@163.com'] = $toUser;
			}else{
			    //包含
			    $subArray = explode("@",$toUser);
			    $toArray[$toUser] = $subArray[0];
			}
		}
		
		$email->to($toArray); 
		$email->subject($subject); 
		$email->send();
	}
}