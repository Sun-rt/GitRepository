<div id="sidebar">

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

    	<?php get_search_form(); ?>

    
    	 <div class="sideba_Archives widget">
         <img title="文章归档" src="<?php bloginfo('template_url'); ?>/images/Archives_15.gif" />
    		<?php wp_get_archives('type=monthly'); ?>
    	</div>
        
      <div class="sideba_player widget">
         <div class="player">
         <?php if (get_option('mytheme_about_text1')!=""): ?>

 <?php echo stripslashes(get_option('mytheme_about_tit1')); ?></textarea>
      
       <?php else : ?>
       
  <embed src='http://cloud.kugou.com/multiPlayer/37033.swf' AllowScriptAccess='always' id='KugouPlayer' FlashVars='' quality='high' width='231' height='358' name='KugouPlayer' align='middle' type='application/x-shockwave-flash'  wmode='transparent' ></embed>
       
         <?php endif; ?>  
    	
     
        </div>
    	</div>
    	 <div class="sideba_rrs">
    	<img title="订阅网站" src="<?php bloginfo('template_url'); ?>/images/rrs_15.gif" />
    		<li class="coll"><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
    		<li  class="coll"><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
    
    <p>分享：</p>        <!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<span class="bds_more"></span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=875647" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
    	</div>
	
     <div title="二维码扫描访问，手机，平板电脑都可以哦！" class="sideba_next widget ">
      <?php if (get_option('mytheme_about_text1')!=""): ?>

 <img src="<?php echo get_option('mytheme_about_text1'); ?>"alt="<?php bloginfo('name'); ?>" /> 
      
       <?php else : ?>
       
  <img src="<?php bloginfo('template_url'); ?>/images/qrcode.gif" />
       
         <?php endif; ?>  
  
     </div>
    
    
	<?php endif; ?>

</div>