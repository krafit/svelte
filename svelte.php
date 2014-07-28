<?php
/*
Plugin Name: svelte share
Plugin URI: https://krafit.de/wordpress/plugins/svelte
Description: 
Author: Simon Kraft (krafit.de)
Author URI: https://krafit.de
Version: 0.1 - Build 1407281651
*/


function krafit_svelte_scripts() {
	
	wp_enqueue_style( 'svelte-style', plugins_url( 'assets/css/style.css' , __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'krafit_svelte_scripts' );




function krafit_svelte_core() {

	$svelte_link = urlencode(wp_get_shortlink());
	$svelte_title = rawurlencode(strip_tags(get_the_title()));
	$svelte_language = urlencode(get_bloginfo( 'language' ));
	$svelte_language = str_replace('-','_',$svelte_language);


		echo 'Share:  <a class="svelte facebook" href="https://www.facebook.com/sharer.php?u=' . $svelte_link . '&amp;t=' . $svelte_title . '" alt="' . __('Share on Facebook', 'krafit_svelte' ) . '" title="' . __('Share on Facebook', 'krafit_svelte' ) . '" target="_blank">' . __('Facebook', 'krafit_svelte' ) . '</a>';
		 
		echo ' <a class="svelte googleplus" href="https://plusone.google.com/_/+1/confirm?hl=' . $svelte_language . '&amp;url=' . $svelte_link .'" alt="' . __('Share on Google+', 'krafit_svelte' ) . '" title="' . __('Share on Google+', 'krafit_svelte' ) . '" target="_blank">' . __('Google+', 'krafit_svelte' ) . '</a>';
		 
		echo ' <a class="svelte twitter" href="https://twitter.com/share?text=' . $svelte_title .'%20-&amp;url=' . $svelte_link .'&amp;via=geekinheels" alt="' . __('Tweet this Post', 'krafit_svelte' ) . '" title="' . __('Tweet this Post', 'krafit_svelte' ) . '" target="_blank">' . __('Twitter', 'krafit_svelte' ) . '</a>';
		 
		echo ' <a class="svelte flattr" href="https://flattr.com/submit/auto?user_id=krafit&amp;url=' . $svelte_link . '&amp;title=' . $svelte_title .'&amp;language=' . $svelte_language . '&amp;&amp;category=text" alt="' . __('Support via Flattr', 'krafit_svelte' ) . '" title="' . __('Support via Flattr', 'krafit_svelte' ) . '" target="_blank">' . __('Flattr', 'krafit_svelte' ) . '</a>';
		
		echo ' <a class="svelte pinterest" href="http://www.pinterest.com/pin/create/button/?url=' . $svelte_link . ( (function_exists('the_post_thumbnail')) ? '&amp;media=' . wp_get_attachment_url(get_post_thumbnail_id()) : '') . '&amp;description=' . $svelte_title . '%20-%20' . $svelte_link . '" alt="' . __('Pin on Pinterest', 'krafit_svelte' ) . '" title="' . __('Pin on Pinterest', 'krafit_svelte' ) . '" target="_blank">' . __('Pinterest', 'krafit_svelte' ) . '</a>';

		echo ' <a class="svelte appnet" href="https://alpha.app.net/intent/post?text=' . $svelte_title . '%20' . $svelte_link . '" alt="' . __('Share on App.net', 'krafit_svelte' ) . '" title="' . __('Share on App.net', 'krafit_svelte' ) . '" target="_blank">' . __('App.net', 'krafit_svelte' ) . '</a>';
		 
		echo ' <a class="svelte xing" href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=' . $svelte_link .'" alt="' . __('Share on Xing', 'krafit_svelte' ) . '" title="' . __('Share on Xing', 'krafit_svelte' ) . '" target="_blank">' . __('Xing', 'krafit_svelte' ) . '</a>';

		if (wp_is_mobile ()) {
		echo ' <a class="svelte whatsapp" href="whatsapp://send?text=' . $svelte_title . '%20-%20' . $svelte_link .'" alt="' . __('Share on Whatsapp', 'krafit_svelte' ) . '" title="' . __('Share on Whatsapp', 'krafit_svelte' ) . '" target="_blank">' . __('Whatsapp', 'krafit_svelte' ) . '</a>';
		}

}