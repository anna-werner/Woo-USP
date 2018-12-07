<?php
/**
 * Plugin Name: Woo USP
 * Plugin URI: #
 * Description: This plugin allows you to display up to five unique selling propositions in you WooCommerce store. Display them anywhere with the shortcode [woousp].
 * Version: 1.1.0
 * Author: Anna Schneider
 * Author URI: https://www.annaschneider.me
 * License: GPL2
 */

/******************************
* global variables
******************************/

// retrieve  plugin settings from the options table
$wcusp_prefix = 'wcusp_';
$wcusp_options = get_option('wcusp_settings');

/******************************
* includes
******************************/

include('assets/scripts.php'); // this controls all JS / CSS
include('includes/data-processing.php'); // this controls all saving of data
include('includes/admin-options.php'); // the plugin options page HTML and save functions

//Add Markup to Single Product Page 
add_action( 'woocommerce_single_product_summary', 'wc_usp_table', 33 );
function wc_usp_table() {
	include("includes/form-markup.php");
}


//Add Shortcode 
add_shortcode('woousp', 'wc_usp_shortcode');
function wc_usp_shortcode(){
    ob_start();
	include_once('includes/form-markup.php');
	return ob_get_clean();
}

