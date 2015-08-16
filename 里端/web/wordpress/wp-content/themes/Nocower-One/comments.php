<?php
defined('ABSPATH') or die('This file can not be loaded directly.');

global $comment_ids; 
$comment_ids = array();
foreach ( $comments as $comment ) {
	if (get_comment_type() == "comment") {
		$comment_ids[get_comment_id()] = ++$comment_i;
	}
} 

if ( !comments_open() ) return;

$my_email = get_bloginfo ( 'admin_email' );
$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
$count_t = $post->comment_count;

date_default_timezone_set(PRC);
$closeTimer = (strtotime(date('Y-m-d G:i:s'))-strtotime(get_the_time('Y-m-d G:i:s')))/86400;
?>

<?php  

if ( have_comments() ) { 
?>
<div class="row">
	<div class="col-md-12" style="margin-left:14px">
		<ul class="commentslist">
			<?php wp_list_comments('type=comment&callback=deel_comment_list') ?>
		</ul>
		<div class="pagenav">
			<?php paginate_comments_links('prev_next=0');?>
		</div>
	</div>
</div>
<?php 
} 
?>
<div id="respond" class="row">
	<?php if (!is_user_logged_in() ) { ?>
<div class="col-md-12" style="margin-left:14px">
	<p>
	
		<h4>
			<?php printf('您必须 <a href="%s">登录</a> 才能发表评论！', wp_login_url( get_permalink() ) );?>
		</h4>
	<p>

</div>
	<?php }else{ ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
		<div class="col-md-12" style="margin-left:14px;margin-bottom:5px">
			<div class="comt-box">
				<textarea width ="782px" placeholder="写点什么..." class="input-block-level comt-area" name="comment" id="comment" cols="100%" rows="3" tabindex="1" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
					<div style="float:right">
					
					</div>	
					<div class="comt-tips pull-right"><?php comment_id_fields(); do_action('comment_form', $post->ID); ?></div>	
			</div>
		</div>
		<div class="col-md-12">
			<button class="btn btn-default pull-right" type="submit" name="submit"  tabindex="5"> 添加评论</button>
		</div>
	</form>
	<?php } ?>
</div>
