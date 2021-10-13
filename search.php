<?php
/*
Template Name: Search Page
*/
?>
<?php get_header(); ?>

<div id="main" class="padded-content">
    <span class="search-form">
        <form action="/" method="get">
            <input style="border: none; border-bottom: 0.2rem solid black; font-size: xx-large;" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
            <input type="hidden" name="post_type[]" value="show" />
            <input style="color: black; font-size: xx-large; background-color: transparent; border: none; font-weight: 900; cursor: pointer;" type="submit" value="⌕" />
        </form>
    </span>

    <?php if (have_posts()) : ?>


        <h1>Search Results</h1>
        <ul class="show-list-image">

            <?php while (have_posts()) : the_post(); ?>

                <?php
                $s_show_id = intval(get_the_ID());
                $s_show = new Event($s_show_id);
                ?>
                <li class="show-item-image">
                    <a href="<?php echo $s_show->get_url(); ?>">
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
            <?php endwhile; ?>

        </ul>

    <?php else : ?>
        <h2>Leider nichts gefunden</h2>

    <?php endif; ?>
</div>

<?php get_footer(); ?>