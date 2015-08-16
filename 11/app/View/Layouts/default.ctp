<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<?php echo $this -> Html -> charset(); ?>
		<title><?php echo '达人吧'; ?></title>
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<!--<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<!-- css -->
		<?php echo $this -> Html -> css('bootstrap.min'); ?>
		<?php echo $this -> Html -> css('bootflat'); ?>
		<?php echo $this -> Html -> css('site'); ?>
		<!-- <?php echo $this -> Html -> css('styles'); ?> -->
		
		<!-- custom css -->
		<?php echo $this -> Html -> css('mainstyle'); ?>
		
		<!-- script -->
		<!-- <?php echo $this -> Html -> script('jquery-2.1.1.min'); ?> -->
		<?php echo $this -> Html -> script('jquery-1.10.1.min'); ?>
		<?php echo $this -> Html -> script('bootstrap.min'); ?>
		<!-- <?php echo $this -> Html -> script('scripts'); ?> -->
		<!-- <?php echo $this -> Html -> script('site.min'); ?> -->
		
		<!-- custom script -->
		<?php echo $this -> Html -> script('mainscript'); ?>

		<?php echo $this -> Html -> script('bootstrap-tooltip'); ?>
		<?php echo $this -> Html -> script('bootstrap-popover'); ?>
		
		<!--
		<?php echo $this -> Html -> css('bootstrap.min'); ?>
		<?php echo $this -> Html -> css('bootstrap_cosmo.min'); ?>
		<?php echo $this -> Html -> css('bootstrap-combined.min'); ?>
		<?php echo $this -> Html -> css('bootstrap-datetimepicker.min'); ?>
		
		<?php echo $this -> Html -> script('jquery-1.11.1.min'); ?>
		<?php echo $this -> Html -> script('bootstrap.min'); ?>
		<?php echo $this -> Html -> script('bootswatch'); ?>
		<?php echo $this -> Html -> script('formvalidation'); ?>
		<?php echo $this -> Html -> script('bootstrap-datetimepicker'); ?>
-->
		
		<!-- css -->
		<!--
		<?php echo $this -> Html -> css('newstyle/bootstrap5152'); ?>
		<?php echo $this -> Html -> css('newstyle/responsive5152'); ?>
		<?php echo $this -> Html -> css('newstyle/prettyPhotoaeb9'); ?>
		<?php echo $this -> Html -> css('newstyle/main5152'); ?>
		<?php echo $this -> Html -> css('newstyle/custom5152'); ?>
		<?php echo $this -> Html -> css('umeditorthemes/default/css/umeditor'); ?>
		-->

		<!-- script -->
		<!--
		<?php echo $this -> Html -> script('newstyle/jquery-1.8.3.min'); ?>
		<?php echo $this -> Html -> script('newstyle/jquery.easing.1.3'); ?>
		<?php echo $this -> Html -> script('newstyle/jquery.prettyPhoto'); ?>
		<?php echo $this -> Html -> script('newstyle/jflickrfeed'); ?>
		<?php echo $this -> Html -> script('newstyle/jquery.liveSearch'); ?>
		<?php echo $this -> Html -> script('newstyle/jquery.form'); ?>
		<?php echo $this -> Html -> script('newstyle/jquery.validate.min'); ?>
		<?php echo $this -> Html -> script('newstyle/custom'); ?>
		
		<?php echo $this -> Html -> script('umeditor.config'); ?>
		<?php echo $this -> Html -> script('umeditor.min'); ?>
		<?php echo $this -> Html -> script('lang/zh-cn/zh-cn'); ?>
		-->
		
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<![endif]-->

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
	</head>
	<body>
		<div class="container-fluid">
			<!--nav-->
			<nav class="navbar navbar-inverse navbar-custom" role="navigation">
				<div class="container">
				  <div class="navbar-header">
				    <a class="navbar-brand" href="/">达人吧</a>
				  </div>
				  <div class="collapse navbar-collapse">
				    <ul class="nav navbar-nav navbar-right">
					    <li>
							<form class="navbar-form" action="/errors/error/3" role="search">
								<div class="form-search search-only">
								  <i class="search-icon glyphicon glyphicon-search"></i>
								  <input type="text" class="form-control search-query" placeholder="搜索">
								</div>
							</form>
					    </li>
					    <li class="nav-link"><a href="/">首页</a></li>
						<li class="nav-link"><a href="/errors/error/3">乐问</a></li>
						<li class="nav-link"><a href="/errors/error/3">知识库</a></li>
						<li class="nav-link"><a href="/errors/error/3">达人堂</a></li>
						<li class="nav-link"><a href="/errors/error/3">生活专区</a></li>
						<?php
							if (empty($userInfo['User']['name']) && empty($userInfo['User']['id'])) {
								echo '<li class="nav-link"><a href="/users/login">登录</a></li>';
							} 
							else {
								echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $userInfo['User']['name'] . ' 的工作台 <b class="caret"></b></a>
										<ul class="dropdown-menu dropdown-menu-costom" role="menu">
										<li><a href="/users/view/'.$userInfo['User']['id'].'">个人主页</a></li>
										<li><a href="/groups/add">创建达人吧</a></li>
										<li><a href="/users/article/'.$userInfo['User']['id'].'">我的文章</a></li>
										<li><a href="/users/favors/'.$userInfo['User']['id'].'">我的收藏</a></li>
										<li><a href="/users/group/'.$userInfo['User']['id'].'">我的达人吧</a></li>
										<li><a href="/users/logout">退出登录</a></li>
										</ul></li>';
								}
						?>
				    </ul>
				  </div>
				</div>
			</nav>
			
			<div id="top-ad-img" class="carousel slide" data-ride="carousel" style="margin-top: 50px; width: 100%; margin: 0 auto; ">
                <ol class="carousel-indicators">
                  <li data-target="#top-ad-img" data-slide-to="0" class="active"></li>
                  <li data-target="#top-ad-img" data-slide-to="1"></li>
                  <li data-target="#top-ad-img" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
	                <?php 
		                $count = count($bannerHomePageData);
		                for ($i = 0; $i < $count; $i++){
			                $recommendArticleData = $bannerHomePageData[$i];
							if ($i == 0)
							{
								echo '<div class="item active">';
							}
							else
							{
								echo '<div class="item">';
							}
							if(strpos($recommendArticleData['link'], "http://") !== false)
							{
								echo '<a href="'.$recommendArticleData['link'].'">';
								echo '<img src="'.$recommendArticleData['carouselurl'].'" style="height: 300px; width: 100%;" />';
								echo '</a>';
							}
							else{
								echo '<img src="'.$recommendArticleData['carouselurl'].'" style="height: 300px; width: 100%;" />';
							}
							
							echo '</div>';
		                }
	                ?>
                  
                </div>
                <!--
<a class="left carousel-control" href="#top-ad-img" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#top-ad-img" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
-->
            </div>
        </div>
			
			<div id="content">
				<div class="page-container">

				<?php echo $this -> Session -> flash(); ?>

				<?php echo $this -> fetch('content'); ?>
				
				</div>
				
			</div>
			
			<!-- Start of Footer -->
			<div class="col-md-12">
			<div class="footer">
			  <div class="container">
			    <div class="clearfix">
			      <div class="footer-logo">
			          <a href="#">达人吧</a>
			      </div>
			      <dl class="footer-nav">
			        <dt class="nav-title">关于达人吧</dt>
			        <dd class="nav-item"><a href="#" id="example1" rel="popover" data-content="他，未必才华横溢、风华绝代；&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        
他，也许就是你身边共担KPI的同事，做事井井有条，思路清晰令你钦佩；&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
他，也许是你在会议中遇到的，但却克己守时令你欣赏；&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
他，也许就是那个每天将阳光般的微笑和感染力带给你的人……&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
这就是我们要找的“达人”" data-original-title="关于达人">关于达人</a></dd>
			        <dd class="nav-item"><a href="#" id="example2" rel="popover" data-content="如果你了解“达人”；如果你认为你是达人，如果你想圈住一群达人，那么，你需要一个平台，经营起来，现在你可以选择个人工作台开始创建：自己的达人吧。" data-original-title="关于达人吧">关于达人吧</a></dd>
			      </dl>
			      <dl class="footer-nav">
			        <dt class="nav-title">快捷链接</dt>
			        <dd class="nav-item"><a href="http://pm.glodon.com/">研发信息化工具</a></dd>
			        <dd class="nav-item"><a href="http://www.glodon.com/">广联达门户</a></dd>
			        <dd class="nav-item"><a href="http://home.glodon.com:7781/bpm/resource/skins/default/operator.jsp">内部OA</a></dd>
			      </dl>
			      <dl class="footer-nav">
			        <dt class="nav-title">联系我们</dt>
			        <dd class="nav-item"><a href="#">研发与市场运作支持部</a></dd>
			        <dd class="nav-item"><a href="#">刘振侠：分机：3283</a></dd>
			        <dd class="nav-item"><a href="#">李旸：分机：3375</a></dd>
			        <dd class="nav-item"><a href="#">张海山：分机：3330</a></dd>
			        <dd class="nav-item"><a href="#">王一楠：分机：3927</a></dd>
			      </dl>
			      <dl class="footer-nav">
			      	<dt class="nav-title">更多内容</dt>
			        <img src="/app/webroot/img/qrcode.jpg" style="width: 120px; height=120px; ">
			      </dl>
			    </div>
			    <div class="footer-copyright text-center">Copyright &copy; 2014. All rights reserved.</div>
			  </div>
			</div>
		</div>
		<script>
		$(function ()
		{ 
			$("#example1").popover();
			$("#example2").popover();
		});
		</script>
	</body>
</html>
