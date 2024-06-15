<?php
/*
Plugin Name: Custom Buy Now Button
Description: Hides the WooCommerce Add to Cart button and replaces it with a custom button that redirects to a specified URL in a new tab.
Version: 1.0
Author: Okke Mengerink
*/

// Ensure the plugin is loaded after WooCommerce is initialized
add_action('plugins_loaded', 'custom_buy_now_button_init');

function custom_buy_now_button_init() {
    // Check if WooCommerce is activated
    if (class_exists('WooCommerce')) {
        // Add filters to customize the Add to Cart button text
        add_filter('woocommerce_product_single_add_to_cart_text', 'custom_buy_now_button_text'); // Single product page
        add_filter('woocommerce_product_add_to_cart_text', 'custom_buy_now_button_text'); // Product archive page

        // Add an action to add custom JavaScript to the footer
        add_action('wp_footer', 'custom_buy_now_button_js');
    }
}

// Function to change the Add to Cart button text
function custom_buy_now_button_text() {
    return __('Buy Now', 'custom-buy-now-button');
}

// Function to add custom JavaScript to the footer
function custom_buy_now_button_js() {
    if (is_product()) {
        ?>
        <script>
        jQuery(function($) {
            // Hide the original add to cart button
            $('.single_add_to_cart_button').hide();

            // Create a custom button with desired functionality
            var customButton = $('<button class="custom-buy-now-button button">Buy Now</button>');
            $('.single_add_to_cart_button').after(customButton);

            // Handle click event on custom button
            customButton.on('click', function(e) {
                e.preventDefault();

                // Redirect to desired URL in a new tab
                var redirect_url = 'https://www.google.com'; // Replace with your desired URL
                var win = window.open(redirect_url, '_blank');
                win.focus();
            });
        });
        </script>
        <?php
    }
}
?>
