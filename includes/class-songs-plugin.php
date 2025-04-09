<?php

class SongsPlugin{
    public function __construct(){

        // Register access limits
        add_action('admin_init', array($this, 'assign_caps'));
        
        // Register custom post type
        add_action( 'init', array($this, 'register_songs_custom_post_type'));
        
        // Register taxonomy
        add_action( 'init', array($this, 'register_genre_taxonomy'));
        
        // Add default term to taxonomy
        add_action('init', array($this, 'add_default_genre_term'));

    }

    public function assign_caps() {
        $roles = array('administrator');
    
        foreach ($roles as $role_name) {
            $role = get_role($role_name);
            if ($role) {
                $role->add_cap('edit_songs');
                $role->add_cap('read_songs');
                $role->add_cap('delete_songs');
                $role->add_cap('edit_songss');
                $role->add_cap('edit_others_songss');
                $role->add_cap('publish_songss');
                $role->add_cap('read_private_songss');
                $role->add_cap('manage_song_genres');
                $role->add_cap('edit_song_genres');
                $role->add_cap('delete_song_genres');
                $role->add_cap('assign_song_genres');
            }
        }
    }

    public function register_songs_custom_post_type(){
        $args = array(
            'public' => true,
            'has_archive' => true,
            'supports' => array('title'),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'songs',
            'map_meta_cap' => true,
            'capabilities' => array(
                'edit_post' => 'edit_songs',
                'read_post' => 'read_songs',
                'delete_post' => 'delete_songs',
                'edit_posts' => 'edit_songss',
                'edit_others_posts' => 'edit_others_songss',
                'publish_posts' => 'publish_songss',
                'read_private_posts' => 'read_private_songss',
            ),
            'labels' => array(
                'name' => 'Songs',
                'singular_name' => 'Songs Entry'
            ),
            'menu_icon' => 'dashicons-playlist-audio',
            'supports' => array('title'),
        );

        register_post_type('songs_cpt',$args );

    }

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
        );

        register_taxonomy('song_genre', 'songs_cpt', $args);
    }

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