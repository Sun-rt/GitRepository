		</div><!-- #primary -->
	</div><!-- #main .wrapper -->
<div id="footer">
	<p>Theme Alone designed by <a href="http://www.windsays.com/" target="_blank">Windy Liu</a>.  &copy; All right reserved.</p>
</div>
</div><!-- #page -->
   
</div><!-- #container -->

<!-- JS -->

 <script>
  $('#nav').slimmenu(
{
    resizeWidth: '900',
    collapserTitle: '菜单',
    animSpeed: 'medium',
    easingEffect: null,
    indentChildren: false,
    childrenIndenter: '&nbsp;'
});

</script>
<!-- Statistical code begin -->
<?php if (get_option('mytheme_analytics')!="") {?>
<div id="analytics"><?php echo stripslashes(get_option('mytheme_analytics')); ?></div>
<?php }?>
<!--Statistical code end-->
<?php wp_footer(); ?>
</script>
</body>
</html>