<?php  get_header(); ?>
<script>
$(document).ready(function(){
	$("#itemexcerpt p").each(function(i,e){
		var content = $(this).html();
		var flag = false;
		while(content.replace( /[^\x00-\xff]/g ,"xx").length > 500){
			content = content.substring(0,content.length - 1);
			flag = true;
		}
		if(flag){
			content += "...";
		}
		$(this).html(content);
	});
});
</script>
<div class="container">
	<?php

	$args = array(
    // 以下代码中设置显示文章的ID
    	'post__in'   => array(69,66,65,64),
    	'showposts' => 4
	);
     query_posts($args);
	 $count = 1?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<?php if($count%2 > 0){?>
	<div class="row" id="postitem">
		<div class="col-md-4" id="descript">
			<?php descript($post->ID)?>
		</div>
		<div class="col-md-8 rightimg" id="thumbnail"> 
			<a href="<?php echo the_permalink();?>"><img  src="<?php echo mmimg(); ?>"/></a>
		</div>
	</div>
	<?php }else{?>
	<div class="row" id="postitem">
			<div class="col-md-8 leftimg" id="thumbnail"> 
				<a href="<?php echo the_permalink();?>"><img  src="<?php echo mmimg(); ?>"/></a>
			</div>
			<div class="col-md-4" id="descript">
				<?php descript($post->ID)?>
			</div>
		</div>
		<?php } $count++;?>
	
	<?php endwhile; endif; ?>
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<p ><button class="btn btn-default btn pull-right"   onclick="window.location.href='<?php echo get_settings('home')."/all" ?>'" style="width:80px;height:30px" role="button">更多案例</button></p>
		</div>
	</div>
</div>
<?php get_footer(); ?>