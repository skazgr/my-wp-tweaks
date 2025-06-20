<?php
// Add "Last Edited By" column to admin posts list
function add_last_edited_by_column($columns) {
    $columns['last_edited_by'] = 'Last Edited By';
    return $columns;
}

function show_last_edited_by_column($column_name, $post_id) {
    if ($column_name === 'last_edited_by') {
        $last_editor_id = get_post_meta($post_id, '_edit_last', true);
        if ($last_editor_id) {
            $user = get_userdata($last_editor_id);
            echo esc_html($user->display_name);
        } else {
            echo '-';
        }
    }
}

$post_types = ['post', 'page']; // Add custom post types if needed

foreach ($post_types as $post_type) {
    add_filter("manage_{$post_type}_posts_columns", 'add_last_edited_by_column');
    add_action("manage_{$post_type}_posts_custom_column", 'show_last_edited_by_column', 10, 2);
}
