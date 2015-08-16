<?php
/**
 * post views
 *
 * 浏览量统计
 *
 * @since gm_record 1.0.0
 *
 * @return views.
 */

function guimeng_set_post_views($postID) {
    $the_ID = "arc".$postID;
    if(isset($_SESSION[$the_ID]) || $_SESSION[$the_ID] == 1)
    return;
    $_SESSION[$the_ID] = 1;
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    }else{
        //administrator的浏览量不统计
        if(!current_user_can("administrator")){
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
function guimeng_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

/**
 * Get the most comments articles.
 *
 * 最热文章
 *
 * @since Zanblog 2.0.0
 *
 * @return The most comments articles.
 */
function elegant_get_most_comments($posts_num, $strim_width, $days) {
  global $wpdb;

  $sql = "SELECT ID , post_title , comment_count
          FROM $wpdb->posts
         WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
     AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit')
         ORDER BY comment_count DESC LIMIT 0 , $posts_num ";

  $posts = $wpdb->get_results($sql);

  foreach ($posts as $post){
    $output .= "\n<p class=\"xgjzjwz\"><a href= \"" . get_permalink($post->ID) . "\" rel=\"bookmark\" title=\"" . $post->post_title . "\" >" . mb_strimwidth($post->post_title, 0, $strim_width) . "</a><span class=\"badge\">" . $post->comment_count . "</span></p>";
  }

  return $output;
} 

?>