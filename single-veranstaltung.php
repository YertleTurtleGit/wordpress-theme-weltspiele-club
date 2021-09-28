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
                        <?php
                        $id = get_the_ID();
                        $event = new Event($id);
                        ?>

                        <div class="single-event">
                                <div class="single-event-row">
                                        <div id='page-header'>
                                                <h1 class='page-title'><?php echo $event->get_title(); ?></h1>
                                        </div>

                                        <p><strong>
                                                <?php echo $event->get_date_string(); ?>
                                        </strong></p>


                                        <div class="event-links">
                                                <?php
                                                $tickets_url = $event->get_ticket_url();
                                                $facebook_url = $event->get_facebook_url();
                                                $instagram_url = $event->get_instagram_url();
                                                $sound_cloud_url = $event->get_sound_cloud_url();
                                                ?>

                                                <?php if ($tickets_url) { ?>
                                                        <a href="<?php echo $tickets_url; ?>" target="_blank">
                                                                <span class="dashicons dashicons-tickets-alt"></span>
                                                        </a>
                                                <?php } ?>

                                                <?php if ($facebook_url) { ?>
                                                        <a href="<?php echo $facebook_url; ?>" target="_blank">
                                                                <span class="dashicons dashicons-facebook-alt"></span>
                                                        </a>
                                                <?php } ?>

                                                <?php if ($instagram_url) { ?>
                                                        <a href="<?php echo $instagram_url; ?>" target="_blank">
                                                                <span class="dashicons dashicons-instagram"></span>
                                                        </a>
                                                <?php } ?>

                                                <?php if ($sound_cloud_url) { ?>
                                                        <a href="<?php echo $sound_cloud_url; ?>" target="_blank">
                                                                <span class="dashicons dashicons-format-audio"></span>
                                                        </a>
                                                <?php } ?>
                                        </div>


                                        <?php if ($event->get_image_url()) { ?>
                                                <div class="event-image-div">
                                                        <img src="<?php echo $event->get_image_url(); ?>" />
                                                </div>
                                        <?php } ?>
                                </div>

                                <div class="single-event-row">
                                        <div class="single-content">
                                                <?php echo $event->get_content(); ?>
                                        </div>
                                </div>

                        </div>
        <?php endwhile;
        endif; ?>

</div>
<video id="background-video" src="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundvideo.mp4" poster="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundimage.jpg" autoplay muted loop playsinline></video>

<?php get_footer(); ?>