<?php

/**
 * Sync roles on plugin load
 */
function songs_plugin_sync_caps() {
    $caps = [
        // Song CPT caps
        'edit_song',
        'read_song',
        'delete_song',
        'edit_songs',
        'edit_others_songs',
        'delete_songs',
        'publish_songs',
        'read_private_songs',
        'delete_private_songs',
        'delete_published_songs',
        'delete_others_songs',
        'edit_private_songs',
        'edit_published_songs',

        // Genre taxonomy caps
        'manage_song_genres',
        'edit_song_genres',
        'delete_song_genres',
        'assign_song_genres',
    ];

    global $wp_roles;

    foreach ( $wp_roles->roles as $role_name => $role_info ) {
        $role = get_role( $role_name );
        if ( ! $role ) {
            continue;
        }

        foreach ( $caps as $cap ) {
            if ( $role_name === CPT_TAXONOMY_ROLE ) {
                $role->add_cap( $cap );
            } else {
                $role->remove_cap( $cap ); // Remove capability for any other roles that may have it
            }
        }
    }
}
?>