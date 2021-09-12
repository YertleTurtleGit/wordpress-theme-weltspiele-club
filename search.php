<?php
/*
Template Name: Search Page
*/
?>
<?php get_header(); ?>

<div id="main">
    <?php if (have_posts()) : ?>
        <p class="info">Deine Suchergebnisse f&uuml;r <strong><?php echo $s ?></strong></p>

        <?php while (have_posts()) : the_post(); ?>
            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <div class="entry">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>      

    <?php else : ?>
        <h2>Leider nichts gefunden</h2>

    <?php endif; ?>
</div>

<?php get_footer(); ?>