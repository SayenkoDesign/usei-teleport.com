<?php
/**
 * Lenard functions file.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}

global $lenard_options;


if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/theme-config.php' );
}

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/*********************************************************************
* THEME SETUP
*/

function lenard_setup() {

    global $lenard_options;

    // Translations support. Find language files in lenard/languages
    load_theme_textdomain('lenard', get_template_directory().'/languages');
    $locale = get_locale();
    $locale_file = get_template_directory()."/languages/{$locale}.php";
    if(is_readable($locale_file)) { require_once($locale_file); }

    // Set content width
    global $content_width;
    if (!isset($content_width)) $content_width = 720;

    // Editor style (editor-style.css)
    add_editor_style(array('assets/css/editor-style.css'));

    // Load plugin checker
    require(get_template_directory() . '/inc/plugin-activation.php');


    add_filter('add_to_cart_fragments' , 'woocommerce_header_add_to_cart_fragment' );

    // Nav Menu (Custom menu support)
    if (function_exists('register_nav_menu')) :
        register_nav_menu('primary', __('Lenard Primary Menu', 'lenard'));
    endif;

    // Theme Features: Automatic Feed Links
    add_theme_support('automatic-feed-links');

    // Theme Features: woocommerce
    add_theme_support( 'woocommerce' );

    // Theme Features: Dynamic Sidebar
    add_post_type_support( 'post', 'simple-page-sidebars' );


    // Theme Features: Post Thumbnails and custom image sizes for post-thumbnails
    add_theme_support('post-thumbnails', array('post', 'page','product','portfolio'));

    // Theme Features: Post Formats
    add_theme_support('post-formats', array( 'gallery', 'image', 'link', 'quote', 'video', 'audio'));


    
}
add_action('after_setup_theme', 'lenard_setup');


function lenard_widgets_setup() {

    global $lenard_options;
    // Widget areas
    if (function_exists('register_sidebar')) :
        // Sidebar right
        register_sidebar(array(
            'name' => "Blog Sidebar",
            'id' => "lenard-widgets-aside-right",
            'description' => __('Widgets placed here will display in the right sidebar', 'lenard'),
            'before_widget' => ' <div class="widget clearfix">',
            'before_title' =>'<div class="widget-title"><h3>',
            'after_title'=>'<div class="border-normal"></div></div></h3>',
            'after_widget'  => '</div>'
        ));

    endif;
   
}
add_action('widgets_init', 'lenard_widgets_setup');


// The excerpt "more" button
function lenard_excerpt($text) {
    return str_replace('[&hellip;]', '[&hellip;]<a class="" title="'. sprintf (__('Read more on %s','lenard'), get_the_title()).'" href="'.get_permalink().'">' . __(' Read more','lenard') . '</a>', $text);
}
add_filter('the_excerpt', 'lenard_excerpt');

// wp_title filter
function lenard_title($output) {
    echo $output;
    // Add the blog name
    bloginfo('name');
    // Add the blog description for the home/front page
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) echo ' - '.$site_description;
    // Add a page number if necessary
    if (!empty($paged) && ($paged >= 2 || $page >= 2)) echo ' - ' . sprintf(__('Page %s', 'lenard'), max($paged, $page));
}
add_filter('wp_title', 'lenard_title');

/*********************************************************************
 * Function to load all theme assets (scripts and styles) in header
 */
function lenard_load_theme_assets() {

    global $lenard_options;

    // Do not know any method to enqueue a script with conditional tags!
    echo '
    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
   <![endif]-->
    
    <!--[if IE]>
        <link rel="stylesheet" href="'.get_template_directory_uri().'/assets/css/ie.css" media="screen" type="text/css" />
        <![endif]-->

    ';

    

    // Enqueue all the theme CSS
    
        wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css');
        wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.css');
        wp_enqueue_style('stroke-font', get_template_directory_uri().'/assets/css/stroke-font.css');
        wp_enqueue_style('bxslider', get_template_directory_uri().'/assets/css/bxslider.css');
        wp_enqueue_style('pretty-photo', get_template_directory_uri().'/assets/css/prettyPhoto.css');
        wp_enqueue_style('owl-carousel', get_template_directory_uri().'/assets/css/owl-carousel.css');
        wp_enqueue_style('animate', get_template_directory_uri().'/assets/css/animate.min.css');
        wp_enqueue_style('settings', get_template_directory_uri().'/assets/rs-plugin/css/settings.css');        
        wp_enqueue_style('main', get_stylesheet_directory_uri().'/style.css', [], "4.7.3");
        wp_enqueue_style('custom', get_template_directory_uri().'/assets/css/custom.css');    
   
   // Enqueue all the js files of theme
    wp_enqueue_script('bootstrap.min', get_template_directory_uri().'/assets/js/bootstrap.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('bootstrap.hover', get_template_directory_uri().'/assets/js/bootstrap-hover-dropdown.js', array(), FALSE, TRUE);
    wp_enqueue_script('parallax', get_template_directory_uri().'/assets/js/parallax.js', array(), FALSE, TRUE);
    wp_enqueue_script('retina', get_template_directory_uri().'/assets/js/retina.js', array(), FALSE, TRUE);
    wp_enqueue_script('bxslider', get_template_directory_uri().'/assets/js/bxslider.js', array(), FALSE, TRUE);
    wp_enqueue_script('circle-progress', get_template_directory_uri().'/assets/js/circle-progress.js', array(), FALSE, TRUE);
    wp_enqueue_script('isotope.pkgd.min', get_template_directory_uri().'/assets/js/isotope.pkgd.min.js', array(), FALSE, TRUE);  
    wp_enqueue_script('jquery.prettyPhoto', get_template_directory_uri().'/assets/js/jquery.prettyPhoto.js', array(), FALSE, TRUE);  
    wp_enqueue_script('wow.min', get_template_directory_uri().'/assets/js/wow.min.js', array(), FALSE, TRUE);  
    wp_enqueue_script('scroll', get_template_directory_uri().'/assets/js/scroll.js', array(), FALSE, TRUE);  
    wp_enqueue_script('jquery.themepunch.tools.min', get_template_directory_uri().'/assets/rs-plugin/js/jquery.themepunch.tools.min.js', array(), FALSE, TRUE);
    wp_enqueue_script('jquery.themepunch.revolution.min', get_template_directory_uri().'/assets/rs-plugin/js/jquery.themepunch.revolution.min.js', array(), FALSE, TRUE);  
    wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', array(), FALSE, TRUE);  
    wp_enqueue_script('owl.carousel-js', get_template_directory_uri().'/assets/js/owl.carousel.js', array(), FALSE, TRUE);
    wp_enqueue_script('owl.scripts-js', get_template_directory_uri().'/assets/js/owl.scripts.js', array(), FALSE, TRUE);
    
    
    $color_variation ='';
    if(isset($lenard_options['custom_color']) && $lenard_options['custom_color']!=''){
    $main_custom_color= esc_attr($lenard_options['custom_color']);

    } else {
    $main_custom_color= "#d90000";
    }
    
          $hex = str_replace("#", "", esc_attr($main_custom_color));

           if(strlen($hex) == 3) {
              $r = hexdec(substr($hex,0,1).substr($hex,0,1));
              $g = hexdec(substr($hex,1,1).substr($hex,1,1));
              $b = hexdec(substr($hex,2,1).substr($hex,2,1));
           } else {
              $r = hexdec(substr($hex,0,2));
              $g = hexdec(substr($hex,2,2));
              $b = hexdec(substr($hex,4,2));
           }
            $new_custom_color= array($r, $g, $b);

  $color_variation='
    .portfolio-container.image-hover-red .portfolio-item:hover .portfolio-image:after,
    .magnifier {
        background: rgba('.$new_custom_color['0'].','.$new_custom_color['1'].','.$new_custom_color['2'].');
        background: rgba('.$new_custom_color['0'].','.$new_custom_color['1'].','.$new_custom_color['2'].', 0.9);
    }
    .widget-title span,
    a:hover,
    a:focus,
    .pagination > li > a:hover,
    .pagination > li > span:hover,
    .widget a:hover,
    .media-body a,
    .widget .media-body span a,
    .breadcrumb a,
    .navbar-default .navbar-nav > li > a:hover,
    .navbar-default .navbar-nav > li > a:focus,
    .navbar-default .navbar-nav > .active > a,
    .navbar-default .navbar-nav > .active > a:focus,
    .navbar-default .navbar-nav > .active > a:hover,
    .stats i,
    .service-box.noborder:hover h3,
    .color-red {
        color: '.$main_custom_color.';
    }
    .service-box:hover {
        border-bottom-color: '.$main_custom_color.';
    }
    .portfolio-filtering a.active:after {
        border-top-color: '.$main_custom_color.';
    }
    .portfolio-filtering a.active:before {
        border-top-color: '.$main_custom_color.';
    }
    .tags-widget a:hover,
    .navbar-toggle,
    .form-control:focus,
    .btn-primary,
    .box-red,
    .pricing-table.premium .btn,
    .pricing-table.premium .pricing-icon-container,
    .tabs-left > .nav-tabs > li:hover,
    .tabs-left > .nav-tabs > li:active,
    .tabs-left > .nav-tabs > li.active,
    .service-box.noborder:hover .icon-container {
        border-color: '.$main_custom_color.';
    }
    .post-media .icon-container,
    .navbar-toggle,
    .red-section,
    .fixed:hover,
    .btn-primary,
    .footer-social-icons .icon-container,
    .box-red,
    .pricing-table.premium .btn,
    .pricing-table.premium .pricing-icon-container,
    .portfolio-filtering a.active,
    .owl-theme .owl-dots .owl-dot.active span,
    .owl-theme .owl-dots .owl-dot:hover span,
    .tabs-left > .nav-tabs > li:active,
    .tabs-left > .nav-tabs > li.active,
    .tabs-left > .nav-tabs > li:hover,
    .service-box:hover .icon-container {
        background-color: '.$main_custom_color.';
    }
    .tagcloud a:hover {
        border-color: '.$main_custom_color.';
    }
    .wpcf7-form-control-wrap .wpcf7-form-control.wpcf7-text:focus {
        border-color: '.$main_custom_color.' !important;
    }
    .btn.btn-primary {
        background-color: '.$main_custom_color.';
        border-color: '.$main_custom_color.';
    }
    .portfolio-filtering a.active:after {
        border-color: rgba('.$new_custom_color['0'].','.$new_custom_color['1'].','.$new_custom_color['2'].', 0);
        border-top-color: '.$main_custom_color.';
    }
    .portfolio-filtering a.active:before {
        border-color: rgba('.$new_custom_color['0'].','.$new_custom_color['1'].','.$new_custom_color['2'].', 0);
        border-top-color: '.$main_custom_color.';
    }
    .box{
        background-color:'.$main_custom_color.';
        border-color:'.$main_custom_color.';
    }

    .fixed:hover{
         background-color:'.$main_custom_color.' !important;
     }

    .service-box:hover {
      border-bottom-color:'.$main_custom_color.'!important;
    }

    .service-box:hover .icon-container {
      background-color: '.$main_custom_color.' !important;
    }

    ';

    wp_add_inline_style( 'custom', $color_variation );
    

}
add_action('wp_enqueue_scripts', 'lenard_load_theme_assets');

/*********************************************************************
 * RETINA SUPPORT
 */
add_filter('wp_generate_attachment_metadata', 'lenard_retina_support_attachment_meta', 10, 2);
function lenard_retina_support_attachment_meta($metadata, $attachment_id) {

    // Create first image @2
    lenard_retina_support_create_images(get_attached_file($attachment_id), 0, 0, false);

    foreach ($metadata as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $image => $attr) {
                if (is_array($attr))
                    lenard_retina_support_create_images(get_attached_file($attachment_id), $attr['width'], $attr['height'], true);
            }
        }
    }

    return $metadata;
}

function lenard_retina_support_create_images($file, $width, $height, $crop = false) {

    $resized_file = wp_get_image_editor($file);
    if (!is_wp_error($resized_file)) {

        if ($width || $height) {
            $filename = $resized_file->generate_filename($width . 'x' . $height . '@2x');
            $resized_file->resize($width * 2, $height * 2, $crop);
        } else {
            $filename = str_replace('-@2x','@2x',$resized_file->generate_filename('@2x'));
        }
        $resized_file->save($filename);

        $info = $resized_file->get_size();

        return array(
            'file' => wp_basename($filename),
            'width' => $info['width'],
            'height' => $info['height'],
        );
    }

    return false;
}

add_filter('delete_attachment', 'lenard_delete_retina_support_images');
function lenard_delete_retina_support_images($attachment_id) {
    $meta = wp_get_attachment_metadata($attachment_id);
    if(is_array($meta)){
        $upload_dir = wp_upload_dir();
        $path = pathinfo($meta['file']);

        // First image (without width-height specified
        $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . wp_basename($meta['file']);
        $retina_filename = substr_replace($original_filename, '@2x.', strrpos($original_filename, '.'), strlen('.'));
        if (file_exists($retina_filename)) unlink($retina_filename);

        foreach ($meta as $key => $value) {
            if ('sizes' === $key) {
                foreach ($value as $sizes => $size) {
                    $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
                    $retina_filename = substr_replace($original_filename, '@2x.', strrpos($original_filename, '.'), strlen('.'));
                    if (file_exists($retina_filename))
                        unlink($retina_filename);
                }
            }
        }
    }
}

// Enqueue comment-reply script if comments_open and singular
function lenard_enqueue_comment_reply() {
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
        }
}
add_action( 'wp_enqueue_scripts', 'lenard_enqueue_comment_reply' );


// Lenard Pagination
// Code taken from: http://wp-snippets.com/pagination-for-twitter-bootstrap/
function lenard_pagination ($before = '', $after = '') {

    global $lenard_options;

    echo $before;

    

        global $wpdb, $wp_query;

        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;

        if ($numposts <= $posts_per_page) return;
        if (empty($paged) || $paged == 0) $paged = 1;

        $pages_to_show = 7;
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1 / 2);
        $half_page_end = ceil($pages_to_show_minus_1 / 2);
        $start_page = $paged - $half_page_start;

        if ($start_page <= 0) $start_page = 1;
        $end_page = $paged + $half_page_end;
        if (($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if ($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if ($start_page <= 0) $start_page = 1;

        echo '<nav id="pagina">';
        echo ' <ul class="pagination">';
        $var=$paged;
        if($paged!=$start_page)
        echo ( '<li><a href="'.get_pagenum_link(--$var).'" aria-label="Previous"><span aria-hidden="true">PAGES</span></a></li>' );
        else
        echo ( '<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">PAGES</span></a></li></li>' );
        

        for ($i = $start_page; $i <= $end_page; $i++) {
            if ($i == $paged)
                echo ' <li><a href="#">' . $i . '</a></li>';
            else
                echo ' <li><a href="'.get_pagenum_link($i).'">' . $i . '</a></li>';
        }
        $var2=$paged;
        if($paged==$end_page)   
        echo ( '<li class="disabled"> <a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>' );
        else
        echo ( '<li><a href="'.get_pagenum_link(++$var2).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>' );
        echo '</ul>';
        echo '</nav>';

  

    echo $after;

    return;
}


/* Code for font-awesome support in Menu*/

add_action('wp_update_nav_menu_item', 'lenard_nav_update',10, 3);
function lenard_nav_update($menu_id, $menu_item_db_id, $args ) {
   if (isset($_REQUEST['menu-item-faicon']) ) {
     $custom_faicon= $_REQUEST['menu-item-faicon'][$menu_item_db_id];
     update_post_meta( $menu_item_db_id, '_menu_item_faicon', $custom_faicon);  
     }

}
add_filter( 'wp_setup_nav_menu_item','lenard_nav_item' );

function lenard_nav_item($menu_item) {
$menu_item->faicon = get_post_meta( $menu_item->ID, '_menu_item_faicon', true );  
return $menu_item;
}



Class Description_Walker extends Walker_Nav_Menu {


    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_lvl( &$output , $depth = 0 , $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-menu \">\n";
    }

   function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
          
           $class_names = ' '. esc_attr( $class_names ) . '';
           
           $output .= $indent . '<li >';
           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
          
           if($item->hasChildren):
           $attributes .= ' data-toggle="dropdown"';
           $class_names.= ' dropdown-toggle';
           endif;
           $prepend='';
          
           $append = '';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
          

            $item_output = $args->before;
            if($depth<1){
                if (strpos(esc_attr( $item->url), '#')>-1 && is_page_template('lenard-page-builder.php')) :
                $item_output .= '<a data-scroll class="'.esc_attr( $class_names ).'" '. $attributes .'>';
                else:
                $item_output .= '<a class="'.esc_attr( $class_names ).'" '. $attributes .'>';
                endif;
            } else {
                $item_output .= '<a class="'.esc_attr( $class_names ).'" '. $attributes .'>';
            }
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            
            $item_output .= $args->after;
       
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

            }

}



function lenard_body_classes( $classes ) {
    if (!is_page_template('lenard-page-builder.php') ) :
    $classes[] = 'multipage';
    endif;  
    return $classes;
}
add_filter( 'body_class', 'lenard_body_classes' );



add_action( 'tgmpa_register', 'lenard_register_required_plugins' );

function lenard_register_required_plugins() {
 

    $plugins = array(
 
        array(
            'name'               => 'Page Builder', // The plugin name.
            'slug'               => 'siteorigin-panels', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/inc/plugins/siteorigin-panels.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Page Builder Addons', // The plugin name.
            'slug'               => 'so-widgets-bundle', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/inc/plugins/so-widgets-bundle.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

       array(
            'name'               => 'Theme Addons', // The plugin name.
            'slug'               => 'lenard-addons', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/inc/plugins/lenard-addons.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),


        array(
            'name'               => 'Contact Form 7', // The plugin name.
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/inc/plugins/contact-form-7.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ), 

        array(
            'name'               => 'Simple Page Sidebars', // The plugin name.
            'slug'               => 'simple-page-sidebars', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/inc/plugins/simple-page-sidebars.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ), 
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false                   // Automatically activate plugins after installation or not.
        );
 
    tgmpa( $plugins, $config );
 
}

/**
 * Configure the SiteOrigin page builder settings.
 * 
 * @param $settings
 * @return mixed
 */


/**
 * Add row styles.
 *
 * @param $styles
 * @return mixed
 */


function lenard_comment($comment, $args, $depth) {
      $GLOBALS['comment'] = $comment; 
      
      extract($args, EXTR_SKIP); 
      if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
      } else {
      $tag = 'li';
      $add_below = 'div-comment';
      }?>       <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> class="media clearfix" id="comment-<?php comment_ID() ?>">       

     
         <?php if ( $args['avatar_size'] != 0 )?><a class="pull-left" href="#"><?php echo get_avatar( $comment, $args['avatar_size'] )?>
         </a>                               
        <div class="media-body"> 
            <h4 class="media-heading"> <?php printf( __( '%s' ), get_comment_author() ); ?></h4>
             <p class="comment-meta"> <?php printf( __('%1$s . %2$s . ','lenard'), get_comment_date(),  get_comment_time('g:i A') ); ?>
             <?php if($args['max_depth']!=$depth):  ?>
             <?php comment_reply_link(array ('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth'])) ;
             endif;?>
              </p>   
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
            <?php endif; ?>  
            <?php comment_text(); ?>
            
        </div>
   </li>
      <?php }
 function lenard_comment_end($comment, $args, $depth) {
            ?>
        <?php 
}


add_filter('loop_shop_columns', 'lenard_product_loop_columns');
function lenard_product_loop_columns() {
    return 3; // 3 products per row
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );

add_filter( 'cmb_meta_boxes', 'lenard_cmb_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function lenard_cmb_metaboxes( array $meta_boxes ) {

    $prefix = 'lenard_';

     $meta_boxes['page_metabox'] = array(
        'id'         => 'page_metabox',
        'title'      => __( 'Lenard Page Settings', 'lenard' ),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(

            array(
                'name' => 'Activate Page Title ',
                'desc' => 'Do you want to enable inner page settings.',
                'id' => $prefix . 'pagetitle_activate',
                'type' => 'checkbox'
            ),

          
             array(
                'name'    => __( 'Page Title', 'lenard' ),
                'id'      => $prefix . 'pagetitle_text',
                'type'    => 'text',
            ),
            

          

           array(
                'name' => __( 'Page title Background', 'lenard' ),
                'desc' => __( 'Upload an image or enter a URL.', 'lenard' ),
                'id'   => $prefix . 'pagetitle_image',
                'type' => 'file',
            ),

           

            

           
        )
    );

 
    $meta_boxes['menu_metabox'] = array(
        'id'         => 'menu_metabox',
        'title'      => __( 'Menu Option', 'lenard' ),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'side',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'     => __( 'Menus', 'lenard' ),
                'desc'     => __( 'Select menu for this page', 'lenard' ),
                'id'       => $prefix . 'menu_select',
                'type'     => 'taxonomy_select',
                'taxonomy' => 'nav_menu', // Taxonomy Slug
                'default' => 'lenard-main-menu',
            ),
        )
    );
    $meta_boxes['details_meox'] = array(
        'id'         => 'details_meox',
        'title'      => __( 'Porject Details', 'lenard' ),
        'pages'      => array( 'portfolio', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'     => __( 'Name', 'lenard' ),
                'desc'     => __( '', 'lenard' ),
                'id'       => $prefix . 'add_name',
                'type'     => 'text',
                 ),
            
             array(
                'name'     => __( 'Release Date', 'lenard' ),
                'desc'     => __( 'Add release date of project', 'lenard' ),
                'id'       => $prefix . 'add_releasedate',
                'type' => 'text_date',
                
                
            ),
            array(
                'name'     => __( 'Website URL', 'lenard' ),
                'desc'     => __( 'Add url of a website', 'lenard' ),
                'id'       => $prefix . 'add_url',
                'type' => 'text',               
            ),
            array(
                'name'     => __( 'Facebook URL', 'lenard' ),
                'desc'     => __( 'Add personal url of a facebook', 'lenard' ),
                'id'       => $prefix . 'add_facebook_url',
                'type' => 'text',               
            ),
            array(
                'name'     => __( 'Twitter URL', 'lenard' ),
                'desc'     => __( 'Add personal url of a twitter', 'lenard' ),
                'id'       => $prefix . 'add_twitter_url',
                'type' => 'text',               
            ),
            array(
                'name'     => __( 'Behance URL', 'lenard' ),
                'desc'     => __( 'Add personal url of a behance', 'lenard' ),
                'id'       => $prefix . 'add_behance_url',
                'type' => 'text',               
            ),
            array(
                'name'     => __( 'Linkedin URL', 'lenard' ),
                'desc'     => __( 'Add personal url of a linkedin', 'lenard' ),
                'id'       => $prefix . 'add_linkedin_url',
                'type' => 'text',               
            ),
            array(
                'name'     => __( 'Dribble URL', 'lenard' ),
                'desc'     => __( 'Add personal url of a dribble', 'lenard' ),
                'id'       => $prefix . 'add_dribble_url',
                'type' => 'text',               
            ),array(
                'name'     => __( 'Google URL', 'lenard' ),
                'desc'     => __( 'Add personal url of a google', 'lenard' ),
                'id'       => $prefix . 'add_google_url',
                'type' => 'text',               
            ),
            )
    );

    return $meta_boxes;
}


function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <div class="lenard_dynamic_shopping_bag">
        <div class="lenard_little_shopping_bag_wrapper">
            <div class="lenard_little_shopping_bag" style="background: transparent !important;">
                <div class="title">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="overview"><?php echo $woocommerce->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'lenard'), $woocommerce->cart->cart_contents_count); ?></span></div>
            </div>
            <div class="lenard_minicart_wrapper">
                <div class="lenard_minicart">
                <?php
                echo '<ul class="cart_list">';
                    if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                        $_product = $cart_item['data'];
                        if ($_product->exists() && $cart_item['quantity']>0) :                                            
                            echo '<li class="cart_list_product">';
                                echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';
                                echo '<div class="cart_list_product_title">';
                                    $lenard_product_title = $_product->get_title();
                                    $lenard_short_product_title = (strlen($lenard_product_title) > 28) ? substr($lenard_product_title, 0, 25) . '...' : $lenard_product_title;
                                    echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $lenard_short_product_title, $_product) . '</a>';
                                    echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'lenard').' '.$cart_item['quantity'].'</div>';
                                echo '</div>';
                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'lenard') ), $cart_item_key );
                                echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                                echo '<div class="clr"></div>';
                            echo '</li>';
                        endif;
                    endforeach;
                    ?>
                    <div class="minicart_total_checkout">
                        <?php _e('Cart subtotal', 'lenard'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                    </div>
                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button lenard_minicart_cart_but"><?php _e('View Shopping Bag', 'lenard'); ?></a>
                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button lenard_minicart_checkout_but"><?php _e('Proceed to Checkout', 'lenard'); ?></a>
                    <?php                                    
                    else: echo '<li class="empty">'.__('No products in the cart.','woothemes').'</li>'; endif;
                echo '</ul>';
                ?>
                </div>
            </div>
        </div>
        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="lenard_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
        
    </div>
    <?php
    $fragments['div.lenard_dynamic_shopping_bag' ] = ob_get_clean();
    return $fragments;

}

function removeDemoModeLink() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}

add_action( 'init', 'lenard_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function lenard_initialize_cmb_meta_boxes() {

    if ( ! class_exists( 'cmb_Meta_Box' ) )
        require_once 'inc/cmb/init.php';

}

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function lenard_detect_woocommerce()
{
    global $post;
    if ( has_shortcode( $post->post_content, 'woocommerce_cart' ) || has_shortcode( $post->post_content, 'woocommerce_my_account' ) || has_shortcode( $post->post_content, 'woocommerce_checkout' ))
    {
        return true;
    } 
    return false;
}
//Excerpt

function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//thumbnails
if ( function_exists( 'add_theme_support' ) ) { 
        add_theme_support( 'post-thumbnails' );
         } //Adds thumbnails compatibility to the theme
    set_post_thumbnail_size( 200, 170, true ); // Sets the Post Main Thumbnails
    add_image_size( 'Popular-thumbnails', 80, 80, true ); // Sets Recent Posts Thumbnails
    

//Displaying Breadcrumbs navigation
function lenard_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = ' / '; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = home_url();
 ?>
  
 <?php 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>';
 
  } else {
 
    echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</li>';?>
   
    <?php
 
  }
} // end lenard_breadcrumbs()
class WP_Widget_Popular_Post_Lenard extends WP_Widget {
    /**
     * Sets up the widgets name etc
     */
    function __construct() {
         $widget_ops = array('classname' => 'Popular Post', 'description' => __( "Gives list of top rated products.","flatty") );
        parent::__construct('popular_post_widget', __('Popular Post(Lenard)','lenard'), $widget_ops);
        $this->alt_option_name = 'popular_post';

    }

    
    public function widget( $args, $instance ) {
         $cache = wp_cache_get('popular_post', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);
        $title='';
       // echo $before_widget; 
        //$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
       
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        
        $number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
         echo $args['before_widget'];?>
         
         <?php if($number!=0):?>
         
        <?php if ( ! empty( $title )) {

            echo $args['before_title'] ?><?php echo $instance['title']?> <?php echo $args['after_title'];
         } 
       ?>
        
         
        <div class="sidebar-popular">
         
          <?php
          $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number,'orderby' => 'comment_count', 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
          if ($r->have_posts()) :
          ?>
            <?php while ( $r->have_posts() ) : $r->the_post(); ?>
             <div class="media">
              <div class="media-left">
                  <a href="<?php echo the_permalink(); ?>">
                   <?php the_post_thumbnail('Popular-thumbnails',array('class'=>'media-object','alt'=>'Generic placeholder image')); ?></a>
              </div>
               
              <div class="media-body">
                  <h4 class="media-heading"><?php get_the_title() ? the_title() : the_ID(); ?></h4>
                  <a href="<?php echo the_permalink(); ?>"><strong><?php _e('Posted ','lenard')?></strong> <?php the_time('F j, Y') ?></a>
              </div>
              </div>
              <?php endwhile; ?>
          <?php endif;?>
             
          </div>
        
        
         <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();    
        ?>           
        <?php echo $after_widget;  

        $content = ob_get_clean();
 
        wp_cache_set('popular_post', $cache, 'widget');
        echo $content;?>
       
        
    
    <?php endif;}

    
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
        $title = strip_tags($instance['title']);
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
        
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of products to show:','flatty' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
   
    <?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');
            return $instance;
        
    }
 function flush_widget_cache() {

        wp_cache_delete('popular_post', 'widget');
    }


      
}
register_widget('WP_Widget_Popular_Post_Lenard');


//Builder functions

function lenard_row_style_fields($fields) {

    
  $fields['row_id'] = array(
      'name'        => __('Row ID', 'siteorigin-panels'),
      'type'        => 'text',
      'group'       => 'attributes',
      'description' => __('Please give an id(without #)', 'siteorigin-panels'),
      'priority'    => 10,
  );

  return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'lenard_row_style_fields');


function lenard_panels_row_container_start( $grid, $attributes ) {
    if(isset($grid['style']['row_id']) )
    echo '<div id="'.$grid['style']['row_id'].'">';
    if(!isset($grid['style']['row_stretch']))
    echo '<div class="container">';

}

add_filter('siteorigin_panels_row_container_start', 'lenard_panels_row_container_start', 10, 2);

function lenard_panels_row_container_end( $grid, $attributes ) { 
    if(isset($grid['style']['row_id']))
    echo '</div>'; 
    if(!isset($grid['style']['row_stretch']))
    echo '</div>';

}

add_filter('siteorigin_panels_row_container_end', 'lenard_panels_row_container_end', 10, 2);



function lenard_custom_menu(){

?>
<div id="navbar" class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-right">
<?php

    $args = array(
                        'authors'      => '',
                        'child_of'     => 0,
                        'date_format'  => get_option('date_format'),
                        'depth'        => 0,
                        'echo'         => 1,
                        'exclude'      => '',
                        'include'      => '',
                        'link_after'   => '',
                        'link_before'  => '',
                        'post_type'    => 'page',
                        'post_status'  => 'publish',
                        'show_date'    => '',
                        'sort_column'  => 'menu_order, post_title',
                        'sort_order'   => '',
                        'title_li'     => '', 
                        'walker'       => new lenard_page_walker
                    ); 
                     wp_list_pages($args); ?>
                     </ul></div>
                     <?php
}

class Lenard_Page_Walker extends Walker_Page {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if ($depth == 0) {
            $output .= "\n$indent<ul>\n";
        } else {
            $output .= "\n$indent<ul class='dropdown-menu'>\n";
        }
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if ($depth == 0) {
            $output .= "$indent</ul>\n";
        } else {
            $output .= "$indent</ul>\n";
        }
    }
}