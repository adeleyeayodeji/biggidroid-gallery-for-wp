<?php
//security
if (!defined('WPINC')) {
    exit("Do not access this file directly.");
}
?>
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/lightgallery.css') ?>">
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/lg-zoom.css') ?>">
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/justifiedGallery.css') ?>">
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/lg-thumbnail.css') ?>">
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/lg-share.css') ?>">
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/lg-rotate.css') ?>">
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/lg-autoplay.css') ?>">
<link rel="stylesheet" href="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/css/lg-fullscreen.css') ?>">
<style>
    body {
        padding: 40px;
        background-image: linear-gradient(#e8f0ff 0%, white 52.08%);
        color: #0e3481;
        min-height: 100vh;
    }

    .gallery-info {
        text-align: center;
        display: block;
        font-size: 12px;
        opacity: 0.7;
        font-style: italic;
    }

    .header .lead {
        max-width: 620px;
    }

    /** Below CSS is completely optional **/

    .gallery-item {
        width: 200px;
        padding: 5px;
    }
</style>

<div class="biggidroid-gallery-frontend">
    <div id="biggidroid-gallery-images">
        <div class="gallery-container" id="animated-thumbnails-gallery">
            <?php
            //loop through $biggidroidImages
            foreach ($biggidroidImages as $image) :
            ?>
                <a class="gallery-item" data-src="<?php echo esc_attr($image); ?>" data-sub-html="<h4>Photo by - <a href='https://biggidroid.com'>BiggiDroid.com </a></h4><p> Location - <a href='https://unsplash.com/s/photos/puezgruppe%2C-wolkenstein-in-gr%C3%B6den%2C-s%C3%BCdtirol%2C-italien'>Puezgruppe, Wolkenstein in Gröden, Südtirol, Italien</a>layers of blue.</p>">
                    <img alt="layers of blue." class="img-responsive" src="<?php echo esc_attr($image); ?>" />
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="<?php echo esc_url(BIGGIDROID_GALLERY_FOR_WP_URL . '/assets/plugins/justifiedGallery/justifiedGallery.js') ?>"></script>
<script type="module">
    // import lightGallery from "https://cdn.skypack.dev/lightgallery@2.1.2";

    // import lgZoom from "https://cdn.skypack.dev/lightgallery@2.1.2/plugins/zoom";

    // import lgThumbnail from "https://cdn.skypack.dev/lightgallery@2.1.2/plugins/thumbnail";

    // import lgShare from "https://cdn.skypack.dev/lightgallery@2.1.2/plugins/share";

    // import lgRotate from "https://cdn.skypack.dev/lightgallery@2.1.2/plugins/rotate";

    // import lgAutoplay from "https://cdn.skypack.dev/lightgallery@2.1.2/plugins/autoplay";
    // import lgFullscreen from "https://cdn.skypack.dev/lightgallery@2.1.2/plugins/fullscreen";

    jQuery("#animated-thumbnails-gallery")
        .justifiedGallery({
            captions: false,
            lastRow: "hide",
            rowHeight: 180,
            margins: 5
        })
        .on("jg.complete", function() {
            lightGallery(document.getElementById("animated-thumbnails-gallery"), {
                autoplayFirstVideo: false,
                pager: false,
                galleryId: "nature",
                flipHorizontal: false,
                flipVertical: false,
                rotateLeft: false,
                plugins: [
                    // lgZoom,
                    // lgThumbnail,
                    // lgShare,
                    // lgRotate,
                    // lgFullscreen,
                    // lgAutoplay
                ],
                mobileSettings: {
                    controls: false,
                    showCloseIcon: false,
                    download: false,
                    rotate: false
                }
            });
        });
</script>