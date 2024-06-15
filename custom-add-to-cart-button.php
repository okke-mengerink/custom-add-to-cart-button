<?php
/*
Plugin Name: Custom Add to Cart Button
Description: Overrides the text and URL of the WooCommerce Add to Cart button.
Version: 1.0
Author: Okke Mengerink
*/

// Ensure the plugin is loaded after WooCommerce is initialized
add_action('plugins_loaded', 'custom_add_to_cart_button_init');

function custom_add_to_cart_button_init() {
    // Check if WooCommerce is activated
    if (class_exists('WooCommerce')) {
        // Add filters to customize the Add to Cart button
        add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_button_text'); // Single product page
        add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_button_text'); // Product archive page

        // Add a filter to modify the Add to Cart button URL
        add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect_url');
    }
}

// Function to change the Add to Cart button text
function custom_add_to_cart_button_text() {
    return __('Buy Now', 'custom-add-to-cart-button');
}

// Function to change the Add to Cart button URL
function custom_add_to_cart_redirect_url($url) {
    // Replace 'https://example.com/your-custom-url' with your desired URL
    return 'https://example.com/your-custom-url';
}
?>