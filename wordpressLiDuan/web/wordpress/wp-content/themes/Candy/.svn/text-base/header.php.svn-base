<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php bloginfo('template_directory'); ?>/css/media.css" rel="stylesheet">
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/cat.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<title>
	<?php if (is_single() || is_page() || is_archive() || is_search()) { ?><?php wp_title('',true); ?> - <?php } bloginfo('name'); ?><?php if ( is_home() ){ ?> - <?php bloginfo('description'); ?><?php } ?><?php if ( is_paged() ){ ?> - <?php printf( __('Page %1$s of %2$s', ''), intval( get_query_var('paged')), $wp_query->max_num_pages); ?><?php } ?>
</title>
<?php 
	if (is_home()){ 
		$description     = get_option('mao10_description');
		$keywords = get_option('mao10_keywords');
	} elseif (is_single() || is_page()){    
		$description1 =  $post->post_excerpt ;
		$description2 = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");
		$description = $description1 ? $description1 : $description2;
		$keywords = "";        
		$tags = wp_get_post_tags($post->ID);
		foreach ($tags as $tag ) {
			$keywords = $keywords . $tag->name . ", ";
		}
	} elseif(is_category()){
		$description     = strip_tags(category_description());
		$current_category = single_cat_title("", false);
		$keywords =  $current_category;
	}
?>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description ?>" />

<?php wp_head(); ?>

</head>
<body>
<nav class="navbar navbar-default" role="navigation" id="headbjs">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="container">
  <!--div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a style="margin-left:15px; display:block;" class="logo navbar-brand" href="<?php bloginfo('url'); ?>"></a>
  </div-->

  <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="col-md-3 col-md-push-7">
      <div class="collapse navbar-collapse pull-right " id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="<?php bloginfo('url'); ?>">联系我们</a></li>
    	    <li><a href="<?php echo bloginfo('url')."/login"?>">登录</a></li>
    	    <li><a href="<?php echo bloginfo('url')."/register"?>">注册</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
  </div>
</nav>
