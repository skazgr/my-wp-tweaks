<?php
/**
 * Plugin Name: Auto Table of Contents
 * Description: Automatically inserts a Table of Contents for posts longer than 1000 words.
 * Version: 1.0
 * Author: Marios Progoulakis
 */

add_filter('the_content', function($content) {
    if (is_singular('post') && str_word_count(strip_tags($content)) > 1000) {
        preg_match_all('/<h([2-3])>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER);
        if (count($matches) > 1) {
            $toc = '<div class="auto-toc"><strong>Contents</strong><ul>';
            foreach ($matches as $index => $match) {
                $id = 'toc-' . $index;
                $heading = strip_tags($match[2]);
                $content = str_replace($match[0], "<h{$match[1]} id="{$id}">{$match[2]}</h{$match[1]}>", $content);
                $toc .= "<li><a href="#{$id}">{$heading}</a></li>";
            }
            $toc .= '</ul></div>';
            return $toc . $content;
        }
    }
    return $content;
});
