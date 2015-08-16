<?php get_header(); ?>
    <div class="container">
        <div class="col-md-9" id="singleb" style="padding-bottom:15px;">
            <div class="panel-group" id="accordion">
                <h3 class="fltitle1">
                    <a style="color:#999999;" href="<?php bloginfo('url'); ?>">
                        首页
                    </a>
                    >
                       <?php the_category(",") ?>
                    
                    ><?php the_title(); ?>
                </h3>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php $num++; ?>
                        <div class="panel-heading" id="hbjs">
                            <h4 class="panel-title">
                                <?php the_title(); ?>
                                    <span class="pull-right" style="font-size:12px; color:#666; line-height:35px;">
                                        <?php the_time( 'Y.m.d'); ?>
                                    </span>
                            </h4>
                        </div>
                        <div id="collapse<?php the_ID(); ?>" class="panel-collapse collapse <?php if($num==1) echo 'in'; ?>">
                            <div class="panel-body" id="pgs">
                                <p>
                                    <?php the_content(); ?>
                                </p>
                                <p>
                                    &nbsp;
                                </p>
                                <p>
                                    &nbsp;
                                </p>
                                <p style="color:#999999;">
                                    感谢你的阅读，本文由 猫猫画报 版权所有，转载时请注明出处，违者必究，谢谢你的合作。 注明出处格式：
                                    <?php the_author_meta( 'display_name'); ?>
                                </p>
                                <a href="<?php bloginfo('url'); ?>">
                                    <?php bloginfo( 'url'); ?>
                                </a>
                                <p>
                                    &nbsp;
                                </p>
                                <div class="op-box mod-cs-opBox">
             <button type="button" style="height:40px;" class="btn btn-info">
			 <i class="glyphicon glyphicon glyphicon-eye-open"></i>
			 <span style="line-height:20px;">
                           浏览
					 <?php echo getPostViews(get_the_ID()); ?>
             </span>
						</button>
                                    
									&nbsp;
			 <button type="button" style="height:40px;" class="btn btn-primary">
			 <i class="glyphicon glyphicon-comment"></i>
				 <span style="line-height:20px;">
									   评论
									<?php comments_number( '0', '1', '%' );?>
				 </span>
			 </button>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; endif; ?>
                       <?php comments_template(); ?>
                           
            </div>
            
        </div>
		<div class="col-md-3">
                <?php if ( !function_exists( 'dynamic_sidebar') || !dynamic_sidebar('side') ) : ?>
                    <?php endif; ?>
            </div>
            <div class="c">
            </div>
    </div>
    <?php get_footer(); ?>