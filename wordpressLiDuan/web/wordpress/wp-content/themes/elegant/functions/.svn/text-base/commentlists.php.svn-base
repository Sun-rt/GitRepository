<?php

	add_filter('get_comments_number', 'comment_count', 0);function comment_count( $count ) {if ( ! is_admin() ) {global $id;$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));return count($comments_by_type['comment']);} else {return $count;}}
	
	
	function icecomment($comment, $args, $depth) { $GLOBALS['comment'] = $comment;global $commentcount;if(!$commentcount) { $page = get_query_var('cpage')-1;$cpp=get_option('comments_per_page');$commentcount = $cpp * $page;}
	
?>


<li id="comment-<?php comment_ID() ?>" <?php comment_class('commenttips',$comment_id,$comment_post_ID); ?> >
	<div class="commnetdiv cf">
		<div class="gravatar">
			<?php echo get_avatar( get_comment_author_email(), '40'); ?>
		</div><!-- comment-author -->
		<div class="commenttext cf">
		
			<?php $options = get_option('deve_options'); ?>
			<?php if(is_page($options['guestname'])):?>
			<?php else: ?>
			<span class="commentcount right"><a href="#comment-<?php comment_ID() ?>"><?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);} ?></a></span>
			<?php endif;?>
			
			
			<div class="commentp">	
				<span class="commentid"><?php comment_author_link();?></span> : <?php comment_text() ?>
			</div>
			<div class="comment-meta">
				<span class="commenttime left"><?php comment_date('Y.m.j') ?> <?php comment_time('H:i'); ?>   <?php edit_comment_link(' [edit]'); ?></span> 
				<?php if ($comment->comment_approved == '0') : ?>
				<span class="moderation left"><?php _e('Your comment is awaiting moderation.') ?></span>
				<?php endif; ?>
				<span class="reply right"><?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
			</div><!--comment-meta-->
		</div><!-- commenttext -->
		
	</div>
  <?php
}
		////////嵌套ping
		function icepings($comment, $args, $depth) {
			   $GLOBALS['comment'] = $comment;
		?>
			<li id="comment-<?php comment_ID(); ?>">
				<div class="pingdiv">
					<?php comment_author_link(); ?>
				</div>
		<?php }
///////////////////// Commentlist结束////////////////////////
	
	
?>