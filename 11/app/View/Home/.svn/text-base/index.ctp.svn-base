<?php
//$sourcestr 是要处理的字符串
//$cutlength 为截取的长度(即字数)
function cut_str($sourcestr, $cutlength, $addsymbol) {
	$returnstr = '';
	$i = 0;
	$n = 0;
	$str_length = strlen($sourcestr);
	//字符串的字节数
	while (($n < $cutlength) and ($i <= $str_length)) {
		$temp_str = substr($sourcestr, $i, 1);
		$ascnum = Ord($temp_str);
		//得到字符串中第$i位字符的ascii码
		if ($ascnum >= 224)//如果ASCII位高与224，
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 3);
			//根据UTF-8编码规范，将3个连续的字符计为单个字符
			$i = $i + 3;
			//实际Byte计为3
			$n++;
			//字串长度计1
		} elseif ($ascnum >= 192)//如果ASCII位高与192，
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 2);
			//根据UTF-8编码规范，将2个连续的字符计为单个字符
			$i = $i + 2;
			//实际Byte计为2
			$n++;
			//字串长度计1
		} elseif ($ascnum >= 65 && $ascnum <= 90)//如果是大写字母，
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 1);
			$i = $i + 1;
			//实际的Byte数仍计1个
			$n++;
			//但考虑整体美观，大写字母计成一个高位字符
		} else//其他情况下，包括小写字母和半角标点符号，
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 1);
			$i = $i + 1;
			//实际的Byte数计1个
			$n = $n + 0.5;
			//小写字母和半角标点等与半个高位字符宽...
		}
	}
	if ($str_length > $cutlength && $addsymbol) {
		$returnstr = $returnstr . "...";
		//超过长度时在尾处加上省略号
	}
	return $returnstr;

}
?>

<!-- Start of Page Container -->
<div class="container-fluid" style="margin-top: 15px; margin-left: 30px;">
	<div class="row">
		<!-- start of sidebar -->
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="/users/group/<?php echo $userInfo['User']['id']; ?>" class="pull-right">更多</a>
					我的吧
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="ul-common">
						<?php
							if ($userLikeGroups){
								foreach ($userLikeGroups['UserGroupLike']['likeinfos'] as $userLikeGroup) :
									echo '<li><span class="glyphicon glyphicon-user" style="margin-right: 5px;"></span><a href="/groups/view/'.$userLikeGroup['groupID'].'">'.$userLikeGroup['groupName'].'</a></li>';
								endforeach;
							}
						?>
					</ul>
	            </div>
	   		</div>
	   		
	   		<div class="panel panel-default">
				<div class="panel-heading">
					<a href="/errors/error/3" class="pull-right">更多</a>
					期刊
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="ul-common">
			   			<?php foreach($journalsArray as $journal): ?>
							<li style="width: 70%;"><a href="<?php echo $journal['link']?>"><?php echo $journal['name']?></a></li>
						<?php endforeach;?>
					</ul>
	            </div>
	   		</div>
	   		
	   		<div class="panel panel-default">
				<div class="panel-heading">
					移动端
		       	</div>
		       	
	   			<div class="panel-body">
		   			<button class="col-md-2" style="height: 40px; text-align: left; width: 180px;">
						<img src="/app/webroot/img/ios.png" style="width: 30px;height: 30px;">
						<span><strong>iOS客户端</strong></span>
					</button>
					<button class="col-md-2" style="height: 40px; margin-top: 10px;width: 180px; text-align: left;">
						<img src="/app/webroot/img/android.png" style="width: 30px;height: 30px;">
						<span><strong>Android客户端</strong></span>
					</button>
	            </div>
	   		</div>
		</div>
		<!-- end of sidebar -->
		
		<!-- start of page content -->
		<div class="col-md-6" style="margin-left: -20px;">
			<!-- start 推荐文章 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $recommendArticleDatas[0]; ?>
					<img src="/app/webroot/img/icon-hot.png" style="width:18px; height:18px; margin-top: -4px;" />
		       	</div>
		       	
	   			<div class="panel-body">
		   			<div class="row">
			   			<div class="col-md-5">
				   			<div id="carousel-recommend" class="carousel slide" data-ride="carousel" style="min-height: 200px;">
				                <ol class="carousel-indicators" style="margin-bottom: -15px;">
					                <?php 
										$imgCount = count($carouselData);
										for ($i = 0; $i < $imgCount ; $i++)
										{
											if ($i == 0)
											{
												echo '<li data-target="#carousel-recommend" data-slide-to="'.$i.'" class="active"></li>';
											}
											else
											{
												echo '<li data-target="#carousel-recommend" data-slide-to="'.$i.'"></li>';
											}
										}
									?>
				                </ol>
				                <div class="carousel-inner">
					                
					                <?php 
										$imgCount = count($carouselData);
										for ($i = 0; $i < $imgCount ; $i++)
										{
											$recommendArticleData = $carouselData[$i];
											if ($i == 0)
											{
												echo '<div class="item active">';
											}
											else
											{
												echo '<div class="item">';
											}
											echo '<a href="'.$recommendArticleData['link'].'">';
											echo '<img src="'.$recommendArticleData['carouselurl'].'" alt="" style="max-height: 200px; width: 100%;" />';
											echo '</a>';
											echo '</div>';
										}
									?>
					                <!--
<a class="left carousel-control" href="#carousel-recommend" data-slide="prev">
					                  <span class="glyphicon glyphicon-chevron-left"></span>
					                </a>
					                <a class="right carousel-control" href="#carousel-recommend" data-slide="next">
					                  <span class="glyphicon glyphicon-chevron-right"></span>
					                </a>
-->
				            	</div>
				        	</div>
			   			</div>
				        
				        <div class="col-md-7">
			   				<ul class="ul-article">
								<?php foreach ($recommendArticleDatas[1] as $recommendArticleData): ?>
								<li>
								<div class="article-title">
									<b>
									<a href=<?php echo $recommendArticleData['link']; ?>>
									<?php
										$tempTitle = $recommendArticleData['title'];
										$tempTitle = cut_str($tempTitle, 100, false);
										echo $tempTitle;
									?>
									</a>
									</b>
								</div>
								<b>
									<?php
										$tempTitle = $recommendArticleData['easyintro'];
										$tempTitle = cut_str($tempTitle,30, true);
										echo $tempTitle;
									?>
								</b>
								</li>
								<?php endforeach; ?>
							</ul>
		   				</div>
		   			</div>
	            </div>
	   		</div>
			<!-- end 推荐文章 -->
			
			<!-- start 活动 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $newEventDatas[0]; ?>
					<img src="/app/webroot/img/icon-huodong.png" style="width:18px; height:18px; margin-top: -4px;" />
					<a href="/events/index" class="pull-right">更多</a>
		       	</div>
		       	
	   			<div class="panel-body" style="margin-top: -20px;">
		   			<div id="eventCarousel" class="carousel slide" style="width: 100%; height: auto;">
						<!-- Carousel items -->
						<div class="carousel-inner" style="width: 100%; height: 100%;">
							<?php
								for ($i = 0; $i < count($newEventDatas[1]); $i++) {
									$newEventData = $newEventDatas[1][$i];
									if ($i == 0)
									{
										echo '<div class="active item" style="width:100%; height:100%; float:left;">';
									}
									else
									{
										echo '<div class="item" style="width:100%; height:100%;">';
									}
									echo '<h4><a style="color:#666666;" href="events/view/'.$newEventData['Event']['id'].'">'.$newEventData['Event']['title'].'</a></h4>';
									echo '<div style="width:25%; height:100%; float:left;">';
									echo '<img src="'.$newEventData['Event']['eventimageurl'].'" style="width:160px; height:160px;"/>';
									echo '</div>';
									echo '<div style="width:70%; height:100%; float:right;">';
									echo '<b>活动地点：</b>地点';
									echo '<hr style="margin-top: 5px; margin-bottom: 5px;" />';
									echo '<b>活动时间：</b>'.$newEventData['Event']['begintime'].'<b>至</b>'.$newEventData['Event']['endtime'];
									echo '<hr style="margin-top: 5px; margin-bottom: 5px;" />';
									echo '<b>截止时间：</b>'.$newEventData['Event']['applyendtime'];
									echo '<hr style="margin-top: 5px; margin-bottom: 5px;" />';
									echo '<b>活动评论：</b>'.$newEventData['Event']['replycount'].'条';
									echo '<hr style="margin-top: 5px; margin-bottom: 5px;" />';
									echo '<b>来自：</b>达人吧';
									echo '<hr style="margin-top: 5px; margin-bottom: 5px;" />';
									echo '</div></div>';
								}
							?>
						</div>
						<!-- Carousel nav -->
						<a style="float: left;" href="#eventCarousel" data-slide="prev">
							<span class="glyphicon glyphicon-arrow-left"></span>
						</a>
						<a style="float: right;" href="#eventCarousel" data-slide="next">
							<span class="glyphicon glyphicon-arrow-right"></span>
						</a>
					</div>
	   			</div>
			</div>
			<!-- end 活动 -->
			
			<!-- start 最新文章 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $newArticleDatas[0]; ?>
					<img src="/app/webroot/img/icon-new.png" style="width:18px; height:18px; margin-top: -4px;" />
					<a href="/article/index" class="pull-right">更多</a>
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="media-list">
			   			<?php foreach ($newArticleDatas[1] as $newArticleData): ?>
			   			<li class="media">
							<div class="media-body">
							    <a href=<?php echo '/article/view/' . $newArticleData['Article']['id']; ?>>
									<h4 class="media-heading">
										<?php
											$tempTitle = $newArticleData['Article']['title'];
											$tempTitle = cut_str($tempTitle, 100, true);
											echo $tempTitle;
										?>
									</h4>
							    </a>
							    <div style="margin-bottom: 5px;">
							    <?php
								$tempTitle = $newArticleData['Article']['easyintro'];
								$tempTitle = cut_str($tempTitle, 80, true);
								echo $tempTitle;
								?>
							    </div>
								<small>
								<a href="/users/view/<?php echo $newArticleData['Article']['autorid']; ?>" title=""><?php echo $newArticleData['Article']['autorname']; ?></a>
								发表于
								<?php echo cut_str($newArticleData['Article']['time'], 5, false); ?>
								<div style="float: right;">
									<span class="glyphicon glyphicon-heart"></span>
									<?php echo $newArticleData['Article']['supportcount']; ?>
									&nbsp;&nbsp;
									<span class="glyphicon glyphicon-comment"></span>
									<?php echo $newArticleData['Article']['replycount']; ?>
								</div>
								</small>
							</div>
							<hr style="margin-top: 10px; margin-bottom: 0px;" />
						</li>
						<?php endforeach; ?>
					</ul>
	   			</div>
			</div>
			<!-- end 最新文章 -->
			
			<!-- start 热榜 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $hotArticleDatas[0]; ?>
					<img src="/app/webroot/img/icon-hot.png" style="width:18px; height:18px; margin-top: -4px;" />
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="media-list">
			   			<?php foreach ($hotArticleDatas[1] as $hotArticleData): ?>
			   			<li class="media">
							<div class="media-body">
							    <a href=<?php echo '/article/view/' . $hotArticleData['Article']['id']; ?>>
									<h4 class="media-heading">
										<?php
											$tempTitle = $hotArticleData['Article']['title'];
											$tempTitle = cut_str($tempTitle, 100, true);
											echo $tempTitle;
										?>
									</h4>
							    </a>
								<small>
								来自
								<a href="/groups/view/<?php echo $hotArticleData['Article']['groupid']; ?>" title=""><?php echo $hotArticleData['Group']['name']; ?>吧</a>
								<div style="float: right;">
									<span class="glyphicon glyphicon-heart"></span>
									<?php echo $hotArticleData['Article']['supportcount']; ?>
								</div>
								</small>
							</div>
							<hr style="margin-top: 10px; margin-bottom: 0px;" />
						</li>
						<?php endforeach; ?>
					</ul>
	   			</div>
			</div>
			<!-- end 热榜 -->
			
			<!-- start 猜你喜欢 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					猜你喜欢
		       	</div>
		       	
	   			<div class="panel-body">
		   			猜你喜欢
	   			</div>
			</div>
			<!-- end 猜你喜欢 -->
			
			<!-- start 最新幻灯片 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					最新幻灯片
		       	</div>
		       	
	   			<div class="panel-body" style="margin-top: -10px;">
		   			<div style="width: 100%; min-height: 130px;">
						<a href="/errors/error/3" class="home-ppt">
							<img src="http://placehold.it/100x100">
							<div class="home-ppt-title">
								<b>ppt</b>
							</div>
						</a>
						<a href="/errors/error/3" class="home-ppt">
							<img src="http://placehold.it/100x100">
							<div class="home-ppt-title">
								<b>ppt</b>
							</div>
						</a>
						<a href="/errors/error/3" class="home-ppt">
							<img src="http://placehold.it/100x100">
							<div class="home-ppt-title">
								<b>ppt</b>
							</div>
						</a>
						<a href="/errors/error/3" class="home-ppt">
							<img src="http://placehold.it/100x100">
							<div class="home-ppt-title">
								<b>ppt</b>
							</div>
						</a>
						<a href="/errors/error/3" class="home-ppt">
							<img src="http://placehold.it/100x100">
							<div class="home-ppt-title">
								<b>ppt</b>
							</div>
						</a>
					</div>
	   			</div>
			</div>
			<!-- end 最新幻灯片 -->
		</div>
				
		
		<!-- start of sidebar -->
		<div class="col-md-3" style="margin-left: -20px;">
			<!-- start 帮助 -->
			<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>欢迎使用达人吧</strong>
              <br />
              如需帮助，请联系<b>张海山</b>!
            </div>
			<!-- end 帮助 -->
			
			<!-- start 热门吧 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $hotGroupDatas[0]; ?>
					<img src="/app/webroot/img/icon-hot.png" style="width:18px; height:18px; margin-top: -4px;" />
					<a href="/groups/index" class="pull-right">更多</a>
		       	</div>
		       	
	   			<div class="panel-body" style="margin-top: -10px;">
		   			<ul class="ul-bar">
						<?php foreach ($hotGroupDatas[1] as $hotGroupData): ?>
							<li>
							<div style="margin-bottom: 5px;">
							<span class="glyphicon glyphicon-star"></span>
							<!-- <img style="width: 20px; height: 20px; margin-right: 5px; float: left;" src=<?php echo $hotGroupData['Group']['portraiturl']; ?> alt="placehold"> -->
							<a href="/groups/view/<?php echo $hotGroupData['Group']['id']; ?>"><?php echo $hotGroupData['Group']['name']; ?></a>
							</div>
							<span><?php echo $hotGroupData['Group']['articleCount']; ?>篇文章 | <?php echo $hotGroupData['Group']['memberCount']; ?>个成员</span>
							<hr style="margin-bottom: 0px; margin-top: 3px;" />
							</li>
						<?php endforeach; ?>
					</ul>
	   			</div>
			</div>
			<!-- end 热门吧 -->
			
			<!-- start 热门标签 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $hotTagDatas[0]; ?>
					<img src="/app/webroot/img/icon-hot.png" style="width:18px; height:18px; margin-top: -4px;" />
		       	</div>
		       	
	   			<div class="panel-body" style="margin-top: -10px;">
		   			<?php foreach ($hotTagDatas[1] as $hotTagData): ?>
					<a href="/errors/error/3" style="margin-right: 5px; margin-top: 5px; float: left;">
						<span class="label label-primary">
							<?php echo $hotTagData['Tag']['name']; ?>
						</span>
					</a>
					<?php endforeach; ?>
	   			</div>
			</div>
			<!-- end 热门标签 -->
			
			<!-- start 常用链接 -->
			<div class="panel panel-default">
				<div class="panel-heading">
					常用链接
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="ul-common">
			   			<?php foreach($homeLinksArray as $links): ?>
							<li><a href="<?php echo $links['link']?>"><?php echo $links['name']?></a></li>
						<?php endforeach;?>
					</ul>
	   			</div>
			</div>
			<!-- end 常用链接 -->
		</div>
		
		<!-- end of sidebar -->
                                        
	</div>
	<!-- end of page content -->
		
	</div>
</div>
<!-- End of Page Container -->