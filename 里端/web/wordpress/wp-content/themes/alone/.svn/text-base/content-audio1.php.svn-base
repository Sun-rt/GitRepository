<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package WordPress
 * @subpackage WindyRomantic
 * @since WindyRomantic 1.0
 */
?>
  	
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/audio/not.the.skin.css">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/audio/circle.skin/circle.player.css">
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.transform2d.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>js/jquery.grab.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>js/jquery.jplayer.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>js/mod.csstransforms.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>js/circle.player.js"></script>
		
		<div class="article">
	



		<script type="text/javascript">
		$(document).ready(function(){

			var myCirclePlayer = new CirclePlayer("song-<?php the_ID(); ?>",
			{
				m4a: "<?php $songofm4a = get_post_meta($post->ID, 'songofm4a_value', true);echo $songofm4a;?>",
				oga: '<?php $songofoga = get_post_meta($post->ID, "songofoga_value", true);echo $songofoga;?>'
			}, {
				cssSelectorAncestor: "#song-<?php the_ID(); ?>"
			});
		</script>




		<div id="song-<?php the_ID(); ?>" class="cp-jplayer"></div>

				<div class="prototype-wrapper"> <!-- A wrapper to emulate use in a webpage and center align -->


			<!-- The container for the interface can go where you want to display it. Show and hide it as you need. -->

			<div id="song-<?php the_ID(); ?>" class="cp-container">
				<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
					<div class="cp-buffer-1"></div>
					<div class="cp-buffer-2"></div>
				</div>
				<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
					<div class="cp-progress-1"></div>
					<div class="cp-progress-2"></div>
				</div>
				<div class="cp-circle-control"></div>
				<ul class="cp-controls">
					<li><a class="cp-play" tabindex="1">play</a></li>
					<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
				</ul>
			</div>


		</div>




		</div><!-- .article -->
	</div><!-- #post -->









				<div class="music-content">
					<div id="jquery_jplayer_1" class="jp-jplayer">
						<div id="jp_container_1" class="jp-audio">
						</div>
					</div>
					<div class="musicblog">
					<div class="album">
						<div>
						<img src="<?php $imgurl = get_post_meta($post->ID, 'imgurl_value', true);echo $imgurl;?>" width="160px" height="160px">
						<p class="thealbum" title="专辑">《<?php $Album = get_post_meta($post->ID, "Album_value", true);echo $Album;?>》</p>
						</div>				
					</div>
					<div class="player">
							<div class="song">
									<p class="song-title"><?php $songname = get_post_meta($post->ID, "songname_value", true);echo $songname;?></p>
									<p class="artist"><?php $Artist = get_post_meta($post->ID, "Artist_value", true);echo $Artist;?></p>
								<div class="playcontrol">
									<a href="javascript:;" id="r_start" class="jp-play" tabindex="1">Play</a>
									<a href="javascript:;" id="r_stop" class="jp-pause" tabindex="1">Pause</a>
								</div>
							</div>
					</div>

						   <script type="text/javascript">
//<![CDATA[
var playList = [{
lrc:'<?php $lrcurl = get_post_meta($post->ID, "lrcurl_value", true);echo $lrcurl;?>'  }],
song_url=''; 
//]]>
</script>
		
					</div><!-- musicblog -->
				</div><!-- music-content -->

