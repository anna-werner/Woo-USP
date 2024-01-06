<?php

function wcusp_options_page()
{
	global $wcusp_options;

	// Ensure USPs are in an array format
	$usps = isset($wcusp_options['usps']) && is_array($wcusp_options['usps']) ? $wcusp_options['usps'] : [];

?>
	<div class="wrap">
		<h2>Woo USPs</h2>

		<form method="post" action="options.php">
			<?php settings_fields('wcusp_settings_group'); ?>

			<table class="form-table" id="wcusp_table">
				<tr>
					<th scope="row"><label for="wcusp_icon_color"><?php echo __('Icon Color'); ?></label></th>
					<td colspan="2">
						<input name="wcusp_settings[wcusp_icon_color]" id="wcusp_icon_color" type="text" class="my-input-class" value="<?php echo esc_attr($wcusp_options['wcusp_icon_color'] ?? ''); ?>">
					</td>
				</tr>
				<?php foreach ($usps as $index => $usp) : ?>
					<tr class="wcusp_row flex-row" data-usp-number="<?php echo $index; ?>">
						<th scope="row">USP<?php echo $index + 1; ?></th>
						<td>
							<input id="wcusp_settings_usps_<?php echo $index; ?>_icon" name="wcusp_settings[usps][<?php echo $index; ?>][icon]" class="regular-text" type="hidden" value="<?php echo esc_attr($usp['icon'] ?? ''); ?>" />
							<div id="preview_wcusp_settings_usps_<?php echo $index; ?>_icon" data-target="#wcusp_settings_usps_<?php echo $index; ?>_icon" class="button icon-picker <?php echo str_replace("|", " ", $usp['icon']) ?? ''; ?>"></div>
						</td>
						<td class="full-width">
							<input id="wcusp_settings_usps_<?php echo $index; ?>_text" name="wcusp_settings[usps][<?php echo $index; ?>][text]" type="text" class="full-width-input" value="<?php echo esc_attr($usp['text'] ?? ''); ?>" />
						</td>
						<td>
							<button type="button" class="button wcusp_remove_usp" data-usp-number="<?php echo $index; ?>">X</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>

			<button type="button" id="add_usp" class="button">Add USP</button>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Options', 'wcusp_domain'); ?>" />
			</p>
		</form>
	</div>
<?php
}

function wcusp_add_options_link()
{
	add_options_page('Woo USPs', 'Woo USPs', 'manage_options', 'wcusp-options', 'wcusp_options_page');
}
add_action('admin_menu', 'wcusp_add_options_link');

function wcusp_register_settings()
{
	register_setting('wcusp_settings_group', 'wcusp_settings', array(
		'type' => 'array',
		'description' => 'WooCommerce USP settings',
		'sanitize_callback' => 'wcusp_sanitize_settings',
		'default' => array()
	));
}
add_action('admin_init', 'wcusp_register_settings');


function wcusp_sanitize_settings($input)
{
	$new_input = array();

	// Handle the USPs
	if (isset($input['usps']) && is_array($input['usps'])) {
		foreach ($input['usps'] as $usp) {
			$sanitized_usp = array(
				'icon' => isset($usp['icon']) ? sanitize_text_field($usp['icon']) : '',
				'text' => isset($usp['text']) ? sanitize_text_field($usp['text']) : ''
			);
			$new_input['usps'][] = $sanitized_usp;
		}
	}

	// Handle the icon color
	if (isset($input['wcusp_icon_color'])) {
		$new_input['wcusp_icon_color'] = sanitize_hex_color($input['wcusp_icon_color']);
	}

	return $new_input;
}
