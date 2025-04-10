<?php
/*
* Plugin Name: Songs Plugin
* Plugin URI: https://github.com/udit710/songs-plugin.git
* Description: A simple songs plugin that allows authors to submit song suggestions using forms
* Version: 1.0
* Author: Udit Malshe
*/

if (!defined('ABSPATH'))
{
    die("Access Denied");
}

// Define administrator role for access to CPT and taxonomy
if (!defined('CPT_TAXONOMY_ROLE') ) 
{
    define('CPT_TAXONOMY_ROLE', 'administrator');
}

require_once plugin_dir_path(__FILE__) . 'includes/functions.php';

// Activate on admin dashboard
add_action( 'admin_init', 'songs_plugin_sync_caps' );

require_once plugin_dir_path(__FILE__) . 'includes/class-songs-plugin.php';

// Activate the plugin
new SongsPlugin();