<?php
//security
if (!defined('WPINC')) {
    exit("Do not access this file directly.");
}
?>
<style>
    .biggidroid-gallery-container-header {
        margin-bottom: 10px;
        border-bottom: 1px solid lightgray;
        padding-bottom: 10px;
        text-align: center;
    }

    .biggidroid-gallery-container-body-flex {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 10px;
    }

    .biggidroid-gallery-container-body-flex img {
        width: 75px;
        height: 56px;
        object-fit: cover;
        object-position: center;
    }

    .biggidroid-gallery-container-body-flex p {
        margin: 0px;
        margin-left: 10px;
        color: red;
        cursor: pointer;
    }

    .biggidroid-gallery-container-body-flex p:hover {
        text-decoration: underline;
        color: black;
    }
</style>
<div class="biggidroid-gallery-container">
    <!-- header -->
    <div class="biggidroid-gallery-container-header">
        <button type="button" class="button button-primary button-large biggidroid-add-image">
            Add Image
        </button>
    </div>
    <!-- body -->
    <div class="biggidroid-gallery-container-body">
        <?php
        //get biggidroidImages
        $biggidroidImages = get_post_meta($post->ID, 'biggidroidImages', true);
        //decode data
        $biggidroidImages = json_decode($biggidroidImages);
        //loop through
        foreach ($biggidroidImages as $biggidroidImage) :
        ?>
            <div class="biggidroid-gallery-container-body-flex">
                <input type="hidden" name="biggidroidImages[]" value="<?php echo $biggidroidImage; ?>">
                <img src="<?php echo $biggidroidImage; ?>" alt="">
                <p class="removeImage" onclick="removeImageBiggiDroidGallery(this, event)">
                    Remove
                </p>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>

<script>
    //add on click event 
    let removeImageBiggiDroidGallery = (elem, e) => {
        e.preventDefault();
        jQuery(document).ready(function($) {
            var element = $(elem);
            //remove the parent element
            element.parent().remove();
        });
    }

    jQuery(document).ready(function($) {
        $(".biggidroid-add-image").click(function(e) {
            e.preventDefault();
            //load wp media
            var mediaUploader = wp.media({
                title: "Select Image",
                button: {
                    text: "Select Image"
                },
                multiple: false
            });

            //on select
            mediaUploader.on("select", function() {
                var attachment = mediaUploader.state().get("selection").first().toJSON();
                //image url
                var imageUrl = attachment.url;
                //append to biggidroid-gallery-container-body
                $(".biggidroid-gallery-container-body").append(
                    `
                        <div class="biggidroid-gallery-container-body-flex">
                            <input type="hidden" name="biggidroidImages[]" value="${imageUrl}">
                            <img src="${imageUrl}" alt="${attachment.alt}">
                            <p class="removeImage" onclick="removeImageBiggiDroidGallery(this, event)">
                                Remove
                            </p>
                        </div>
                    
                    `
                );
            });

            //open
            mediaUploader.open();
        });
    });
</script>