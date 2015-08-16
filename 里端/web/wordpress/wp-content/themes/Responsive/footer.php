		<div id="footer">
              
              <div class="foot"> 
            
			
            
            <div class="foot2">
            <h1>联系Contact:</h1>
            
            <div class="f mail">
             <?php if (get_option('mytheme_mail')!=""): ?>

   <a  title="发送邮件" href="Mailto:<?php echo get_option('mytheme_mail'); ?>"><?php echo get_option('mytheme_mail'); ?></a>
      
       <?php else : ?>
       
   <a  title="发送邮件" href="#">123@123.com</a>
       
         <?php endif; ?>  
          
            
            
            </div>
            <div class="f tel" title="联系电话">
           
           <?php if (get_option('mytheme_mail')!=""): ?>

   <a  title="发送邮件" href="Mailto:<?php echo get_option('mytheme_mail'); ?>"><?php echo get_option('mytheme_mail'); ?></a>
      
       <?php else : ?>
       
   <a>021475-8254</a>
       
         <?php endif; ?>  
          
           
            
            </div>
            <div class="f_bq"> <p>© <?php echo date("Y"); echo " "; bloginfo('name'); ?>  All Rigts Reserved.</p> </div>
         
            </div> 
            
           
		     </div>
             
        </div>

<div style="display:none"><?php echo stripslashes(get_option('mytheme_analytics')); ?></div>

	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
	
</body>
    <script src="<?php bloginfo('template_url'); ?>/js/Pageaction.js" type="text/javascript"></script>
</html>
