<?php
/*
Plugin Name: Svelte Sharing
Description: Tinfoil hat Social Sharing
Author: Simon Kraft
Author URI: https://simonkraft.de
Version: 0.4.1
Text Domain: svelte
*/



// ------------------ Plugin Init ------------------

	// Setup Action and Filter Hooks
		register_activation_hook(__FILE__, 'krafit_svelte_add_defaults');
		register_uninstall_hook(__FILE__, 'krafit_svelte_delete_plugin_options');
		add_action('admin_init', 'krafit_svelte_init' );
		add_action('admin_menu', 'krafit_svelte_add_options_page');
		add_filter( 'plugin_action_links', 'krafit_svelte_plugin_action_links', 10, 2 );

		

	// Delete options table entries ONLY when plugin deactivated AND deleted
		function krafit_svelte_delete_plugin_options() {
			delete_option('krafit_svelte_options');
		}

	// // Set textdomain / load translations
	function krafit_svelte_lang_init() {
			load_plugin_textdomain( 'svelte', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	add_action('init', 'krafit_svelte_lang_init');



// ------------------ Include admin.php ------------------

	// Let's include the admin.php file, if we are in dashboard
		if ( is_admin() ) {
			include( plugin_dir_path( __FILE__ ) . '/admin.php');
		}



// ------------------ Load styles and scripts ------------------

	// Load all styles and scripts we need
		function krafit_svelte_scripts() {
			wp_enqueue_style( 'svelte-default-style', plugins_url( 'assets/css/style.css' , __FILE__ ) );
		}
		add_action( 'wp_enqueue_scripts', 'krafit_svelte_scripts' );



// Hook for additional single session stuff
	function svelte_before_sharing() {
	    do_action('svelte_before_sharing');
	}


// Hook for additional single session stuff
	function svelte_after_sharing() {
	    do_action('svelte_after_sharing');
	}






// ------------------ Da output ------------------


function krafit_svelte_core() {

	$options = get_option( 'krafit_svelte_options' );
	$flattrID = $options['flattr_global'];
	$twitterID = $options['twitter_global'];
	$svelte_link = urlencode(wp_get_shortlink());
	$svelte_title = rawurlencode(strip_tags(get_the_title()));
	$svelte_language = urlencode(get_bloginfo( 'language' ));
	$svelte_language = str_replace('-','_',$svelte_language);


		echo '<div class="svelte-social">';

		svelte_before_sharing();

		if (class_exists('KrafitLikes')) { ?>
				<span class="sociallink krafitlike"><?php krafit_likes(); ?></span>
		<?php }

		if(isset($options['facebook']) && $options['facebook'] == '1' ):
			echo '<a class="svelte facebook" href="https://www.facebook.com/sharer.php?u=' . $svelte_link . '&amp;t=' . $svelte_title . '" alt="' . __('Share on Facebook', 'svelte' ) . '" title="' . __('Share on Facebook', 'svelte' ) . '" target="_blank">' . __('Facebook', 'svelte' ) . '</a>';
		endif; 

		if(isset($options['twitter']) && $options['twitter'] == '1' ):		 
		echo ' <a class="svelte twitter" href="https://twitter.com/share?text=' . $svelte_title .'%20-&amp;url=' . $svelte_link .'&amp;via=krafit" alt="' . __('Tweet this Post', 'svelte' ) . '" title="' . __('Tweet this Post', 'svelte' ) . '" target="_blank">' . __('Twitter', 'svelte' ) . '</a>';
		endif; 

		if(isset($options['googleplus']) && $options['googleplus'] == '1' ):
		echo ' <a class="svelte googleplus" href="https://plusone.google.com/_/+1/confirm?hl=' . $svelte_language . '&amp;url=' . $svelte_link .'" alt="' . __('Share on Google+', 'svelte' ) . '" title="' . __('Share on Google+', 'svelte' ) . '" target="_blank">' . __('Google+', 'svelte' ) . '</a>';
		endif; 

		if(isset($options['flattr']) && $options['flattr'] == '1' ):
		echo ' <a class="svelte flattr" href="https://flattr.com/submit/auto?user_id=' . $flattrID . '&amp;url=' . $svelte_link . '&amp;title=' . $svelte_title . '&amp;language=' . $svelte_language . '&amp;&amp;category=text" alt="' . __('Support via Flattr', 'svelte' ) . '" title="' . __('Support via Flattr', 'svelte' ) . '" target="_blank">' . __('Flattr', 'svelte' ) . '</a>';
		endif; 

		if(isset($options['pinterest']) && $options['pinterest'] == '1' ):
		echo ' <a class="svelte pinterest" href="http://www.pinterest.com/pin/create/button/?url=' . $svelte_link . ( (function_exists('the_post_thumbnail')) ? '&amp;media=' . wp_get_attachment_url(get_post_thumbnail_id()) : '') . '&amp;description=' . $svelte_title . '%20-%20' . $svelte_link . '" alt="' . __('Pin on Pinterest', 'svelte' ) . '" title="' . __('Pin on Pinterest', 'svelte' ) . '" target="_blank">' . __('Pinterest', 'svelte' ) . '</a>';
		endif; 

		if(isset($options['appnet']) && $options['appnet'] == '1' ):
		echo ' <a class="svelte appnet" href="https://alpha.app.net/intent/post?text=' . $svelte_title . '%20' . $svelte_link . '" alt="' . __('Share on App.net', 'svelte' ) . '" title="' . __('Share on App.net', 'svelte' ) . '" target="_blank">' . __('App.net', 'svelte' ) . '</a>';
		endif; 

		if(isset($options['xing']) && $options['xing'] == '1' ):
		echo ' <a class="svelte xing" href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=' . $svelte_link .'" alt="' . __('Share on Xing', 'svelte' ) . '" title="' . __('Share on Xing', 'svelte' ) . '" target="_blank">' . __('Xing', 'svelte' ) . '</a>';
		endif; 

		if(isset($options['whatsapp']) && $options['whatsapp'] == '1' && wp_is_mobile ()):
		echo ' <a class="svelte whatsapp" href="whatsapp://send?text=' . $svelte_title . '%20-%20' . $svelte_link .'" alt="' . __('Share on WhatsApp', 'svelte' ) . '" title="' . __('Share on WhatsApp', 'svelte' ) . '" target="_blank">' . __('WhatsApp', 'svelte' ) . '</a>';
		endif; 

		svelte_after_sharing();

		echo '</div>';

}