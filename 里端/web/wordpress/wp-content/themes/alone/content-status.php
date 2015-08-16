<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package WordPress
 * @subpackage WindyRomantic
 * @since WindyRomantic 1.0
 */
?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="article">
			<header class="statusheader">
				<div class="statusavatar">
					<?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
				</div>
				
			</header>
			
				<div class="status-content">
					<div class="statusdate">
						<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'windyromantic' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></h2>
					</div>
					<?php the_content( __( '<span class="meta-nav" title="继续阅读"></span>' )); ?>
				</div><!-- .entry-content -->

				<div class="clear"></div>
		</div><!-- .article -->
	</div><!-- #post -->
