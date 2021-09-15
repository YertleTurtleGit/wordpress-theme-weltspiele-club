<?php get_header(); ?>

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

<a href="<?php echo get_home_url() ?>">
        <div id="logo-small-div">
                <img id="logo-small" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.png" />
                <img id="logo-small-text" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo_text.png" />
        </div>
</a>

<div class="content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
        <?php endwhile;
        endif; ?>
</div>

<video id="background-video" src="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundvideo.mp4" poster="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundimage.jpg" autoplay muted loop playsinline></video>

<?php get_footer(); ?>