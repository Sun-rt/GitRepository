<?php get_header(); 
	global $wp_query;
	$curauth = $wp_query->get_queried_object();
?>
<div class="container">
	<div class="row">
		<header class="archive-header"> 
			<h1><?php echo $curauth->display_name.'的案例' ?></h1>
			<?php if ( $curauth->description ) echo '<div class="archive-header-info">'.$curauth->description.'</div>'; ?>
		</header>
		
		<?php include( 'modules/excerpt.php' ); ?>
	</div>
</div>
<?php get_footer(); ?>