<?php
add_action('woocommerce_before_calculate_totals', function ($cart) {
    $gift_product_id = 123; // Replace with actual product ID
    $min_cart_total = 50;

    if (is_admin() || defined('DOING_AJAX')) return;

    $has_gift = false;
    foreach ($cart->get_cart() as $item) {
        if ($item['product_id'] == $gift_product_id) {
            $has_gift = true;
            break;
        }
    }

    if ($cart->get_subtotal() >= $min_cart_total && !$has_gift) {
        $cart->add_to_cart($gift_product_id);
    }

    if ($cart->get_subtotal() < $min_cart_total && $has_gift) {
        foreach ($cart->get_cart() as $key => $item) {
            if ($item['product_id'] == $gift_product_id) {
                $cart->remove_cart_item($key);
            }
        }
    }
});
