<?php
/*This is the basic-plugin PHP file created using windows CLI
*Plugin Name: WP Project Listing
*Plugin URI: http://itsligo.ie
*Description: A plugin for creating and displaying and add project listings for your wordpress site Use this Shortcode[project_location_list].
*Author: Adam Lee adapted from Wordpress Codex
*Date: 05/03/2017
*Author URI: https://premium.wpmudev.org/blog/create-wordpress-custom-post-types/?utm_expid=3606929-101._J2UGKNuQ6e7Of8gblmOTA.0&utm_referrer=https%3A%2F%2Fwww.google.ie%2F
*Version: 1.0.1
*License: none
*/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Main goal is to create my own plugin but also to have clean and understandable code for other developers to make changes to the code with ease   //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Exit if accessed directly
//Safety falisafe
//if hacked exit
if(! defined('ABSPATH')){
    exit;
}

//Using plugin dir path gives an absolute file location 
//**Make sure to concatinate the file or it will not work
require ( plugin_dir_path(__FILE__) . 'wp-project-listing.php'); //File needs two underscores **Learned the hard way**
//require ( plugin_dir_path(__FILE__) . 'wp-project-custom-meta-box.php'); //File needs two underscores **Learned the hard way**
require ( plugin_dir_path(__FILE__) . 'wp-project-shortcode.php');
//require ( plugin_dir_path(__FILE__) . 'wp-project-custom-meta-box.php');
//require ( plugin_dir_path(__FILE__) . 'wp-project-settings.php');

////THIS WILL ALLOW YOU TO VIEW THE PATH TO ENSURE ITS CORRECT
//$dir = plugin_dir_path(_FILE_);
//var_dump($dir);
//die();













?>