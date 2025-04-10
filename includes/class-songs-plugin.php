<?php

class SongsPlugin{
    public function __construct(){

        // Register custom post type
        add_action( 'init', array($this, 'register_songs_custom_post_type'));
        
        // Register taxonomy
        add_action( 'init', array($this, 'register_genre_taxonomy'));
        
        // Add default term to taxonomy
        add_action('init', array($this, 'add_default_genre_term'));
        
    }

    /**
     * Register the custom post type 'Songs'
     */
    public function register_songs_custom_post_type(){
        $caps = [
            'edit_post'             => 'edit_song',
            'read_post'             => 'read_song',
            'delete_post'           => 'delete_song',
            'edit_posts'            => 'edit_songs',
            'edit_others_posts'     => 'edit_others_songs',
            'publish_posts'         => 'publish_songs',
            'read_private_posts'    => 'read_private_songs',
            'delete_posts'          => 'delete_songs',
            'delete_private_posts'  => 'delete_private_songs',
            'delete_published_posts'=> 'delete_published_songs',
            'delete_others_posts'   => 'delete_others_songs',
            'edit_private_posts'    => 'edit_private_songs',
            'edit_published_posts'  => 'edit_published_songs',
            'create_posts'          => 'edit_songs',
        ];

        $args = array(
            'public' => true,
            'has_archive' => true,            
            'exclude_from_search' => false,
            'publicly_queryable' => false,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
            'show_ui' => true,
            'capability_type' => array('song', 'songs'),
            'capabilities' => $caps,
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
