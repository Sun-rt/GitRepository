<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-offset-2">
				<?php  
					global $wpdb;
    				$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
   					$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
   					$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    				$request .= " ORDER BY term_id asc";
    				$categorys = $wpdb->get_results($request);
					foreach ($categorys as $category) { ?>
							<div class="panel panel-default" style="margin-top: 20px;">
								<div class="panel-heading" id="headbjs">
								<i class="glyphicon glyphicon-tag"></i>
								<span style="color:#fff; margin-left:10px;">
								<a href="<?php echo get_category_link($category->term_id) ?>"><?php echo get_cat_name(''. $category->term_id .'') ?></a>
								</span>
								<a class="pull-right" href="<?php echo get_category_link(''.$category->term_id.''); ?>"> 更多
								</a>
								</div>
								<div class="panel-body">
									<div class="row">
									
									<?php query_posts('cat='.$category->term_id.'&showposts=3'); ?>
									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										<div class="col-md-4 cpxj1">
												<div class="xstc" style="display:none;">
												<div class="zitifff">
												 	<?php the_excerpt(); ?>
												 </div>
												</div>
											<a class="img-div" style="display:block; overflow:hidden;" href="<?php the_permalink(); ?>"> <img src="<?php echo mmimg(); ?>"/></a>
											<a style="color:#999; height:45px; overflow:hidden; display:block; margin: 10px 0px;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											<p>评论: <span class="juhuangse"><?php comments_number('0', '1', '%' );?></span>
											 <span class="pull-right"><span class="juhuangse"><?php the_time('Y.m.d'); ?></span></span>
											</p>
										</div>
									<?php endwhile; endif; ?>
									</div>
								</div>
							</div>			  
				<?php };?>		
			
	</div>
	</div>
	
	<?php get_footer(); ?>