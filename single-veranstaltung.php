<?php get_header(); ?>

<div class="content page-content">
    <div>

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

                        <div class="program-event-place">
                            <span class="small-title monospace uppercase">Weltspiele</span>
                            <div class="underline-rich-text-box no-word-break">
                                <?php echo $event->get_weltspiele_text(); ?>
                            </div>
                        </div>

                        <div class="program-event-place">
                            <span class="small-title monospace uppercase">Saal III</span>
                            <div class="underline-rich-text-box no-word-break">
                                <?php echo $event->get_saal_iii_text(); ?>
                            </div>
                        </div>


                        <div>
                            <div class="small-title monospace uppercase">Links</div>
                            <div class="underline-rich-text-box event-links">
                                <?php
                                $tickets_url = $event->get_ticket_url();
                                $facebook_url = $event->get_facebook_url();
                                $instagram_url = $event->get_instagram_url();
                                $sound_cloud_url = $event->get_sound_cloud_url();
                                $link_before = false;
                                ?>

                                <?php if ($tickets_url) { ?>
                                    <a href="<?php echo $tickets_url; ?>" target="_blank">
                                        Tickets
                                    </a>
                                <?php
                                    $link_before = true;
                                } ?>

                                <?php if ($facebook_url) { ?>
                                    <a href="<?php echo $facebook_url; ?>" target="_blank">
                                        <?php if (§link_before) {
                                            echo ", ";
                                        } ?>Facebook
                                    </a>
                                <?php
                                    $link_before = true;
                                }
                                ?>

                                <?php if ($instagram_url) { ?>
                                    <a href="<?php echo $instagram_url; ?>" target="_blank">
                                        <?php if (§link_before) {
                                            echo ", ";
                                        } ?>Instagram
                                    </a>
                                <?php
                                    $link_before = true;
                                }
                                ?>

                                <?php if ($sound_cloud_url) { ?>
                                    <a href="<?php echo $sound_cloud_url; ?>" target="_blank">
                                        <?php if (§link_before) {
                                            echo ", ";
                                        } ?>SoundCloud
                                    </a>
                                <?php
                                    $link_before = true;
                                }
                                ?>
                            </div>
                        </div>
                        <div>
                            <div class="small-title monospace uppercase">Kosten</div>
                            <div class="underline-rich-text-box">
                                <?php echo $event->get_cost_text(); ?>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="small-title monospace uppercase">Informationen</div>
                        <div>
                            <div class="rich-text-box">
                                <?php echo $event->get_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>

        <?php endwhile;
        endif; ?>

    </div>
</div>



<?php get_footer(); ?>