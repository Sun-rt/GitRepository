<?php
class deve_widget9 extends WP_Widget {
     function deve_widget9() {
         $widget_ops = array('description' => '');
         $this->WP_Widget('deve_widget9', '', $widget_ops);
     }
     function widget($args, $instance) {
         extract($args);
         $title = apply_filters('widget_title',esc_attr($instance['title']));
         $limit = strip_tags($instance['limit']);
		 $email = strip_tags($instance['email']);
         echo $before_widget.$before_title.$title.$after_title;
?> 
         <ul>
						<?php
						global $wpdb;
						$limit_num = $limit ; 
						$my_email ="'" . $email . "'";
						$rc_comms = $wpdb->get_results("SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author_email != $my_email ORDER BY comment_date_gmt DESC LIMIT $limit_num ");
						$rc_comments = '';foreach ($rc_comms as $rc_comm) { 
						
						$rc_comments .= "<li>".$rc_comm->comment_author.":&nbsp;<a href='". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID. "' title='在 " . $rc_comm->post_title .  " 发表的评论'>".cut_str(strip_tags($rc_comm->comment_content),20)."</a></li>\n";}
						
						
						echo $rc_comments;
						?>
		</ul>		
		 
<?php		 
         echo $after_widget;
     }
     function update($new_instance, $old_instance) {
         if (!isset($new_instance['submit'])) {
             return false;
         }
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         $instance['limit'] = strip_tags($new_instance['limit']);
		 $instance['email'] = strip_tags($new_instance['email']);
         return $instance;
     }
     function form($instance) {
         global $wpdb;
         $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '', 'email' => ''));
         $title = esc_attr($instance['title']);
         $limit = strip_tags($instance['limit']);
		 $email = strip_tags($instance['email']);
 ?>
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
         </p>
         <p>
             <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量： <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
         </p>
		 <p>
             <label for="<?php echo $this->get_field_id('email'); ?>">输入你的邮箱以排除显示你的回复: <br>（留空则不排除）<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label>
         </p>
         <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
 <?php
     }
 }
 add_action('widgets_init', 'deve_widget9_init');
 function deve_widget9_init() {
     register_widget('deve_widget9');
 }

?>