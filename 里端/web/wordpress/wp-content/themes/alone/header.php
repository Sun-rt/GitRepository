<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?>>
<head>

<!-- Custom Title Setup -->
<title><?php if (is_home()||is_search()) { bloginfo('name'); } else { wp_title(''); } ?></title>

<!-- Meta -->
<meta name="keywords" content="<?php echo get_option('mytheme_keywords'); ?>" />
<meta name="description" content="<?php echo get_option('mytheme_description'); ?>" />
<meta content="<?php bloginfo('name'); ?>"/>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Syndication -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo get_bloginfo_rss('rss2_url'); ?>" />
<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.ico" >
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
<!-- Stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" /> 
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/slimmenu.css" type="text/css" media="screen" /> 
<!-- Javascript -->
<script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.slimmenu.js"></script>

<!-- WP Headers -->
<?php wp_head(); ?>
</head>
<body class="windsays">

<div id="container">

<div class="site">
		<div id="nav">
			<?php wp_nav_menu($args) ;?>
		</div>
	 	<div class="clear"></div>
		<div id="banner" class="site-header" role="banner">
		<div class="blogtitle">
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		</div>
			<h3><?php bloginfo( 'description' ); ?></h3>
		</div>
	<div id="main" class="wrapper">
		<div id="primary" class="site-content">
