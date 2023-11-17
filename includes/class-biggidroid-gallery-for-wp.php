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
        //add meta box
        add_action('add_meta_boxes', array($this, 'addMetaBox'));
        //enqueue scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Enqueue scripts
     */
    public function enqueueScripts($hook)
    {
        //check if post type is biggidroid_gallery
        if ($hook == 'post-new.php' || $hook == 'post.php') {
            global $post;
            if ($post->post_type == 'biggidroid_gallery') {
                //enqueue scripts wp upload media
                wp_enqueue_media();
            }
        }
    }

    /**
     * Add meta box
     */
    public function addMetaBox()
    {
        add_meta_box(
            'biggidroid_gallery_meta_box',
            'Add Images',
            array($this, 'renderMetaBox'),
            'biggidroid_gallery',
            'normal',
            'high'
        );
    }

    /**
     * Render meta box
     */
    public function renderMetaBox($post)
    {
        ob_start();
        include_once BIGGIDROID_GALLERY_FOR_WP_DIR . '/templates/add_images.php';
        $output = ob_get_clean();
        echo $output;
    }

    /**
     * Register post type
     */
    public function registerPostType()
    {

        //$labels
        $labels = [
            'name' => "Gallery",
            'singular_name' => "Gallery",
            'menu_name' => "BiggiDroid Gallery",
            'name_admin_bar' => "BiggiDroid Gallery",
            'add_new' => "Add New Gallery",
            'add_new_item' => "Add New Gallery",
            'new_item' => "New Gallery",
            'edit_item' => "Edit Gallery",
            'view_item' => "View Gallery",
            'all_items' => "All Gallery",
            'search_items' => "Search Gallery",
            'parent_item_colon' => "Parent Gallery:",
            'not_found' => "No Gallery found.",
            'not_found_in_trash' => "No Gallery found in Trash.",
        ];

        //args
        $args = [
            'label' => "BiggiDroid Gallery",
            'labels' => $labels,
            'description' => "BiggiDroid Gallery for WordPress",
            'show_ui' => true,
            'supports' => ['title'],
        ];

        //register
        register_post_type('biggidroid_gallery', $args);
    }
}

//init
$init = new BiggiDroid_Gallery_For_WP();
$init->init();
