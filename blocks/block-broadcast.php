<div class="broadcast">
    <?php
    // TODO Implement random order.
    $terms = get_terms(array(
        'taxonomy' => 'format',
        'hide_empty' => false,
    ));
    ?>

    <span class="broadcast-title">
        <img title="Broadcast" alt="Broadcast" src="<?php echo get_bloginfo('template_directory'); ?>/images/broadcast.png" />
    </span>

    <ul class="broadcast-list">
        <?php
        foreach ($terms as $term) :
            // TODO Objectify.
            $format_id = $term->term_id;
            $name = $term->name;
            $link = get_term_link($format_id);
        ?>
            <a href="<?php echo $link; ?>">
                <li class="broadcast-show-item">
                    <span class="broadcast-show-title"><?php echo $name; ?></span>
                </li>
            </a>
        <?php
        endforeach;
        wp_reset_query();
        ?>

    </ul>

</div>