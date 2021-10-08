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
        <div class="program-month-title"><?php echo $current_month_name; ?></div>
        <ul>
            <?php
            while ($loop->have_posts()) : $loop->the_post();

                $id = get_the_ID();
                $event = new Event($id);
            ?>

                <?php if ($event->get_begin_date()->format('m') == $current_month) { ?>
                    <a href="<?php echo $event->get_url(); ?>">
                        <li class="program-event">

                            <div class="program-event-header underline">
                                <span style="min-width: 300px;" class="uppercase in-brackets">
                                    <?php echo $event->get_begin_date()->format('D j'); ?>
                                </span>

                                <span class="tag-container">
                                    <span class="program-event-tag uppercase">
                                        <?php echo $event->get_category()->get_title(); ?>
                                    </span>
                                    <span class="program-event-tag uppercase accent-background">
                                        Warnhinweise: blabla
                                    </span>
                                </span>
                            </div>

                            <div class="underline">
                                <?php echo $event->get_title(); ?>
                            </div>

                            <div class="program-event-place-container">
                                <div class="program-event-place">
                                    <span class="program-event-place-title monospace uppercase">Weltspiele</span>
                                    <div class="program-event-place-text">
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                                    </div>
                                </div>
                                <div class="program-event-place">
                                    <span class="program-event-place-title monospace uppercase">Saal III</span>
                                    <div class="program-event-place-text">
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                                    </div>
                                </div>
                            </div>

                        </li>
                    </a>
                <?php } ?>

            <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>


    <div class="program-month">
        <div class="program-month-title"><?php echo $next_month_name; ?></div>
        <ul>
            <?php
            while ($loop->have_posts()) : $loop->the_post();

                $id = get_the_ID();
                $event = new Event($id);
            ?>

                <?php if ($event->get_begin_date()->format('m') == $next_month) { ?>
                    <li class="program-event">

                        <div class="program-event-header underline">
                            <span class="uppercase in-brackets">
                                <?php echo $event->get_begin_date()->format('D j'); ?>
                            </span>

                            <span class="tag-container">
                                <span class="program-event-tag uppercase">
                                    <?php echo $event->get_category()->get_title(); ?>
                                </span>
                                <span class="program-event-tag uppercase accent-background">
                                    Warnhinweise: blabla
                                </span>
                            </span>
                        </div>

                        <div class="underline">
                            <?php echo $event->get_title(); ?>
                        </div>

                        <div class="program-event-place-container">
                            <div class="program-event-place">
                                <span class="program-event-place-title monospace">Weltspiele</span>
                            </div>
                            <div class="program-event-place">
                                <span class="program-event-place-title monospace">Saal III</span>
                            </div>
                        </div>

                    </li>
                <?php } ?>

            <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>