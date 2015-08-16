<?php get_header(); ?>

<div class="container">
	 <div class="col-md-9" id="singleb">
	<div class="panel-group" id="accordion">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $num++; ?>
  <div class="panel panel-default">
    <div class="panel-heading" id="hbjs">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>" id="lbss">
         <?php the_title(); ?>
        </a>
		<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a>
		 <a href="#"><?php the_time('Y.m.d'); ?></a>
      </h4>
    </div>
    <div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse <?php if($num==1) echo 'in'; ?>">
      <div class="panel-body" id="pgs">
	  <img src="<?php echo mmimg(); ?>"/>
        <p><?php the_content(); ?></p>	
		 <p>&nbsp;</p>
		 <p>&nbsp;</p>
		 <p>感谢你的阅读，本文由 猫猫画报 版权所有，转载时请注明出处，违者必究，谢谢你的合作。
注明出处格式：<?php the_author_meta('display_name'); ?></p><a href="<?php bloginfo('url'); ?>"> <?php bloginfo('url'); ?> </a>
 <p>&nbsp;</p>
<div class="op-box mod-cs-opBox">  <span class="pv"><?php echo getPostViews(get_the_ID()); ?></span> <a class="comment-bnt" id="commentBnt" href="#" onclick="return false"> <?php comments_number('0', '1', '%' );?><span class="comment-nub"></span> </a>评论</div>
      </div>
    </div>
  </div>
  <?php endwhile; endif; ?>
  <ul id="pager" class="pagination">
				<?php par_pagenavi(9); ?>
			</ul>
				<!-- Baidu Button BEGIN -->
					<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
					<a class="bds_qzone"></a>
					<a class="bds_tsina"></a>
					<a class="bds_tqq"></a>
					<a class="bds_renren"></a>
					<a class="bds_t163"></a>
					<span class="bds_more"></span>
					<a class="shareCount"></a>
					</div>
					<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=714476" ></script>
					<script type="text/javascript" id="bdshell_js"></script>
					<script type="text/javascript">
					document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
					</script>
					<!-- Baidu Button END -->
					<div class="c"></div>
									</div>
					
					   <div class="c"></div>
					 
			<!-- content_bar end -->

		</article>
		
<div id="commentsbox">
	
<?php comments_template(); ?>

</div>
</div>

<div class="five columns " role="complementary">
	<div id="right">
		
		<!-- Sidebar widgets -->
	

</div><div class="col-md-3">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('side') ) : ?><?php endif; ?>
					
			</div>
			
</div>



	  </div>
	  
			



	 </div>
	 
	
				
<?php get_footer(); ?>