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
        <button type="button" class="button button-primary button-large">
            Add Image
        </button>
    </div>
    <!-- body -->
    <div class="biggidroid-gallery-container-body">
        <div class="biggidroid-gallery-container-body-flex">
            <img src="https://plus.unsplash.com/premium_photo-1683141316518-70595b251f01?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
            <p>
                Remove
            </p>
        </div>
    </div>
</div>