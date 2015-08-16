
<div id="respond_box">
	<div id="respond">
		<h3>添加评论</h3>	
		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link('取消'); ?></small>
		</div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<div class="comment-tip"><p>您必须<a href="<?php echo wp_login_url(); ?>">登录</a>才能评论</p></div>
    <?php else : ?>
    <form action="" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
	  <?php if ( is_user_logged_in() ) : ?>
      <div class="comment-tip"><p>
	  <?php {
$user = wp_get_current_user();
$link = $user->display_name.'  <a href="' . get_settings('siteurl') . '/wp-login.php?action=logout">登出 &raquo;</a>';
echo apply_filters('loginout', $link);
}
?>
	  </p></div>
	  <?php endif; ?>
	<?php endif; ?>
	<?php if ( ! $user_ID ): ?>
	<div id="comment-author-info">
		<p>
			<input type="text" name="author" id="author" class="commenttext" value="<?php echo $comment_author; ?>" size="22" tabindex="1" placeholder="姓名（必填）" required />

		</p>
		<p>
			<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" placeholder="邮件（必填）" required />
		</p>
		<p>
			<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" placeholder="网址" />
		</p>
	</div>
      <?php endif; ?>

		<div><textarea name="comment" id="comment" tabindex="4" cols="50" rows="8" placeholder="毛主席说我们之所以胜利是因为敌人看过从不评论"></textarea></div>
		<div><input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="发  布" /><?php comment_id_fields(); ?>
</div>
		
		<?php do_action('comment_form', $post->ID); ?>
    </form>
	<div class="clear"></div>
    <?php endif; ?>
  </div> 
  </div> 