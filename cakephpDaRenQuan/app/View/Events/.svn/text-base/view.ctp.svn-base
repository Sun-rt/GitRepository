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
					<img class="group-top-portrait" src=<?php echo $event['Group']['portraiturl'];?> alt="placehold">
				</div>
				<div class="group-top-name">
					<h3>
						<?php echo $event['Group']['name']; ?>
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
						        'groupId':'<?php echo $event['Group']['id']; ?>',
						        'groupName':'<?php echo $event['Group']['name']; ?>',
						        'portraitUrl':'<?php echo $event['Group']['portraiturl']; ?>',
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
						        'groupId':'<?php echo $event['Group']['id']; ?>',
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
				<a href="/groups/view/<?php echo $event['Group']['id']; ?>" class="group-top-submenu active-menu">
					<img src="/app/webroot/img/group-home.png" />
					<h6 style="margin-top: 5px;">首页</h6>
				</a>
				<a href="/groups/viewarticle/<?php echo $event['Group']['id']; ?>" class="group-top-submenu">
					<img src="/app/webroot/img/group-article.png" />
					<h6 style="margin-top: 5px;">文章</h6>
				</a>
				<a href="/groups/viewevent/<?php echo $event['Group']['id']; ?>" class="group-top-submenu">
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
					<li><a href="/groups/view/<?php echo $event['Group']['id'] ?>" title=""><?php echo $event['Group']['name'] ?></a></li>
					<li class="active"><span><?php echo $event['Event']['title'] ?></span></li>
			    </ol>
			</div>
		</div>
	</div>
	
	<div class="row" style="margin-bottom: 20px;">
		<div class="col-md-1">
		</div>
		<div class="col-md-7">
			<div>
				<h3 style="margin-top: 10px;">
		            <a>
		                <?php echo $event['Event']['title'] ?>
		            </a>
	        	</h3>
	        	<div>
		            <span>
		            	<a href="/users/view/<?php echo $event['Event']['autorid'] ?>">
		                <?php echo $event['Event']['autorname'] ?></a>&nbsp;创建于&nbsp;
		            </span>
		            <span class="date">
		                <?php echo $event['Event']['time'] ?>&nbsp;&nbsp;
		            </span>
		            <span class="category">
	                    <a href="#" title="View all posts in Server &amp; Database">
	                        <?php echo $event['Category']['name'] ?>&nbsp;&nbsp;
	                    </a>
					</span>
		            <!-- <span class="comments">
		                <a title="Comment on Integrating WordPress with Your Website">
		                    <?php echo "浏览(".$event['Event']['visitcount'].")" ?>&nbsp;&nbsp;
		                </a>
		            </span>
		            <span class="comments">
		            	<a>
                    		<?php echo "赞(". $event['Event']['supportcount'].")" ?>&nbsp;&nbsp;
		            	</a>
					</span> -->
		            <span class="comments">
		                <a title="">
		                    <?php echo "评论(<b id='reply-count'>".$event['Event']['replycount']."</b>)" ?>&nbsp;&nbsp;
		                </a>
		            </span>
		            <span class="category">
		                <a href="/errors/error/3" title="">
		                    分享
		                </a>
		            </span>
					&nbsp;&nbsp;
		            <span>
		            	<?php 
			            if ($isAuthor)
			            {
			            	echo '<a href="/events/edit/'.$event['Event']['id'].'">编辑</a>';
			            }
			            ?>
		            </span>
		        </div>
		        <!-- end of post meta -->
		        
		        <div id="articleContent" style="margin-top: 30px;">
		        	<div style="width: 100%; height: 285px;">
			            <div style="width:35%; height: 100%; float: left;">
				            <img src="<?php echo $event['Event']['eventimageurl'] ?>" style="width:100%; height:100%;"/>
				        </div>
				        
			            <div style="width:63%; height:100%; float:right;">
				            <b>活动地点：</b><?php echo $event['Event']['location'] ?><hr />
				            <b>活动时间：</b><?php echo $event['Event']['begintime'] ?>&nbsp;&nbsp;至&nbsp;&nbsp;<?php echo $event['Event']['endtime'] ?><hr />
				            <b>截止时间：</b><?php echo $event['Event']['applyendtime'] ?><hr />
				            <b>活动评论：</b><?php echo $event['Event']['replycount'] ?>条<hr />
				            <b>来自：</b><a href="/groups/view/<?php echo $event['Group']['id'] ?>" title=""><?php echo $event['Group']['name'] ?></a><hr />
			            </div>
		            </div>
		            
		            <h4 style="margin-top: 20px;">
			            活动内容
		            </h4>
		            <div style="margin-top: 20px;">
		            	<?php echo $event['Event']['content']; ?>
		            </div>
		            <hr />
		            <div style="margin-top: 20px;">
			            <script>
						 	function ajaxApply(){
							    $.ajax({
							        url : "/events/apply/<?php echo $event['Event']['id'] ?>",
							        dataType : 'json',
							        success : function(applyCount, textStatus) {
								        document.getElementById("apply-it").innerHTML = "你已报名："+applyCount+"人";
								        document.getElementById("unapply_btn").style.display = "";
							        },
							    });
						    }

						    function ajaxCancelApply(){
							    $.ajax({
							        url : "/events/unapply/<?php echo $event['Event']['id'] ?>",
							        dataType : 'json',
							        success : function(applyCount, textStatus) {
								        document.getElementById("apply-it").innerHTML = "报名："+applyCount+"人";
								        document.getElementById("unapply_btn").style.display = "none";
							        },
							    });
						    }
						</script>
					    <div class="btn btn-success">
					        <span class="like-it " id="apply-it" onclick="ajaxApply();">
				                <?php 
				                    if($eventOtherInfo['applied'])
				                    {
					                    echo '你已报名：'.$eventOtherInfo['participantCount'].'人';
				                    }
				                    else
				                    {
					                    echo '报名：'.$eventOtherInfo['participantCount'].'人';
				                    }
				                ?>
					        </span>
					    </div>
					    <?php 
		                    if($eventOtherInfo['applied'])
		                    {
			                    echo '<div id="unapply_btn" class="btn btn-danger"><span class="like-it " onclick="ajaxCancelApply();">取消报名</span></div>';
		                    }
		                    else
		                    {
		                    	echo '<div id="unapply_btn" class="btn btn-danger" style="display:none;"><span class="like-it " onclick="ajaxCancelApply();">取消报名</span></div>';
		                    }
		                ?>
		               	<div style="float: right;">
		               		<strong>
		                    分享到:&nbsp;&nbsp;
		                	</strong>
						    <button name="mailSend" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
		                    <a href="#" style="color: white">
			                    邮件
		                    </a>
		                    </button>
		               	</div>
					    
					    <script>
						function ajaxEmailShare()
						{
							var subject = document.getElementById('mail-share-title').value;
							var to = document.getElementById('mail-share-to').value;
							var why = document.getElementById('mail-share-why').value;
							
						    $.ajax({
								type: "post",
								url: "/events/emailShare",
								dataType : 'json',
								data : {
						            'eventID' : '<?php echo $event['Event']['id'] ?>',
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
								      <input type="text" id="mail-share-title" class="form-control common-control" name="data[Group][name]" placeholder="请输入主题" style="width: 80%" value="<?php echo $userInfo['User']['name']?>向你推荐活动：《<?php echo $event['Event']['title'] ?>》">
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
		            </div>
		            <hr />

		            <section class="articles-list" style="min-height: 130px; height: auto; display: block;">
						<h4>
							已报名&nbsp;&nbsp;
							<form action="/events/export" method="post" style="display: inline;">
								<input type="text" hidden="true" name="eventid" value="<?php echo $event['Event']['id'] ?>" />
								<button class="btn btn-primary" type="submit">
									导出报名列表
								</button>
							</form>
						</h4>
						<?php foreach ($eventOtherInfo['participants'] as $user): ?>
			            <div class="event-part" style="text-align:center">
							<img src="<?php echo $user['User']['portraiturl']; ?>" style = "width:40px;height=40px">
							<br />
							<div class="event-person-name">
								<b><a href="/users/view/<?php echo $user['User']['id']; ?>"><?php echo $user['User']['name']; ?></a></b>
							</div>
						</div>
			            <?php endforeach; ?>
					</section>
		        </div>
		        
		        <section id="comments">
		            <h4 id="comments-title">
		                <?php echo(count($eventReplies)) ?> 条评论
		            </h4>
		            <hr />
		            <div id="commentarea">
		            <?php foreach ($eventReplies as $eventReply): ?>
		            <div>
			            <div style="width: auto; height: 40px;">
				            <a href="/users/view/<?php echo $eventReply['EventReply']['autorid']; ?>" class="comment-img">
			                    <img alt="" src="<?php echo $eventReply['EventReply']['autorportraiturl']; ?>" style="width: 30px; height: 30px; max-width: 30px; max-height: 30px;">
			                </a>
			                <div class="comment-author">
			                    <a href="/users/view/<?php echo $eventReply['EventReply']['autorid']; ?>">
			                        <b><?php echo $eventReply['EventReply']['autorname']; ?></b>
			                    </a>
			                    &nbsp;&nbsp;&nbsp;&nbsp;
			                    <a>
			                        <time datetime="2013-02-26T13:18:47+00:00">
			                            <?php echo $eventReply['EventReply']['time']; ?>
			                        </time>
			                	</a>
			                </div>
			            </div>
		                <!-- end .comment-meta -->
		                <div class="comment-body" style="height: auto; min-height: 30px;">
		                    <p>
		                        <?php echo $eventReply['EventReply']['content']; ?>
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
								url: "/events/commentevent",
								dataType : 'json',
								data : {
						            'data[EventReply][content]' : document.getElementById('commentcontent').value,
						            'data[EventReply][belongid]' : document.getElementById('commentarticleid').value
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
								currentHtml += '<div><div style="width: auto; height: 40px;"><a href="/users/view/'+data[index].EventReply.autorid+'" class="comment-img"><img alt="" src="'+data[index].EventReply.autorportraiturl+'" style="width: 30px; height: 30px; max-width: 30px; max-height: 30px;"></a><div class="comment-author"><a href="/users/view/'+data[index].EventReply.autorid+'">';
								currentHtml += '<b>'+data[index].EventReply.autorname+'</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a><time datetime="2013-02-26T13:18:47+00:00">';
									                    
								currentHtml += data[index].EventReply.time+'</time></a></div></div><div class="comment-body" style="height: auto; min-height: 30px;"><p>';
								currentHtml += data[index].EventReply.content+'</p></div></div><hr />';
							}
							commentDiv.innerHTML = currentHtml;
							
							var count = Number(index) + 1;
							document.getElementById('comments-title').innerHTML = count+"条评论";
							document.getElementById('commentcontent').value = '';
							document.getElementById('reply-count').innerHTML = count;
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
		                    <div id="commentcontentdiv">
		                        <label for="comment">
		                            内容
		                        </label>
		                        <br />
		                        <textarea class="col-md-12" name="data[EventReply][belongid]" id="commentarticleid" style="display: none;"><?php echo $event['Event']['id']; ?></textarea>
		                        <textarea class="col-md-12" name="data[EventReply][content]" id="commentcontent" cols="58" rows="6"></textarea>
		                    </div>
		                    <span class="emotion">表情</span>
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
		                    <div>
		                        <input class="btn btn-primary" type="button" onclick="validate_form()" value="评论">
		                    </div>
		            </div>
		        </section>
		        <!-- end of comments -->
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					活动创建者
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
	   		
		</div>
	</div>
</div>

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