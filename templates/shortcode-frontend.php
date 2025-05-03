<?php
//security
if (!defined('WPINC')) {
    exit("Do not access this file directly.");
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.12/css/lightgallery.min.css">

<style>
    .lightgallery {
        column-count: 4;
        column-gap: 20px;
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 10px;
    }

    @media (max-width: 900px) {
        .lightgallery {
            column-count: 2;
        }
    }

    @media (max-width: 600px) {
        .lightgallery {
            column-count: 1;
        }
    }

    .lightgallery a {
        display: inline-block;
        width: 100%;
        margin: 0 0 20px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
        transition: transform 0.2s, box-shadow 0.2s;
        break-inside: avoid;
        background: #fff;
        position: relative;
    }

    .lightgallery a:hover {
        transform: translateY(-4px) scale(1.04);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
        z-index: 2;
    }

    .lightgallery img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        aspect-ratio: 40 / 39;
        transition: filter 0.2s;
    }

    .lightgallery a:hover img {
        filter: brightness(0.95) saturate(1.1);
    }
</style>

<div class="lightgallery">
    <?php foreach ($biggidroidImages as $image) : ?>
        <a href="<?php echo esc_attr($image); ?>">
            <img src="<?php echo esc_attr($image); ?>" loading="lazy" />
        </a>
    <?php endforeach; ?>
</div>

<!-- JS dependencies -->
<script src="https://cdn.jsdelivr.net/npm/lightgallery@1.6.12/dist/js/lightgallery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lg-thumbnail/1.1.0/lg-thumbnail.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lg-fullscreen/1.1.0/lg-fullscreen.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        //get all div .lightgallery
        $('.lightgallery').each(function(index, element) {
            // element == this
            $(this).lightGallery({
                selector: 'a',
                thumbnail: true,
                fullscreen: true,
            });
        });
    });
</script>