<?php

function mrkting_add_submenu() {
	add_submenu_page( 'themes.php', 'My Super Awesome Options Page', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
}
add_action( 'admin_menu', 'mrkting_add_submenu' );

function mrkting_settings_init() { 
	register_setting ('theme_options', 'mrkting_options_settings');
	add_settings_section(
	'mrkting_options_page_section', //  the id
	'Your section title', // Section Title
	'mrkting_options_page_section_callback', //$callback (function we will create)
	'theme_options'// page (matches menu_slug set in add_submenu_page)
	);
	function mrkting_options_page_section_callback() { 
		echo 'A description and detail about the section.';
	}

	add_settings_field( 
	'mrkting_text_field', // id
	'Enter your text', // title
	'mrkting_text_field_render', // $callback (function we will create)
	'theme_options', // page (matches menu_slug)
	'mrkting_options_page_section'// section (matches section in add_settings_section)
	);
	function mrkting_text_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<input type="text" name="mrkting_options_settings[mrkting_text_field]" value="<?php if(isset($options['mrkting_text_field'])) echo $options['mrkting_text_field']; ?>"  />
		<?php
	}
	add_settings_field( 
		'mrkting_checkbox_field', 
		'Check your preference', 
		'mrkting_checkbox_field_render', 
		'theme_options', 
		'mrkting_options_page_section'
	);
	function mrkting_checkbox_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
			?>
		<input type="checkbox" name="mrkting_options_settings[mrkting_checkbox_field]" 
			<?php if(isset($options['mrkting_checkbox_field'])) checked( 'on', ($options['mrkting_checkbox_field']) ) ;?> 
				value="on" />
		<label>Turn it On</label>
		<?php
	}

	add_settings_field( 'mrkting_radio_field', 
		'Choose an option', 
		'mrkting_radio_field_render', 
		'theme_options', 
		'mrkting_options_page_section'
	);
	function mrkting_radio_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<input type="radio" name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 1 ); ?>
				value="1" /><label>Option One</label><br />
		<input type="radio" name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 2 ); ?>
				value="2" /><label>Option Two</label><br />
		<input type="radio"name="mrkting_options_settings[mrkting_radio_field]"<?php if(isset($options['mrkting_radio_field'])) checked( $options['mrkting_radio_field'], 3 ); ?>
				value="3" /><label>Option Three</label>
		<?php
	}

	add_settings_field( 
		'mrkting_textarea_field', 
		'Enter content in the textarea', 
		'mrkting_textarea_field_render', 
		'theme_options', 
		'mrkting_options_page_section'
	);
	function mrkting_textarea_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<textarea cols="40" rows="5" name="mrkting_options_settings[mrkting_textarea_field]">
			<?php if (isset($options['mrkting_textarea_field'])) echo$options['mrkting_textarea_field']; ?>
		</textarea>
		<?php
	}

	add_settings_field( 
		'mrkting_select_field', 
		'Choose from the dropdown', 
		'mrkting_select_field_render', 
		'theme_options', 
		'mrkting_options_page_section'
		);
	function mrkting_select_field_render() { 
		$options = get_option( 'mrkting_options_settings' );
		?>
		<select name="mrkting_options_settings[mrkting_select_field]">
			<option value="1"<?php if (isset($options['mrkting_select_field'])) selected( $options['mrkting_select_field'], 1 ); ?>>Option 1</option>
			<option value="2"<?php if (isset($options['mrkting_select_field'])) selected( $options['mrkting_select_field'], 2 ); ?>>Option 2</option>
		</select>
		<?php
	}

	function my_theme_options_page(){ 
	?>
	<form action="options.php" method="post">
		<h2>My Awesome Options Page</h2>
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

















