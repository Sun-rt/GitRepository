<?php get_header(); ?>
<div class="container">
		<div class="row">
			<!--h3><a href="<?php echo get_category_link( get_cat_ID( single_cat_title('',false) ) ); ?>"><?php single_cat_title() ?></a></h2-->
			<!--?php if ( category_description() ) echo '<div class="archive-header-info">'.category_description().'</div>'; ?-->
		
		</div>

		<?php include( 'modules/excerpt.php' ); ?>
		
</div>
<?php  get_footer(); ?>