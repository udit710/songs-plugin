<?php

class SongsPlugin{
    public function __construct(){

        // Register custom post type
        add_action( 'init', array($this, 'register_songs_custom_post_type'));
        
        // Register taxonomy
        add_action( 'init', array($this, 'register_genre_taxonomy'));
        
        // Add default term to taxonomy
        add_action('init', array($this, 'add_default_genre_term'));
        
        // Register access limits
        add_action('admin_init', array($this, 'assign_caps'));

    }

    /**
     * Assign relevant capabilites
     */
    public function assign_caps() {
        $role = get_role('administrator');
        $capabilities = array(
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
            'manage_song_genres',
            'edit_song_genres',
            'delete_song_genres',
            'assign_song_genres',
        );

        // Assign admin capabilites
        foreach ( $capabilities as $cap ) {
            $role->add_cap( $cap );
        }
    }

    /**
     * Register the custom post type 'Songs'
     */
    public function register_songs_custom_post_type(){
        $args = array(
            'public' => true,
            'has_archive' => true,            
            'exclude_from_search' => false,
            'publicly_queryable' => false,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
            'show_ui' => true,
            'capability_type' => array('song', 'songs'),
            'labels' => array(
                'name' => 'Songs',
                'singular_name' => 'Song',
                'add_new_item' => 'Add New Song',
                'edit_item' => 'Edit Song',
                'view_item' => 'View Song',
                'view_items' => 'View Song',
                'delete_item' => 'Delete Song',
                'search_items' => 'Search Songs',
                'not_found' => 'No Songs found',
                'not_found_in_trash' => 'No Songs found in Trash',
            ),
            'menu_icon' => 'dashicons-playlist-audio',
            'map_meta_cap' => true,
        );

        register_post_type('songs_cpt',$args );

    }

    /**
     * Register the Taxonomy 'Genre' for the custom post type 'Songs'
     */
    public function register_genre_taxonomy() {
        $args = array(
            'labels' => array(
                'name' => 'Genre',
                'singular_name' => 'Genre',
                'add_new_item' => 'Add New Genre'
            ),
            'public' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'genre'),
            'capabilities' => array(
                'manage_terms' => 'manage_song_genres',
                'edit_terms' => 'edit_song_genres',
                'delete_terms' => 'delete_song_genres',
                'assign_terms' => 'assign_song_genres',
            ),
            'map_meta_cap' => true,
        );

        register_taxonomy('song_genre', 'songs_cpt', $args);
    }

    /**
     * Add default term to Taxonomy 'Genre'
     */
    public function add_default_genre_term() {

        // Add only if genre exists and term doesnt exist
        if (taxonomy_exists( 'song_genre' )){
            if (!term_exists('Classical', 'song_genre')) {
                wp_insert_term('Classical', 'song_genre');
            }
        }
    }
    
}

?>
