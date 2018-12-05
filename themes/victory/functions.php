<?php
/*
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

// including some required file with shortcodes

require_once get_template_directory().'/inc/shortcodes.php';
require_once get_template_directory().'/inc/personal-area.php';

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

        wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array(), '1.14.3');
        wp_enqueue_script('popper');

        wp_register_script('bootstrap', get_template_directory_uri().'/libs/bootstrap/bootstrap.min.js', array('jquery-3.3.1'), '4.1.3');
        wp_enqueue_script('bootstrap');

        wp_register_script('slickscripts', get_template_directory_uri() . '/libs/slick/slick.min.js', array('jquery-3.3.1'), '1.8.0'); // Slick scripts
        wp_enqueue_script('slickscripts');

        wp_register_script('fancyboxscripts', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js', array('jquery-3.3.1'), '3.5.2'); // Fancybox scripts
        wp_enqueue_script('fancyboxscripts');

        wp_register_script('victory-scripts', get_template_directory_uri() . '/js/index.js', array('jquery-3.3.1'), '1.0.0'); // Custom scripts
        wp_enqueue_script('victory-scripts'); // Enqueue it!

        wp_localize_script('victory-scripts', 'vars',
            array(
                'admin_url' =>  get_admin_url(),
                'news_url'  => get_template_directory_uri()
            )
        );

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

    wp_register_style('fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css', array(), '3.5.2', 'all');
    wp_enqueue_style('fancybox'); // Enqueue it!

    wp_register_style('fontawesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css', array(), '5.5.0', 'all');
    wp_enqueue_style('fontawesome'); // Enqueue it!

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


// Add custom attribute and value to a nav menu item's anchor based on CSS class.
add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
    if ( 'login' === $item->classes[0] ) {
        $item->post_title = 'Войти';
        $atts['data-toggle'] = 'modal';
        $atts['data-target'] = '#enter';
    }

    return $atts;
}, 10, 3 );

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html_length_post()
{
    return 40;
}

// Create the Custom Excerpts callback
function html_excerpt_post($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    add_filter('excerpt_more', function( $more_callback) {
        return ' ...';
    });

    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    return $output;
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

function enqueue_admin()
{
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    wp_enqueue_script('media-upload');
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

if( !function_exists('victory_go_home') ):
    function victory_go_home(){
        wp_redirect( esc_html( home_url() ) );
        exit();
    }
endif;

if( !function_exists('auto_login_new_user') ):
    function auto_login_new_user( $user_id ) {
        wp_set_auth_cookie($user_id);
        $user = get_user_by( 'id', $user_id );
        do_action( 'wp_login', $user->user_login, $user );
        wp_set_current_user($user_id);
    }
endif;

if( !function_exists('admin_color_scheme') ):
    function admin_color_scheme() {
       global $_wp_admin_css_colors;
       $_wp_admin_css_colors = [];
    }
endif;

function remove_personal_options() {
     echo '<script type="text/javascript">jQuery(document).ready(function($) {
$(\'form#your-profile tr.user-admin-bar-front-wrap\').remove(); // remove the "Toolbar" field
$(\'table.form-table tr.user-url-wrap\').remove();// remove the "Website" field in the "Contact Info" section
$(\'h2:contains("Обо мне")\').remove(); // remove the "About Yourself" titles
$(\'form#your-profile tr.user-description-wrap\').remove(); // remove the "Biographical Info" field
$(\'form#your-profile tr.user-profile-picture\').remove(); // remove the "Profile Picture" field
});</script>';

}

function show_extra_profile_fields( $user ) {
    $gender = get_the_author_meta( 'gender', $user->ID );
    ?>
    <table class="form-table">
        <tbody>
        <tr class="user-gender-wrap">
            <th>
                <label class="label">Пол</label>
            </th>
            <td>
                <label class="radio"><input type="radio" id="male" name="gender"  <?php if ($gender == 'male' ) { ?>checked="checked"<?php }?> value="male">Мужской</label>
                <label class="radio"><input type="radio" id="female" name="gender"  <?php if ($gender == 'female' ) { ?>checked="checked"<?php }?> value="female">Женский</label>
            </td>
        </tr>
        </tbody>
    </table>
 <?php }

function save_extra_profile_fields( $user_id ) {
    update_user_meta( $user_id, 'gender', $_POST['gender'] );
}

function additional_user_fields( $user ) {
    ?>
    <h3>Документы пользователя</h3>

    <table class="form-table">

        <tr>
            <th>
                <label>Загрузите документ</label>
            </th>
            <?php
                $images = get_the_author_meta( 'images', $user->ID );
                if( $images == "" ) {
                   $images = [];
                } else {
                   $images = unserialize($images);
                }
                    foreach($images as $image) :?>
                        <tr class="image-row" >
                            <th>
                                <?php if ($image) : ?>
                                    <img class="user-preview-image" style="width: auto; height: 100px;" src="<?php echo $image; ?>;">
                                 <?php
                                    endif;
                                ?>
                            </th>
                            <td>
                                <input type="text" name="image" class="user-doc-image regular-text" value="<?php echo $image; ?>" class="regular-text" />
                                <input type='button' class="button-primary uploadimage" value="Upload Image" />
                                <input type='button' class="button-secondary deleteimage" style="background-color: #dc3545; border-color: #dc3545; box-shadow: 0 1px 0 #dc3545; text-shadow: 0 -1px 1px #dc3545, 1px 0 1px #dc3545, 0 1px 1px #dc3545, -1px 0 1px #dc3545; color: #fff;" value="Delete Image" /><br />
                                <span class="description">Please upload am image for your profile.</span>
                            </td>
                        </tr>
                    <?php

                    endforeach;
                    ?>
                    <tr>
                    <th>
                        <img class="user-preview-image" src="" style="width: auto; height: 100px;">
                    </th>
                    <td>
                        <input type="hidden" name="images" id="images" class="user-doc-new-image regular-text" value="" />
                        <input type="text" name="image" class="user-doc-image regular-text" id="image" value="" />
                        <input type='button' class="button-primary uploadimage" value="Upload Image" /><br />
                        <span class="description">Please upload am image for your profile.</span>
                    </td>
                    </tr>
        </tr>
    </table><!-- end form-table -->
    <?php
} // additional_user_fields

function add_image_doc_field() {
    if (is_admin()) {
        echo '<script type="text/javascript">jQuery(document).ready(function($) {
            $( ".uploadimage" ).on( "click", function() {

                var that = this;
                var oldFunc = window.send_to_editor;

                tb_show("Добавить документ", "media-upload.php?type=image&TB_iframe=1");

                window.send_to_editor = function( html )
                {
                    imgurl = $( "img" + html ).attr( "src" );
                    $newimage = $( that ).prev(".user-doc-image");
                    $newimage.val(imgurl);
                    $( that ).parent("td").prev("th").find(".user-preview-image").attr("src", imgurl);
                    tb_remove();
                    window.send_to_editor = oldFunc;
                    setTimeout(function() {
                        var $imageurl, images = [];

                        $imageurl = $(".user-preview-image")
                        $imageurl.each(function(key,data) {
                            images.push($(data).attr("src"));
                        });

                        $("#images").val(images);
                    }, 100);
                }

                return false;
            });

            $( ".deleteimage" ).on( "click", function() {
                $(this).closest(".image-row").remove();
            });
           });
    </script>';
    }
}

function save_additional_user_meta( $user_id ) {
    if (empty($_POST['images'])) {
        $images = "";
    } else {
        $images = serialize(explode(';,',$_POST['images']));
    }

    update_user_meta( $user_id, 'images', $images);
}

function additional_user_foto_field( $user ) {
    ?>
    <h3>Фото пользователя</h3>

    <table class="form-table">

        <tr>
            <th>
                <label>Загрузите фото</label>
            </th>
        </tr>
        <?php
            $foto = get_the_author_meta( 'foto', $user->ID );
        ?>
        <tr class="image-row" >
            <th>
                <img class="user-preview-foto" style="width: auto; height: 100px;" src="<?php echo $foto; ?>">
            </th>
            <td>
                <input type="text" name="foto" id="foto" class="user-foto regular-text" value="<?php echo $foto; ?>" class="regular-text" />
                <input type='button' class="button-primary uploadfoto" value="Upload Foto" /><br />
                <span class="description">Please upload a foto for your profile.</span>
            </td>
        </tr>
    </table><!-- end form-table -->
    <?php
} // end additional_user_image_field

function add_user_foto_field() {
    if (is_admin()) {
        echo '<script type="text/javascript">jQuery(document).ready(function($) {
            $( ".uploadfoto" ).on( "click", function() {
                var that = this;
                var oldFunc = window.send_to_editor;

                tb_show("Добавить фото", "media-upload.php?type=image&TB_iframe=1");

                window.send_to_editor = function( html )
                {
                    imgurl = $( "img" + html ).attr( "src" );
                    $newfoto = $( that ).prev(".user-foto");
                                        console.log($newfoto);
                    $newfoto.val(imgurl);
                    $( that ).parent("td").prev("th").find(".user-preview-foto").attr("src", imgurl);
                    tb_remove();
                    window.send_to_editor = oldFunc;
                    setTimeout(function() {
                        var foto;

                        //foto = $(".user-preview-foto").attr("src");

                        //$("#foto").val(foto);
                    }, 100);
                }

                return false;
            });

           });
    </script>';
    }
}

function save_user_foto_meta( $user_id ) {
    $foto = $_POST['foto'];
    update_user_meta( $user_id, 'foto', $foto);
}

function getRoleUserUploadFile() {
    if (is_admin()) {
        $user = get_role('subscriber');
        $user->add_cap('upload_files');
    }
}

function update_post( $post_id ) {
    $deposit_opened = strtotime(get_field('deposit_open'));
    $deposit_period = get_field('period');
    $deposit_close = date("d-m-Y", strtotime("+" . $deposit_period ." month", $deposit_opened));

    update_field( 'deposit_opened' , $deposit_opened, $post_id );
    update_field( 'close_deposit_date' , $deposit_close, $post_id );
    return $post_id;
}

function conditional_logic() {
        ?>
        <script type="text/javascript">
            jQuery(window).load(function () {
                jQuery('.disabled .acf-input .hasDatepicker').attr("disabled", "disabled");
            })
        </script>
    <?php
}

function pagination_news($posts_per_page, $page = 0)
{
    global $news;

    $i = 0;
    $count = $news->found_posts;

    /** Stop execution if there's only 1 page */
    if( $count <= $posts_per_page ) {
        return;
    }

    while ( $i + 1 <= ceil( $count / $posts_per_page ) ) {
        $links[] = (string)($i*$posts_per_page + 1);
        $i++;
    }

    $paginationString = '';

    $paginationString .= '<div class="container"><div class="row"><div class="pagination"><ul>' . "\n";

    sort( $links );
    foreach ( (array) $links as  $key =>$link ) {
        $class = $page == $key ? ' class="active"' : ' class="not-active"';
        $paginationString .= sprintf( '<li%s page="' . $key . '"><a>%s</a></li>' . "\n", $class, $key+1 );
    }

    $paginationString .= '</ul></div></div></div>' . "\n";

    return $paginationString;
}

function pagination($posts_per_page, $page = 0)
{
    global $news;

    $i = 0;
    $count = $news->found_posts;

    /** Stop execution if there's only 1 page */
    if( $count <= $posts_per_page )
        return;

    while ( $i + 1 <= ceil( $count / $posts_per_page ) ) {
        $links[] = (string)($i*$posts_per_page + 1);
        $i++;
    }

    $paginationString = '';

    $paginationString .= '<div class="container"><div class="row"><div class="pagination"><ul>' . "\n";

    sort( $links );
    foreach ( (array) $links as  $key =>$link ) {
        $class = $page == $key ? ' class="active"' : ' class="not-active"';
        $paginationString .= sprintf( '<li%s page="' . $key . '"><a>%s</a></li>' . "\n", $class, $key+1 );
    }

    $paginationString .= '</ul></div></div></div>' . "\n";
    return $paginationString;
}

$perPageNews = 3;

function paginationNews() {
    global $news;
    global $perPageNews;

    $page = $_POST['page'];

    $args = array(
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_type'      => 'post',
        'posts_per_page' => $perPageNews,
        'offset'         => $page * $perPageNews,
    );

    $news = new WP_Query( $args );
    $news_out = '';

    while ( $news->have_posts() ) {
        $news->the_post();

        $news_out .='<section class="reviews">';
        $news_out .='<div class="container">';
        $news_out .='<div class="row">';
        $news_out .='<div class="col-12">';
        $news_out .='<div class="wrapper-block">';
        $news_out .='<div class="wrapper2">';
        $news_out .='<div class="">';
        $news_out .='<div class="review">';
        $news_out .='<div class="photo">';
        $news_out .='<a href="" data-toggle="modal" data-target="#watch-news">';
        if ( get_the_post_thumbnail_url() ) {
            $news_out .= '<img src="' . get_the_post_thumbnail_url() . '" alt="photo">';
        }
        $news_out .='</a>';
        $news_out .='</div>';
        $news_out .='<h4>';
        $news_out .='<a href=""  data-toggle="modal" data-target="#watch-news">'. get_the_title() .'</a>';
        $news_out .='</h4>';
        $news_out .= html_excerpt_post('html_length_post');
        $news_out .='<div class="clean"></div>';
        $news_out .='</div>';
        $news_out .='<div class="clean"></div>';
        $news_out .='<div class="bot-trans">';
        $news_out .='<span>';
        $news_out .= get_the_date();
        $news_out .= '</span>';
        $news_out .= '<a href="#" data-toggle="modal" data-target="#watch-news" class="link-review">Читать далее</a>';
        $news_out .= '</div>';
        $news_out .= '<div class="clean"></div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '<div class="modal fade" id="watch-news" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
        $news_out .= '<div class="modal-dialog news modal-dialog-centered" role="document">';
        $news_out .= '<div class="modal-content">';
        $news_out .= '<div class="modal-body">';
        $news_out .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        $news_out .= '<img src="' . get_template_directory_uri() . '/img/close-modal.png" alt="close-modal">';
        $news_out .= '</button>';
        $news_out .= '<span class="data-news">' . get_the_date() .'</span>';
        $news_out .= '<div>';
        $news_out .= '<div class="all-w-bl-with">';
        $news_out .= '<div class="name">';
        $news_out .= '<p>';
        $news_out .= get_the_title();
        $news_out .= '</p>';
        $news_out .= '</div>';
        $news_out .= '<div class="img">';
        if ( get_the_post_thumbnail_url() ){
             $news_out .= '<img src="' . get_the_post_thumbnail_url() .'" alt="">';
        }
        $news_out .= '</div>';
        $news_out .= '<div class="bot-has-row"><a href=""><span class="left"><i class="fas fa-chevron-left"></i></span></a><a href=""><span class="right"><i class="fas fa-chevron-right"></i></span></a></div>';
        $news_out .= '<div class="clean"></div>';
        $news_out .= '</div>';
        $news_out .= '<div class="text-info-has">';
        $news_out .= get_the_content();
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</div>';
        $news_out .= '</section>';
    }



    $news_out .= '</div></div></div></section>';

    $news_out .= pagination($perPageNews, $page );

    $news_out .= '</div></div>';

    wp_reset_query();

    if(!empty($news_out)){
        $json['success'] = 1;
        $json['news'] = $news_out;
    }else{
        $json['success'] = 0;
    }
    echo json_encode($json);
    die();
}

function change_post_menu_label() {
    global $menu, $submenu;
    $menu[5][0] = 'Новости';
    $submenu['edit.php'][5][0] = 'Новости';
    $submenu['edit.php'][10][0] = 'Добавить новость';
    $submenu['edit.php'][16][0] = 'Новостные метки';
    echo '';
}

function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Новости';
    $labels->singular_name = 'Новости';
    $labels->add_new = 'Добавить новость';
    $labels->add_new_item = 'Добавить новость';
    $labels->edit_item = 'Редактировать новость';
    $labels->new_item = 'Добавить новость';
    $labels->view_item = 'Посмотреть новость';
    $labels->search_items = 'Найти новость';
    $labels->not_found = 'Не найдено';
    $labels->not_found_in_trash = 'Корзина пуста';
}

if( wp_doing_ajax() ){
    add_action( 'wp_ajax_nopriv_victory_ajax_return_post', 'victory_ajax_return_post' );
    add_action( 'wp_ajax_victory_ajax_return_post', 'victory_ajax_return_post' );
}

function victory_ajax_return_post() {
    global $post;
    $post = get_post($_POST['post'], OBJECT );
    setup_postdata( $post );
    //var_dump($post);
}

/**

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('admin_head', 'admin_color_scheme');
add_action('admin_enqueue_scripts', 'enqueue_admin');
add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_style( 'admin-styles', get_template_directory_uri() .'/css/admin.css' );
}, 99 );
add_action('init', 'victory_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'victory_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'pagination_news');
add_action('init', 'pagination'); // Add our Range Pagination
add_action( 'init', 'change_post_object_label' ); // Rename Posts
add_action( 'admin_menu', 'change_post_menu_label' ); // Rename Posts
add_action('wp_logout','victory_go_home');
add_action('user_register', 'auto_login_new_user');
add_action('show_user_profile', 'show_extra_profile_fields');
add_action('edit_user_profile', 'show_extra_profile_fields');
add_action('personal_options_update', 'save_extra_profile_fields');
add_action('edit_user_profile_update', 'save_extra_profile_fields');
add_action('show_user_profile', 'additional_user_foto_field' );
add_action('edit_user_profile', 'additional_user_foto_field' );
add_action('personal_options_update', 'save_user_foto_meta');
add_action('edit_user_profile_update', 'save_user_foto_meta');
add_action('show_user_profile', 'additional_user_fields' );
add_action('edit_user_profile', 'additional_user_fields' );
add_action('personal_options_update', 'save_additional_user_meta');
add_action('edit_user_profile_update', 'save_additional_user_meta');
add_action('admin_init', 'getRoleUserUploadFile');
add_action('acf/save_post' , 'update_post');
add_action('admin_head', 'conditional_logic');
// paginationNews on click
add_action('wp_ajax_paginationNews', 'paginationNews');
add_action('wp_ajax_nopriv_paginationNews', 'paginationNews');

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
add_filter('admin_head', 'remove_personal_options' );
add_filter('admin_head', 'add_image_doc_field');
add_filter('admin_head', 'add_user_foto_field');
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
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
add_filter('user_contactmethods', 'my_user_contactmethods');
add_filter('acf/load_field/name=full_name', 'disable_acf_load_field');
add_filter('acf/load_field/name=amount', 'disable_acf_load_field');
add_filter('acf/load_field/name=refill', 'disable_acf_load_field');
add_filter('acf/load_field/name=rate', 'disable_acf_load_field');
add_filter('acf/load_field/name=period', 'disable_acf_load_field');
add_filter('acf/load_field/name=order_type', 'disable_acf_load_field');
add_filter('acf/load_field/name=order_name', 'disable_acf_load_field');
add_filter('acf/load_field/name=order_phone', 'disable_acf_load_field');
add_filter('acf/load_field/name=order_date', 'disable_acf_load_field');
add_filter('acf/load_field/name=order_comment', 'disable_acf_load_field');
add_filter('acf/prepare_field', 'hide_fields');
add_filter('gettext',  'change_post_name');
add_filter('ngettext',  'change_post_name');

function change_post_name( $translated ) {
    $translated = str_ireplace(  'Записи',  'Новости',  $translated );
    return $translated;
}

function hide_fields ($field) {
    $deposit_open = get_field('deposit_open');
    if ( ( $field['_name'] == 'deposit_opened' &&  empty($deposit_open) ) ||
         ($field['_name'] == 'close_deposit_date' &&  empty($deposit_open))  ||
         ($field['_name'] == 'deposit_open' && !empty($deposit_open)) )
       {
        return false;
    }
  return $field;
}

function disable_acf_load_field( $field ) {
    $field['disabled'] = 1;
    return $field;
}

function my_user_contactmethods($user_contactmethods){

  $user_contactmethods['patronymic']    = 'Отчество';
  $user_contactmethods['phone']         = 'Телефон';
  $user_contactmethods['birthday']      = 'Дата рождения';
  $user_contactmethods['city']          = 'Город';
  $user_contactmethods['pass_ser']      = 'Серия паспорта';
  $user_contactmethods['pass_num']      = 'Номер паспорта';
  $user_contactmethods['pass_whom']     = 'Кем выдан';
  $user_contactmethods['pass_date']     = 'Дата выдачи';
  $user_contactmethods['pass_code']     = 'Код подразделения';
  $user_contactmethods['user_amount']   = 'Сумма сбережений';

  return $user_contactmethods;
}


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

function custom_post_type_deposit() {

    $labels = array(

        'name'                  => _x( 'Вклады', 'Post Type General Name', 'victory' ),

        'singular_name'         => _x( 'Вклады', 'Post Type Singular Name', 'victory' ),

        'menu_name'             => __( 'Вклады', 'victory' ),

        'name_admin_bar'        => __( 'Вклады', 'victory' ),

        'archives'              => __( 'Архив Вкладов', 'victory' ),

        'parent_item_colon'     => __( 'Родительский Элемент:', 'victory' ),

        'all_items'             => __( 'Все Вклады', 'victory' ),

        'add_new_item'          => __( 'Добавить Новый Вклад', 'victory' ),

        'add_new'               => __( 'Добавить Новый', 'victory' ),

        'new_item'              => __( 'Новый Вклад', 'victory' ),

        'edit_item'             => __( 'Редактировать Вклад', 'victory' ),

        'update_item'           => __( 'Обновить Вклад', 'victory' ),

        'view_item'             => __( 'Посмотреть Вклад', 'victory' ),

        'search_items'          => __( 'Поиск Вклада', 'victory' ),

        'not_found'             => __( 'Не Найдено', 'victory' ),

        'not_found_in_trash'    => __( 'Не найдено в корзине', 'victory' ),

        'featured_image'        => __( 'Избранное Изображение', 'victory' ),

        'set_featured_image'    => __( 'Установить Избранное Изображение', 'victory' ),

        'remove_featured_image' => __( 'Удалить Избранное Изображение', 'victory' ),

        'use_featured_image'    => __( 'Использовать как Избранное Изображение', 'victory' ),

        'insert_into_item'      => __( 'Вставить в Вклад', 'victory' ),

        'uploaded_to_this_item' => __( 'Загружено в этот Вклад', 'victory' ),

        'items_list'            => __( 'Список Вкладов', 'victory' ),

        'items_list_navigation' => __( 'Управление списком Вкладов', 'victory' ),

        'filter_items_list'     => __( 'Филтьр списка Вкладов', 'victory' ),

    );

    $args = array(

        'label'                 => __( 'Вклады', 'victory' ),

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

    register_post_type( 'deposit', $args );

}

add_action( 'init', 'custom_post_type_deposit', 0 );

function custom_post_type_service() {

    $labels = array(

        'name'                  => _x( 'Заказы', 'Post Type General Name', 'victory' ),

        'singular_name'         => _x( 'Заказы', 'Post Type Singular Name', 'victory' ),

        'menu_name'             => __( 'Заказы', 'victory' ),

        'name_admin_bar'        => __( 'Заказы', 'victory' ),

        'archives'              => __( 'Архив Заказов', 'victory' ),

        'parent_item_colon'     => __( 'Родительский Элемент:', 'victory' ),

        'all_items'             => __( 'Все Заказы', 'victory' ),

        'add_new_item'          => __( 'Добавить Новый Заказ', 'victory' ),

        'add_new'               => __( 'Добавить Новый', 'victory' ),

        'new_item'              => __( 'Новый Заказ', 'victory' ),

        'edit_item'             => __( 'Редактировать Заказ', 'victory' ),

        'update_item'           => __( 'Обновить Заказ', 'victory' ),

        'view_item'             => __( 'Посмотреть Заказ', 'victory' ),

        'search_items'          => __( 'Поиск Заказа', 'victory' ),

        'not_found'             => __( 'Не Найдено', 'victory' ),

        'not_found_in_trash'    => __( 'Не найдено в корзине', 'victory' ),

        'featured_image'        => __( 'Избранное Изображение', 'victory' ),

        'set_featured_image'    => __( 'Установить Избранное Изображение', 'victory' ),

        'remove_featured_image' => __( 'Удалить Избранное Изображение', 'victory' ),

        'use_featured_image'    => __( 'Использовать как Избранное Изображение', 'victory' ),

        'insert_into_item'      => __( 'Вставить в Заказ', 'victory' ),

        'uploaded_to_this_item' => __( 'Загружено в этот Заказ', 'victory' ),

        'items_list'            => __( 'Список Заказов', 'victory' ),

        'items_list_navigation' => __( 'Управление списком Заказов', 'victory' ),

        'filter_items_list'     => __( 'Филтьр списка Заказов', 'victory' ),

    );

    $args = array(

        'label'                 => __( 'Заказы', 'victory' ),

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

    register_post_type( 'service', $args );

}

add_action( 'init', 'custom_post_type_service', 0 );

function custom_post_type_equipment() {

    $labels = array(

        'name'                  => _x( 'Спецтехника', 'Post Type General Name', 'victory' ),

        'singular_name'         => _x( 'Спецтехника', 'Post Type Singular Name', 'victory' ),

        'menu_name'             => __( 'Спецтехника', 'victory' ),

        'name_admin_bar'        => __( 'Спецтехника', 'victory' ),

        'archives'              => __( 'Архив Спецтехники', 'victory' ),

        'parent_item_colon'     => __( 'Родительский Элемент:', 'victory' ),

        'all_items'             => __( 'Вся Спецтехника', 'victory' ),

        'add_new_item'          => __( 'Добавить Новую Спецтехнику', 'victory' ),

        'add_new'               => __( 'Добавить Новую', 'victory' ),

        'new_item'              => __( 'Новая Спецтехника', 'victory' ),

        'edit_item'             => __( 'Редактировать Спецтехнику', 'victory' ),

        'update_item'           => __( 'Обновить Спецтехнику', 'victory' ),

        'view_item'             => __( 'Посмотреть Спецтехнику', 'victory' ),

        'search_items'          => __( 'Поиск Спецтехники', 'victory' ),

        'not_found'             => __( 'Не Найдено', 'victory' ),

        'not_found_in_trash'    => __( 'Не найдено в корзине', 'victory' ),

        'featured_image'        => __( 'Избранное Изображение', 'victory' ),

        'set_featured_image'    => __( 'Установить Избранное Изображение', 'victory' ),

        'remove_featured_image' => __( 'Удалить Избранное Изображение', 'victory' ),

        'use_featured_image'    => __( 'Использовать как Избранное Изображение', 'victory' ),

        'insert_into_item'      => __( 'Вставить в Спецтехнику', 'victory' ),

        'uploaded_to_this_item' => __( 'Загружено в эту Спецтехнику', 'victory' ),

        'items_list'            => __( 'Список Спецтехники', 'victory' ),

        'items_list_navigation' => __( 'Управление списком Спецтехники', 'victory' ),

        'filter_items_list'     => __( 'Филтьр списка Спецтехники', 'victory' ),

    );

    $args = array(

        'label'                 => __( 'Спецтехника', 'victory' ),

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

    register_post_type( 'equipment', $args );

}

add_action( 'init', 'custom_post_type_equipment', 0 );

/////// If admin create the menu

if (is_admin()) {
    add_action('admin_menu', 'victory_options_admin_menu');
}

if (!function_exists('victory_options_admin_menu')):
    function victory_options_admin_menu() {
        add_options_page('Victory Options', 'Победа Настройки', 8, '/inc/theme-admin.php', 'theme_options_page');
        require_once get_template_directory().'/inc/theme-admin.php';
    }
endif;

function create_onetime_nonce($action = -1) {
    $time = time();
    $nonce = wp_create_nonce($time.$action);
    return $nonce . '-' . $time;
}

function verify_onetime_nonce( $_nonce, $action = -1) {
    $parts = explode( '-', $_nonce );
    $nonce = $parts[0];
    $generated = $parts[1];

    $nonce_life = 60*60;
    $expires    = (int) $generated + $nonce_life;
    $expires2   = (int) $generated + 120;
    $time       = time();

    if( ! wp_verify_nonce( $nonce, $generated.$action ) || $time > $expires ){
        return false;
    }

    return true;
}

?>
