<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Hey guy WTF are you doing?');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('本文已被密码保护，请输入密码以查看评论。'); ?></p>
	<?php
		return;
	}
?>


<?php
       if (function_exists('wp_list_comments')) { $trackbacks = $comments_by_type['pings']; }
       else { $trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID)); }
?>

<section id="comments">
<?php if ( comments_open() ) : ?>

<?php get_template_part('commentform');?>
<?php else : ?>
<p class="nocommentsyet"></p>
<?php endif; ?>

<?php if ( have_comments() ) : ?>

<div id="comments-body">
<ol class="commentlist">
<?php wp_list_comments('type=all&callback=themecomment&max_depth=500'); ?>
</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<div id="commentnav" data-post-id="<?php echo $post->ID?>"><?php paginate_comments_links('prev_text=« Prev&next_text=Next »');?></div>
<?php endif; ?>
</div>
<?php else : ?>

<?php endif; ?>


</section>
