<?php
// Replace login page logo with a custom image from Media Library
function skazgr_custom_login_logo() {
    echo '
    <style type="text/css">
        .login h1 a {
            background-image: url("https://yourdomain.com/wp-content/uploads/2025/06/my-logo.png");
            background-size: contain;
            width: 100%;
            height: 100px;
        }
    </style>';
}
add_action('login_head', 'skazgr_custom_login_logo');
