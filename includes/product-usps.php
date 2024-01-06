<?php

add_action('add_meta_boxes', 'wcusp_add_product_meta_box');

function wcusp_add_product_meta_box()
{
    add_meta_box(
        'wcusp_product_usp',
        __('Product USPs', 'wcusp_domain'),
        'wcusp_product_usp_callback',
        'product',
        'advanced',
    );
}

function wcusp_product_usp_callback($post)
{
    // Fetch USPs stored in post meta or initialize with an empty array
    $usps = get_post_meta($post->ID, '_wcusp_settings', true);
    if (empty($usps)) {
        $usps = [];
    }

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'wcusp_product_usp_nonce');

    // Output the form fields
    echo '<table class="form-table" id="wcusp_table">';

    foreach ($usps as $index => $usp) {
        echo '<tr class="wcusp_row flex-row" data-usp-number="' . esc_attr($index) . '">';
        echo '<th>USP' . esc_html($index + 1) . '</th>';
        echo '<td>';
        echo '<input type="hidden" name="wcusp_settings[usps][' . esc_attr($index) . '][icon]" class="regular-text" value="' . esc_attr($usp['icon'] ?? '') . '" />';
        echo '<div class="button icon-picker ' . esc_attr(str_replace("|", " ", $usp['icon'] ?? '')) . '"></div>';
        echo '</td>';
        echo '<td class="full-width">';
        echo '<input type="text" name="wcusp_settings[usps][' . esc_attr($index) . '][text]" class="full-width-input" value="' . esc_attr($usp['text'] ?? '') . '" />';
        echo '</td>';
        echo '<td>';
        echo '<button type="button" class="button wcusp_remove_usp" data-usp-number="' . esc_attr($index) . '">X</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '<button type="button" id="add_usp" class="button">Add USP</button>';
}


add_action('save_post', 'wcusp_save_product_usps');

function wcusp_save_product_usps($post_id)
{
    if (!isset($_POST['wcusp_product_usp_nonce']) || !wp_verify_nonce($_POST['wcusp_product_usp_nonce'], plugin_basename(__FILE__))) {
        return $post_id;
    }

    $sanitized_usps = array();

    if (!empty($_POST['wcusp_settings']['usps']) && is_array($_POST['wcusp_settings']['usps'])) {
        foreach ($_POST['wcusp_settings']['usps'] as $usp) {
            $sanitized_icon = isset($usp['icon']) ? sanitize_text_field($usp['icon']) : '';
            $sanitized_text = isset($usp['text']) ? sanitize_text_field($usp['text']) : '';

            $sanitized_usps[] = array(
                'icon' => $sanitized_icon,
                'text' => $sanitized_text
            );
        }
    }

    update_post_meta($post_id, '_wcusp_settings', $sanitized_usps);
}
