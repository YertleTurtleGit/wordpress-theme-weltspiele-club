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
                $title = get_the_title();
                $startdatum = date_create(get_post_meta($id, 'startdatum')[0])->format('d.m.');
                $month = date_create(get_post_meta($id, 'startdatum')[0])->format('m');
                $kategorie = get_term(get_post_meta($id, 'kategorie')[0])->name;
            ?>

                <?php if ($month == $current_month) { ?>
                    <li class="program-event">
                        <span class="program-event-date">
                            <a href="<?php echo get_permalink(); ?>"><?php echo $startdatum; ?></a>
                        </span>
                        <?php if ($kategorie) { ?>
                            <span class="program-event-category">
                                <?php echo $kategorie; ?>
                            </span>
                        <?php } ?>
                        <span class="program-event-text">
                            <p><?php echo $title; ?> </p>
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
                $title = get_the_title();
                $startdatum = date_create(get_post_meta($id, 'startdatum')[0])->format('d.m.');
                $month = date_create(get_post_meta($id, 'startdatum')[0])->format('m');
                $kategorie = get_term(get_post_meta($id, 'kategorie')[0])->name;
            ?>

                <?php if ($month == $next_month) { ?>
                    <li class="program-event">
                        <span class="program-event-date">
                            <a href="<?php echo get_permalink(); ?>"><?php echo $startdatum; ?></a>
                        </span>
                        <?php if ($kategorie) { ?>
                            <span class="program-event-category">
                                <?php echo $kategorie; ?>
                            </span>
                        <?php } ?>
                        <span class="program-event-text">
                            <p><?php echo $title; ?> </p>
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