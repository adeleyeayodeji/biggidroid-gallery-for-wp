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
        //save post hook
        add_action('save_post', array($this, 'savePost'), 10, 2);
        //add shortcode
        add_shortcode('biggidroid_gallery', array($this, 'shortcode'));
        //enqueue scripts to frontend
        add_action('wp_enqueue_scripts', array($this, 'enqueueScriptsFrontend'));
    }

    /**
     * enqueueScriptsFrontend
     */
    public function enqueueScriptsFrontend()
    {
        //css for lightgallery
        wp_enqueue_style('biggidroid-gallery-lightgallery', BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/light-gallery.css', [], BIGGIDROID_GALLERY_FOR_WP_VERSION, 'all');
        //js for lightgallery
        wp_enqueue_script('biggidroid-gallery-lightgallery', BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/js/light-gallery.js', ['jquery'], BIGGIDROID_GALLERY_FOR_WP_VERSION, true);
        //add biggidroid-core js
        wp_enqueue_script('biggidroid-core', BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/js/biggidroid-core.js', ['jquery'], BIGGIDROID_GALLERY_FOR_WP_VERSION, true);
    }

    /**
     * Shortcode callback function
     */
    public function shortcode($atts)
    {
        //get the shortcode attributes
        $shortCodeAtt = shortcode_atts([
            "title" => "BiggiDroid Gallery",
            "id" => 200
        ], $atts, "biggidroid_gallery");
        //get images post meta
        $biggidroidImages = get_post_meta($shortCodeAtt['id'], 'biggidroidImages', true);
        //check if its empty
        if (empty($biggidroidImages)) return false;
        //decode the $biggidroidImages
        $biggidroidImages = json_decode($biggidroidImages);
        //title
        $title = $shortCodeAtt['title'];
        //start buffering
        ob_start();
        //include the template
        include_once BIGGIDROID_GALLERY_FOR_WP_DIR . '/templates/shortcode-frontend.php';
        //get the content
        $content = ob_get_clean();
        //return content
        return $content;
    }

    /**
     * Save post
     */
    public function savePost($post_id, $post)
    {
        //check if post type is biggidroid_gallery
        if ($post->post_type != "biggidroid_gallery") {
            return false;
        }

        //get all input data
        $biggidroidImages = $this->sanitizeDynamic($_POST['biggidroidImages']);

        //encode the $biggidroidImages
        $biggidroidImages = json_encode($biggidroidImages);

        //check if its empty
        if (empty($biggidroidImages)) return false;

        //post meta
        update_post_meta($post_id, 'biggidroidImages', $biggidroidImages);

        return true;
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

        //add short code
        add_meta_box(
            'biggidroid_gallery_shortcode_meta_box',
            'Shortcode',
            array($this, 'renderShortcodeMetaBox'),
            'biggidroid_gallery',
            'side'
        );
    }

    /**
     * renderShortcodeMetaBox
     */
    public function renderShortcodeMetaBox($post)
    {
        ob_start();
        include_once BIGGIDROID_GALLERY_FOR_WP_DIR . '/templates/shortcode.php';
        $output = ob_get_clean();
        echo $output;
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

    //sanitize_array
    public function sanitize_array($array)
    {
        //check if array is not empty
        if (!empty($array)) {
            //loop through array
            foreach ($array as $key => $value) {
                //check if value is array
                if (is_array($array)) {
                    //sanitize array
                    $array[$key] = is_array($value) ? $this->sanitize_array($value) : $this->sanitizeDynamic($value);
                } else {
                    //check if $array is object
                    if (is_object($array)) {
                        //sanitize object
                        $array->$key = $this->sanitizeDynamic($value);
                    } else {
                        //sanitize mixed
                        $array[$key] = $this->sanitizeDynamic($value);
                    }
                }
            }
        }
        //return array
        return $array;
    }

    //sanitize_object
    public function sanitize_object($object)
    {
        //check if object is not empty
        if (!empty($object)) {
            //loop through object
            foreach ($object as $key => $value) {
                //check if value is array
                if (is_array($value)) {
                    //sanitize array
                    $object->$key = $this->sanitize_array($value);
                } else {
                    //sanitize mixed
                    $object->$key = $this->sanitizeDynamic($value);
                }
            }
        }
        //return object
        return $object;
    }

    //dynamic sanitize
    public function sanitizeDynamic($data)
    {
        $type = gettype($data);
        switch ($type) {
            case 'array':
                return $this->sanitize_array($data);
                break;
            case 'object':
                return $this->sanitize_object($data);
                break;
            default:
                return sanitize_text_field($data);
                break;
        }
    }
}

//init
$init = new BiggiDroid_Gallery_For_WP();
$init->init();
