<?php

function fb_wp_head() {
	global $wp_version;
	if ( isset( $_GET['page'] ) && "fb_box_settings" == $_GET['page'] )
	{
		wp_enqueue_script( 'fb_main_script', plugins_url( 'js/script.js', __FILE__ ) );
		wp_enqueue_style( 'tip_stylesheet', plugins_url( 'css/jquery.tooltip.css', __FILE__ ) );
		wp_enqueue_script( 'tip_script', plugins_url( 'js/jquery.tooltip.js', __FILE__ ) );
		wp_enqueue_script( 'tip_myscript', plugins_url( 'js/myscript.js', __FILE__ ) );
	}
	if ( $wp_version < 3.8 )
		wp_enqueue_style( 'fb_old_stylesheet', plugins_url( 'css/wp3.8_lesser.css', __FILE__ ) );
	else
		wp_enqueue_style( 'fb_current_stylesheet', plugins_url( 'css/style.css', __FILE__ ) );

}
	function fb_like_bx_settings_page() {
		$fb_like_bx_settings=get_option('fb_like_bx_options');
		$copy = false;
		$message = $error = "";
		$plugin_info = get_plugin_data( __FILE__ );
		if ( isset( $_REQUEST['fb_form_submit'] ) && check_admin_referer( plugin_basename( __FILE__ ), 'fb_nonce' ) ) {		
				$options['appID']=$_REQUEST['appID'];
				$options['pageURL']=$_REQUEST['pageURL'];
				$options['streams']	=$_REQUEST['streams'];
				$options['borderdisp']=$_REQUEST['borderdisp'];
				$options['colorScheme']=$_REQUEST['colorScheme'];
				$options['showFaces']	=$_REQUEST['showFaces'];
				$options['header']=	$_REQUEST['header'];	
				fb_like_bx_update_options($options);
				$fb_like_bx_settings=get_option('fb_like_bx_options');
		}
		?>
		<div class="fb_like_bx_wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			
			
			<div class="postbox settings_wrap left">
			
			<h3 class="hndle" style="padding:10px;">FB Widget Settings</h3>
			<div class="inside">
			<div class="updated fade" <?php if ( empty( $message ) || "" != $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
			<div id="fb_admin_notice" class="updated fade" style="display:none"><p><strong>Note:</strong> To save the settings please click the 'Save Changes' button.</p></div>
			<div class="error" <?php if ( "" == $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $error; ?></strong></p></div>
			
			<?php if ( ! isset( $_GET['action'] ) ) { ?>
				<form name="form1" method="post" action="" enctype="multipart/form-data" id="fcbkbttn_settings_form">
					<table class="form-table">
						<tr valign="top">
							<th scope="row">FB App ID:</th>
							<td>
								<input name='appID' type='text'  value='<?php echo $fb_like_bx_settings['appID']; ?>' />&nbsp; <img border="0"  value="Tip" src="<?php echo plugins_url( 'images/help.png', __FILE__ )?>" class="tip" title="Enter the FB Page ID">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">FB Page URL:</th>
							<td>
								<input name='pageURL' type='text' value='<?php echo $fb_like_bx_settings['pageURL']; ?>' />&nbsp; <img border="0"  value="Tip" src="<?php echo plugins_url( 'images/help.png', __FILE__ )?>" class="tip" title="The URL of the FB Page.">
							</td>
						</tr>
					
						<tr>
							<th>
								Display Posts:
							</th>
							<td>
							<div class="cmb_radio_inline"><div class="cmb_radio_inline_option">
							<input type="radio" name="streams" id="streams1" value="yes" <?php if(isset($fb_like_bx_settings['streams']) && $fb_like_bx_settings['streams']=="yes"){echo 'checked="checked"';}?>><label for="streams1">Yes</label></div>
							<div class="cmb_radio_inline_option"><input type="radio" name="streams" id="streams2" value="no" <?php if(isset($fb_like_bx_settings['streams']) && $fb_like_bx_settings['streams']=="no"){echo 'checked';}?>><label for="streams2">No</label></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img border="0"  class="tip" value="Tip" src="<?php echo plugins_url( 'images/help.png', __FILE__ )?>" title="To display the latest posts.">
							</div>
							</td>
						</tr>
						<tr>
						<tr>
							<th>
								Theme:
							</th>
							<td>
							<div class="cmb_radio_inline"><div class="cmb_radio_inline_option">
							<input type="radio" name="colorScheme" id="colorScheme1" value="light" <?php if(isset($fb_like_bx_settings['colorScheme']) && $fb_like_bx_settings['colorScheme']=="light"){echo 'checked';}?>><label for="colorScheme1">Light</label></div>
							<div class="cmb_radio_inline_option"><input type="radio" name="colorScheme" id="colorScheme2" value="dark" <?php if(isset($fb_like_bx_settings['colorScheme']) && $fb_like_bx_settings['colorScheme']=="dark"){echo 'checked';}?>><label for="colorScheme2">Dark</label></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img border="0"  class="tip" value="Tip" src="<?php echo plugins_url( 'images/help.png', __FILE__ )?>" title="The theme can be 'light' or 'dark'.">
							</div>
							</td>
						</tr>
						<tr>
							<th>
								Display Border:
							</th>
							<td>
							<div class="cmb_radio_inline"><div class="cmb_radio_inline_option">
							<input type="radio" name="borderdisp" id="borderdisp1" value="yes" <?php if(isset($fb_like_bx_settings['borderdisp']) && $fb_like_bx_settings['borderdisp']=="yes"){echo 'checked';}?>><label for="borderdisp1">Yes</label></div>
							<div class="cmb_radio_inline_option"><input type="radio" name="borderdisp" id="borderdisp2" value="no" <?php if(isset($fb_like_bx_settings['borderdisp']) && $fb_like_bx_settings['borderdisp']=="no"){echo 'checked';}?>><label for="borderdisp2">No</label></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img border="0"  class="tip" value="Tip" src="<?php echo plugins_url( 'images/help.png', __FILE__ )?>" title="Show border around the fb box.">
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
								Display Faces :
							</th>
							<td>
							<div class="cmb_radio_inline"><div class="cmb_radio_inline_option">
							<input type="radio" name="showFaces" id="showFaces1" value="yes" <?php if(isset($fb_like_bx_settings['showFaces']) && $fb_like_bx_settings['showFaces']=="yes"){echo 'checked';}?>><label for="showFaces1">Yes</label></div>
							<div class="cmb_radio_inline_option"><input type="radio" name="showFaces" id="showFaces2" value="no"  <?php if(isset($fb_like_bx_settings['showFaces']) && $fb_like_bx_settings['showFaces']=="no"){echo 'checked';}?>><label for="showFaces2">No</label></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img border="0"  value="Tip" class="tip" src="<?php echo plugins_url( 'images/help.png', __FILE__ )?>" title="To display profile photos of people who liked your page.">
							</div>
							</td>
						</tr>
						<tr>
							<th>
								Display Header:
							</th>
							<td>
							<div class="cmb_radio_inline"><div class="cmb_radio_inline_option">
							<input type="radio" name="header" id="header1" value="yes" <?php if(isset($fb_like_bx_settings['header']) && $fb_like_bx_settings['header']=="yes"){echo 'checked';}?>><label for="header1">Yes</label></div>
							<div class="cmb_radio_inline_option"><input type="radio" name="header" id="header2" value="no" <?php if(isset($fb_like_bx_settings['header']) && $fb_like_bx_settings['header']=="no"){echo 'checked';}?>><label for="header2">No</label></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img border="0"  value="Tip" class="tip" title="To display the FB header at the top of the box." src="<?php echo plugins_url( 'images/help.png', __FILE__ )?>" title="Display 'Find Us on FB' header on the box">
							</div>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
								<input type="hidden" name="fb_form_submit" value="submit" />
								<input type="submit" class="button-primary" value="Save Changes" />
							</td>
						</tr>
					</table>
					<?php wp_nonce_field( plugin_basename( __FILE__ ), 'fb_nonce' ); ?>
				</form>
				<?php } ?>
				</div>
				</div>
				<div class="postbox right ads_bar">
			<h3 class="hndle" style="padding:10px;"><span>Follow Us</span></h3>
			<div class="inside">
			Give your valuable feedback so that we can improve the plugin for you and other users. Please take the time to let us and others know about your experiences by leaving a review.
<br/>
		
			</div>
			</div>
		</div>
	<?php }
	function fb_like_bx_update_options($data) {
		update_option( 'fb_like_bx_options', $data );
	}
	function fb_admin_init_menu() {
		add_menu_page( 'DYC Plugins', 'DYC Plugins', 'manage_options', 'dyc_plugins', 'fb_like_bx_settings_page', '', 1001 );
		add_submenu_page( 'dyc_plugins','FB Widget Settings','FB Widget', 'manage_options', "fb_box_settings", 'fb_like_bx_settings_page' );
	}
	
add_action( 'admin_menu', 'fb_admin_init_menu' );
add_action( 'wp_enqueue_scripts', 'fb_wp_head' );
add_action( 'admin_enqueue_scripts', 'fb_wp_head' );
?>