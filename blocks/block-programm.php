<div class="program">

    <?php
    $loop = new WP_Query(
        array(
            'post_type' => 'veranstaltung',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_key' => 'startdatum',
            'orderby' => 'meta_value_num',
            'meta_type' => 'DATE',
            'order' => 'ASC'
        )
    );


    $current_month = current_time('m');
    $current_month_name = current_time('F');

    $next_month = current_time('m') + 1;
    $next_month_name =  DateTime::createFromFormat('!m', $next_month)->format('F');
    ?>

    <div class="program-month">
        <span class="program-month-title"><?php echo $current_month_name; ?></span>
        <ul>
            <?php
            while ($loop->have_posts()) : $loop->the_post();

                $id = get_the_ID();
                $event = new Event($id);
            ?>

                <?php if ($event->get_begin_date()->format('m') == $current_month) { ?>
                    <li class="program-event">
                        <span class="program-event-date">
                            <a href="<?php echo $event->get_url(); ?>">
                                <?php echo $event->get_begin_date()->format('d.m.'); ?>
                            </a>
                        </span>
                        <?php if ($event->get_category()) { ?>
                            <span class="program-event-category">
                                <?php echo $event->get_category()->get_title(); ?>
                            </span>
                        <?php } ?>
                        <span class="program-event-text">
                            <p><?php echo $event->get_title(); ?> </p>
                        </span>
                    </li>
                <?php } ?>

            <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>


    <div class="program-month">
        <span class="program-month-title"><?php echo $next_month_name; ?></span>
        <ul>
            <?php
            while ($loop->have_posts()) : $loop->the_post();

                $id = get_the_ID();
                $event = new Event($id);
            ?>

                <?php if ($month == $next_month) { ?>
                    <li class="program-event">
                        <span class="program-event-date">
                            <a href="<?php echo $event->get_url(); ?>">
                                <?php echo $event->get_begin_date()->format('d.m.'); ?>
                            </a>
                        </span>
                        <?php if ($event->get_category()) { ?>
                            <span class="program-event-category">
                                <?php echo $event->get_category()->get_title(); ?>
                            </span>
                        <?php } ?>
                        <span class="program-event-text">
                            <p><?php echo $event->get_title(); ?> </p>
                        </span>
                    </li>
                <?php } ?>

            <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>