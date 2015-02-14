<?php

class ERM_Admin{

	// Function to add admin menu
	function erm_admin_menu_options(){

		// Enque Admin Script
		$handle = 'erm_color_picker_script';
		$src = ERM__PLUGIN_URL.'jscolor/jscolor.js';
		wp_register_script( $handle , $src );
		wp_enqueue_script( $handle );
		
		
		
		// Registering Plugin Options
			// Activation Option
			register_setting( 'erm-settings-group', 'erm_is_activated' );
			register_setting( 'erm-settings-group', 'erm_use_custom_design' );

			// Button Text Option
			register_setting( 'erm-settings-group', 'erm_button_text' );
			register_setting( 'erm-settings-group', 'erm_button_text_color' );
			register_setting( 'erm-settings-group', 'erm_button_text_size' );
			

			// Button Design
			register_setting( 'erm-settings-group', 'erm_button_background_color' );
			register_setting( 'erm-settings-group', 'erm_button_border' );
			register_setting( 'erm-settings-group', 'erm_button_padding' );
			register_setting( 'erm-settings-group', 'erm_button_margin' );

			// Text Button Design on Hover
			register_setting( 'erm-settings-group', 'erm_hover_button_background_color' );
			register_setting( 'erm-settings-group', 'erm_hover_text_color' );

			register_setting( 'erm-settings-group', 'erm_is_first_time' );
			add_options_page( 'Easy Reading Mode | Options Page' , 'Easy Reading Mode' , 'manage_options' , 'reading-mode-options-page' , array( 'ERM_Admin' , 'admin_page_content' ) );
	}

	// Admin page content
	function admin_page_content(){
		if(get_option('erm_is_first_time') != 'no'){
				update_option('erm_is_activated','yes');		
			}

		

		echo '<form method="post" action="options.php" class="erm-options-form">';
		settings_fields( 'erm-settings-group' );
    	do_settings_sections( 'erm-settings-group' );
	
		// Fetching Current Option Settings
    	
    	$activated = esc_attr( get_option('erm_is_activated') );
    	$use_custom_design = esc_attr( get_option('erm_use_custom_design') );

    	$button_text = esc_attr( get_option('erm_button_text') );
    	$button_text_color = esc_attr( get_option('erm_button_text_color') );
    	$button_text_size = esc_attr( get_option('erm_button_text_size') );
    	$button_padding = esc_attr( get_option('erm_button_padding') );
    	$button_margin = esc_attr( get_option('erm_button_margin'));

    	$background_color = esc_attr( get_option( 'erm_button_background_color' ) );
    	$border = esc_attr( get_option( 'erm_button_border' ) );

    	$hover_background_color = esc_attr( get_option('erm_hover_button_background_color') );
    	$hover_text_color = esc_attr( get_option('erm_hover_text_color') );


    	// 1. Activation Option
    	?>
    	<h1>Easy Reading Mode Options Page</h1>
    	<form>
    		<table>
    			<tr>
    				<td><h3>General Options</h3></td>
    			<tr>
    				<td><label>Reading Mode Active</label></td>
					<td>
						<?php if($activated == 'yes'){ ?>
							<input type="radio" name="erm_is_activated" value="yes" checked="checked">Yes
							<input type="radio" name="erm_is_activated" value="no">No<br>
						<?php }else{ ?>
							<input type="radio" name="erm_is_activated" value="yes">Yes
							<input type="radio" name="erm_is_activated" value="no" checked="checked">No<br>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td><label>Button Text</label></td>
					<td><input type="text" name="erm_button_text" value="<?php echo $button_text; ?>"></td>
				<tr>

				<tr>
					<td><label>Use Below Design Options</label></td>
		
					<td>
						<?php if($use_custom_design == 'yes'){ ?>
							<input type="radio" name="erm_use_custom_design" value="yes" checked="checked">Yes
							<input type="radio" name="erm_use_custom_design" value="no">No<br>
						<?php }else{ ?>
							<input type="radio" name="erm_use_custom_design" value="yes">Yes
							<input type="radio" name="erm_use_custom_design" value="no" checked="checked">No<br>
						<?php } ?>
					</td>
				</tr>
				<!-- Button Text Settings -->
				<tr>
					<td><h3>Button Text Options</h3></td>
				</tr>
				<tr>
					<td><label>Button Text Color</label></td>
					<td><input type="text" name="erm_button_text_color" value="<?php echo $button_text_color; ?>" class="color"></td>
				<tr>
				<!-- <tr>
					<td><label>Button Text Size</label></td>
					<td><input type="text" name="erm_button_text_size" value="<?php echo $button_text_size; ?>">px</td>
				<tr> -->
				
				<tr>
					<td><h3>Button Options</h3></td>
				</tr>
				<tr>
					<td><label>Background Color</label></td>
					<td><input type="text" name="erm_button_background_color" value="<?php echo $background_color?>" class="color" /></td>
				<tr>
				<tr>
					<td><label>Border</label></td>
					<td><input type="text" name="erm_button_border" value="<?php echo $border?>" /> (in standard css format. To remove border use 'none')</td>
				<tr>
				<tr>
					<td><label>Button Padding</label></td>
					<td><input type="text" name="erm_button_padding" value="<?php echo $button_padding; ?>"> (in standard css format with 'px' as suffix - eg: 5px 10px)</td>
				<tr>
				<tr>
					<td><label>Button Margin</label></td>
					<td><input type="text" name="erm_button_margin" value="<?php echo $button_margin; ?>"> (in standard css format with 'px' as suffix - eg: 5px 10px)</td>
				<tr>
				
				<!-- <tr>
					<td><h3>Hover Options</h3></td>
				</tr>
				<tr>
					<td><label>Button Background Color</label></td>
					<td><input type="text" name="erm_hover_button_background_color" value="<?php echo $hover_background_color?>" class="color" /></td>
				<tr>
				<tr>
					<td><label>Button Text Color</label></td>
					<td><input type="text" name="erm_hover_text_color" value="<?php echo $hover_text_color?>" class="color" /></td>
				<tr> -->
				<tr>
					<td><?php submit_button(); ?></td>
				</tr>
			</table>
			<input type="hidden" name="erm_is_first_time" value="no">
		</form>
		
	<?php }

 } ?>