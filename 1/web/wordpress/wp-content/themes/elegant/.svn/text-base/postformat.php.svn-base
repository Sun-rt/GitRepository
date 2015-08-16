<?php if( has_post_format( 'status' )) { //Status~?> 
<tr><td>
	<div class="status post">
		<div class="statusmain">
			<h2 class="statusavatar statusindex left">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
					<?php echo get_avatar( get_the_author_email(), '42' ); ?></a>
			</h2>
			<div class="status-content left"> <?php the_content();?></div>
		</div>
		<div class="clear"></div>
		<span class="status-time right">
			<?php the_date() ?> | <?php comments_popup_link('评论(0)', '评论(1)', '评论(%)'); ?><?php edit_post_link('[Edit]',' | ','');?>
		</span>
	</div>
</tr></td>
<?php } else{ //Default~?>
<tr><td>
	<div id="post-<?php the_ID();?>" class="post">
	  <div class="post_header">
		<p class="title">
		<a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title();?></a> 
		<?php edit_post_link(' [Edit]','<span class="postedit">','</span>');?>
		</p>
		<p class="postmeta">
			<span class="postdate"><?php the_time('Y.m.j'); ?></span> /
			<span class="postcomm"><?php comments_popup_link('没有评论','1 评论','% 评论');?></span> /
			<span class="postcat"><?php the_category(', ');?></span> /
			<span class="postaut"><?php the_author();?></span>
		</p>
	  </div>
	<div class="clear"></div>
		
		<div class="thumb left"><?php if ( has_post_thumbnail()) : ?><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a><?php endif; ?></div>

		<div class="entry"><?php echo cut_str(strip_tags(apply_filters('the_content',$post->post_content)),200); ?></div>
		<div class="clear"></div>
	</div><div class="clear"></div>
</tr></td>
<?php } //End~?>