<?php

/******************************
 * script control
 ******************************/

function wcusp_load_scripts()
{
    if (!is_admin()) {
        wp_enqueue_style('main-css', plugin_dir_url(__FILE__) . 'css/main.css');
    }
}
add_action('wp_enqueue_scripts', 'wcusp_load_scripts');

/******************************
 * enqueue icons
 ******************************/

//Backend
function wcusp_admin_scripts($hook_suffix)
{
    if ($hook_suffix == 'settings_page_wcusp-options' || $hook_suffix == 'post.php' || $hook_suffix == 'post-new.php') {
        $css = plugin_dir_url(__FILE__) . 'css/icon-picker.css';
        wp_enqueue_style('dashicons-picker', $css, array('dashicons'), '1.0');

        $js = plugin_dir_url(__FILE__) . 'js/admin.js';
        wp_enqueue_script('admin-scripts', $js, array('jquery'), '1.0');

        $css = plugin_dir_url(__FILE__) . 'css/admin.css';
        wp_enqueue_style('admin-css', $css, '', '');

        $iconpicker = plugin_dir_url(__FILE__) . 'js/icon-picker.js';
        wp_enqueue_script('dashicons-picker', $iconpicker, array('jquery'), '1.0');

        $fontawesome = plugin_dir_url(__FILE__) . 'fonts/font-awesome/css/font-awesome.css';
        wp_enqueue_style('font-awesome', $fontawesome);

        $linearicons = plugin_dir_url(__FILE__) . 'fonts/linearicons/style.css';
        wp_enqueue_style('linearicons', $linearicons, '', '');

        $linecons = plugin_dir_url(__FILE__) . 'fonts/linecons/style.css';
        wp_enqueue_style('linecons', $linecons, '', '');
    }
}
add_action('admin_enqueue_scripts', 'wcusp_admin_scripts');


//Frontend
function wcusp_frontend_icon_picker_scripts()
{
    wp_enqueue_style('dashicons');
    $fontawesome = plugin_dir_url(__FILE__) . 'fonts/font-awesome/css/font-awesome.css';
    wp_enqueue_style('font-awesome', $fontawesome, '', '');
    $linearicons = plugin_dir_url(__FILE__) . 'fonts/linearicons/style.css';
    wp_enqueue_style('linearicons', $linearicons, '', '');
    $linecons = plugin_dir_url(__FILE__) . 'fonts/linecons/style.css';
    wp_enqueue_style('linecons', $linecons, '', '');
}
add_action('wp_enqueue_scripts', 'wcusp_frontend_icon_picker_scripts');

/******************************
 * enqueue color picker
 ******************************/

function color_picker_assets($hook_suffix)
{
    // $hook_suffix to apply a check for admin page.
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-script-handle', plugin_dir_url(__FILE__) . '/js/color-picker.js', array('wp-color-picker'), false, true);
}
add_action('admin_enqueue_scripts', 'color_picker_assets');
