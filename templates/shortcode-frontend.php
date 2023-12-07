<?php
//security
if (!defined('WPINC')) {
    exit("Do not access this file directly.");
}
?>
<div class="biggidroid-gallery-frontend">
    <div id="biggidroid-gallery-images">
        <?php
        //loop through $biggidroidImages
        foreach ($biggidroidImages as $image) :
        ?>
            <a href="<?php echo esc_attr($image); ?>">
                <img src="<?php echo esc_attr($image); ?>" />
            </a>
        <?php endforeach; ?>
    </div>
</div>