<?php
//$sourcestr 是要处理的字符串
//$cutlength 为截取的长度(即字数)
function cut_str($sourcestr, $cutlength, $addsymbol)
{
    $returnstr  = '';
    $i          = 0;
    $n          = 0;
    $sourcestr = strip_tags($sourcestr);
    $str_length = strlen($sourcestr);
    //字符串的字节数
    while (($n < $cutlength) and ($i <= $str_length)) {
        $temp_str = substr($sourcestr, $i, 1);
        $ascnum   = Ord($temp_str);
        //得到字符串中第$i位字符的ascii码
        if ($ascnum >= 224) //如果ASCII位高与224，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 3);
            //根据UTF-8编码规范，将3个连续的字符计为单个字符
            $i         = $i + 3;
            //实际Byte计为3
            $n++;
            //字串长度计1
        } elseif ($ascnum >= 192) //如果ASCII位高与192，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 2);
            //根据UTF-8编码规范，将2个连续的字符计为单个字符
            $i         = $i + 2;
            //实际Byte计为2
            $n++;
            //字串长度计1
        } elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i         = $i + 1;
            //实际的Byte数仍计1个
            $n++;
            //但考虑整体美观，大写字母计成一个高位字符
        } else //其他情况下，包括小写字母和半角标点符号，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i         = $i + 1;
            //实际的Byte数计1个
            $n         = $n + 0.5;
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

<script>
	hide_top_img();
</script>

<div class="container-fluid" style="margin-top: 90px;">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="group-top-img" style="background-image: url(/app/webroot/img/km-top.jpg);">
				<div style="float: left; width: auto; margin-left: 30px;">
					<img class="group-top-portrait" src=<?php echo $group['Group']['portraiturl'];?> alt="placehold">
				</div>
				<div class="group-top-name">
					<h3>
						<?php echo $group['Group']['name']; ?>
					</h3>
				</div>
				<script>
				 	function ajaxJoin(){
			
					 	$.ajax({
						 	type: "POST",
					        url : "/groups/follow",
					        dataType : 'json',
					        data:
					        {
						        'groupId':'<?php echo $group['Group']['id']; ?>',
						        'groupName':'<?php echo $group['Group']['name']; ?>',
						        'portraitUrl':'<?php echo $group['Group']['portraiturl']; ?>',
					        },
					        success : function(data, textStatus) {
						        document.getElementById("follow-it").innerHTML = '<a href="#">已加入</a>';
						        document.getElementById("unfollow-div").style.display = '';
						        document.getElementById("unfollow-div").innerHTML = '<a href="#" onclick="ajaxUnfollow();">退出</a>';
					        },
					    });
			
				    }

				    function ajaxUnfollow(){
			
					 	$.ajax({
						 	type: "POST",
					        url : "/groups/unfollow",
					        dataType : 'json',
					        data:
					        {
						        'groupId':'<?php echo $group['Group']['id']; ?>',
					        },
					        success : function(data, textStatus) {
						        document.getElementById("follow-it").innerHTML = '<a href="#" onclick="ajaxJoin();">加入</a>';
						        document.getElementById("unfollow-div").style.display = 'none';
					        },
					    });
			
				    }
				</script>
				<div id="follow-it" class="group-top-status">
					<?php 
						if($followed){
							echo '<a>已加入</a>';
							// echo '&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="ajaxJoin();" >退出</a>';
						}
						else
						{
							echo '<a href="#" onclick="ajaxJoin();">加入</a>';
						}
						?>
								
				</div>
				<?php
					if ($followed && !$isGroupCreator) {
						echo '<div id="unfollow-div" class="group-top-status">';
					}
					else
					{
						echo '<div id="unfollow-div" class="group-top-status" style="display:none;">';
					}
				 
					if ($followed && !$isGroupCreator)
					{
						echo '<a href="#" onclick="ajaxUnfollow();">退出</a>';
					}
					
					echo '</div>';
				?>
				
				<?php
					if ($isManager)
					{
						echo '<div class="group-top-manager"><a href="/groups/manage/'.$group['Group']['id'].'" title="">管理达人吧</a></div>';
					}
				?>
			</div>
			
			<div class="group-top-menu">
				<a href="/groups/view/<?php echo $group['Group']['id']; ?>" class="group-top-submenu active-menu">
					<img src="/app/webroot/img/group-home.png" />
					<h6 style="margin-top: 5px;">首页</h6>
				</a>
				<a href="/groups/viewarticle/<?php echo $group['Group']['id']; ?>" class="group-top-submenu">
					<img src="/app/webroot/img/group-article.png" />
					<h6 style="margin-top: 5px;">文章</h6>
				</a>
				<a href="/groups/viewevent/<?php echo $group['Group']['id']; ?>" class="group-top-submenu">
					<img src="/app/webroot/img/group-event.png" />
					<h6 style="margin-top: 5px;">活动</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-discuss.png" />
					<h6 style="margin-top: 5px;">讨论</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-toupiao.png" />
					<h6 style="margin-top: 5px;">投票</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-photo.png" />
					<h6 style="margin-top: 5px;">相册</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-app.png" />
					<h6 style="margin-top: 5px;">管理应用</h6>
				</a>
			</div>
			
			<div style="margin-top: 5px;">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="/">首页</a></li>
					<li><a href="/groups/index">达人吧</a></li>
					<li class="active"><span><?php echo $group['Group']['name'];?></span></li>
			    </ol>
			</div>
	
		</div>
		<div class="col-md-1">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-7">
			
			<!--
			<div class="panel panel-default">
				<div class="panel-heading">
					本吧分类
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="ul-common">
						<?php foreach ($categories as $category):?>
	                    <li>
		                    <a href="/errors/error/3" title="">
			                    <?php echo $category['ArticleCategory']['name'];?>
			                </a>
		                </li>
		                <?php endforeach; ?>
					</ul>
	            </div>
	   		</div>
	   		-->

	   		<div class="panel panel-default">
				<div class="panel-heading">
					本吧文章
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="media-list">
			   			<?php foreach ($articles as $article): ?>
			   			<li class="media">
							<div class="media-body">
							    <a href=<?php echo '/article/view/' . $article['Article']['id']; ?>>
									<h4 class="media-heading">
										<?php
											$tempTitle = $article['Article']['title'];
											$tempTitle = cut_str($tempTitle, 100, true);
											echo $tempTitle;
										?>
									</h4>
							    </a>
							    <div style="margin-bottom: 5px;">
							    <?php
								$tempTitle = $article['Article']['content'];
								$tempTitle = cut_str($tempTitle, 100, true);
								echo $tempTitle;
								?>
							    </div>
								<small>
								<span class="glyphicon glyphicon-user"></span>&nbsp;
								<a href="/users/view/<?php echo $article['Article']['autorid']; ?>" title=""><?php echo $article['Article']['autorname']; ?></a>
								&nbsp;&nbsp;发表于
								<?php echo cut_str($article['Article']['time'], 5, false); ?>
								<!--
								&nbsp;&nbsp;
								<span class="glyphicon glyphicon-tag"></span>&nbsp;
								<a href="#" >
									<?php echo $article['Article']['category'][0]['ArticleCategory']['name']; ?>
								</a>
								-->
								<div style="float: right;">
									<span class="glyphicon glyphicon-heart"></span>
									<?php echo $article['Article']['supportcount']; ?>
									&nbsp;&nbsp;
									<span class="glyphicon glyphicon-comment"></span>
									<?php echo $article['Article']['replycount']; ?>
								</div>
								</small>
							</div>
							<hr style="margin-top: 10px; margin-bottom: 0px;" />
						</li>
						<?php endforeach; ?>
					</ul>
					<div style="text-align: center;">
						<ul class="pagination">
							<?php
								echo $this->Paginator->first('第一页') . '  '; 
								echo $this->Paginator->prev('前一页'). '  '; 
								echo $this->Paginator->numbers(). '  '; 
								echo $this->Paginator->next('下一页'). '  '; 
								echo $this->Paginator->last('尾页'). '  ';
							?>
						</ul>
					</div>
	            </div>
	   		</div>
	   		
		</div>
		
		<div class="col-md-3" style="margin-left: -10px;">
			<div style="width: 100%; height: 50px; text-align: center; margin-top: 10px;">
               	<a class="btn btn-primary" href="/article/add/<?php echo $group['Group']['id']; ?>">
	               	<span class="glyphicon glyphicon-edit"></span>
	               	发布文章
	            </a>
               	&nbsp;
               	<a class="btn btn-primary" href="/events/add/<?php echo $group['Group']['id']; ?>">
	               	<span class="glyphicon glyphicon-bullhorn"></span>
	               	创建活动
	            </a>
           	</div>
           	
           	<div class="panel panel-default">
				<div class="panel-heading">
					本吧信息
		       	</div>
		       	
	   			<div class="panel-body">
		   			<b>简介：</b>
		   			<?php echo cut_str($group['Group']['info'], 30, true) ?>
		   			<hr style="margin-top: 10px; margin-bottom: 10px;" />
		   			<b>吧内成员：</b>
		   			<?php echo count($groupMemebers); ?>人
		   			<br />
		   			<b>文章数量：</b>
		   			<?php echo count($articles); ?>篇
		   			<br />
		   			<b>本吧积分：</b>
		   			<?php echo $group['Group']['integration']; ?>分
	            </div>
	   		</div>
	   		
	   		<div class="panel panel-default">
				<div class="panel-heading">
					吧主
		       	</div>
		       	
	   			<div class="panel-body">
		   			<div style="width: auto; min-height: 70px;">
		   			<div style="width: 50px; height: 60px; display: inline-block; margin-right: 5px; text-align: center;">
                    		<?php echo '<a href="/users/view/'.$groupCreator['userID'].'">'.'<img src="'.$groupCreator['portraiturl'].'" width="50px" height="50px">'.'</a>&nbsp;&nbsp;';
							echo $groupCreator['userName']; ?>
                		</div>
	                </div>
	            </div>
	   		</div>
	   		
		</div>
    </div>
</div>