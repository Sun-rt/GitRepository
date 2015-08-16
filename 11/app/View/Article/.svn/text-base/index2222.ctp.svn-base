<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="../" class="navbar-brand">达人吧</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<li>
					<a href="#">首页</a>
				</li>
				<li>
					<a href="#">乐问</a>
				</li>
				<li>
					<a href="#">知识库</a>
				</li>
				<li>
					<a href="#">达人堂</a>
				</li>
				<li>
					<a href="#">吐槽专区</a>
				</li>
			</ul>

			<form class="navbar-form navbar-left">
				<input type="text" class="form-control col-lg-8" placeholder="Search">
			</form>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">我的工作台<b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="#">我的文章</a>
						</li>
						<li>
							<a href="#">我的活动</a>
						</li>
						<li>
							<a href="#">我的收藏</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">个人主页</a>
						</li>
					</ul>
				</li>
			</ul>

		</div>
	</div>
</div>

<div class="container" style="margin-top: 70px;">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div style="float: left; margin-left: 20px;">
					<a href="#"><img style="width: 120px; height: 120px;" src=<?php echo $articleInfo['Group']['portraiturl'] ?> alt="placehold"></a>
				</div>
				<div style="float: left; padding-top: 57px; margin-left: 20px;">
					<h2> <?php echo $articleInfo['Group']['name'] ?> </h2>
				</div>
				<div style="float: left; margin-left: 20px; padding-top: 75px;">
					<a href="#" class="btn btn-primary disabled">已加入</a>
				</div>
				<div style="float: left; margin-left: 20px; padding-top: 75px;">
					<a class="btn btn-primary">退出</a>
				</div>
			</div>
			<br />
			<div class="row">
				<ul class="nav nav-pills" style="margin-left: 20px;">
					<li class="active">
						<a href="#">首页</a>
					</li>
					<li class="active">
						<a href="#">文章</a>
					</li>
					<li class="active">
						<a href="#">活动</a>
					</li>
					<li class="active">
						<a href="#">投票</a>
					</li>
					<li class="active">
						<a href="#">相册</a>
					</li>
					<li class="dropdown active">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">更多应用<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">应用1</a>
							</li>
							<li>
								<a href="#">应用2</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">应用3</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>

		</div>
	</div>

	<ul class="breadcrumb">
		<li>
			<a href="#">首页</a>
		</li>
		<li class="active">
			文章
		</li>
	</ul>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2> <?php echo $articleInfo['Article']['title'] ?> </h2>
				</div>
				<div class="panel-body">
					<div style="height: 20px;">
						<ul class="nav nav-pills">
							<li><a href="#"><?php echo $articleInfo['Article']['autorname'] ?></a></li>
							<li style="padding-top: 10px;"><?php echo $articleInfo['Article']['time'] ?></li>
  							<li><a href="#">浏览<span class="badge">42</span></a></li>
  							<li><a href="#">评论<span class="badge">35</span></a></li>
  							<li><a href="#">赞<span class="badge">3</span></a></li>
						</ul>
					</div>
					<div>
						<hr />
						<p class="lead">
							<?php 
								echo $articleInfo['Article']['content']
							?>
						</p>
					</div>
					<hr />
					<div>
						<span style="margin-left: 10px;">分类:<span class="label label-success"  style="margin-left: 5px;"><?php echo $articleInfo['ArticleCategory']['name']; ?></span></span>
						<span style="margin-left: 10px;">标签:<span class="label label-danger"  style="margin-left: 5px;">分析</span></span>
					</div>
					<br />
					<h5 style="margin-left: 10px;">相关阅读</h5>
					<a href="#" class="btn btn-link">相关阅读1</a>
					<a href="#" class="btn btn-link">相关阅读2</a>
					<a href="#" class="btn btn-link">相关阅读3</a>

					<div style="text-align: center; margin-top: 20px;">
						<a href="#" class="btn btn-danger">我顶</a>
						<a href="#" class="btn btn-primary" style="margin-left: 20px;">收藏</a>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="bs-component">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">关于作者</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3">
								<img src="http://placehold.it/50x50" alt="placehold">
							</div>
							<div class="col-lg-9">
								<p>
									<?php echo $articleInfo['Article']['autorname']
									?>
								</p>
								<p>
									电商开发部
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>