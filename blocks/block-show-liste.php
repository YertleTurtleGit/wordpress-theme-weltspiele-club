<ul class="show-list">

    <?php
    $loop = new WP_Query(
        array(
            'post_type' => 'show',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_key' => 'begin_date',
            'orderby' => 'meta_value_num',
            'meta_type' => 'DATE',
            'order' => 'ASC'
        )
    );

    $max_shown_days = 7;

    $day_count = 0;
    $next_show = Event::get_next();
    $current_day = null;
    ?>

    <a style="width: 100%;" href="<?php echo $next_show->get_url(); ?>">
        <span class="show-list-next-on">
            <span>NEXT ON:</span>
            <span style="text-transform: uppercase; font-weight: 900;"><?php echo $next_show->get_title(); ?></span>
            <span><?php echo $next_show->get_date_string(); ?></span>
        </span>
    </a>

    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
        <?php
        $show_id = get_the_ID();
        $show = new Event($show_id);

        if (block_field('show-list_show_past', false) || !$show->is_in_past()) {

            $day_count++;

            if ($day_count <= $max_shown_days) {

                $begin_date = $show->get_begin_date();

                if ($current_day != $begin_date) {
                    if (!is_null($current_day)) {
                        echo "</ul>";
                    }
                    $current_day = $begin_date;
        ?>
                    <li class='show-list-current-day'><span><?php echo $current_day->format("l, d.m.y"); ?></span></li>
                    <ul style="padding: 0;">
                    <?php
                }
                    ?>

                    <li class="show-item 
                    <?php if ($show->is_the_current()) {
                        echo 'show-item-live';
                    } ?>">
                        <a class="show-item-info" href="<?php echo $show->get_url(); ?>">
                            <span class="show-item-info-date"><?php echo $show->get_date_string(false); ?></span>
                            <span class="show-item-info-title"><?php echo $show->get_title(); ?></span>
                        </a>
                        <span class="show-item-info-tags">
                         
                            <?php echo $show->get_genres_string(true); ?>
                        </span>
                    </li>
        <?php
            }
        }
    endwhile;
    wp_reset_query();
        ?>

                    </ul>
</ul>