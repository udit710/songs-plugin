<?php
/*
* Plugin Name: Songs Plugin
* Plugin URI: https://github.com/udit710/songs-plugin
* Description: A simple songs plugin that allows authors to add song suggestion forms to their content via a shortcode.
* Version: 1.0
* Author: Udit Malshe
*/

if (!defined('ABSPATH'))
{
    die("Access Denied");
}

require_once __DIR__ . '/vendor/autoload.php';
use udit710\SongsPlugin;

// Define administrator role for access to CPT and taxonomy
if (!defined('CPT_TAXONOMY_ROLE') ) 
{
    define('CPT_TAXONOMY_ROLE', 'administrator');
}

$songs_plugin = new \udit710\SongsPlugin\SongsPlugin();

// Activation tasks
register_activation_hook( __FILE__, array( $songs_plugin, 'activate' ) );