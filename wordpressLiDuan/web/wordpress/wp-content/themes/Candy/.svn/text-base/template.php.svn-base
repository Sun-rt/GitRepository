<?php 
/*
	Template Name: 模版页面
*/
get_header(); ?>
<div class="container">
	<div class="col-md-8 col-sm-offset-2">
	   <div class="panel-group" id="accordion">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $num++; ?>
		  <div class="panel panel-default">
		    <div class="panel-heading" id="hbjs">
		      <h4 class="panel-title">
		        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>" id="lbss">
		         <?php the_title(); ?>
		        </a>
		      </h4>
		    </div>
		    <div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse <?php if($num==1) echo 'in'; ?>">
		      <div class="panel-body" id="pgs">
			  <img src="<?php echo mmimg(); ?>"/>
		        <p><?php the_content(); ?></p>	
		      </div>
		    </div>
		  </div>
		  <?php endwhile; endif; ?>					
       </div>
	</div>
</div>
<?php  get_footer(); ?>