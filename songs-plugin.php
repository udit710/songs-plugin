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

require_once plugin_dir_path(__FILE__) . 'includes/manage-roles-songs-plugin.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-songs-plugin.php';
require_once plugin_dir_path(__FILE__) . 'includes/suggestion-form.php';

$songs_plugin = new SongsPlugin();

// Activation tasks
register_activation_hook( __FILE__, array( $songs_plugin, 'activate' ) );