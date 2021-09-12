<?php
function init_hauptmenue()
{
    register_nav_menu('hauptmenue', __('Hauptmenü'));
}
add_action('init', 'init_hauptmenue');

// Adding the Open Graph in the Language Attributes
function add_opengraph_doctype($output)
{
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

function insert_fb_in_head()
{
    global $post;
    if (!is_singular())
        return;

    if ($excerpt = $post->post_excerpt) {
        $excerpt = strip_tags($post->post_excerpt);
    } else {
        $excerpt = get_bloginfo('description');
    }

    $page_permalink = get_the_permalink();
    $page_title =  get_the_title();
    $page_name = get_bloginfo();
    $og_title = $page_title;

    echo '<title>' . $page_title . '</title>';

    echo '<meta property="og:title" content="' . $og_title . '"/>';
    echo '<meta property="og:description" content="' . $excerpt . '"/>';
    echo '<meta property="og:type" content="article"/>';
    echo '<meta property="og:url" content="' . $page_permalink . '"/>';
    echo '<meta property="og:site_name" content="' . $page_name . '"/>';

    echo '<meta name="twitter:title" content="' . $og_title . '"/>';
    echo '<meta name="twitter:card" content="summary" />';
    echo '<meta name="twitter:description" content="' . $excerpt . '" />';
    echo '<meta name="twitter:url" content="' . $page_permalink . '"/>';

    $thumbnail_src = get_the_post_thumbnail_url($post->ID, 'large');

    echo '<meta property="og:image" content="' . $thumbnail_src . '"/>';
    echo '<meta name="twitter:image" content="' . $thumbnail_src . '"/>';

    /*if (!has_post_thumbnail($post->ID)) {
        $default_image = " 	https://tanke-hannover.de/logo-og.png";
        echo '<meta property="og:image" content="' . $default_image . '"/>';
        echo '<meta name="twitter:image" content="' . $default_image . '"/>';
    } else {
        $thumbnail_src = get_the_post_thumbnail_url($post->ID, 'large');
        echo '<meta property="og:image" content="' . $thumbnail_src . '"/>';
        echo '<meta name="twitter:image" content="' . $thumbnail_src . '"/>';
    }*/
}
add_action('wp_head', 'insert_fb_in_head', 5);

function my_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(http://club.weltspiele.club/wp-content/uploads/2021/08/cropped-logo-big.png);
            min-height: 100%;
            width: 100%;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');



function widgets_init()
{
    register_sidebar(array(
        'name'          => 'Test Widget',
        'id'            => 'test-widget',
    ));
}
add_action('widgets_init', 'widgets_init');

add_theme_support('post-thumbnails');

function ww_load_dashicons(){
    wp_enqueue_style('dashicons');
 }
 add_action('wp_enqueue_scripts', 'ww_load_dashicons', 999);

// Removes from admin menu
add_action('admin_menu', 'my_remove_admin_menus');
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
// Removes from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

// ************* Remove default Posts type since no blog *************

// Remove side menu
add_action('admin_menu', 'remove_default_post_type');

function remove_default_post_type()
{
    remove_menu_page('edit.php');
}

// Remove +New post in top Admin Menu Bar
add_action('admin_bar_menu', 'remove_default_post_type_menu_bar', 999);

function remove_default_post_type_menu_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-post');
}

// Remove Quick Draft Dashboard Widget
add_action('wp_dashboard_setup', 'remove_draft_widget', 999);

function remove_draft_widget()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}

// End remove post type

function date_to_str(DateTime $date, string $format)
{
    return date_i18n($format, $date->getTimestamp());
}


function get_veranstaltung_datum(int $id): string
{
    $mehrtagig = (bool) get_post_meta($id, 'mehrtagig', true);
    $startdatum = date_create(get_post_meta($id, 'startdatum', true));
    $enddatum = date_create(get_post_meta($id, 'enddatum', true));
    $ganztagig = (bool) get_post_meta($id, 'ganztagig', true);
    $startzeit = date_create(get_post_meta($id, 'startzeit', true));
    $endzeit = date_create(get_post_meta($id, 'endzeit', true));

    $date_string = '';

    if ($mehrtagig) {
        if (date_format($startdatum, 'Y') == date_format($enddatum, 'Y')) {
            if (date_format($startdatum, 'm') == date_format($enddatum, 'm')) {
                $date_string .= date_to_str($startdatum, 'd.') . ' – ' . date_to_str($enddatum, 'd. F Y');
            } else {
                $date_string .= date_to_str($startdatum, 'd. F') . ' – ' . date_to_str($enddatum, 'd. F Y');
            }
        } else {
            $date_string .= date_to_str($startdatum, 'd. F Y') . ' – ' . date_to_str($enddatum, 'd. F Y');
        }
    } else {
        $date_string .= date_to_str($startdatum, 'd. F Y',);
    }

    if (!$ganztagig) {
        $date_string .= ' / ' . date_to_str($startzeit, 'G:i') . ' – ' . date_to_str($endzeit, 'G:i') . ' Uhr';
    }

    return $date_string;
}

function get_veranstaltung_bild_url(int $id)
{
    $veranstaltungsbild = get_post_meta($id, 'bild', true);
    return wp_get_attachment_image_src($veranstaltungsbild, 'large')[0];
}

function get_veranstaltung_bild(int $id)
{
    $image_url = get_veranstaltung_bild_url($id);

    if (!$image_url) {
        return '';
    }

    return '<div class="event-image-div"><img src="' . $image_url . '" /></div>';
}
