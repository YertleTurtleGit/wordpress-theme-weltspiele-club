<?php get_header(); ?>

<div class="content">

    <?php
    $term = get_queried_object();
    $artist_id = $term->term_id;
    $artist = new Artist($artist_id);
    ?>

    <div class="padded-content">
        <h1><?php echo $artist->get_name() ?></h1>

        <div> <img src="<?php echo $artist->get_image_url(); ?>" /></div>
        <p><?php echo $artist->get_description(); ?></p>
    </div>

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
        ?>

        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
            <?php
            $show_id = get_the_ID();
            $show = new Event($show_id);
            $artists = $show->get_artists();

            $show_from_artist = false;
            foreach ($artists as $artist) {
                if ($artist->get_id() == $artist_id) {
                    $show_from_artist = true;
                    break;
                }
            }

            if ($show_from_artist) {
            ?>
                <li class="show-item">
                    <a class="show-item-info" href="<?php the_permalink(); ?>">
                        <span class="show-item-info-date"><?php echo $show->get_date_string(); ?></span>
                        <span class="show-item-info-title"><?php the_title(); ?></span>
                    </a>
                    <span class="show-item-info-tags">
                        <?php echo $show->get_genres_string(true); ?>
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