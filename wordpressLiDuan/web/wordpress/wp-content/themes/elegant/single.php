<?php get_header(); ?>

	<div class="content singlepage">
		<div class="postlist">
			<?php if(have_posts()){while(have_posts()){the_post();
				include('singleformat.php'); } }else{?>
			<div>
				<div class="title">
					<h2>额..神啊！发生神马事了....</h2>
				</div>
				<div class="entry">
					<p>神曰：你要找的东西不在地球上</p>
				</div>
			</div>
			<?php guimeng_set_post_views(get_the_ID()); ?>
			<?php }?>
		</div>

		<?php comments_template('', true); ?>
	</div>

<?php get_footer(); ?>