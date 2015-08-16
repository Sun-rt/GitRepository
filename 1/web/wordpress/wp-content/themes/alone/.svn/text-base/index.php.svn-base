<?php get_header(); ?>
			<div class="content">
		
					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php else : ?>
						<div class="post">
							<p>Sorry, there were no posts found.</p>
						</div><!-- end post -->
					<?php endif; ?>

			<div class="clear"></div>

					<!-- 分页导航 开始-->
				<div class="footernavi">
					<span class="newer footerlink"><?php previous_posts_link('上一页'); ?></span>
					<span class="older footerlink"><?php next_posts_link('下一页'); ?></span>
				</div>
					<!-- 分页导航 结束-->
			</div><!-- #content -->
			
			<div class="clear"></div>
	

<?php get_footer(); ?>