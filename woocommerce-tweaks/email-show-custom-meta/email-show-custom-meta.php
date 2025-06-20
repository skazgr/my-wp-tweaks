<?php
add_action('woocommerce_order_item_meta_end', function ($item_id, $item, $order) {
    $product = $item->get_product();
    $custom_field = get_post_meta($product->get_id(), '_custom_field_key', true);
    if ($custom_field) {
        echo '<p><strong>Extra Info:</strong> ' . esc_html($custom_field) . '</p>';
    }
}, 10, 3);
