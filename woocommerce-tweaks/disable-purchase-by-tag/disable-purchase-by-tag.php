<?php
add_filter('woocommerce_is_purchasable', function ($purchasable, $product) {
    if (has_term('view-only', 'product_tag', $product->get_id())) {
        return false;
    }
    return $purchasable;
}, 10, 2);
