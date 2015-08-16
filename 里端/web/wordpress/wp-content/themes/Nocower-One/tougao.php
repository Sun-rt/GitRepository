<?php 
if ( !is_user_logged_in() ) { 	
	wp_redirect(get_settings('home')."/login");
} ?>
<?php
/*
	Template Name: 投稿页面
*/
$redirect_content ="";
if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send'){
	/*( isset($_COOKIE["tougao"]) && ( time() - $_COOKIE["tougao"] ) < 120 ){
		wp_die('您投稿也太勤快了吧，先歇会儿！');
	}*/
	//表单变量初始化
	//$name = isset( $_POST['tougao_authorname'] ) ? $_POST['tougao_authorname'] : '';
	//$email = isset( $_POST['tougao_authoremail'] ) ? $_POST['tougao_authoremail'] : '';
	//$blog = isset( $_POST['tougao_authorblog'] ) ? $_POST['tougao_authorblog'] : '';
	$title = isset( $_POST['tougao_title'] ) ? $_POST['tougao_title'] : '';
	$tags = isset( $_POST['tougao_tags'] ) ? $_POST['tougao_tags'] : '';
	$category = isset( $_POST['tougao_cat'] ) ? (int)$_POST['tougao_cat'] : 0;
	$content = isset( $_POST['tougao_content'] ) ? $_POST['tougao_content'] : '';
	$excerpt = isset( $_POST['tougao_excerpt'] ) ? $_POST['tougao_excerpt'] : '';
	
	//表单项数据验证
	/*if ( empty($title) || strlen($title) > 100 ){
		$redirect_content = '文章标题必须填写，且不得超过100个长度！<a href="'.get_settings('home').'/submit">返回</a>';
		wp_die($redirect_content);
	}*/
	
	if (strlen($excerpt) >2000){
		$redirect_content = '描述不能好超过2000个字符<a href="'.get_settings('home').'/submit">返回</a>';
		wp_die($redirect_content);
		//wp_die('内容必须填写，且不得少于100个长度');
	}
	$tougao = array('post_title' => $title,
					'post_content' => $content,
					'post_status' => 'publish',
					'tags_input' => $tags,
					'post_excerpt'=>$excerpt,
					'post_category' => array($category)
					);

	$status = wp_insert_post( $tougao );//将文章插入数据库
	
	
	if ($status != 0){
		global $wpdb;
		$myposts = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
		/*add_post_meta($myposts[0]->ID, 'tcp_postauthor', $name);    //插入投稿人昵称的自定义域
		if( !empty($blog))
			add_post_meta($myposts[0]->ID, 'tcp_posturl', $blog);    //插入投稿人网址的自定义域
			*/
		setcookie("tougao", time(), time()+180);
		//$redirect_title ＝ '投稿成功！';
	
		wp_redirect(get_permalink($myposts[0]->ID));
		//$redirect_content = '提交案例成功！<a href="'.get_settings('home').'">返回</a>';
		
	}else{
		//$redirect_title ＝ "投稿失败！";
		$redirect_content = '提交案例失败！<a href="'.get_settings('home').'/submit">返回</a>';
		wp_die($redirect_content,$redirect_title);
	}
	
}
get_header();?>

<body>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/tougao.css" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/kindeditor/themes/default/default.css" />
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/kindeditor/kindeditor-min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/kindeditor/lang/zh_CN.js"></script>

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/tougao.js"></script>		
	
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
	<div class="container">
		<div class="row">
			
			<div class="entry">
				<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" onsubmit="return vailddata()">
					<div id="basicinfo_discard">
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-10">
								<h4>
									<?php global $current_user; get_currentuserinfo(); echo $current_user->display_name; ?>，请确认您拥有该作品的版权；带有<small style="color:red"> *</small>是必须要填写的。
								</h4>
							</div>
						</div>
						<div class="row formrow">
							<div class="col-md-2 forminputlabel"><small style="color:red">* </small><a>分类</a></div>
							<div class="col-md-4">
								<select name="tougao_cat" class="formselect">
								<?php 
								   $categorys = getCategorys();
								   foreach ($categorys as $category) 
								   	{?>
								   	<option value="<?php echo $category->term_id ?>"><?php echo get_cat_name(''. $category->term_id .'') ?></option>							   	
								<?php };?>
								</select>
							</div>
							<div class="col-md-6 prompt"></div>	
						</div>
						<div class="row formrow">
							<div class="col-md-2 forminputlabel"><a>颜色</a></div>
							<div class="col-md-1">
								<div class="col-md-2">
									<input type="button" id="colorpicker" class="btn btnStyle" value="点击选择" />
									<input type="hidden" id="color" value="" name="tougao_tags" />
								</div>
							</div>	
							<div class="col-md-9 " id="colorView"></div>
						</div>
						<div class="row formrow">
							<div class="col-md-2 forminputlabel"><small style="color:red">* </small><a>标题</a></div>
							<div class="col-md-4">
								<input class="forminput noempty limitlength100" value="" onKeyUp="checkLen(this.value, 50)" name="tougao_title" id="tougao_title"/>
							</div>
							<div class="col-md-6 prompt" id="lblSummary50" >还可以输入<font color='red'>50字符</font>/汉字</div>	
						</div>
						
						<div class="row formrow">
							<div class="col-md-2 forminputlabel"><a>材质</a></div>
							<div class="col-md-4">
								<input class="forminput limitlength100" value="" name="tougao_material"/>
							</div>
							<div class="col-md-6 prompt"></div>
						</div>
						<div class="row formrow">
							<div class="col-md-2 forminputlabel"><a>款式</a></div>
							<div class="col-md-4">
								<input class="forminput limitlength100" value="" name="tougao_style"/>
							</div>
							<div class="col-md-6 prompt"></div>
						</div>
						<div class="row formrow">
							<div class="col-md-2 forminputlabel"><a>生产厂家</a></div>
							<div class="col-md-4">
								<input class="forminput limitlength100" value="" name="tougao_manufacturer"/>
							</div>
							<div class="col-md-6 prompt"></div>
						</div>
						<div class="row formrow">
							<div class="col-md-2 forminputlabel"><a>超链接</a></div>
							<div class="col-md-4">
								<input class="forminput limitlength100" value="" name="tougao_link"/>
							</div>
							<div class="col-md-6 prompt"></div>
						</div>
						<div class="row formrow uploadpic">
							<div class="col-md-2 forminputlabel"><small style="color:red">* </small><a>案例图</a></div>
							<div class="col-md-4">
								<input type="hidden" value="" class="noempty" />
								<div class="col-md-2">
									<input class="btn  btnStyle selectImg"  value="上传图片"/>
								</div>
								<div class="col-md-10">
									<div class="imageView" id="tougao_anli" ></div>
								</div>
							</div>
							<div class="col-md-6 prompt"></div>
						</div>
						<div class="row formrow uploadpic">
							<div class="col-md-2 forminputlabel"><a>设计图</a></div>
							<div class="col-md-4">
							<input type="hidden" value="" />
								<div class="col-md-2">
									<input class="btn  btnStyle selectImg"  value="上传图片"/>
								</div>
								<div class="col-md-10">
									<div class="imageView" id="tougao_sheji"></div>
								</div>
							</div>
						</div>
						<div class="row formrow">
							<div class="row">
								<div class="col-md-2 forminputlabel"><small style="color:red">* </small><a>描述</a></div>
								<div class="col-md-9">
									<textarea rows="15" cols="40" name="tougao_excerpt" onKeyUp="checkLen(this.value, 2000)" class="formtextarea noempty"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-11 prompt"  id="lblSummary2000" style="text-align:right;z-index:-1;">还可以输入<font color='red'>2000字符</font>/汉字</div>
							</div>
						</div>
						<div class="row formrow"  >
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<p>
								<input type="hidden" value="" name="tougao_content" id="tougao_content" />
								<input type="hidden" value="send" name="tougao_form" />
								<div class="row">
								<div class="col-md-offset-4">
									<div class="col-md-3">
										<input id="submit" class="btn btnStyle" name="submit" type="submit"  value="提交案例" />
									</div>
									<div class="col-md-3">
										<input id="reset"class="btn btnStyle"  type="reset" value="取消" />
									</div>
								</div>
								</p>
							</div>
							<div class="col-md-2"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
	<?php get_footer(); ?>