<?php
/**
 * All the admin interface code lives in this file. Be kind!
 *
 * @package svelte Plugin
 * @subpackage admin
 * @since 0.1 - Build 1407291100 
 */



	// Init plugin options to white list our options
		function krafit_svelte_init(){
			register_setting( 'krafit_svelte_plugin_options', 'krafit_svelte_options', 'krafit_svelte_validate_options' );
		}

	// We want the menu to set place, right where the whole Design stuff takes place - so we hook it up in the designs menu
		function krafit_svelte_add_options_page() {
			add_submenu_page( 'options-general.php', __('Sharing Settings', 'svelte'), __('Sharing', 'svelte'), 'install_themes', 'sharing', 'krafit_svelte_render_form');
		}


	// Render the Plugin options form
		function krafit_svelte_render_form() { ?>
			<div class="wrap">
				
				<!-- Display Plugin Icon, Header, and Description -->
				<h2><?php _e('Social Sharing Settings', 'svelte'); ?></h2>

				<!-- Beginning of the Plugin Options Form -->
				<form method="post" action="options.php">
					<?php settings_fields('krafit_svelte_plugin_options'); ?>
					<?php $options = get_option('krafit_svelte_options'); ?>


					<table class="form-table">


						<!-- Checkbox Buttons -->
						<tr valign="top">
							<th scope="row"><?php _e( 'Display options', 'svelte' ) ?></th>
							<td>
								<!-- Posts checkbox button -->
								<label><input name="krafit_svelte_options[show_on_posts]" type="checkbox" value="1" <?php if (isset($options['show_on_posts'])) { checked('1', $options['show_on_posts']); } ?> /> <?php _e( 'Show on posts', 'svelte' ) ?></label><br />

								<!-- Pages checkbox button -->
								<label><input name="krafit_svelte_options[show_on_pages]" type="checkbox" value="1" <?php if (isset($options['show_on_pages'])) { checked('1', $options['show_on_pages']); } ?> /> <?php _e( 'Show on pages', 'svelte' ) ?></label><br />
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e( 'Sharing-Services', 'svelte' ) ?></th>
							<td>
								<!-- Facebook checkbox button -->
								<label><input name="krafit_svelte_options[facebook]" type="checkbox" value="1" <?php if (isset($options['facebook'])) { checked('1', $options['facebook']); } ?> /> Facebook</label><br />

								<!-- Twitter checkbox button -->
								<label><input name="krafit_svelte_options[twitter]" type="checkbox" value="1" <?php if (isset($options['twitter'])) { checked('1', $options['twitter']); } ?> /> Twitter</label><br />

								<!-- Google+ checkbox button -->
								<label><input name="krafit_svelte_options[googleplus]" type="checkbox" value="1" <?php if (isset($options['googleplus'])) { checked('1', $options['googleplus']); } ?> /> Google+</label><br />

								<!-- Flattr checkbox button -->
								<label><input name="krafit_svelte_options[flattr]" type="checkbox" value="1" <?php if (isset($options['flattr'])) { checked('1', $options['flattr']); } ?> /> Flattr </label><br />

								<!-- Pinterest checkbox button -->
								<label><input name="krafit_svelte_options[pinterest]" type="checkbox" value="1" <?php if (isset($options['pinterest'])) { checked('1', $options['pinterest']); } ?> /> Pinterest </label><br />
							
								<!-- App.net checkbox button -->
								<label><input name="krafit_svelte_options[appnet]" type="checkbox" value="1" <?php if (isset($options['appnet'])) { checked('1', $options['appnet']); } ?> /> App.net </label><br />
							
								<!-- Xing checkbox button -->
								<label><input name="krafit_svelte_options[xing]" type="checkbox" value="1" <?php if (isset($options['xing'])) { checked('1', $options['xing']); } ?> /> Xing </label><br />
							
								<!-- Whatsapp checkbox button -->
								<label><input name="krafit_svelte_options[whatsapp]" type="checkbox" value="1" <?php if (isset($options['whatsapp'])) { checked('1', $options['whatsapp']); } ?> /> Whatsapp </label>
							
							</td>
						</tr>

						<?php if($options['twitter'] == '1' ): ?>
						<!-- Textbox Control -->
						<tr>
							<th scope="row">Sidewide Twitter name</th>
							<td>
								<input type="text" size="57" name="krafit_svelte_options[twitter_global]" value="<?php echo $options['twitter_global']; ?>" />
							</td>
						</tr>
						<tr>
							<th scope="row">Personal Twitter name</th>
							<td>
								<label><input name="krafit_svelte_options[allow_twitter_overwrite]" type="checkbox" value="1" <?php if (isset($options['allow_twitter_overwrite'])) { checked('1', $options['allow_twitter_overwrite']); } ?> /> yes</label><br />
								<small>Allow authors to overwrite global Twitter name with their personal name?</small>
							</td>
						</tr>
						<?php endif; ?>

						<?php if($options['flattr'] == '1' ): ?>
						<!-- Textbox Control -->
						<tr>
							<th scope="row">Global flattr ID</th>
							<td>
								<input type="text" size="57" name="krafit_svelte_options[flattr_global]" value="<?php echo $options['flattr_global']; ?>" />
							</td>
						</tr>
						<tr>
							<th scope="row">Personal flattr ID</th>
							<td>
								<label><input name="krafit_svelte_options[allow_flattr_overwrite]" type="checkbox" value="1" <?php if (isset($options['allow_flattr_overwrite'])) { checked('1', $options['allow_flattr_overwrite']); } ?> /> yes</label><br />
								<small>Allow authors to overwrite global flattr ID with their personal flattr ID?</small>
							</td>
						</tr>
						<?php endif; ?>

					</table>
					<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
					</p>
				</form>



			</div>
		<?php	}

	// Sanitize and validate input. Accepts an array, return a sanitized array.
		function krafit_svelte_validate_options($input) {
			 // strip html from textboxes
			$input['flattr_global'] =  wp_filter_nohtml_kses($input['flattr_global']); // Sanitize textbox input (strip html tags, and escape characters)
			return $input;
		}

	// Display a Settings link on the main Plugins page
		function krafit_svelte_plugin_action_links( $links, $file ) {

			if ( $file == plugin_basename( __FILE__ ) ) {
				$posk_links = '<a href="'.get_admin_url().'options-general.php?page=sharing">'.__('Settings').'</a>';
				// make the 'Settings' link appear first
				array_unshift( $links, $posk_links );
			}

			return $links;
		}
