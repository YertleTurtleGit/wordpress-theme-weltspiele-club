<?php get_header(); ?>

<div class="language-video-div">
    <video id="language-video" autoplay muted loop playsinline>
        <source src="<?php echo get_bloginfo('template_directory'); ?>/images/languagesvideo.mp4" />
    </video>
</div>

<div class="offset-div">

    <a href="<?php echo get_home_url() ?>">
        <div id="logo-div">
            <img id="logo" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.png" />
            <img id="logo-text" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo_text.png" />
        </div>
    </a>

    <div id="sticky-landing-page">

        <div class="menu-all">
            <div class="menu-collapse">
                <?php
                wp_nav_menu(array(
                    'menu'           => 'hauptmenue',
                    'fallback_cb'    => false
                ));
                ?>
            </div>
            <a class="toggle-nav" href="#">☰</a>
        </div>

        <video id="landing-background-video" poster="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundimage.jpg" autoplay muted loop playsinline>
            <source src="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundvideo.mp4" />
        </video>
    </div>

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

<script>
    console.log("index script loaded");
    const logo = document.getElementById("logo-div");
    logo.style.translate = "calc(50vw - 50%) calc(50vh - 50%)";
    logo.style.scale = "1";

    function refreshLogoPosition() {
        const scrollPosition = window.scrollY;

        if (scrollPosition > 1000) {
            logo.style.translate = "";
            logo.style.scale = "0.75";
        } else {
            logo.style.translate = "calc(50vw - 50%) calc(50vh - 50%)";
            logo.style.scale = "1";
        }
    }

    refreshLogoPosition();
    window.addEventListener("scroll", refreshLogoPosition);
</script>