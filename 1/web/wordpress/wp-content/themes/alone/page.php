<?php get_header(); ?>
			<div class="singlecontent">
				<div class="article">
					<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

					<div class="content">
						<h2 class="entry-title">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						<div class="post_meta">
							<span class="category"><?php the_category(', '); ?></span>
						</div>
						<?php the_content(); ?>
					</div>

						<?php else : ?>
					    <div class="errorbox">
					        没有文章！
					    </div>
					    <?php endif; ?>
				</div><!-- article -->
			</div><!-- singlecontent -->

			<div class="clear"></div>
			<?php comments_template(); ?>

<?php get_footer(); ?>