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

<div class='content' style="margin-top: 15rem;">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="entry">
                                <div id='page-header'>
                                        <h1 class='page-title'><?php the_title(); ?></h1>
                                </div>

                                <?php $id = get_the_ID(); ?>

                                <p><strong><?php echo get_veranstaltung_datum($id); ?></strong></p>

                                <?php echo get_veranstaltung_bild($id); ?>

                                <div class="single-content">
                                        <?php the_content(); ?>
                                </div>
                        </div>
        <?php endwhile;
        endif; ?>

        <div class="event-links">
                <?php
                $tickets_url = get_post_meta($id, 'tickets', true);
                $facebook_url = get_post_meta($id, 'facebook', true);
                $instagram_url = get_post_meta($id, 'instagram', true);
                $soundcloud_url = get_post_meta($id, 'soundcloud', true);
                ?>

                <?php if ($tickets_url) { ?>
                        <a href="<?php echo $tickets_url; ?>" target="_blank">
                                <span class="dashicons dashicons-tickets-alt"></span>
                        </a>
                <?php } ?>

                <?php if ($facebook_url) { ?>
                        <a href="<?php echo $facebook_url; ?>" target="_blank">
                                <span class="dashicons dashicons-facebook"></span>
                        </a>
                <?php } ?>

                <?php if ($instagram_url) { ?>
                        <a href="<?php echo $instagram_url; ?>" target="_blank">
                                <span class="dashicons dashicons-instagram"></span>
                        </a>
                <?php } ?>
                
                <?php if ($soundcloud_url) { ?>
                        <a href="<?php echo $soundcloud_url; ?>" target="_blank">
                                <span class="dashicons dashicons-format-audio"></span>
                        </a>
                <?php } ?>
        </div>
</div>

<video id="background-video" src="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundvideo.mp4" poster="<?php echo get_bloginfo('template_directory'); ?>/images/backgroundimage.jpg" autoplay muted loop playsinline></video>

<?php get_footer(); ?>