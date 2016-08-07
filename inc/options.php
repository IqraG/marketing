<?php

function mrkting_add_submenu() {
	add_submenu_page( 'themes.php', 'My Super Awesome Options Page', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
}
add_action( 'admin_menu', 'mrkting_add_submenu' );

//Allows users to enter their name in the Footer
function mrkting_settings_init() { 
	register_setting ('theme_options', 'mrkting_options_settings');
	add_settings_section(
	'mrkting_options_page',
	'Choose Your Options',
	'mrkting_options_page_callback',
	'theme_options'
	);
	function mrkting_options_page_callback() { 
		echo 'You can enter your name in the footer, choose header for posts headings, and choose your background colour';
	}

	//Allows users to enter their name in the Footer
	add_settings_field( 
	'mrkting_text_field',
	'Enter Your Name',
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

	add_settings_field( 'mrkting_radio_field', 
		'Choose Header Style', 
		'mrkting_radio_field_render', 
		'theme_options', 
		'mrkting_options_page'
	);
	function mrkting_radio_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<input type="radio" name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 1 ); ?>
				value="1" /><label>Header 1</label><br />
		<input type="radio" name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 2 ); ?>
				value="2" /><label>Header 2</label><br />
		<input type="radio"name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 3 ); ?>
				value="3" /><label>Header 3</label>
		<?php
	}

	add_settings_field( 
		'mrkting_select_field', 
		'Choose Your Background', 
		'mrkting_select_field_render', 
		'theme_options', 
		'mrkting_options_page'
		);
	function mrkting_select_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<select name="mrkting_options_settings[mrkting_select_field]">
			<option value="1"<?php if (isset($options['mrkting_select_field'])) selected( $options['mrkting_select_field'], 1 ); ?>>Light</option>
			<option value="2"<?php if (isset($options['mrkting_select_field'])) selected( $options['mrkting_select_field'], 2 ); ?>>Dark</option>
		</select>
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

















