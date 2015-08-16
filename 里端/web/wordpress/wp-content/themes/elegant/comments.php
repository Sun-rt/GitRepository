<div id="comments">

	<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
	    <?php die('貌似你做了些不该做的……Big brother is watching you！'); ?>
	<?php endif; ?>
	<?php if(!empty($post->post_password)) : ?>
	    <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	    <?php endif; ?>
	<?php endif; ?>
	<?php $i++; ?> 
	
	<?php //trackbacks计数分离
	if (function_exists('wp_list_comments')) {
		$trackbacks = $comments_by_type['pings'];
	} else {
		$trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID));
	}?>

	
		<?php if($comments) : //如果有评论 ?>
		
			<div id="commnents" class="commentsorping">
			
				<div class="commentsays"><?php comments_number('No Response', 'Only One Response', '% Responses' );?></div>
			
				<div class="commentpart">Comment<?php echo (' (' . (count($comments)-count($trackbacks)) . ')'); ?></div>
				<div class="pingpart">Trackback<?php echo (' (' . count($trackbacks) . ')');?></div>
			</div>
	
	
			<?php if ( function_exists('wp_list_comments') ) : //嵌套评论 ?>
			<div class="commentshow">
				<div id="loading-comments"><span class="nimei"><img src="<?php bloginfo('template_directory')?>/images/loading.gif" width="16" height="16"></span>Loading ....</div>
				
				<ul class="commentlist">
				<?php wp_list_comments('type=comment&callback=icecomment&max_depth=10000'); ?>
				</ul>
				
				<nav class="commentnav">
					<?php paginate_comments_links('prev_text=<&next_text=>');?>
				</nav>
			</div>
			<?php else : ?>
					
			<?php endif; ?>
			
			
			<?php if ( ! empty($comments_by_type['pings']) ) : //嵌套ping?>
			<ul class="pingtlist">
					<?php wp_list_comments('type=pings&callback=icepings'); ?>
			</ul>
			<?php else : ?>
			<ul class="pingtlist">
				<li>还没有Trackback</li>
			</ul>
			<?php endif; ?>
									
	<?php else : ?>
	  
	<?php endif; ?>
	
	
	<?php if(comments_open()) : ?>
		<div class="clear"></div>
		<div id="respond">
			<span class="replytitle left">Leave a Reply</span>
			<div id="cancel-comment-reply">
				<?php cancel_comment_reply_link('取消回复') ?>
			</div>
			<div class="clear"></div>

		        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="comm_frm">


		    <?php if(get_option('comment_registration') && !$user_ID) : ?>
			
		        <div class="form-vertical right">
		            <div class="infoerror">
		            您必须 <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a> 才能发表评论！</div>

			                <div class="control-group" style="margin-top:10px;">
			                <div class="controls">
			                <div class="input-prepend" style="width:181px;">
			                <input style="width: 181px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;" type="submit" class="btn btn-primary" tabindex="5" value="提交评论（Ctrl+Enter）" name="submit" id="submit">
			                <?php comment_id_fields(); ?>
					        <?php do_action('comment_form', $post->ID); ?>
			                </div>
			                </div>
			                </div>
							<script type="text/javascript">
								document.getElementById("comment").onkeydown = function SubmitKey(moz_ev)
								{var ev = null;if (window.event){ev = window.event;}else{ev = moz_ev;}if (ev != null && ev.ctrlKey && ev.keyCode == 13){document.getElementById("submit").click();}}
							</script>
							<div class="clear"></div>

		        </div><?php else : ?>
				
				
		            <?php if($user_ID) : ?>
		                <div class="form-vertical">
		                	<div class="infoerror">
		                	你已经登陆为 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">退出登录 &raquo;</a></div>
							<div class="clear"></div>
		                </div>
		    <?php else : ?>


				<div class="form-vertical">

                <div class="control-group">
                <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <input style="width: 141px;" placeholder="昵称（必填）" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1">
                </div>
                </div></div>

                <div class="control-group">
                <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                    <input style="width: 141px;" placeholder="邮箱（必填）" type="email" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2">
                </div>
                </div></div>
                <div class="control-group">
                <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-leaf"></i></span>
                    <input style="width: 141px;" placeholder="网站" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3">
                </div>
                </div></div>

				<div class="clear"></div>

                </div>
				
			<?php endif; ?>

		        <div class="form-vertical">
                <p>
                	<textarea style="width:470px;float:left;margin: 0 15px 10px 10px;height: 140px;" placeholder="您的建议是我们的最大的动力。" id="comment" name="comment" tabindex="1"></textarea>
					<script type="text/javascript">
						document.getElementById("comment").onkeydown = function (moz_ev)
						{var ev = null;if (window.event){ev = window.event;}else{ev = moz_ev;}if (ev != null && ev.ctrlKey && ev.keyCode == 13){document.getElementById("submit").click();}}
					</script>
                </p>
                <div class="clear"></div>
                </div>
				<?php wp_smilies();?>
				
                <div class="control-group">
                <div class="controls">
                <div class="input-prepend" style="width:181px;">
                <input style="width: 165px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;" type="submit" class="btn btn-info" tabindex="5" value="提交评论（Ctrl+Enter）" name="submit" id="submit">
                <?php comment_id_fields(); ?>
		        <?php do_action('comment_form', $post->ID); ?>
                </div>
                </div>
                </div>
				<div class="clear"></div>
		    </form>
		</div>
		    <?php endif; ?>
		<?php else : ?>
		<?php endif; ?>
	
</div>