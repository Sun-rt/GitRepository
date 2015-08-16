<?php
############################################################################
# 版权声明:                                                                #
# 此文件提取自 lianyue_theme 主题，根据 GNU GPL 许可证进行合法的使用及传播 #
# 不得用于商业用途                                                         #                                    #
############################################################################

# 安全检测
if (!defined('DB_NAME')) {
	die('theme:http://blog.ageme.info/');
}

# 特色图片
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' ). 
set_post_thumbnail_size( 0, 0,true ); 

# 文章略缩图
function wp_image($w,$h,$post_id=0)
{
	
	if($post_id)
		$post = get_post($post_id);  
	else
		global $post;

	$thumbnail_images = thumbnail_images($post->ID);
	if ($thumbnail_images) {
		//文章内容图片
		$images = $thumbnail_images;
	}
	
	//如果还没就截取随机图片
	if(!$images){
		$images_rend = glob(TEMPLATEPATH."/images/random/*.*");
		$images_rend_id = array_rand($images_rend,1);
		$images_rend = $images_rend[$images_rend_id];
		$images_rend = str_replace( TEMPLATEPATH, get_bloginfo('template_url'),$images_rend);
		$images = $images_rend;	
	}

	$images = '<img src="'.$images.'" alt="'.$post->post_title.'" class="post_thumbnail wp_thumbnail">';
	return $images;
}

//获取文章图片
function thumbnail_images($post_id)
{
	//检测是否有特色图片
	$has_post_thumbnail= has_post_thumbnail($post_id);
	if ($has_post_thumbnail) {
		$timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
		$post_timthumb = $timthumb_src[0];
		return $post_timthumb;
	} else {
		//检测是否有文章内有插入图片
		$post_timthumb = '';
		$content = get_post($post_id); 
		$content = $content->post_content; 

		$content = apply_filters('the_content', $content);
		$content = preg_replace('/<img(.*?)class=[\'"]wp-smiley[\'"](.*?)>/isU', '', $content); 

		$content = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/isU',$content, $index_matches); 
		$first_img_src = $index_matches [1];
		if (!empty($first_img_src) ) {
			$post_timthumb = $first_img_src;
		}
		return $post_timthumb;
	}
}
//