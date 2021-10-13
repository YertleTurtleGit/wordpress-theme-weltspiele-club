<?php get_header(); ?>

<?php
$term = get_queried_object();
$format_id = $term->term_id;
$format = new EventFormat($format_id);
?>

<div class="padded-content">
    <img class="single-format-image" src="<?php echo $format->get_image_url(); ?>" />
    <h1><?php echo $format->get_name(); ?></h1>
    <h2><?php echo $format->get_frequency_string(); ?></h2>
    <p><?php echo $format->get_description(); ?></p>
</div>

<div class="related-shows padded-content">
    <h1>Recent Shows</h1>
    <ul class="show-list-image">

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

        ?>

        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
            <?php
            $s_show_id = intval(get_the_ID());
            $s_show = new Event($s_show_id);

            if ($s_show->get_format()->get_id() == $format_id) {
            ?>
                <li class="show-item-image">
                    <a href="<?php $s_show->get_url(); ?>">
                        <div class="show-item-image-image"><img src="<?php echo $s_show->get_image_url('medium'); ?>" />
                        </div>
                        <div class="show-item-image-info">
                            <div class="show-item-image-info-title"><?php echo $s_show->get_title(); ?></div>
                            <div class="show-item-image-info-date"><?php echo $s_show->get_date_string(); ?></div>
                        </div>
                    </a>
                    <span class="show-item-info-tags">
                        <?php echo $s_show->get_artists_string(true); ?>
                        <?php echo $s_show->get_genres_string(true); ?>
                    </span>
                </li>
        <?php
            }
        endwhile;
        wp_reset_query();
        ?>

    </ul>
</div>


<?php get_footer(); ?>