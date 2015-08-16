<!DOCTYPE html>
<html lang="zh-CN" class="no-js">
	<head>
		<?php echo $this -> Html -> charset(); ?>
		
		<title>管理员 - 达人吧</title>
		
		<!-- Bootstrap -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/app/webroot/adminstyle/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/app/webroot/adminstyle/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="/app/webroot/adminstyle/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="/app/webroot/adminstyle/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="/app/webroot/adminstyle/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="/app/webroot/adminstyle/vendors/jquery-1.9.1.min.js"></script>
		<script src="/app/webroot/adminstyle/bootstrap/js/bootstrap.min.js"></script>
		
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	                    <span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">达人吧</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <b>admin</b><i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">退出登录</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
	                        <li>
	                            <a href="/admins/index">控制台</a>
	                        </li>
	                        <li>
	                            <a href="/admins/statpvuv">PV / UV</a>
	                        </li>
	                        <li>
	                            <a href="/admins/statarticle">文章统计</a>
	                        </li>
	                        <li>
	                            <a href="/admins/statbar">达人吧统计</a>
	                        </li>
	                        <li>
	                            <a href="/admins/homebanner">首页banner</a>
	                        </li>
	                        <li>
	                            <a href="/admins/recommendpic">推荐文章轮播图</a>
	                        </li>
	                        <li>
	                            <a href="/admins/recommendarticle">推荐文章管理</a>
	                        </li>
	                        <li>
	                            <a href="/admins/homejournals">期刊管理</a>
	                        </li>
	                        <li>
	                            <a href="/admins/homelinks">常用链接</a>
	                        </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li>
                            <a href="/admins/index"><i class="icon-chevron-right"></i>控制台</a>
                        </li>
                        <li>
                            <a href="/admins/statpvuv"><i class="icon-chevron-right"></i>PV / UV</a>
                        </li>
                        <li>
                            <a href="/admins/statarticle"><i class="icon-chevron-right"></i>文章统计</a>
                        </li>
                        <li>
                            <a href="/admins/statbar"><i class="icon-chevron-right"></i>达人吧统计</a>
                        </li>
                        <li>
                            <a href="/admins/homebanner"><i class="icon-chevron-right"></i>首页banner</a>
                        </li>
                        <li>
                            <a href="/admins/recommendpic"><i class="icon-chevron-right"></i>推荐文章轮播图</a>
                        </li>
                        <li>
                            <a href="/admins/recommendarticle"><i class="icon-chevron-right"></i>推荐文章管理</a>
                        </li>
                        <li>
                            <a href="/admins/homejournals"><i class="icon-chevron-right"></i>期刊管理</a>
                        </li>
                        <li>
                            <a href="/admins/homelinks"><i class="icon-chevron-right"></i>常用链接</a>
                        </li>
                    </ul>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
	                
	                <?php echo $this -> Session -> flash(); ?>

					<?php echo $this -> fetch('content'); ?>
                    
                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; 达人吧 2014</p>
            </footer>
        </div>
			
	</body>
</html>
