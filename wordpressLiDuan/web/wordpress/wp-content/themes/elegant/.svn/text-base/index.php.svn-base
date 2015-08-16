<?php get_header(); ?>

	<div class="content">
	<div class="introduction">
	<div class="player-a">
	<p class="ptitle">本季风格：你在我心里</p>
	<p class="cover"><img src="<?php bloginfo('template_directory'); ?>/images/home_2.jpg"></p>
	<p class="song-name">If I Were You - tamia</p>
	<p class="swfplayer">
	<object type="application/x-shockwave-flash" name="audioplayer_1" style="outline: none" data="http://www.poboke.com/wp-content/plugins/audio-player/assets/player.swf?ver=2.0.4.6" width="210" height="30" id="audioplayer_1"><param name="bgcolor" value="#FFFFFF"><param name="wmode" value="transparent"><param name="menu" value="false"><param name="flashvars" value="animation=no&amp;encode=no&amp;initialvolume=60&amp;remaining=yes&amp;noinfo=no&amp;buffer=5&amp;checkpolicy=no&amp;rtl=no&amp;bg=ffffff&amp;text=ffffff&amp;leftbg=ffffff&amp;lefticon=333333&amp;volslider=000000&amp;voltrack=FFFFFF&amp;rightbg=ffffff&amp;rightbghover=ffffff&amp;righticon=333333&amp;righticonhover=333333&amp;track=FFFFFF&amp;loader=ffffff&amp;border=ffffff&amp;tracker=ffffff&amp;skip=3d3b3b&amp;soundFile=http://m1.file.xiami.com/1/68/35068/214642/2539589_564452_l.mp3&amp;playerID=audioplayer_1&amp;autostart=yes&loop=yes"></object>
	</p>
	</div>
	</div>
		<div class="postlist">
			<table class="table content-table"><tbody>
				<tr style="display:none"><td></td></tr>
				<?php if(have_posts()){while(have_posts()){the_post();
					include('postformat.php'); }?>
			</tbody></table>
			<?php }else{ include('404page.php'); }?>
		</div>
		<div class="pagenavi cf">
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="pagenavi"><?php pagenavi(); ?></div>
			<?php endif; ?><div class="clear"></div>
		</div>
<script>
jQuery(function($){
	$('#demo1').slideBox();
	$('#demo2').slideBox({
		direction : 'top',//left,top#方向
		duration : 0.3,//滚动持续时间，单位：秒
		easing : 'linear',//swing,linear//滚动特效
		delay : 5,//滚动延迟时间，单位：秒
		startIndex : 1//初始焦点顺序
	});
	$('#demo3').slideBox({
		duration : 0.3,//滚动持续时间，单位：秒
		easing : 'linear',//swing,linear//滚动特效
		delay : 5,//滚动延迟时间，单位：秒
		hideClickBar : false,//不自动隐藏点选按键
		clickBarRadius : 10
	});
});
</script>
<div id="demo1" class="slideBox">
  <ul class="items">
    <li><a href="" title="这里是测试标题一"><img src="<?php bloginfo('template_directory'); ?>//images/01.jpg"></a></li>
    <li><a href="" title="这里是测试标题二"><img src="<?php bloginfo('template_directory'); ?>//images/02.jpg"></a></li>
    <li><a href="" title="这里是测试标题三"><img src="<?php bloginfo('template_directory'); ?>//images/03.jpg"></a></li>
    <li><a href="" title="这里是测试标题四"><img src="<?php bloginfo('template_directory'); ?>//images/04.jpg"></a></li>
    <li><a href="" title="这里是测试标题五"><img src="<?php bloginfo('template_directory'); ?>//images/05.jpg"></a></li>
  </ul>
</div>
	</div>

<?php get_footer(); ?>