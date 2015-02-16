<?php

class ERM_Admin{

	function erm_register_settings(){
		register_setting( 'erm-settings-group', 'erm-settings' );

		add_settings_section( 'erm-general-options', 'General Options', array('ERM_Admin','section_one_callback'), 'erm-options-page' );
		add_settings_section( 'erm-design-options', 'Design Options', array('ERM_Admin','section_one_callback'), 'erm-options-page' );

		// Declaring All Settings Options
			$obj = new ERM_Admin();

   			$obj->erm_new_field(array(
					'id'=>'erm_is_activated',
					'label'=>'Activated',
					'field_type'=>'checkbox',
					'type'=>'text',
					'group'=>'erm-general-options',
					'class'=>'erm-checkbox'
					));	

   			$obj->erm_new_field(array(
   					'id'=>'erm_custom_design',
   					'label'=>'Use Custom Design',
   					'field_type'=>'checkbox',
   					'type'=>'text',
   					'group'=>'erm-general-options',
   					'class'=> 'erm-checkbox'
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_button_text',
   					'label'=>'Button Text',
   					'field_type'=>'input',
   					'type'=>'text',
   					'group'=>'erm-design-options',
   					'class'=>'erm-input'
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_text_color',
   					'label'=>'Text Color',
   					'field_type'=>'input',
   					'type'=>'text',
   					'group'=>'erm-design-options',
   					'class'=>'color'
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_text_size',
   					'label'=>'Text Size',
   					'field_type'=>'input',
   					'type'=>'text',
   					'group'=>'erm-design-options',
   					'class'=>'erm-input'
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_background_color',
   					'label'=>'Button Background Color',
   					'field_type'=>'input',
   					'type'=>'text',
   					'group'=>'erm-design-options',
   					'class'=>'color'
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_border',
   					'label'=>'Button Border',
   					'field_type'=>'input',
   					'type'=>'text',
   					'group'=>'erm-design-options',
   					'class'=>'erm-input',
   					'help-text'=>"(in standard css format - eg: 5px solid black. To remove border use 'none')"
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_padding',
   					'label'=>'Button Padding',
   					'field_type'=>'input',
   					'type'=>'text',
   					'group'=>'erm-design-options',
   					'class'=>'erm-input',
   					'help-text'=>"(in standard css format with 'px' as suffix - eg: 5px 10px)"
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_margin',
   					'label'=>'Button Margin',
   					'field_type'=>'input',
   					'type'=>'text',
   					'group'=>'erm-design-options',
   					'class'=>'erm-input',
   					'help-text'=>"(in standard css format with 'px' as suffix - eg: 5px 10px)"
   				));

   			$obj->erm_new_field(array(
   					'id'=>'erm_is_first_time',
   					'label'=>'',
   					'field_type'=>'input',
   					'type'=>'hidden',
   					'group'=>'erm-design-options',
   					'class'=>'erm-input'
   				));


	}

	// Registering Setting and Field
	function erm_new_field($field){
		register_setting('erm-settings-group',$field['id']);
		
		$args = array(
			'field_type'=>$field['field_type'],
			'type'=>$field['type'],
			'id'=>$field['id']
		);

		if($field['class'])
			$args['class']=$field['class'];

		if($field['help-text'])
			$args['help-text']=$field['help-text'];

		add_settings_field($field['id'],$field['label'],array('ERM_Admin', 'erm_field_callback'),'erm-options-page',$field['group'],$args);
	}


	// Callback Function to print form field
	function erm_field_callback($args){
		$setting = esc_attr( get_option($args['id']) );
		
		if($args['field_type']=='input'){	
			echo '<'.$args['field_type'].' type="'.$args['type'].'" id="'.$args['id'].'" name="'.$args['id'].'" value="'.$setting.'" class="'.$args['class'].'"/>';
		}

		
		if($args['field_type']=='checkbox'){
			if($setting == 'yes'){
				echo '<input type="radio" name="'.$args['id'].'" value="yes" checked="checked">Yes';
				echo '<input type="radio" name="'.$args['id'].'" value="no">No<br>';
			}else{
				echo '<input type="radio" name="'.$args['id'].'" value="yes">Yes';
				echo '<input type="radio" name="'.$args['id'].'" value="no" checked="checked">No<br>';
			}
		}

		if($args['help-text']);
			echo $args['help-text'];

	}

	// Section Callback
	function section_one_callback(){
		// Do Nothing
	}

	// Options Page Form Output
	function erm_options_page() {

			update_option('erm_is_first_time','no');

			
	    	$handle = 'erm_color_picker_script';
			$src = ERM__PLUGIN_URL.'jscolor/jscolor.js';
			wp_register_script( $handle , $src );
			wp_enqueue_script( $handle );
    	?>

	    <div class="wrap">
	    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	        <h2>My Plugin Options</h2>
	        <form action="options.php" method="POST">
	            <?php settings_fields( 'erm-settings-group' ); ?>
	            <?php do_settings_sections( 'erm-options-page' ); ?>
	            <?php submit_button(); ?>
	        </form>
	    </div>
    	<?php
	}

}