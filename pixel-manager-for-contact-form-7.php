<?php
/*
Plugin Name: Pixel Manager for Contact Form 7
description: Setup Social Pixel in Your Contact Form 7
Version: 1.0
Author: Gravity Master
License: GPL2
*/

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
   die();
}

/* All constants should be defined in this file. */
if ( ! defined( 'GMWPLW_PLUGIN_DIR' ) ) {
   define( 'GMWPLW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GMWPLW_PLUGIN_BASENAME' ) ) {
   define( 'GMWPLW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'GMWPLW_PLUGIN_URL' ) ) {
   define( 'GMWPLW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/* Auto-load all the necessary classes. */
if( ! function_exists( 'GMWPLW_class_auto_loader' ) ) {
   
   function GMWPLW_class_auto_loader( $class ) {
      
      $includes = GMWPLW_PLUGIN_DIR . 'includes/' . $class . '.php';
      
      if( is_file( $includes ) && ! class_exists( $class ) ) {
         include_once( $includes );
         return;
      }
      
   }
}
spl_autoload_register('GMWPLW_class_auto_loader');

/* Initialize all modules now. */

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if ( ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) ) {
   new GMWPLW_Cron();
   new GMWPLW_Backend();
   new GMWPLW_Display();
   new GMWPLW_Frontend();
}