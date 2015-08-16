<?php get_header(); ?>
<div class="container">
	<div class="row">
		<?php while (have_posts()) : the_post(); ?>
		<header class="article-header">
			<h1 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
		</header>
		<article class="article-content">
			<div class="row">
				<div class="col-md-6 col-md-offset-4">
					<?php the_content(); ?>
				</div>
			</div>
		</article>
		<?php comments_template('', true); ?>
		<?php endwhile;  ?>
	</div>
</div>
<?php get_footer(); ?>