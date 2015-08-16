<?php get_header(); ?>

	<div class="content singlepage">
		<div class="postlist">
			<?php if(have_posts()){while(have_posts()){the_post();?>
			<div id="post-<?php the_ID();?>" class="post">
				<div class="postcon">
					<h2 class="title"><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title(); ?>">
					<?php the_title();?></a></h2>
					<span class="entry">
						<?php the_content(); ?>
					</span>
				</div>

				<div class="clear"></div>
				<?php if($options['sharebar']){ include('sharebar.php'); } ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<?php }?>
			<?php }else{ include('404page.php'); }?>
		</div>

		<?php comments_template('', true); ?>
	</div>

<?php get_footer(); ?>