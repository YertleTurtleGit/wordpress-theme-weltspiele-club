<div class="about padded-content">

    <span class="about-title">
        <img title="About" alt="About" src="<?php echo get_bloginfo('template_directory'); ?>/images/about.png" />
    </span>

    <div class="padded-content">
        <?php
        $page = get_page_by_title('about');
        $content = apply_filters('the_content', $page->post_content);
        echo $content;
        ?>
    </div>

</div>