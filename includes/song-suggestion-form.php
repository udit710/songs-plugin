<?php

add_shortcode( 'song-suggestion-form', 'render_form' );
function render_form()
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

    ob_start()?>
    <div class="songs-form">
        <h1>Song Suggestion Form</h1>
        <p>Please fill the form below to send song suggestions</p>
        <form id="songs-form__form">
            <div class="form-group mb-2">
                <input name="name" type="text" placeholder="Name" class="form-control">
            </div>
            <div class="form-group mb-2">
                <input name="email" type="email" placeholder="Email" class="form-control">
            </div>
            <div class="form-group mb-2">
                <input name="song-name" type="text" placeholder="Song Name" class="form-control">
            </div>
            <div class="form-group mb-2">
                <textarea name="song-desc" placeholder="Song description" class="form-control"></textarea>
            </div>
            <div class="form-group mb-2">
                <button type="submit" class="btn btn-success btn-block w-100">Send</button>
            </div>
        </form>
    </div>
<?php 
return ob_get_clean();
}

