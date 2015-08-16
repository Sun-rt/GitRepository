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

function getSexTitle($isSelf,$sex){
	if ($isSelf){
		return "我";
	}
	else{
		if ($sex == '男'){
			return '他';
		}
		else if ($sex == '女'){
			return '她';
		}
		else{
			return 'Ta';
		}
	}
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
			<div class="user-top-img" style="background-image: url(/app/webroot/img/user-top.jpg);">
				<div style="float: left;">
					<img class="user-top-portrait" src=<?php echo $user['User']['portraiturl'];?> alt="placehold">
				</div>
				<div style="float: left; width: auto;">
				<div class="user-top-name">
				<script>
			 	function ajaxFollow(){
				    $.ajax({
				        url : "/users/follow/<?php echo $user['User']['id'] ?>",
				        dataType : 'json',
				        success : function(followed, textStatus) {
					        if (followed == 1){
								document.getElementById("follow-it").innerHTML = "已关注";
							}
							else{
								document.getElementById("follow-it").innerHTML = "关注";
							}
					        
				        },
				    });
			    }
				</script>
					<h4>
						<?php echo $user['User']['name']; ?>
						<?php 
							if (!$isSelf)
							{
								echo '<div class="btn btn-success" style="display: inline;"><span id="follow-it" class="like-it" onclick="ajaxFollow();">';
								
								if ($followed){
									echo '已关注';
								}
								else{
									echo '关注';
								}
								echo '</span></div>';
							}
						?>
					</h4>
					
				</div>
				<div class="user-top-status">
					<h4>
						<?php echo $user['User']['dept']; ?>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<?php echo $user['User']['office']; ?>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<?php echo $user['User']['email']; ?>
					</h4>
				</div>
				<div class="user-top-data">
					<h4>
						<?php echo getSexTitle($isSelf,$user['User']['sex']);?>关注的吧：<?php echo count($followGroups); ?>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<?php echo getSexTitle($isSelf,$user['User']['sex']);?>关注：<?php echo $followersCount; ?>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						关注<?php echo getSexTitle($isSelf,$user['User']['sex']);?>：<?php echo $fansCount; ?>
					</h4>
				</div>
				</div>
			</div>
			<!-- 顶部头图 -->
			
			<div class="user-top-menu">
				<a href="/users/view/<?php echo $user['User']['id']; ?>" class="user-top-submenu active-menu">
					<img src="/app/webroot/img/user-home.png" />
					<h5><?php echo getSexTitle($isSelf,$user['User']['sex']);?>的主页</h5>
				</a>
				<a href="/users/userinfo/<?php echo $user['User']['id']; ?>" class="user-top-submenu">
					<img src="/app/webroot/img/user-profile.png" />
					<h5><?php echo getSexTitle($isSelf,$user['User']['sex']);?>的资料</h5>
				</a>
				<a href="/users/article/<?php echo $user['User']['id']; ?>" class="user-top-submenu">
					<img src="/app/webroot/img/user-article.png" />
					<h5><?php echo getSexTitle($isSelf,$user['User']['sex']);?>的文章</h5>
				</a>
				<a href="/users/favors/<?php echo $user['User']['id']; ?>" class="user-top-submenu">
					<img src="/app/webroot/img/user-favor.png" />
					<h5><?php echo getSexTitle($isSelf,$user['User']['sex']);?>的收藏</h5>
				</a>
				<a href="/users/group/<?php echo $user['User']['id']; ?>" class="user-top-submenu">
					<img src="/app/webroot/img/user-bar.png" />
					<h5><?php echo getSexTitle($isSelf,$user['User']['sex']);?>的达人吧</h5>
				</a>
				<a href="/errors/error/3" class="user-top-submenu">
					<img src="/app/webroot/img/user-app.png" />
					<h5>更多应用</h5>
				</a>
			</div>
			<!-- 顶部菜单 -->
			
		</div>
		<div class="col-md-1">
		</div>
	</div>
	
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-1">
		</div>
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading">
					文章
		       	</div>			       	
	   			<div class="panel-body">
		   			<ul class="media-list">
			   			<?php foreach ($articles as $article): ?>
			   			<li class="media">
							<div class="media-body">
								<a href="/users/view/<?php echo $user['User']['id']; ?>">
									<?php echo $user['User']['name']; ?>
								</a>
								发表了文章
								<br />
							    <a href=<?php echo '/article/view/' . $article['Article']['id']; ?>>
									<h4 class="media-heading">
										<?php
											$tempTitle = $article['Article']['title'];
											$tempTitle = cut_str($tempTitle, 100, true);
											echo $tempTitle;
										?>
									</h4>
							    </a>
								<small>
								<?php echo cut_str($article['Article']['time'], 5, false); ?>
								<!--
								&nbsp;&nbsp;
								<span class="glyphicon glyphicon-tag"></span>&nbsp;
								<a href="#" >
									<?php echo $article['ArticleCategory']['name']; ?>
								</a>
								-->
								<div style="float: right;">
									<span class="glyphicon glyphicon-heart"></span>
									<?php echo $article['Article']['supportcount']; ?>
									&nbsp;&nbsp;
									<span class="glyphicon glyphicon-comment"></span>
									<?php echo $article['Article']['replycount']; ?>
									&nbsp;&nbsp;
									<span class="glyphicon glyphicon-eye-open"></span>
									<?php echo $article['Article']['visitcount']; ?>
								</div>
								</small>
							</div>
							<hr style="margin-top: 10px; margin-bottom: 0px;" />
						</li>
						<?php endforeach; ?>
					</ul>
	            </div>
	   		</div>
	   		
	   		<div class="panel panel-default">
				<div class="panel-heading">
					活动
		       	</div>			       	
	   			<div class="panel-body">
		   			<ul class="media-list">
			   			<?php foreach ($events as $event): ?>
			   			<li class="media">
							<div class="media-body">
								<a href="/users/view/<?php echo $user['User']['id']; ?>">
									<?php echo $user['User']['name']; ?>
								</a>
								创建了活动
								<br />
							    <a href=<?php echo '/event/view/' . $event['Event']['id']; ?>>
									<h4 class="media-heading">
										<?php
											$tempTitle = $event['Event']['title'];
											$tempTitle = cut_str($tempTitle, 100, true);
											echo $tempTitle;
										?>
									</h4>
							    </a>
								<small>
								<?php echo cut_str($event['Event']['time'], 5, false); ?>
								&nbsp;&nbsp;
								<span class="glyphicon glyphicon-tag"></span>&nbsp;
								<a href="#" >
									<?php echo $event['Category']['name']; ?>
								</a>
								<div style="float: right;">
									<span class="glyphicon glyphicon-heart"></span>
									<?php echo $event['Event']['supportcount']; ?>
									&nbsp;&nbsp;
									<span class="glyphicon glyphicon-comment"></span>
									<?php echo $event['Event']['replycount']; ?>
									&nbsp;&nbsp;
									<span class="glyphicon glyphicon-eye-open"></span>
									<?php echo $event['Event']['visitcount']; ?>
								</div>
								</small>
							</div>
							<hr style="margin-top: 10px; margin-bottom: 0px;" />
						</li>
						<?php endforeach; ?>
					</ul>
	            </div>
	   		</div>
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo getSexTitle($isSelf,$user['User']['sex']);?>的达人吧
		       	</div>
		       	
	   			<div class="panel-body">
		   			<div style="width: 100%; min-height: 80px">
			            <?php foreach ($followGroups as $followGroup) : ?>
                    		<div style="width: 70px; height: 80px; display: inline-block; margin-right: 5px; text-align: center;">
	                    		<a href="<?php echo '/groups/view/'.$followGroup['groupID']; ?>">
		                    		<img src="<?php echo $followGroup['groupportraiturl']; ?>" style="width: 50px;height: 50px;" alt="<?php echo $followGroup['groupName'] ?>">
		                    		<br />
		                    	</a>
								<?php echo cut_str($followGroup['groupName'], 5, false); ?>
                    		</div>
						<?php endforeach; ?>
		            </div>
	            </div>
	   		</div>
	   		
	   		<div class="panel panel-default">
				<div class="panel-heading">
					来访记录
		       	</div>
		       	
	   			<div class="panel-body">
		   			<div style="width: 100%; min-height: 80px">
			   			<?php 
				   			
				   			foreach ($visitors as $visitor){
					   			echo '<div style="width: 70px; height: 80px; display: inline-block; margin-right: 5px; text-align: center;">';
					   			echo '<img src="'.$visitor['User']['portraiturl'].'" width="50px" height="50px" <br />';
					   			echo $visitor['User']['name'];
					   			echo '</div>';
				   			}
				   			
			   			?>
		            </div>
	            </div>
	   		</div>
		</div>
	</div>
	
</div>