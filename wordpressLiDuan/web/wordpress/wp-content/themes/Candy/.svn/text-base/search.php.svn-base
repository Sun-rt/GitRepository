<?php get_header(); ?>
	
	
	<div class="container">
	 <div class="col-md-9">
	<div class="panel-group" id="accordion">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $num++; ?>

  <div class="panel panel-default">
    <div class="panel-heading" id="hbjs">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>" id="lbss">
         <?php the_title(); ?>
        </a>
		<a href="<?php the_permalink(); ?>"><?php the_author_meta('display_name'); ?></a>
		 <a href="<?php the_permalink(); ?>"><?php the_time('Y.m.d'); ?></a>
      </h4>
    </div>
    <div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse <?php if($num==1) echo 'in'; ?>">
      <div class="panel-body">
	  <a href="<?php the_permalink(); ?>"><img src="<?php echo mmimg(); ?>"/></a>
      <?php the_content(); ?>
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
			

<div class="row" id="lbpm">
<?php query_posts('showposts=4&orderby=rand'); ?>
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="col-md-3">
 
    <a href="<?php the_permalink(); ?>" class="thumbnail">
    <img src="<?php echo mmimg(); ?>"/>
    </a>
  </div>
  <?php endwhile; endif; ?>

</div>

	 </div>
	 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php get_footer(); ?>