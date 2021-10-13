<?php get_header(); ?>

<?php
$term = get_queried_object();
$genre_id = $term->term_id;
$genre = new Genre($genre_id);
?>

<div class="padded-content">
    <h1><?php echo $genre->get_name() ?></h1>
    <p><?php echo $genre->get_description(); ?></p>
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
        $genres = $show->get_genres();

        $show_has_genre = false;
        foreach ($genres as $genre) {
            if ($genre->get_id() == $genre_id) {
                $show_has_genre = true;
                break;
            }
        }

        if ($show_has_genre) {
        ?>
            <li class="show-item">
                <a class="show-item-info" href="<?php the_permalink(); ?>">
                    <span class="show-item-info-date"><?php echo $show->get_date_string(); ?></span>
                    <span class="show-item-info-title"><?php the_title(); ?></span>
                </a>
                <span class="show-item-info-tags">
                    <?php echo $show->get_artists_string(); ?>
                </span>
            </li>
    <?php
        }
    endwhile;
    wp_reset_query();
    ?>

</ul>


<?php get_footer(); ?>