<?php

/**
 * Plugin Name: BiggiDroid Gallery for WP
 * Plugin URI:  https://biggidroid.com/biggidroid-gallery-for-wp
 * Author:      BiggiDroid
 * Author URI:  https://biggidroid.com
 * Description: A simple gallery plugin for WordPress.
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: biggidroid-gallery-for-wp
 */

//check if file is access directly
if (!defined('WPINC')) {
    exit("Do not access this file directly.");
}

//define plugin constants
define("BIGGIDROID_GALLERY_FOR_WP_VERSION", time());
//plugin file
define("BIGGIDROID_GALLERY_FOR_WP_FILE", __FILE__);
//plugin directory
define("BIGGIDROID_GALLERY_FOR_WP_DIR", dirname(BIGGIDROID_GALLERY_FOR_WP_FILE));
//plugin url
define("BIGGIDROID_GALLERY_FOR_WP_URL", plugins_url('', BIGGIDROID_GALLERY_FOR_WP_FILE));

//check if class exists
if (!class_exists('BiggiDroid_Gallery_For_WP')) {
    //include the class file
    include_once BIGGIDROID_GALLERY_FOR_WP_DIR . '/includes/class-biggidroid-gallery-for-wp.php';
}
