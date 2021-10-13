<?php
require get_theme_file_path('Event.php');
require get_theme_file_path('EventFormat.php');
require get_theme_file_path('Artist.php');
require get_theme_file_path('Genre.php');


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
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png);
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