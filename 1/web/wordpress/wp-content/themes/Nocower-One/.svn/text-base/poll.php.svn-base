<?php
/*
	Template Name: poll页面
*/
get_header(); ?>


<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/poll.css" />
<div class="poll-container">
	<div class="row">
		<?php while (have_posts()) : the_post(); ?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1" style="margin-bottom: 30px">
				<br />
				<h5>"<?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?>先生/女士您好，感谢您对XX产品的支持，为了帮助您尽快准确的联系到该产品的生产厂家，需要您填写一部分问卷调查"</h5>
			</div>
		</div>
		<article class="poll-article-content">
			<div class="row">
				<div class="col-md-8 col-md-offset-1">
					<?php the_content(); ?>
				</div>
				
				
			</div>
		</article>
		<script src="<?php bloginfo('template_url'); ?>/js/polls.js"></script>
		<div class="row">
			
			<div class="col-md-6 col-md-offset-6">
				<button onclick="submitPolls()" class="btn  submit_btn">提交</button>
			</div>
			<div class="col-md-6 col-md-offset-1">

				<br />
				<h5>结束语："感谢您的耐心填写，我们会将您的信息尽快交给厂商"</h5>
				<br />
			</div>
		</div>
		<?php endwhile;  ?>
	</div>
</div>

<?php get_footer(); ?>