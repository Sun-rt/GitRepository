

<?php get_header(); ?>
<div class="singlecontainer">
	<div class="row">
		<?php while (have_posts()) : the_post(); ?>
		<?php $meta = getmetadatas($post->ID);?>
			
           		<!--?php if (have_posts()) : while (have_posts()) : the_post(); ?-->  
           	
		 		<div class="col-md-8 col-md-offset-1" id="singleleft" >
		 			<div class="row" id="topbar">
		 				<div class="col-md-12" style="padding:0px">
		 					<div class="col-md-6 pull-left" style="font-size:20px;margin-top:10px;text-align:left;">
		 				 		 <p><b><?php the_title(); ?></b></p>
		 					</div>
		 					<div class="col-md-6 pull-right" style="font-size:small;margin-top:10px;text-align:right;">
		 				  		<p>上传时间：<?php the_time('Y-m-d') ?></p>
		 				  	</div>
           				</div>
           			</div>
           			<div class="row" id="singleimgs">
           				<?php the_content(); ?>
           			</div>
           			<div class="row" id="footerbar">
           				<div class="col-md-3">
           					<div class="post-like">
   							 <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">觉得很赞 
   							 	<span class="count">[<?php if( get_post_meta($post->ID,'bigfa_ding',true) ){echo get_post_meta($post->ID,'bigfa_ding',true);} else {echo '0';}?>]</span>
							 </a>
							</div>
						</div>
						<div class="col-md-3" style="margin-left:-50px">
							<div class="post-like">
   							 <a href="javascript:;" data-action="ding1" data-id="<?php the_ID(); ?>" class="unfavorite<?php if(isset($_COOKIE['bigfa_ding1_'.$post->ID])) echo ' done';?>">没有创意 
   							 	<span class="count">[<?php if( get_post_meta($post->ID,'bigfa_ding1',true) ){echo get_post_meta($post->ID,'bigfa_ding1',true);} else {echo '0';}?>]</span>
							 </a>
							</div>
           				</div>
           				<div class="col-md-3 pull-right">
           					<div class="post-like">
           					  	<a href="#" >评论数:<span class="count">[<?php echo get_comments_number('0', '1', '%'); ?>]</span></a>
           					</div>
           				</div>

           			</div>
           			<div class="row">
           				<?php comments_template('', true); ?>
           			</div>
         		</div>
         		<div class="col-md-3 id="singleright" >
         			<div class="row" >
     					<div class="col-md-3" ><p>作者:</p></div>
						<div class="col-md-9 meta"><?php the_author(); ?></div>				   	
				    </div>
				    <div class="row" >         			
     					<div class="col-md-3" ><p >类别:</p></div>
						<div class="col-md-8 meta"><?php foreach((get_the_category()) as $category){echo $category->cat_name;} ?></div>				  
				    </div>
				     <div class="row" >
						<div class="col-md-3" ><p >材质:</p></div>
						<div class="col-md-9 meta"><?php echo $meta->material?></div>
					</div>
				     <div class="row" >
         				<div class="col-md-12">
					      <p style="float:left;">颜色：</p>
					      	<div style="float:left;">
					 		<?php 
							$colors =get_the_tags();
							if($colors){
							foreach($colors as $this_tag) { ?>
					      	 <div class="colorchunk" style="background-color:<?php echo $this_tag->name?>"></div>
					      	<?php }} ?>
					      	</div>
				     	</div>
				     </div>			
				     <div class="row" >
						<div class="col-md-3" ><p>款式:</p></div>
						<div class="col-md-9 meta"><?php echo $meta->style?></div>
					</div>
					<div class="row">
						<div class="col-md-3" ><p>厂家:</p></div>
						<div class="col-md-9 meta"><?php echo $meta->manufacturer?></div>
					</div>
					<div class="row">
						<div class="col-md-3" ><p >链接:</p></div>
						<div class="col-md-9 meta"><?php echo $meta->link?></div>
					</div>
				     <div class="row">
				    	<div class="col-md-12">
				    		<div><?php the_excerpt(); ?></div>
				    	</div>
				    </div>
				     <div class="row">
				    	<div class="col-md-12">
				    		<p ><button class="btn btn-default btn btnStyle"  onclick="window.location.href='<?php echo get_settings('home')."/survey" ?>'" style="width:80px;height:30px" role="button">我要购买</button></p>
				    	</div>
				    </div>

         		</div>
         	
           
			<!--?php the_content(); ?-->

		<?php endwhile;  ?>

		<!--footer class="article-footer">
			
			<div id="baidshare">
			<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_t163" data-cmd="t163" title="分享到网易微博"></a><a href="#" class="bds_baidu" data-cmd="baidu" title="分享到百度搜藏"></a><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a><a href="#" class="bds_tqf" data-cmd="tqf" title="分享到腾讯朋友"></a><a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_tsohu" data-cmd="tsohu" title="分享到搜狐微博"></a><a href="#" class="bds_thx" data-cmd="thx" title="分享到和讯微博"></a><a href="#" class="bds_taobao" data-cmd="taobao" title="分享到我的淘宝"></a><a href="#" class="bds_qq" data-cmd="qq" title="分享到QQ收藏"></a><a href="#" class="bds_bdysc" data-cmd="bdysc" title="分享到百度云收藏"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_hi" data-cmd="hi" title="分享到百度空间"></a><a href="#" class="bds_msn" data-cmd="msn" title="分享到MSN"></a><a href="#" class="bds_sohu" data-cmd="sohu" title="分享到搜狐白社会"></a><a href="#" class="bds_mogujie" data-cmd="mogujie" title="分享到蘑菇街"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","t163","baidu","tieba","tqf","bdhome","sqq","tsohu","thx","taobao","qq","bdysc","douban","hi","msn","sohu","mogujie","meilishuo","qy","leho","mshare","huaban","share189","hx","diandian"],"viewText":"分享到：","viewSize":"32"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":false}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=86326610.js?cdnversion='+~(-new Date()/36e5)];</script>
			</div>
		</footer-->

		<!--div class="relates">
			
		</div-->

		

		

	</div>
</div>
<?php get_footer();?>