<?php
add_filter('woocommerce_get_availability_text', function($availability, $product) {
    if (!$product instanceof WC_Product) {
        return $availability;
    }

    if (!$product->is_in_stock()) {
        return 'Back in stock soon!';
    }

    return $availability;
}, 10, 2);
