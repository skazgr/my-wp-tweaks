<?php
/**
 * Reading Progress Bar
 * Injects a slim progress bar at top of posts.
 */

add_action('wp_enqueue_scripts', function() {
    if (is_singular('post')) {
        $base = get_stylesheet_directory_uri() . '/reading-progress-bar';
        wp_enqueue_style('reading-progress-css', $base . '/progress-bar.css');
        wp_enqueue_script('reading-progress-js', $base . '/progress-bar.js', array('jquery'), null, true);
    }
});

add_action('wp_body_open', function() {
    if (is_singular('post')) {
        echo '<div id="reading-progress"><div id="reading-progress-bar"></div></div>';
    }
});
?>