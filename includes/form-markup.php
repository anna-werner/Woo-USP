<?php

// Include Options
$wcusp_options = get_option('wcusp_settings');

$post_id = get_queried_object_id();
$product_usps = [];
if ($post_id) {
	$product_usps = get_post_meta($post_id, '_wcusp_settings', true);
}

// Check and get global USPs array if product-specific USPs are not set
$global_usps = isset($wcusp_options['usps']) ? $wcusp_options['usps'] : [];

$usps = !empty($product_usps) ? $product_usps : $global_usps;

if (empty($usps)) {
	return;
}

// Start the USPs container
echo '<div class="product-usps-wrapper">
        <div class="product-usps">';

// Loop through each USP in the array
foreach ($usps as $usp) {
	// Extract icon and text for each USP
	$icon_class = isset($usp['icon']) ? str_replace("|", " ", $usp['icon']) : '';
	$usp_text = $usp['text'] ?? '';

	// Output the USP block
	echo '<div class="product-usp-block">
            <div class="usp-image">
                <i style="color:' . ($wcusp_options['wcusp_icon_color'] ?? '#defaultColor') . '" class="' . $icon_class . '"></i>
            </div>
            <div class="usp-title">
                <span>' . esc_html($usp_text) . '</span>
            </div>
          </div>';
}

// End the USPs container
echo '</div>
    </div>';
