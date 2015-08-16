<?php 
/*
	Template Name: 全部页面
*/
get_header(); ?>
<div class="container">
	<div class="row">
	<?php $count =0 ;?>
		<?php 
		$categorys = getCategorys();
		$categoaysArray =[];
		foreach ($categorys as $category) { 
			array_push($categoaysArray,$category->term_id);
		}
		$args = array(
    // 以下代码中设置显示文章的ID
    	'category__in' => $categoaysArray,
    	'paged'=>$paged
		);
    	 query_posts($args);
		 $max_page = $wp_query->max_num_pages;
		 ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<?php if($count % 3 == 0){?>
      	 <div class="row excerptrow">
			
		 <?php } ?> 
			<div class="col-md-4 " >
			  <div class="col-md-12 excerptitem">		
					<div class="col-md-12 excerptimg" > 
						<a href="<?php the_permalink();?>"> 
							<img src="<?php echo mmimg(); ?>"/>
						</a>
					</div>
					<div class="col-md-12 excerptmeta" >
						<a class="excerpttitle " href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
						<ul class="focus">
							<li class="metaauthor"><i class="glyphicon glyphicon-user"></i><?php if( !is_author() ){ ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author() ?></a><?php } ?></li>												
							<li class="metatime"><i class="glyphicon glyphicon-time"></i><?php if(is_home()) the_time('Y.m.d'); else the_time('Y-m-d'); ?></li>
						</ul>
					</div>		   
				</div>
			</div>		
		<?php if($count % 3 == 2){?>
		</div>
		 <?php } ?> 
		 <?php $count = $count + 1;?>
	  <?php endwhile; ?>	
	</div>
<div class="row">
	<div class="center">
		<?php pagenav();?>
	</div>		
</div>
</div>

<?php get_footer(); ?>