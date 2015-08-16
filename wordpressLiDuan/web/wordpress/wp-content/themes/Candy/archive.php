<?php get_header(); ?>
	
	
	<div class="container">
	 <div class="col-md-9">
	 <h3 class="fltitle"> <a style="color:#999999;" href="<?php bloginfo('url'); ?>">首页 </a> > <?php single_cat_title(); ?></h3>
	<div class="panel-group" id="accordion">
	 
 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php $num++; ?>
 <div class="panel panel-default">
    <div class="panel-heading" id="hbjs">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>" id="lbss">
         <span class="lzt1"><?php the_title(); ?></span>
		 </a>
		 <a style="color: #1AA0E1 ;" class="djck pull-right lzt" href="<?php the_permalink(); ?>"><span class="glyphicon glyphicon-hand-right" style="margin-left:15px;"></span> 点击查看</a>
        
      </h4>
    </div>
    <div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse <?php if($num==1) echo 'in'; ?>">
      <div class="panel-body">
	  <a href="<?php the_permalink(); ?>"></a>
      <?php the_excerpt(); ?>
      </div>
    </div>
  </div>
  <?php endwhile; endif; ?>
   <ul id="pager" class="pagination">
						 <?php par_pagenavi(9); ?>
   </ul>
</div>



	  </div>
	  <div class="col-md-3">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('side') ) : ?><?php endif; ?>
	  </div>
 <div class="c"></div>
<div class="container" id="lbpm">
  <h4 class="rmwz">热门文章</h4>
<?php if (have_posts()) : ?>
						<?php 
						// Create a new filtering function that will add our where clause to the query
						function filter_where( $where = '' ) {
							// posts in the last 30 days
							$where .= " AND post_date > '" . date('Y-m-d', strtotime('-360 days')) . "'";
							return $where;
						};
						$args=array(
							'orderby' => 'meta_value_num','meta_key'=> 'post_views_count','order' => 'DESC','showposts'=>'4','caller_get_posts' => 1
						);
						add_filter( 'posts_where', 'filter_where' );
						$my_query=new WP_Query(
							$args
						);
						remove_filter( 'posts_where', 'filter_where' );
						while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;
						?>

  <div class="col-md-3">
									<div class="xstc" style="display:none;">
									<div class="zitifff">
									 	<?php the_excerpt(); ?>
									 </div>
									</div>
								<a class="img-div" style="display:block; overflow:hidden;" href="<?php the_permalink(); ?>"> <img src="<?php echo mmimg(); ?>"/></a>
								<a style="color:#666; height:35px; overflow:hidden; display:block; padding: 20px 5px;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								
							</div>
 <?php endwhile;?><?php endif;wp_reset_query(); ?>

</div>

	 </div>
	 
	
	
	
	
<?php get_footer(); ?>