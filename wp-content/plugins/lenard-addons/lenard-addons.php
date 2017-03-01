<?php
/*
Plugin Name: Lenard Addons
Plugin URI: http://tuchuk.com/wordpress-free-plugins/lenard-addons
Description: This is addon for lenard theme to generate custom post types and widgets
Version: 1.0
Author: Sunil Chaulgain
Author URI: http://tuchuk.com
Text Domain: usei-addons
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class LenardAddons{
 
    public function __construct() {
 
        load_plugin_textdomain( 'lenard-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
        add_filter( 'init', array( $this, 'learn_addons_posttypes' ) );
        add_action( 'init', array( $this, 'custom_post_type' ) );
        add_action( 'init', array( $this, 'create_portfolio_taxonomies' ));
        add_filter( 'init', array( $this, 'learn_addons_shortcode' ) );
 
    }

    public function learn_addons_posttypes() {

    }

    public function learn_addons_shortcode() {
      add_shortcode( 'portfolio', array($this, 'portfolio_shortcode') );
    }

    public function portfolio_shortcode( $atts ) {

        $test=extract( shortcode_atts(
          array(
            'category' => '',
            'excerpt' => 'false',
          ), $atts )
        );

        $output = '';

        $query_args = array(
          'posts_per_page'    =>   15,
          'post_type'         =>   'portfolio',
          'no_found_rows'     =>   true,
        );


        $portfolio_posts = get_posts( $query_args );

        $r = new WP_Query($query_args);

        $output .= '
            <div class="portfolio-wrapper">
                <div class="container">
                    <div class="portfolio-filtering">';
                    $args = array(
                    'taxonomy'     => 'portfolio_categories',
                    'orderby'      => 'name',
                    'type'     => 'portfolio'
                    );

                    $categories = get_categories($args);

                    if ($categories) :
                      $cat_slugs_arr = array();

                      $output.=' <a href="#" class="filter active" data-filter="*">All</a>';
                      foreach ($categories as $cat) { 
                        if($cat->slug!='uncategorized'):
                          $output.='<a href="#" class="filter" data-filter=".'.$cat->slug.'">'.$cat->name.'</a></li>';
                        endif;    
                      }
                    endif;
                    $output.='
                    </div>                    
                </div><!-- end container -->';

       

                $output.='
                <ul class="portfolio-container clearfix image-hover-red hover-titles-effect masonry" id="masonry_grid">';

                if ($r->have_posts()) : while ($r->have_posts()) : $r->the_post(); 
                  $terms = get_the_terms($post->ID, 'portfolio_categories' );
                    if ($terms && ! is_wp_error($terms)) :
                      $term_slugs_arr = array();
                      $num=count($terms);
                        foreach ($terms as $term) {
                          $term_slugs_arr[] = $term->slug;
                        }
                      $terms_slug_str = join( " ", $term_slugs_arr);
                    endif;
                    $output.='<li class="portfolio-item mix ';if($terms!='')$output.= $terms_slug_str;$output.='">';  
                      $output.='<div class="portfolio-image">';

                        if (has_post_thumbnail() ) :
                          $att = get_post_meta(get_the_ID(),'_thumbnail_id',true);
                          $thumb = get_post($att);
                            if (is_object($thumb)) { $att_ID = $thumb->ID; $att_url = $thumb->guid; }
                            else { $att_ID = $post->ID; $att_url = $post->guid; }
                          $att_title = (!empty(get_post($att_ID)->post_excerpt)) ? get_post($att_ID)->post_excerpt : get_the_title($att_ID);
                         $output.= get_the_post_thumbnail(get_the_ID(), 'full', array('alt'=>'','class'=>'','title'=> '')); 
                        endif;

                      $output.='</div><!-- end portfolio-image -->  

                            

                      <div class="portfolio-hover-desc">

                            <h3 class="portfolio-hover-title">';

                              if($terms!=null)

                                foreach ($terms as $term) {

                                        $num--;

                                      $output.=$term->slug;

                                      if($num!=0)

                                     $output.=', ';

                                }$output.='</h3>

                            <div class="portfolio-description">'.get_the_title($post->ID).'</div>

                                <div class="portfolio-buttons">

                                    <a data-gal="prettyPhoto[product-gallery]" rel="bookmark" href="'.wp_get_attachment_url( get_post_thumbnail_id($post_id) ).'" title=""><i class="fa fa-search"></i></a>

                                    <a href="'.get_the_permalink($post->ID).'" title=""><i class="fa fa-link"></i></a>

                                </div><!-- end portfolio-buttons -->

                    </div>  ';
                endwhile;
                endif;
               $output.='</ul><!-- end portfolio-container -->
           </div> <!-- end portfolio-wrapper -->    
        </div><!-- end section-container -->
    </section>'; 
    return $output;
    }

    
    public function custom_post_type() {

        $labels = array(
            'name'                => _x( 'Portfolio', 'Post Type General Name', 'lenard' ),
            'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'lenard' ),
            'menu_name'           => __( 'Portfolio', 'lenard' ),
            'parent_item_colon'   => __( 'Parent Portfolio', 'lenard' ),
            'all_items'           => __( 'All Portfolio', 'lenard' ),
            'view_item'           => __( 'View Portfolio', 'lenard' ),
            'add_new_item'        => __( 'Add New Portfolio', 'lenard' ),
            'add_new'             => __( 'Add New', 'lenard' ),
            'edit_item'           => __( 'Edit Portfolio', 'lenard' ),
            'update_item'         => __( 'Update Portfolio', 'lenard' ),
            'search_items'        => __( 'Search Portfolio', 'lenard' ),
            'not_found'           => __( 'Not Found', 'lenard' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'lenard' ),
        );
        
        $args = array(
            'label'               => __( 'portfolio', 'lenard' ),
            'description'         => __( 'Portfolio details and list', 'lenard' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor',  'thumbnail','tags', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies' => array('portfolio_category'),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */  
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'register_meta_box_cb' => '',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        
        register_post_type( 'portfolio', $args );

    }

    public function create_portfolio_taxonomies()
    {
       // Add new taxonomy, make it hierarchical (like categories)
      $labels = array(
        'name' => _x( 'portfolio_category', 'taxonomy general name' ),
        'singular_name' => _x( 'portfolio_category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search portfolio_categories' ),
        'popular_items' => __( 'Popular portfolio_categories' ),
        'all_items' => __( 'All portfolio_categories' ),
        'parent_item' => __( 'Parent portfolio_category' ),
        'parent_item_colon' => __( 'Parent portfolio_category:' ),
        'edit_item' => __( 'Edit portfolio_category' ),
        'update_item' => __( 'Update portfolio_category' ),
        'add_new_item' => __( 'Add New portfolio_category' ),
        'new_item_name' => __( 'New portfolio_category Name' ),
       );
      register_taxonomy('portfolio_categories',array('portfolio'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'portfolio_categories' ),
      ));
    }
 
}

$addons = new LenardAddons();