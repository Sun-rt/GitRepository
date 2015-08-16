<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8,ie=7">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php wp_title('-', true, 'right'); echo get_option('blogname'); if (is_home ()) echo get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>
<?php wp_head(); ?>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php bloginfo('template_directory'); ?>/css/header.css" rel="stylesheet">
<link href="<?php bloginfo('template_directory'); ?>/css/index.css" rel="stylesheet">
<link href="<?php bloginfo('template_directory'); ?>/css/poll.css" rel="stylesheet">
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/cat.js"></script>

<script type='text/javascript'>
/* <![CDATA[ */
var pollsL10n = {"ajax_url":"http:\/\/101.200.173.125\/wp-admin\/admin-ajax.php","text_wait":"\u4f60\u7684\u8bf7\u6c42\u6b63\u5728\u6267\u884c\u4e2d\uff0c\u8bf7\u7a0d\u7b49","text_valid":"\u8bf7\u9009\u62e9\u6709\u6548\u7684\u6295\u7968\u9009\u9879","text_multiple":"Maximum number of choices allowed: ","show_loading":"1","show_fading":"1"};
/* ]]> */
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/polls-js.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" media="all">

<!--[if lt IE 9]><script src="<?php bloginfo('template_url'); ?>/js/html5.js"></script><![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie6.css" type="text/css"/> 
<![endif]-->
<!--[if IE 6]>
		<script src="<?php bloginfo('template_url'); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script>DD_belatedPNG.fix('.logo,.widgetzry ul,background,background');</script>
<![endif]-->
<script src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/header.js"></script>

</head>
<!-- Modal -->
<div id="myModal" class="modal fade dialogcss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">联系我们</h3>
  </div>
  <div class="modal-body">
    <p>感谢您对我们的关注，请您联系：</p>
    <p>QQ：188292821</p>
    <p>Email：188292821@qq.com</p>
  </div>
</div>
<body >
	<?php if(is_home() || is_category() || is_page('all')) {?>
	<div class="row" id="header-1">
		<div class="col-md-12">
			<div class="row" style="position: relative;">
				<div id="header-1-logo">
					<a href="<?php echo get_settings('home'); ?>">
						
					</a>
				</div>
				<div class="col-md-12">
					<div class="row" id="topbar-1">
						<div class="col-md-4 col-md-offset-8">
			                <ul class="topnav-1" >
			                    
			                     <?php if ( is_user_logged_in() ) { ?>
			                     <li class="dropdown topnav-1-li">
			                     	<a href="#" class="btn btn-xs dropdown-toggle topnav_li_a-1" data-toggle="dropdown"> 
			                     		<?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?>
			                     		<b class="caret"></b>
			                     	</a>
			                     	<ul class="dropdown-menu topnav-1-li-ul">   
							         <li class="topnav-1-li-ul-btn"><a href="<?php echo wp_logout_url("/"); ?>"  title="退出">退出</a></li>
							       </ul>  
			                     </li>
			                     
			                    <?php } else { ?> 
			                    
			                    <li class="topnav-1-li" ><a href="<?php echo get_settings('home'); ?>/register" class="btn btn-xs topnav_li_a-1">注册</a></li>
			                    <li class="topnav-1-li" ><a href="<?php echo get_settings('home'); ?>/login" class="btn btn-xs topnav_li_a_login">登录</a></li>
			                    <?php } ?> 
		                        <li class="topnav-1-li" >
		                        	<!--a href="<?php echo get_settings('home'); ?>" class="btn  btn-xs" style="color: #656364;">联系我们</a-->
		                        	
		                        	<a href="#myModal" role="button" class="btn btn-xs" style="color: #656364; font-size:12pt;" data-toggle="modal">联系我们</a>
									 
									
	                        	</li>
			                </ul>
		            	</div>
					</div>
					<div class="row" id="research">
						<div class="col-md-5 col-md-offset-4">
							<form class="serchForm" method="get" onsubmit="return toVaild()" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
								<div class="input-group">									
										<fieldset>
										<input class="search-text" id="searchtext"  name="s" style="text" <?php if( is_search() ){ echo ' value="'.$s.'"'; } ?> autofocus="" x-webkit-speech="">								
										<button class="input-group-addon" style="margin-left:-4px;outline: none;" id="search-icon">
											<i class="glyphicon glyphicon-search" style="margin-left:-15px; cursor: pointer;"></i>
										</button>	
										</fieldset>							
								</div>
							</form>
						</div>
					</div>
					<div class="row" id="top_submit-1">
						
						<div class="col-md-2 col-md-offset-10 top_submit_btn-1">
							<ul class="topnav-1">
								<li  class="topnav-1-li" ><a href="<?php echo get_settings('home')."/submit" ?>" class="btn btn-lg btn-color-1 pull-right">上传案例</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="bottom">
				<li >
					<a href="<?php echo get_settings('home')."/all" ?>" class="btn btn-lg bottom_li_a_all" >全部</a>
				</li> 
				<?php  
					$categorys = getCategorys();
					foreach ($categorys as $category) { ?>
						<li >
							<a href="<?php echo get_category_link($category->term_id) ?>" class="btn btn-lg bottom_li_a"><?php echo get_cat_name(''. $category->term_id .'') ?></a>
						</li> 
				<?php }?>	
			</div>
		</div>
	</div>
	<?php } else{?>	
		
	<div class="row" id="header-2">
		<div class="col-md-12">
			<div class="row" style="position: relative;">
				<div id="header-2-logo">
					<a href="<?php echo get_settings('home'); ?>">
						
					</a>
				</div>
				<div class="col-md-12">
					<div class="row" id="topbar-2">
						<div class="divwidth">
			                <ul class="topnav-2" >
			                    
			                     <?php if ( is_user_logged_in() ) { ?>
			                     <!--li ><a href="#" class="btn btn-xs topnav_li_a-2"> <?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?></a></li>
			                     <li ><a href="<?php echo wp_logout_url("/"); ?>" title="退出" class="btn btn-xs topnav_li_a-2">退出</a></li-->
		                     	 <li class="dropdown topnav-2-li">
			                     	<a href="#" class="btn btn-xs  dropdown-toggle topnav_li_a-2" data-toggle="dropdown"> 
			                     		<?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?>
			                     		<span class="caret"></span>
			                     	</a>
			                     	<ul class="dropdown-menu topnav-2-li-ul">   
							         <li><a href="<?php echo wp_logout_url("/"); ?>" class="" title="退出">退出</a></li>
							       </ul>  
			                     </li>
			                     
			                    <?php } else { ?> 
			                    
			                    <li  class="topnav-2-li"><a href="<?php echo get_settings('home'); ?>/register" class="btn btn-xs topnav_li_a-2">注册</a></li>
			                    <li  class="topnav-2-li"><a href="<?php echo get_settings('home'); ?>/login" class="btn btn-xs topnav_li_a_2_login">登录</a></li>
			                    <?php } ?> 
		                        <li class="topnav-2-li">
		                        	<a href="#myModal" role="button" class="btn btn-xs topnav_li_a-2" data-toggle="modal">联系我们</a>
	                        	</li>
			                </ul>
		            	</div>
					</div>
					<div class="row divcolor">
					<div id="top_submit-2">
						<div class="top_submit_btn-2 divwidth">
							<?php if(is_page('login') || is_page('register') || is_page('submit')) {?>
							<?php } else{?>	
							<ul class="topnav-2-li">
							<li  ><a href="<?php echo get_settings('home')."/submit" ?>" class="btn btn-small btn-color-2 pull-right"><i class="glyphicon glyphicon-share"></i>上传案例</a></li>
							</ul>
							<?php }?>	
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>	
	<!--
<div class="header">
    <div class="navbar">
        <div class="row">
            <div class="col-md-12 ">
                <ul class="nav" style="float:right">
                    <li class="page_item page-item-8 current_page_item" ><a href="<?php echo get_settings('home'); ?>">联系我们</a></li>
                     <?php if ( is_user_logged_in() ) { ?>
                     <li class="page_item page-item-8 current_page_item" ><a href="#"> <?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?></a></li>
                     <li class="page_item page-item-8 current_page_item"><a href="<?php echo wp_logout_url("/"); ?>" title="退出">退出</a></li>
                    <?php } else { ?> 
                    <li class="page_item page-item-8 current_page_item" ><a href="<?php echo get_settings('home'); ?>/login">登录</a></li>
                    <li class="page_item page-item-8 current_page_item" ><a href="<?php echo get_settings('home'); ?>/register" >注册</a></li>
                    <?php } ?> 
                        
                </ul>
            </div>
           
        </div>
   </div>
   <div class="row" id="headerbar">
    <div  class="row"  style="width:942px;margin:0 auto;">
        <div  style="float:left">
            <a href="#" ><img src="<?php echo get_settings('home')."/images/logo.png" ?>" style = "height:90px ;"></img></a>
        </div>
        <div class="row" style="float:right">
            <a  style="margin-right:-150px" class="btn btn-default" href="<?php echo get_settings('home')."/submit" ?>"  role="button">提交案例</a>
        </div>
      </div>
    </div>
</div>
-->

	