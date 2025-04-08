<?php

class SongsPlugin{
    public function __construct(){

        // Register access limits
        add_action('admin_init', array($this, 'assign_songs_cpt_caps'));

        // Register custom post type
        add_action( 'init', array($this, 'songs_custom_post_type'));

    }

    public function assign_songs_cpt_caps() {
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
            }
        }
    }

    public function songs_custom_post_type(){
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

        register_post_type('songs',$args );

    }
    
}

?>