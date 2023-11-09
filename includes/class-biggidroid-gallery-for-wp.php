<?php
//check if file is access directly
if (!defined('WPINC')) {
    exit("Do not access this file directly.");
}

/**
 * BiggiDroid Gallery For WP
 */
class BiggiDroid_Gallery_For_WP
{
    public function init()
    {
        //add action init
        add_action('init', array($this, 'registerPostType'));
    }

    /**
     * Register post type
     */
    public function registerPostType()
    {
        //args
        $args = [
            'label' => "BiggiDroid Gallery",
            'description' => "BiggiDroid Gallery for WordPress",
            'show_ui' => true,
        ];

        //register
        register_post_type('biggidroid_gallery', $args);
    }
}

//init
$init = new BiggiDroid_Gallery_For_WP();
$init->init();
