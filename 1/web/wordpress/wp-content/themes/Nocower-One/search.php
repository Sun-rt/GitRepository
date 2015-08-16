<?php get_header(); ?>
<div class="container">
	<div class="row">
		<?php if ($s=="") :?>
			
		<?php elseif ( !have_posts() ) : ?>
			<!--header class="archive-header"> 
				<h1>没有找到有关“<?php echo $s; ?>”的内容</h1>
				
			</header-->
			<!--?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
				    'showposts' => 4,
				    'caller_get_posts' => 1,
				    'paged' => $paged
				);
				query_posts($args);
			?-->
			<!--?php include( 'modules/excerpt.php' ); ?-->
		<?php else: ?>
			<!--header class="archive-header"> 
				<h1>有关【<?php echo $s; ?>】的内容</h1>
			</header-->
			<?php include( 'modules/excerpt.php' ); ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer();
 ?>