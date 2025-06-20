<?php
// Restrict free shipping method to logged-in users only
add_filter('woocommerce_package_rates', function($rates) {
    if (!is_user_logged_in()) {
        foreach ($rates as $rate_id => $rate) {
            if ('free_shipping' === $rate->method_id) {
                unset($rates[$rate_id]);
            }
        }
    }
    return $rates;
});
