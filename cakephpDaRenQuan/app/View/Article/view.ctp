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


<!-- <link type="text/css" rel="stylesheet" href="/app/webroot/qqface/css/reset.css" /> -->

<style type="text/css">
span.emotion{width:42px;height:20px;background:url(http://www.16code.com/cache/demos/user-say/img/icon.gif) no-repeat 2px 2px;padding-left:20px;cursor:pointer}
span.emotion:hover{background-position:2px -28px}

/* qqFace */
.qqFace{margin-top:4px;background:#fff;padding:2px;border:1px #dfe6f6 solid;}
.qqFace table td{padding:0px;}
.qqFace table td img{cursor:pointer;border:1px #fff solid;}
.qqFace table td img:hover{border:1px #0066cc solid;}
</style>



<div class="container-fluid" style="margin-top: 50px;">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="group-top-img" style="background-image: url(/app/webroot/img/km-top.jpg);">
				<div style="float: left; width: auto; margin-left: 30px;">
					<img class="group-top-portrait" src=<?php echo $articleInfo['Group']['portraiturl'];?> alt="placehold">
				</div>
				<div class="group-top-name">
					<h3>
						<?php echo $articleInfo['Group']['name']; ?>
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
						        'groupId':'<?php echo $articleInfo['Group']['id']; ?>',
						        'groupName':'<?php echo $articleInfo['Group']['name']; ?>',
						        'portraitUrl':'<?php echo $articleInfo['Group']['portraiturl']; ?>',
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
						        'groupId':'<?php echo $articleInfo['Group']['id']; ?>',
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
		// 					echo '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="ajaxJoin();" >退出</a>';
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
			</div>
			
			<div class="group-top-menu">
				<a href="/groups/view/<?php echo $articleInfo['Group']['id']; ?>" class="group-top-submenu active-menu">
					<img src="/app/webroot/img/group-home.png" />
					<h6 style="margin-top: 5px;">首页</h6>
				</a>
				<a href="/groups/viewarticle/<?php echo $articleInfo['Group']['id']; ?>" class="group-top-submenu">
					<img src="/app/webroot/img/group-article.png" />
					<h6 style="margin-top: 5px;">文章</h6>
				</a>
				<a href="/groups/viewevent/<?php echo $articleInfo['Group']['id']; ?>" class="group-top-submenu">
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
		</div>
		<div class="col-md-1">
		</div>
	</div>

	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div style="margin-top: 5px;">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="/">首页</a></li>
					<li><a href="/groups/view/<?php echo $articleInfo['Group']['id'] ?>" title=""><?php echo $articleInfo['Group']['name'] ?></a></li>
					<li class="active"><span><?php echo $articleInfo['Article']['title'] ?></span></li>
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
			<h3 style="margin-top: 10px;">
	            <a>
	                <?php echo $articleInfo['Article']['title'] ?>
	            </a>
	        </h3>
	        
	        <div>
	            <span>
	            	<a href="/users/view/<?php echo $articleInfo['Article']['autorid'] ?>">
	                <?php echo $articleInfo['Article']['autorname'] ?></a>
	            </span>
	            <span class="date">
	                <?php echo $articleInfo['Article']['time'] ?>
	            </span>
	            <span class="comments">
	                <a>
	                    <?php echo "浏览(<b>".$articleInfo['Article']['visitcount']."</b>)" ?>
	                </a>
	            </span>
	            <span class="comments">
	                <a>
	                    <?php echo "收藏(<b id='favor-count'>".$articleInfo['Article']['favorcount']."</b>)" ?>
	                </a>
	            </span>
	            <span class="comments">
	                <a>
	                    <?php echo "评论(<b id='reply-count'>".$articleInfo['Article']['replycount']."</b>)" ?>
	                </a>
	            </span>
	            <span class="category">
	                <a href="/errors/error/3" title="">
	                    分享
	                </a>
	            </span>
	            <?php 
		            if ($isAuthor){
			            echo '<span class="category">';
			            echo '<a href="/article/edit/'.$articleInfo['Article']['id'].'">编辑</a>';;
			            echo '</span>';
		            }
		        ?>
	        </div>
	        <hr />
	        <!-- end of post meta -->
	        <div id="articleContent" style="overflow-x: hidden; width: 100%; height: auto; margin-top: 20px;">
	        	<?php echo $articleInfo['Article']['content']; ?>
			</div>
			
			<section class="like-article-container" style="display: block;">
		        <div class="like-article">
			        <?php
		            if (!$articleOtherInfo['supported']){
			            echo '<img id="support-img" src="/app/webroot/img/icon_favor_n.png" style="width: 40px; height: 40px; margin-top: 5px;" onclick="ajaxLike()"><br />';
			            echo '<span id="like-it" class="like-it" style="margin-top: 20px;" onclick="ajaxLike()">
	                    赞</span>';
		            }else{
			            echo '<img id="support-img" src="/app/webroot/img/icon_favor.png" style="width: 40px; height: 40px; margin-top: 5px;" onclick="ajaxLike()"><br />';
			            echo '<span id="like-it" class="like-it" style="margin-top: 20px;" onclick="ajaxLike()">
	                    赞&nbsp;(&nbsp;'.$articleInfo['Article']['supportcount'].'&nbsp;)</span>';
		            }
		        	?>
	            </div>
		        
		        <div class="like-article">
			        <?php
		            if (!$favored){
			            echo '<img id="favor-img" src="/app/webroot/img/icon_mark_n.png" style="width: 40px; height: 40px; margin-top: 5px;" onclick="ajaxMark()"><br />';
			            echo '<span id="mark-it" class="like-it" style="margin-top: 20px;" onclick="ajaxMark()">收藏';
	// 		            echo $articleInfo['Article']['favorcount'];
			            echo '</span>';
		            }else{
			            echo '<img id="favor-img" src="/app/webroot/img/icon_mark.png" style="width: 40px; height: 40px; margin-top: 5px;" onclick="ajaxMark()"><br />';
			            echo '<span id="mark-it" class="like-it" style="margin-top: 20px;" onclick="ajaxMark()">';
			            echo '已收藏';
			            echo '</span>';
		            }
		        	?>
		        </div>
	        </section>
	        
	        <div class="like-btn">
				<script>
			 	function ajaxLike(){
				    $.ajax({
				        url : "/article/support/<?php echo $articleInfo['Article']['id'] ?>",
				        dataType : 'json',
				        success : function(data, textStatus) {
					        if(data.isZan == '0')
					        {
								document.getElementById("support-img").src = "/app/webroot/img/icon_favor_n.png"; 
								document.getElementById("like-it").innerHTML = "赞 ("+data.supportCount+")" ;
					        }
					        else
					        {
						        document.getElementById("support-img").src = "/app/webroot/img/icon_favor.png" 
						        document.getElementById("like-it").innerHTML = "赞 ("+data.supportCount+")";
					        }
					        
				        },
				    });
			    }
			    
			    function ajaxMark(){
				    $.ajax({
					    type: "POST",
				        url : "/article/favorArticle",
				        dataType : 'json',
				        data:
				        {
					        id:"<?php echo $articleInfo['Article']['id'] ?>",
					        title:"<?php echo $articleInfo['Article']['title'] ?>"
				        },
				        success : function(data, textStatus) {
					        if(data.isFavor == '0')
					        {
								document.getElementById("favor-img").src = "/app/webroot/img/icon_mark_n.png"; 
								document.getElementById("mark-it").innerHTML = "收藏 ("+data.favorCount+")" ;
					        }
					        else
					        {
						        document.getElementById("favor-img").src = "/app/webroot/img/icon_mark.png" 
						        document.getElementById("mark-it").innerHTML = "已收藏";
					        }
					        
					        document.getElementById("favor-count").innerHTML = data.favorCount;
				        },
				    });
			    }
				</script>

				<!--
	            <span class="tags">
	                <strong>
	                    分类:&nbsp;&nbsp;
	                </strong>
	                <a href="/errors/error/3" rel="tag">
	                    <?php echo $articleInfo['ArticleCategory']['name']; ?>
	                </a>
	            </span>
	            -->
	            <span class="tags" style="margin-left: 10px;">
	                <strong>
	                    标签:&nbsp;&nbsp;
	                </strong>
	                <?php 
		                $count = count($articleTags);
		                for ($i = 0 ; $i < count($articleTags);$i++){
			                echo '<a href="';
			                echo '/errors/error/3';
			                //真是情况
	// 		                echo '/Tags/view/'.$articleTags[$i]['Tag']['id'];
			                echo '" rel="tag">';
			                echo $articleTags[$i]['Tag']['name'];
			                echo '</a>';
			                if ($i != $count - 1){
				                echo ',';
			                }
		                }
	                ?>
	            </span>
	            <span class="tags" style="margin-left: 10px;float: right">
	                <strong>
	                    分享到:&nbsp;&nbsp;
	                </strong>
	                <script>
						function ajaxEmailShare()
						{
							var subject = document.getElementById('mail-share-title').value;
							var to = document.getElementById('mail-share-to').value;
							var why = document.getElementById('mail-share-why').value;
							
							/*
if(subject.length <= 0 || to.length <= 0 || why.length <= 0)
							{
								alert('参数不对');
								return;
							}
*/
							
						    $.ajax({
								type: "post",
								url: "/article/emailShare",
								dataType : 'json',
								data : {
						            'articleID' : '<?php echo $articleInfo['Article']['id'] ?>',
						            'subject' :subject,
						            'to' : to,
						            'why' : why,
						        },
								beforeSend: function(XMLHttpRequest){
									
								},
								success: function(data, textStatus){
									alert('邮件分享成功');
								},
								complete: function(XMLHttpRequest, textStatus){
									
								},
								error: function(){
									
								}
							});
							// dismiss
							$('#myModal').modal('hide');
						}
						
						function test() {
							
						}
					</script>
					
					<div id="myModal" class="modal fade" style="background-color: transparent; padding-top: 100px;">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					        <h4 class="modal-title">分享到邮件</h4>
					      </div>
					      <div class="modal-body">
						      <div class="row">
							      <div class="col-md-3" style="text-align: right;">
								      发送给
							      </div>
							      <div class="col-md-9">
								      <textarea type="text/plain" id="mail-share-to" class="form-control common-control" style="height:80px; width: 80%" placeholder="请输入邮箱地址"></textarea>
							      </div>
						      </div>
						      <div class="row" style="margin-top: 10px;">
							      <div class="col-md-3" style="text-align: right;">
								      主题
							      </div>
							      <div class="col-md-9">
								      <input type="text" id="mail-share-title" class="form-control common-control" name="data[Group][name]" placeholder="请输入主题" style="width: 80%" value="<?php echo $userInfo['User']['name']?>向你推荐文章：《<?php echo $articleInfo['Article']['title'] ?>》">
							      </div>
						      </div>
						      <div class="row" style="margin-top: 10px;">
							      <div class="col-md-3" style="text-align: right;">
								      分享理由
							      </div>
							      <div class="col-md-9">
								      <textarea type="text/plain" id="mail-share-why" class="form-control common-control" style="height:80px; width: 80%" placeholder="请输入分享理由"></textarea>
							      </div>
						      </div>
					      </div>
					      <div class="modal-footer">
						      <button type="button" class="btn btn-primary" onclick="ajaxEmailShare()" data-dismiss="modal">分享</button>
						      <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					
					<button name="mailSend" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    <a href="#" style="color: white">
	                    邮件
                    </a>
                    </button>
                    
                    <button name="imSend" type="button" class="btn btn-primary">
                    <a href="#" style="color: white">
	                    广讯通
                    </a>
                    </button>
	            </span>
	        </div>
	        
	        <section id="comments" style="margin-top: 10px;">
	            <h4 id="comments-title">
	                <?php echo(count($articleReplies)) ?> 条评论
	            </h4>
	            <hr />
	            <div id="commentarea">
	            <?php foreach ($articleReplies as $articleReply): ?>
	            <div>
		            <div style="width: auto; height: 40px;">
			            <a href="#" class="comment-img">
		                    <img alt="" src="<?php echo $articleReply['ArticleReply']['autorportraiturl']; ?>" style="width: 30px; height: 30px;">
		                </a>
		                <div class="comment-author">
		                    <a href="#">
		                        <b><?php echo $articleReply['ArticleReply']['autorname']; ?></b>
		                    </a>
		                    &nbsp;&nbsp;&nbsp;&nbsp;
		                    <a>
		                        <time datetime="2013-02-26T13:18:47+00:00">
		                            <?php echo $articleReply['ArticleReply']['time']; ?>
		                        </time>
		                	</a>
		                </div>
		            </div>
	                <!-- end .comment-meta -->
	                <div class="comment-body" style="height: auto; min-height: 30px;">
	                    <p>
	                        <?php echo $articleReply['ArticleReply']['content']; ?>
	                    </p>
	                </div>
	                <!-- end of comment-body -->
	            </div>
	            <hr />
	            <?php endforeach; ?>
	            </div>
	            
	            <script type="text/javascript">
				    function validate_form() {
			        	var groupname = document.getElementById('commentcontent').value;
			        	
			            if (groupname != null && groupname != '') 
			            {
				            commentarticle();
			            }
				    }
				   
				 	function commentarticle() {
					    $.ajax({
							type: "post",
							url: "/article/commentArticle",
							dataType : 'json',
							data : {
					            'data[ArticleReply][content]' : document.getElementById('commentcontent').value,
					            'data[ArticleReply][belongid]' : document.getElementById('commentarticleid').value
					        },
							beforeSend: function(XMLHttpRequest){
								
							},
							success: function(data, textStatus){
								updatecomments(data);
								exchange(document.getElementById("commentarea"));
							},
							complete: function(XMLHttpRequest, textStatus){
								
							},
							error: function(){
								
							}
						});
					}
					
					function updatecomments(data) {
						var commentDiv = document.getElementById('commentarea');
						var currentHtml = "";
						
						var index = 1;
						for(index in data)
						{
							if (!data[index]) break;
							currentHtml += '<div><div style="width: auto; height: 40px;"><a href="/users/view/'+data[index].ArticleReply.autorid+'" class="comment-img"><img alt="" src="'+data[index].ArticleReply.autorportraiturl+'" style="width: 30px; height: 30px;"></a><div class="comment-author">';
							currentHtml += '<a href="/users/view/'+data[index].ArticleReply.autorid+'"><b>'+data[index].ArticleReply.autorname+'</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a><time datetime="2013-02-26T13:18:47+00:00">';
								                    
							currentHtml += data[index].ArticleReply.time+'</time></a></div></div><div class="comment-body" style="height: auto; min-height: 30px;"><p>';
							currentHtml += data[index].ArticleReply.content+'</p></div></div><hr />';
						}
						commentDiv.innerHTML = currentHtml;
						
						var count = Number(index) + 1;
						document.getElementById('comments-title').innerHTML = count+"条评论";
						document.getElementById('commentcontent').value = '';
						document.getElementById('reply-count').innerHTML = count;
						/*
	for(var i=0; i<data.length; i++)
						
	*/
					}
				</script>
	            
	            <div id="respond">
	                <h4>
	                    发表评论
	                </h4>
	                <div class="cancel-comment-reply">
	                    <a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">
	                        取消评论
	                    </a>
	                </div>
                    <div id="commentcontentdiv" style="min-height: 160px;">
                        <label for="comment">
                            内容
                        </label>
                        <br />
                        <textarea class="col-md-12" name="data[ArticleReply][belongid]" id="commentarticleid" style="display: none;"><?php echo $articleInfo['Article']['id']; ?></textarea>
                        <textarea class="col-md-12" name="data[ArticleReply][content]" id="commentcontent" cols="58" rows="6"></textarea>
                    </div>
                    <span class="emotion">表情</span>
                    <div style="margin-top: 10px;">
	                    <p class="allowed-tags">
	                        你可以使用如下HTML标签
	                        <div>
	                        <small>
	                            <code>
	                                &lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt;
	                                &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del
	                                datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt;
	                            </code>
	                        </small>
	                        </div>
	                    </p>
                    </div>
                    <div>
                        <input class="btn btn-primary" type="button" onclick="validate_form()" value="评论">
                    </div>
	            </div>
	        </section>
			<!-- end of comments -->
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					关于作者
		       	</div>
		       	
	   			<div class="panel-body">
		   			<div style="width: 100%; height: 80px">
			            <div style="width:40%; height:100%; float:left;">
				            <img src="<?php echo $author['User']['portraiturl'] ?>" style="width:60px; height:70px; margin-top: 5px; margin-left: 10px;" />
			            </div>
			            <div style="width:60%; height:100%; float:right;">
				            <b>
				            	<a href="/users/view/<?php echo $author['User']['id'] ?>" title="<?php echo $author['User']['name'] ?>">
			                        <?php echo $author['User']['name'] ?>
			                    </a>
			                </b>
			                <br />
			                <b>
			                	<a href="/errors/error/3" style="color: gray;"> <?php echo $author['User']['dept'] ?></a>
			                </b>
			                <br />
			                <b>
				            	<a href="/errors/error/3" style="color: gray;"> <?php echo $author['User']['office'] ?></a>
			                </b>
			            </div>
		            </div>
	            </div>
	   		</div>
	   		
	   		<div class="panel panel-default">
				<div class="panel-heading">
					作者最新文章
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul class="media-list">
			   			<?php foreach ($latestArticles as $article): ?>
			   			<li class="media">
							<div class="media-body">
							    <a href="<?php echo '/article/view/' . $article['Article']['id']; ?>">
									<h4 class="media-heading">
										<?php
											$tempTitle = $article['Article']['title'];
											$tempTitle = cut_str($tempTitle, 100, true);
											echo $tempTitle;
										?>
									</h4>
							    </a>
							</div>
							<hr style="margin-top: 10px; margin-bottom: 0px;" />
						</li>
						<?php endforeach; ?>
					</ul>
	            </div>
	   		</div>
		</div>
	</div>
</div>
<br />

<style type="text/css">
	img { max-width: 100%; }
</style>

<script type="text/javascript" src="/app/webroot/qqface/js/jquery.min.js"></script>
<script type="text/javascript" src="/app/webroot/qqface/js/jquery.qqFace.js"></script>
<script type="text/javascript">
$(function(){
	$('.emotion').qqFace({
		id : 'facebox', 
		assign:'commentcontent', 
		path:'/app/webroot/qqface/arclist/'	//表情存放的路径
	});

	exchange(document.getElementById("commentarea"));
});

function exchange(container)
{
	var str = container.innerHTML;
	container.innerHTML = replace_em(str);
}

function replace_em(str){
	// str = str.replace(/\</g,'&lt;');
	// str = str.replace(/\>/g,'&gt;');
	// str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/app/webroot/qqface/arclist/$1.gif" border="0" />');
	return str;
}
</script>