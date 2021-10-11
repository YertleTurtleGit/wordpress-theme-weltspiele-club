<?php get_header(); ?>


<style>
    body {
        background-color: black;
    }

    .header,
    .header * {
        background-color: transparent;
    }

    .header * {
        color: white;
        border-color: white !important;
    }
</style>

<div class="index-info uppercase monospace">
    cosmos for music, arts and culture
</div>


<div class="landing-background-video-container">
    <video poster="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundimage.jpg" autoplay muted loop playsinline>
        <source src="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundvideo.mp4" />
    </video>
</div>



<!--
<div class="content">
    <h1 style="clear: left;" id="programm">Programm</h1>
    <?php //echo apply_filters('the_content', get_page_by_title('programm')->post_content); 
    ?>

    <h1 style="clear: left; padding-top: 6rem;" id="awareness">Awareness</h1>
    <?php //echo get_page_by_title('awareness')->post_content; 
    ?>

    <h1 style="clear: left; padding-top: 6rem;" id="about">About</h1>
    <?php //echo get_page_by_title('about')->post_content; 
    ?>
</div>
-->

<?php get_footer(); ?>