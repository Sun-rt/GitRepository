<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		<p>
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ); ?></label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
		</p>
		<p>
			<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" />
		</p>

		<?php do_action( 'login_form' ); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-left">
					<p class="forgetmenot">
						<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
						<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( '记住我', 'theme-my-login' ); ?></label>
					</p>
				</div>
				<div class="col-md-2 col-md-offset-1">
					<p class="submit">
						<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'theme-my-login' ); ?>" />
						<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
						<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
						<input type="hidden" name="action" value="login" />
					</p>
				</div>
			</div>
		</div>
	</form>
	
</div>
