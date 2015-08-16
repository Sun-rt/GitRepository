<?php
/**
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
 * @package       Cake.View.Layouts.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $title_for_layout;?></title>
	<style>
		.comment-img {
			 height: 30px;
			 width: 30px;
			 float: left;
			 margin-right: 10px;
		 }
		 
		 .comment-author {
			 float: left;
			 margin-top: 5px;
		 }
		 
		 .comment-author a {
			 color: gray;
			 font-size: 12px;
		 }
	</style>
</head>
<body>
	<?php echo $content_for_layout;?>
	
	<div style="display: block; min-height: 25px; padding-right: 20px;">
		<div style="float:right"><b>**此邮件由达人吧系统自动推送，请勿回复**</b></div>
	</div>
</body>
</html>