<?php get_header(); ?>


<div class="content page-content">
        <div>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <?php the_content(); ?>
                <?php endwhile;
                endif; ?>
        </div>
</div>

<?php get_footer(); ?>