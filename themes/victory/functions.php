<?php
/*
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

// including some required file with shortcodes

require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/personal-area.php';

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function victory_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => false,
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'menu_item',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => '',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="nav main-menu justify-content-between">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
    $classes[] = 'menu_item';

    return $classes;
}

add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );

// Load HTML5 Blank scripts (header.php)
function victory_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('jquery-3.3.1', get_template_directory_uri() . '/libs/jquery/jquery.min.js', array(), '3.3.1');
        wp_enqueue_script('jquery-3.3.1');

        wp_register_script('jquery-ui', get_template_directory_uri() . '/libs/jqueryUI/jquery-ui.min.js', array(), '1.12.1');
        wp_enqueue_script('jquery-ui');

    	wp_register_script('jquery-ui-touch-punch', get_template_directory_uri() . '/libs/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js', array(), '0.2.3');
        wp_enqueue_script('jquery-ui-touch-punch');

        wp_register_script('bootstrap', get_template_directory_uri().'/libs/bootstrap/bootstrap.min.js', array('jquery-3.3.1'), '4.1.3');
        wp_enqueue_script('bootstrap');

        wp_register_script('slickscripts', get_template_directory_uri() . '/libs/slick/slick.min.js', array('jquery-3.3.1'), '1.8.0'); // Slick scripts
        wp_enqueue_script('slickscripts');

        wp_register_script('upload', get_template_directory_uri() . '/libs/upload/imageuploadify.min.js', array('jquery-3.3.1'), '1.0.0'); // Upload
        wp_enqueue_script('upload');

        wp_register_script('victory-scripts', get_template_directory_uri() . '/js/index.js', array('jquery-3.3.1'), '1.0.0'); // Custom scripts
        wp_enqueue_script('victory-scripts'); // Enqueue it!

//        wp_register_script('google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDhXduNu_0Am0oQdy-wPAnSDzibbpaoYzg');
//        wp_enqueue_script('google-map-api');
    }
}

// Load HTML5 Blank styles
function victory_styles()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/libs/bootstrap/bootstrap.min.css', array(), '4.1.3', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('jquery-ui', get_template_directory_uri() . '/libs/jqueryUI/jquery-ui.min.css', array(), '1.12.1', 'all');
    wp_enqueue_style('jquery-ui'); // Enqueue it!

    wp_register_style('slick', get_template_directory_uri() . '/libs/slick/slick.css', array(), '1.8.0', 'all');
    wp_enqueue_style('slick'); // Enqueue it!

    wp_register_style('upload', get_template_directory_uri() . '/libs/upload/imageuploadify.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style('upload'); // Enqueue it!

    wp_register_style('victory', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('victory'); // Enqueue it!

    //theme styles
    wp_register_style('victory-theme-style', get_template_directory_uri() . '/css/index.css', array(), '1.0', 'all');
    wp_enqueue_style('victory-theme-style');
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'victory'), // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}



// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read more', 'ledeffect') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Create the Custom Excerpts callback
function the_excerpt_max_charlength( $string, $charlength ){
    $charlength++;

    if ( mb_strlen( $string ) > $charlength ) {
        $subex = mb_substr( $string, 0, $charlength - 3 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            $output = mb_substr( $subex, 0, $excut );
        } else {
            $output;
        }
        $output .= '...';

        return $output;

    } else {
        return $string;
    }
}

/**

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'victory_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'victory_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual do_shortcodes only)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('document_title_parts', function( $parts ){
	if( isset($parts['site']) ) unset($parts['site']);
	if( isset($parts['page']) ) unset ($parts['page']);
	return $parts;
});

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


// Register Custom Post Type

function custom_post_type_review() {

    $labels = array(

        'name'                  => _x( 'Отзывы', 'Post Type General Name', 'victory' ),

        'singular_name'         => _x( 'Отзывы', 'Post Type Singular Name', 'victory' ),

        'menu_name'             => __( 'Отзывы', 'victory' ),

        'name_admin_bar'        => __( 'Отзывы', 'victory' ),

        'archives'              => __( 'Архив Отзывов', 'victory' ),

        'parent_item_colon'     => __( 'Родительский Элемент:', 'victory' ),

        'all_items'             => __( 'Все Отзывы', 'victory' ),

        'add_new_item'          => __( 'Добавить Новый Отзыв', 'victory' ),

        'add_new'               => __( 'Добавить Новый', 'victory' ),

        'new_item'              => __( 'Новый Отзыв', 'victory' ),

        'edit_item'             => __( 'Редактировать Отзыв', 'victory' ),

        'update_item'           => __( 'Обновить Отзыв', 'victory' ),

        'view_item'             => __( 'Посмотреть Отзыв', 'victory' ),

        'search_items'          => __( 'Поиск Отзыва', 'victory' ),

        'not_found'             => __( 'Не Найдено', 'victory' ),

        'not_found_in_trash'    => __( 'Не найдено в корзине', 'victory' ),

        'featured_image'        => __( 'Избранное Изображение', 'victory' ),

        'set_featured_image'    => __( 'Установить Избранное Изображение', 'victory' ),

        'remove_featured_image' => __( 'Удалить Избранное Изображение', 'victory' ),

        'use_featured_image'    => __( 'Использовать как Избранное Изображение', 'victory' ),

        'insert_into_item'      => __( 'Вставить в отзыв', 'victory' ),

        'uploaded_to_this_item' => __( 'Загружено в этот отзыв', 'victory' ),

        'items_list'            => __( 'Список отзывов', 'victory' ),

        'items_list_navigation' => __( 'Управление списком отзывов', 'victory' ),

        'filter_items_list'     => __( 'Филтьр списка отзывов', 'victory' ),

    );

    $args = array(

        'label'                 => __( 'Отзывы', 'victory' ),

        'description'           => __( 'Post Type Description', 'victory' ),

        'labels'                => $labels,

        'supports'              => array( 'title'),

        'hierarchical'          => false,

        'public'                => true,

        'show_ui'               => true,

        'show_in_menu'          => true,

        'menu_position'         => 5,

        'show_in_admin_bar'     => true,

        'show_in_nav_menus'     => true,

        'can_export'            => true,

        'has_archive'           => true,

        'exclude_from_search'   => false,

        'publicly_queryable'    => true,

        'capability_type'       => 'page',

    );

    register_post_type( 'reviews', $args );

}

add_action( 'init', 'custom_post_type_review', 0 );

///////////////////////////////////////////////////////////////////////////////////////////
/////// If admin create the menu
///////////////////////////////////////////////////////////////////////////////////////////
if (is_admin()) {
    add_action('admin_menu', 'victory_options_admin_menu');
}

if (!function_exists('victory_options_admin_menu')):
    function victory_options_admin_menu() {
        add_options_page('Victory Options', 'Победа Настройки', 8, '/inc/theme-admin.php', 'theme_options_page');
        require_once get_template_directory().'/inc/theme-admin.php';
    }
endif;

?>
