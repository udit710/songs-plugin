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
    echo "Access Denied";
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/class-songs-plugin.php';

new SongsPlugin();