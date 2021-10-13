<?php
/*
Template Name: Empty Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="author" content="Endric Merker radioweltspiele@galzone.de">
    <meta name="title" content=<?php echo get_the_title(); ?> />
    <meta name="description" content=<?php echo get_bloginfo() ?> />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link href="<?php echo get_bloginfo('template_directory'); ?>/style.css" rel='stylesheet'>

    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="48x48" href="favicon-48x48.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

    <link rel="mask-icon" href="safari-pinned-tab.svg" color="white">
    <meta name="msapplication-TileColor" content="white">
    <meta name="theme-color" content="white">

    <?php if (is_singular() && pings_open()) { ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php
    }
    wp_head(); ?>

    <title><?php echo get_the_title(); ?></title>

</head>


<body <?php body_class(); ?>>

    <div style="display: flex; align-items: center; width: 100%; height: 100vh; justify-content: center; border-bottom: 0.25rem solid black;">
        <img style="max-width: 90%; width: 40rem;" id="logo-big" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo-big.png" />
    </div>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
    <?php endwhile;
    endif; ?>

    <?php wp_footer(); ?>
</body>

</html>