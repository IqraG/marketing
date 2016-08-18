<?php

function mrkting_add_submenu() {
	add_submenu_page( 'themes.php', 'Options Page', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
}
add_action( 'admin_menu', 'mrkting_add_submenu' );


function mrkting_settings_init() { 
	register_setting ('theme_options', 'mrkting_options_settings');
	add_settings_section(
	'mrkting_options_page',
	'Choose Your Options',
	'mrkting_options_page_callback',
	'theme_options'
	);
	function mrkting_options_page_callback() { 
		// Options page description
		echo 'You can enter your name in the footer, choose to display page image, and choose font for homepage content';
	}

	//Allows users to enter their name in the Footer
	add_settings_field( 
	'mrkting_text_field',
	'Enter Your Name', // Field to enter name
	'mrkting_text_field_render',
	'theme_options',
	'mrkting_options_page'
	);
	function mrkting_text_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<input type="text" name="mrkting_options_settings[mrkting_text_field]" value="<?php if(isset($options['mrkting_text_field'])) echo $options['mrkting_text_field']; ?>"  />
		<?php
	}

	//Option to turn to header type
	add_settings_field( 'mrkting_radio_field', 
		'Choose Header Font for Front Page', 
		'mrkting_radio_field_render', 
		'theme_options', 
		'mrkting_options_page'
	);
	function mrkting_radio_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<input type="radio" name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 1 ); ?> 
				value="1" /><label>Quicksand</label><br />
		<input type="radio" name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 2 ); ?>
				value="2" /><label>Julius Sans One</label><br />
		<input type="radio"name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 3 ); ?>
				value="3" /><label>Poiret One</label>
		<?php
	}

	//Option to turn on/off image on the bottom of pages
	add_settings_field( 
		'mrkting_checkbox_image', 
		'Page Image', 
		'mrkting_checkbox_image_render', 
		'theme_options', 
		'mrkting_options_page'
	);
	function mrkting_checkbox_image_render() { 
		$options = get_option( 'mrkting_options_settings' ); 
			?>
		<input type="checkbox" name="mrkting_options_settings[mrkting_checkbox_image]" 
			<?php if(isset($options['mrkting_checkbox_image'])) checked( 'on', ($options['mrkting_checkbox_image']) ) ;?> 
				value="on" />
		<label>Turn it On</label> 
		<?php
	}

	function my_theme_options_page(){ 
	?>
	<form action="options.php" method="post">
		<h2>Options Page</h2>
		<?php
			settings_fields( 'theme_options' );
			do_settings_sections( 'theme_options' );
			submit_button();
		?>
	</form>
	<?php
	}
}
add_action( 'admin_init', 'mrkting_settings_init' );

















