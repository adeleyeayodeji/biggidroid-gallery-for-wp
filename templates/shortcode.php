<?php
//security
if (!defined('WPINC')) {
    exit("Do not access this file directly.");
}
//get the gallery id
$galleryId = $post->ID;
//get the gallery title
$galleryTitle = $post->post_title;
?>

<style>
    .biggidroid-gallery-shortcode-display {
        text-align: center;
        font-weight: bold;
    }
</style>

<div class="biggidroid-gallery-shortcode-display">
    [biggidroid_gallery title="<?php echo $galleryTitle; ?>" id="<?php echo $galleryId; ?>"]
</div>