<?php
add_action('woocommerce_after_shop_loop_item_title', function () {
    global $product;
    $sku = $product->get_sku();
    if ($sku) {
        echo '<p class="product-sku">SKU: ' . esc_html($sku) . '</p>';
    }
}, 11);
