
<link href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.css" rel="stylesheet">
<script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.1/js/bootstrap.js"></script>

<div class="container-fluid" style="margin-top: 30px;">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-body">
				<?php echo $why?>
			</div>
			</div>
			
			<div class="panel panel-primary">
			  <div class="panel-heading">
				  <h3 class="panel-title">
					  <?php echo $articleInfo['Event']['title'] ?>
				  </h3>
			  </div>
			  <div class="panel-body">
				  <div>
				  <?php echo $articleInfo['Event']['content']; ?>
				  </div>
				  <div style="width: 100%; height: 285px;">
			            <div style="width:35%; height: 100%; float: left;">
				            <img src="<?php echo $articleInfo['Event']['eventimageurl'] ?>" style="width:100%; height:100%;"/>
				        </div>
				        
			            <div style="width:63%; height:100%; float:right;">
				            <b>活动地点：</b><?php echo $articleInfo['Event']['location'] ?><hr />
				            <b>活动时间：</b><?php echo $articleInfo['Event']['begintime'] ?>&nbsp;&nbsp;至&nbsp;&nbsp;<?php echo $articleInfo['Event']['endtime'] ?><hr />
				            <b>截止时间：</b><?php echo $articleInfo['Event']['applyendtime'] ?><hr />
				            <b>活动评论：</b><?php echo $articleInfo['Event']['replycount'] ?>条<hr />
				            <b>来自：</b><a href="/groups/view/<?php echo $articleInfo['Group']['id'] ?>" title=""><?php echo $articleInfo['Group']['name'] ?></a><hr />
			            </div>
		            </div>
				  <div id="commentarea">
		            <?php foreach ($articleReplies as $articleReply): ?>
		            <div>
			            <div style="width: auto; height: 40px;">
				            <a href="#" class="comment-img">
			                    <img alt="" src="<?php echo FULL_BASE_URL.$articleInfo['Event']['autorname']; ?>" style="width: 30px; height: 30px;">
			                </a>
			                <div class="comment-author">
			                    <a href="#">
			                        <b><?php echo $articleReply['EventReply']['autorname']; ?></b>
			                    </a>
			                    &nbsp;&nbsp;&nbsp;&nbsp;
			                    <a>
			                        <time datetime="2013-02-26T13:18:47+00:00">
			                            <?php echo $articleReply['EventReply']['time']; ?>
			                        </time>
			                	</a>
			                </div>
			            </div>
		                <!-- end .comment-meta -->
		                <div class="comment-body" style="height: auto; min-height: 30px;">
		                    <p>
		                        <?php echo $articleReply['EventReply']['content']; ?>
		                    </p>
		                </div>
		                <!-- end of comment-body -->
		            </div>
		            <hr />
		            <?php endforeach; ?>
		            
		            <div style="display: block; min-height: 25px;">
		            <div>
						<a href='<?php echo FULL_BASE_URL; ?>/article/view/<?php echo $articleInfo['Event']['id'] ?>' >查看全部评论</a>
					</div>
					<div style="float:right">
						<a href='<?php echo FULL_BASE_URL; ?>/article/view/<?php echo $articleInfo['Event']['id'] ?>' >我要评论</a>
					</div>
		            </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>