<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<h2 class="entry-title">
			<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<div class="post_meta">
			<span class="date"><?php the_time('Y年n月j日') ?></span>
		</div>
	</div>
	<div class="entry-content">
		<?php the_content( __( '<span class="meta-nav" title="继续阅读"></span>' )); ?>
	</div>
	<div class="readmore">
	<a href="<?php echo get_permalink(); ?>#comments">发表评论</a>
	</div>
</div><!-- end post -->


