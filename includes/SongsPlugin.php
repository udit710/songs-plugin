<?php

namespace udit710\SongsPlugin;

require_once plugin_dir_path(__FILE__) . 'SP_REST_API.php';

class SongsPlugin{
    public function __construct(){

        // Register custom post type
        add_action( 'init', [$this, 'sp_register_songs_custom_post_type']);
        
        // Register taxonomy
        add_action( 'init', [$this, 'sp_register_genre_taxonomy']);
        
        // Load scripts from assets
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);

        // Register REST API endpoint
        new SP_REST_API();
    }

    /**
     * Register the custom post type 'Songs'
     */
    public function sp_register_songs_custom_post_type(){
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

        $labels = [
            'name' => __('Songs', 'songs-plugin'),
            'singular_name' => __('Song', 'songs-plugin'),
            'add_new_item' => __('Add New Song', 'songs-plugin'),
            'edit_item' => __('Edit Song', 'songs-plugin'),
            'view_item' => __('View Song', 'songs-plugin'),
            'view_items' => __('View Songs', 'songs-plugin'),
            'delete_item' => __('Delete Song', 'songs-plugin'),
        ];

        $args = [
            'public' => false,
            'has_archive' => false,            
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'capability_type' => ['song', 'songs'],
            'capabilities' => $caps,
            'labels' => $labels,
            'menu_icon' => 'dashicons-playlist-audio',
            'show_in_rest' => true,
            'map_meta_cap' => true,
            'supports' => ['title','author', 'excerpt', 'thumbnail'],
        ];

        register_post_type('sp_song',$args );

    }

    /**
     * Register the Taxonomy 'Genre' for the custom post type 'Songs'
     */
    public function sp_register_genre_taxonomy() {
        $args = [
            'labels' => [
                'name' => __('Genre','songs-plugin'),
                'singular_name' => __('Genre','songs-plugin'),
                'add_new_item' => __('Add New Genre','songs-plugin')
            ],
            'public' => false,
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'capabilities' => [
                'manage_terms' => 'manage_song_genres',
                'edit_terms' => 'edit_song_genres',
                'delete_terms' => 'delete_song_genres',
                'assign_terms' => 'assign_song_genres',
            ],
            'map_meta_cap' => true,
        ];

        register_taxonomy('sp_genre', 'sp_song', $args);
    }

    /**
     * Add default term to Taxonomy 'Genre'
     */
    public function sp_add_default_genre_term() {

        // Add only if genre exists and term doesnt exist
        if (taxonomy_exists( 'sp_genre' )){
            if (!term_exists('Classical', 'sp_genre')) {
                wp_insert_term('Classical', 'sp_genre');
            }
        }
    }

    /**
     * Perform initial tasks on plugin activation
     */
    public function activate() {
        
        $this->sp_register_genre_taxonomy();

        // Sync capabilities
        if ( function_exists('songs_plugin_sync_caps') ) {
            songs_plugin_sync_caps();
        }
    
        // Insert default term for taxonomy 'Genre'
        $this->sp_add_default_genre_term();
    
        flush_rewrite_rules();
    }

    /**
     * Load scripts and localize plugin data to be used by JS
     */
    public function load_assets(){

        wp_enqueue_script( 
            'songs-form-js', 
            plugin_dir_url( __FILE__ ).'../assets/js/songs-plugin.js', 
            array('jquery'), 
            1, 
            true
        );
        wp_localize_script('songs-form-js', 'spData', array(
            'rest_url' => get_rest_url(null, 'songs/v1/send-suggestions'),
            'nonce' => wp_create_nonce('wp_rest')
        ));

    }
}

?>
