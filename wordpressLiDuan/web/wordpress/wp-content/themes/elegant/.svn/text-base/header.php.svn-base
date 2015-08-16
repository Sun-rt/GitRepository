<!DOCTYPE html>
<html>
<head>
	<title><?php
			if ( is_tag() ) { echo wp_title('Tag:'); if($paged > 1) printf(' - 第%s页',$paged); echo ' | '; bloginfo( 'name' ); }
			elseif ( is_archive() ) { echo wp_title(''); if($paged > 1) printf(' - 第%s页',$paged); echo ' | '; bloginfo( 'name' ); }
			elseif ( is_search() ) { echo '&quot;'.wp_specialchars($s).'&quot;的搜索结果 | '; bloginfo( 'name' ); }
			elseif ( is_home() ) {bloginfo( 'name' ); $paged = get_query_var('paged'); if($paged > 1) printf(' - 第%s页',$paged); }
			elseif ( is_404() ) {echo '页面不存在！ | '; bloginfo( 'name' ); }
			else { echo wp_title( ' | ', false, right ); bloginfo( 'name' ); }
	?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<?php if( is_single() || is_page() ) {
    if( function_exists('get_query_var') ) {
        $cpage = intval(get_query_var('cpage'));
        $commentPage = intval(get_query_var('comment-page'));
    }
    if( !empty($cpage) || !empty($commentPage) ) {
        echo '<meta name="robots" content="noindex, nofollow" />';
        echo "\n";
    }
	}
	?>

	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ty.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fb/fancybox.css" type="text/css" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/html5.js"></script>
	<![endif]-->
	<!--[if IE 6]>
	<script src="http://letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/DD_belatedPNG.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix("*");
	</script>
	<![endif]-->
	<?php $options = get_option('ice_options'); ?>
	<meta name="keywords" content="<?php echo $options['keywords'] ?>" />
	<meta name="description" content="<?php echo $options['description'] ?>" />
	<?php if($options['csscode']!=""){ echo '<style type="text/css">'.$options['csscode'].'</style>'; }?>
	
	<link rel="icon" href="<?php if($options['openfavicon']) { echo $options['faviconurl']; } else { echo get_bloginfo('template_directory').'/favicon.ico'; } ?>" type="image/x-icon" />
	
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php wp_head(); ?>
	<?php if($options['headcode']!=""){ echo stripcslashes($options['headcode']); }?>
</head>
<body>
<div id="divbg">
	<img src="http://tupian.enterdesk.com/2014/mxy/01/06/03/3.jpg" data-pinit="registered" style="height: 100%;  width: 100%;">
</div>
<div id="divbg2"></div>

<div class="container">
<div class="logocon">
	<div id="logo">
		<?php if ($options['textlogo']) {?>
			<a href="<?php bloginfo('url') ?>" title="<?php bloginfo('name') ?>">
				<div id="sitetitle"><?php bloginfo('name') ?></div>
				<div id="sitedesc"><?php bloginfo('description') ?></div>
			</a>
		<?php } else {?>
			<a href="<?php bloginfo('url') ?>" id="logolink"><img src="<?php if($options['openlogo']) { echo $options['logourl']; } else { echo get_bloginfo('template_directory').'/images/logo.png'; } ?>"></a>
		<?php }?>
	</div>
</div>
<div class="topmenucon">
	<?php ice_menu('topmenu', 2); get_search_form(); ?>
	<div class="clear"></div>
</div>