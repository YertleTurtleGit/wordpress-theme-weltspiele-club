<div class="live-now">
    <?php
    $show = Event::get_the_current();
    ?>

    <?php
    if ($show->stream_embedded()) {
    ?>
        <iframe style="width: 70rem; height: 40rem; max-width: 100vw; max-height: 100vh;" src="<?php echo $show->get_stream_url() ?>" frameborder="0"></iframe>
    <?php
    } else {
    ?>
        <a href="<?php echo $show->get_url(); ?>">
            <img class="live-now-image" src="<?php echo $show->get_image_url(); ?>" />
        </a>
    <?php
    }
    ?>

    <div class="live-now-info">
        <div class="live-now-icons">
            <a href="<?php echo $show->get_stream_url() ?>">
                <img title="play" src="<?php echo get_bloginfo('template_directory'); ?>/images/play.png">
            </a>

            <!-- TODO Where are you headed? -->
            <img title="audio" src="<?php echo get_bloginfo('template_directory'); ?>/images/audio.png">
        </div>
        <a href="<?php echo $show->get_url(); ?>">
            <span>
                <div class="live-now-title">
                    <?php echo $show->get_title() ?>
                </div>
                <?php echo $show->get_artists_string(); ?>
            </span>

            <p><strong><?php echo $show->get_date_string(); ?></strong></p>
        </a>

        <p>
            <?php echo $show->get_excerpt(); ?>
        </p>

        <span style="padding-top: 1rem;" class="show-item-info-tags">
            <?php echo $show->get_genres_string(); ?>
        </span>

    </div>
</div>