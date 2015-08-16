<?php $options = get_option('ice_options');
	if( has_post_format( 'status')) { //Status~?> 
		<div class="status post">
			<div class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></div>
			<h2 class="statusavatar left">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
					<?php echo get_avatar( get_the_author_email(), '42' ); ?></a>
			</h2>
			<div class="status-content left"> <?php the_content();?></div>
			<div class="clear"></div>
			<span class="status-time right"><?php the_date() ?><?php edit_post_link('[Edit]',' | ','');?></span>
		</div>
<?php } else{ //Default?>

<div id="post-<?php the_ID();?>" class="post">
	
	<div class="postcon">
		<div class="postinfo">
			<div class="postavatar left"><?php echo get_avatar( get_the_author_email(), '48' ); ?></div>
			<div class="posttitle"><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php the_title();?></a></div>
			<div class="postdesc"><?php the_time('Y-m-j'); ?> / <?php the_category(', ');?> / <?php echo guimeng_get_post_views(get_the_ID()); ?> 次围观 / <?php comments_popup_link('没有评论','1 个评论','% 个评论');?><?php edit_post_link('[Edit]',' / ','');?></div>
		</div><div class="clear"></div>
		
		<span class="entry">
			<?php the_content(); ?>
			<div class="warning codei"><div class="box-content">本博客所有文章如无特别注明均为原创。<br>
复制或转载请以超链接形式注明转自<a href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>，原文地址《<a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title();?></a>》</div></div>
		</span>
	</div>

	<?php if($options['relatedpost']) {?>
	<div class="relatebar">	
	<span class="relatetitle">暧昧文章：</span>
	<ul class="cf">	
		<?php $post_num = 3; $exclude_id = $post->ID;$posttags = get_the_tags(); $i = 0;if ( $posttags ) { $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';$args = array('post_status' => 'publish','tag_slug__in' => explode(',', $tags), 'post__not_in' => explode(',', $exclude_id), 'caller_get_posts' => 1, 'orderby' => 'comment_date', 'posts_per_page' => $post_num);query_posts($args); while( have_posts() ) { the_post(); ?><li class="left"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class="relatetime">Posted on <?php the_time('Y.m.j'); ?></span></li>
		<?php $exclude_id .= ',' . $post->ID; $i ++;} wp_reset_query();}if ( $i < $post_num ) { $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';$args = array('category__in' => explode(',', $cats), 'post__not_in' => explode(',', $exclude_id),'caller_get_posts' => 1,'orderby' => 'comment_date','posts_per_page' => $post_num - $i);query_posts($args);while( have_posts() ) { the_post(); ?> <li class="left"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class="relatetime">Posted on <?php the_time('Y.m.j'); ?></span></li>
		<?php $i ++;} wp_reset_query();}if ( $i  == 0 )  echo '<li>还没有相关文章</li>';?>
	</ul>	
	</div><div class="clear"></div>
	<?php } if($options['sharebar']){ include('sharebar.php'); }?>

	<span class="left" id="pre_post"><?php if (get_previous_post()) { previous_post_link('上一篇： %link','%title',true);} else { echo "上一篇： 没了";} ?></span>
	<span class="right" id="next_post"><?php if (get_next_post()) { next_post_link('上一篇： %link','%title',true);} else { echo "下一篇： 没了";} ?></span>

	<div class="clear"></div>
</div>
<div class="clear"></div>
					
<?php } //End~ ?>