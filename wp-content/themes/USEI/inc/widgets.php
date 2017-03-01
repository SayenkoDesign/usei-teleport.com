<?php 

if ( ! function_exists( 'portfolio_shortcode' ) ) {

 

    function portfolio_shortcode( $atts ) {

        $test=extract( shortcode_atts(

                array(

                    // category slug attribute - defaults to blank

                    'category' => '',

                    // full content or excerpt attribute - defaults to full content

                    'excerpt' => 'false',

                ), $atts )

        );

         

        $output = '';

         

        // set the query arguments

        $query_args = array(

            // show all posts matching this query

            'posts_per_page'    =>   15,

            // show the 'portfolio' custom post type

            'post_type'         =>   'portfolio',

            // tell WordPress that it doesn't need to count total rows - this little trick reduces load on the database if you don't need pagination

            'no_found_rows'     =>   true,

        );

         

        // get the posts with our query arguments

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

            }endif;



                  $output.='

                    </div>                    

                </div><!-- end container -->';

       

        $output.='<ul class="portfolio-container clearfix image-hover-red hover-titles-effect masonry" id="masonry_grid">';

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

            else : //get_template_part('partials/nothing-found');

            endif;

            

               $output.='</ul><!-- end portfolio-container -->

           </div> <!-- end portfolio-wrapper -->    

        </div><!-- end section-container -->

    </section>';

         

         return $output;

    }

 

    add_shortcode( 'portfolio', 'portfolio_shortcode' );

}