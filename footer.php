<div class="content page-content footer">
    <div class="footer-logo">
        <img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo-text.png" />
    </div>
    <div class="footer-menu uppercase monospace">
        <?php
        wp_nav_menu(array(
            'menu'           => 'hauptmenue',
            'fallback_cb'    => false
        ));
        ?>
    </div>
    <div class="footer-links uppercase monospace">
        <?php
        wp_nav_menu(array(
            'menu'           => 'footerlinks',
            'fallback_cb'    => false
        ));
        ?>
    </div>
    <div class="footer-info uppercase monospace">
    cosmos for music, arts and culture
    </div>
</div>

<script src="<?php echo get_bloginfo('template_directory'); ?>/script.js"></script>

<?php wp_footer(); ?>
</body>

</html>