<ul class="artist-list">

    <?php

    $terms = get_terms(array(
        'taxonomy' => 'artist',
        'hide_empty' => false
    ));

    /*function getExcerpt($str, $startPos = 0, $maxLength = 250)
    {
        if (strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= '...';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }*/

    foreach ($terms as $term) :
        // TODO Objectify.
        $artist_id = $term->term_id;
        $artist = new Artist($artist_id);
    ?>

        <li class="artist-item">
            <a href="<?php echo $artist->get_url(); ?>">
                <div class="artist-item-image"> <img src="<?php echo $artist->get_image_url(); ?>" /></div>
                <div class="artist-item-info">
                    <h2><?php echo $artist->get_name() ?></h2>
                    <!--<p><?php //echo $description 
                            ?></p>-->
                </div>
            </a>
        </li>

    <?php
    endforeach;
    wp_reset_query();
    ?>

</ul>