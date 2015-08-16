<div id="footer">
<span class="footi">
	<?php if($options['footertext']=='') {?>
		Copyright &copy; 2014&nbsp;<a href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?> </a>
	<?php } else { echo stripcslashes($options['footertext']); } ?>
</span
<span class="copyr">| Elegant由<a href="http://cn.wordpress.org/" target="_blank">Wordpress</a>驱动.
</span>
</div><div class="clear"></div>
</div>

<?php wp_footer(); $options = get_option('ice_options'); ?>

<?php if(is_single()||is_page()){?><div id="gotocomment" title="到评论列表"></div><?php }?>
<div id="gototop" title="到顶部"></div>
<div id="gotobottom" title="到底部"></div>

<?php if($options['opentongji']){ ?>
<div id="tongjicode"><?php echo stripcslashes($options['tongjicode']) ?></div>
<?php } ?>
<?php if($options['bodycode']!=""){ echo stripcslashes($options['bodycode']); }?>
</body>

<script type="text/javascript" src="<?php if($options['sinajquery']){echo 'http://lib.sinaapp.com/js/jquery/1.8.2/jquery.min.js';}else{echo get_bloginfo('template_directory').'/js/jQuery.js';}?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ice.js"></script>
<?php if ($options['fancybox']) {echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/fb/fancybox.pack.js"></script>';}?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
</html>