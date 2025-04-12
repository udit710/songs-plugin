<?php

add_shortcode( 'song-suggestion-form', 'sp_render_form' );
function sp_render_form()
{
    // Get current post
    $post = get_post();
    if ( ! $post ) {
        return '';
    }

    // Fetch the post author's user object
    $author = get_userdata( $post->post_author );
    if ( ! $author ) {
        return '';
    }

    // Only render if the post-author has the 'author' role
    if ( ! in_array( 'author', (array) $author->roles, true ) ) {
        return '<div><h3 style="color:#FF5733;">Access Denied. Only Authors can add this form!</h3></div>';
    }

    $html_path = plugin_dir_path(__FILE__) . '../templates/suggestion-form.html';
    if ( file_exists( $html_path ) ) {
        return file_get_contents( $html_path );
    }
    return '';
    
}