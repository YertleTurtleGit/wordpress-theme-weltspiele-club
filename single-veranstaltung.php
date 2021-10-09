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

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
        $id = get_the_ID();
        $event = new Event($id);
        ?>

        <div class="single-event">

            <?php
            $image_url = $event->get_image_url();
            if ($image_url) { ?>
                <div class="event-image-div">
                    <img src="<?php echo $image_url; ?>" />
                </div>
            <?php } ?>


            <div class="event-left-column">
                <h1 class='event-title center uppercase'><?php echo $event->get_title(); ?></h1>

                <div class="show-date center uppercase">
                    <?php echo $event->get_date_string(); ?>
                </div>
            </div>

            <div class="event-bottom-row">
                <div>
                    <div class="small-title monospace uppercase">Links</div>
                    <div class="underline-rich-text-box event-links">
                        <?php
                        $tickets_url = $event->get_ticket_url();
                        $facebook_url = $event->get_facebook_url();
                        $instagram_url = $event->get_instagram_url();
                        $sound_cloud_url = $event->get_sound_cloud_url();
                        ?>

                        <?php if ($tickets_url) { ?>
                            <a href="<?php echo $tickets_url; ?>" target="_blank">
                                <span>Tickets</span>
                            </a>
                        <?php } ?>

                        <?php if ($facebook_url) { ?>
                            <a href="<?php echo $facebook_url; ?>" target="_blank">
                                <span>Facebook</span>
                            </a>
                        <?php } ?>

                        <?php if ($instagram_url) { ?>
                            <a href="<?php echo $instagram_url; ?>" target="_blank">
                                <span>Instagram</span>
                            </a>
                        <?php } ?>

                        <?php if ($sound_cloud_url) { ?>
                            <a href="<?php echo $sound_cloud_url; ?>" target="_blank">
                                <span>SoundCloud</span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <div class="small-title monospace uppercase">Kosten</div>
                    <div class="underline-rich-text-box">
                        <span>999 Euro</span>
                    </div>
                </div>
            </div>

            <div>
                <div class="small-title monospace uppercase">Informationen</div>
                <div>
                    <div class="rich-text-box">Was soll hier hin? Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</div>
                </div>
            </div>

            <?php echo $event->get_content(); ?>

        </div>

<?php endwhile;
endif; ?>



<?php get_footer(); ?>