<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>

<div id="post-wrapper">

    <div id="content">

     <?php if (have_posts()) : while (have_posts()) : the_post();

     $terms = get_the_terms($post->ID, 'category' );

	  if ($terms && ! is_wp_error($terms)) :

		  $term_slugs_arr = array();

		  $num=count($terms);

		  foreach ($terms as $term) {

			  $term_slugs_arr[] = $term->slug;

		  }

		  $terms_slug_str = join( " ", $term_slugs_arr);

	  endif;?>

     <div class="portfoliostyle">

            <div class="portfolio-wrapper">

                <ul class="portfolio-container clearfix image-hover-red hover-titles-effect masonry" id="masonry_grid">

				          <li class="portfolio-item mix <?php if($terms!='')echo $terms_slug_str; ?>">

                              <div class="portfolio-image">

                                  <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('alt'=>'','class'=>'','title'=> ''));?>

                              </div><!-- end portfolio-image -->

                              <div class="portfolio-hover-desc">

                                  <div class="portfolio-buttons">

                                      <a data-gal="prettyPhoto[product-gallery]" rel="bookmark" href="<?php  echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) )?>" title=""><i class="fa fa-search"></i></a>

                                  </div><!-- end portfolio-buttons -->

                              </div><!-- end portfolio-hover-desc -->

                          </li><!-- portfolio-item --> 

					  <?php if ( get_post_gallery() ) : 

                      $gallery = get_post_gallery( get_the_ID(), false );

					  foreach( $gallery['src'] AS $src ){?>

                       <li class="portfolio-item mix <?php if($terms!='')echo $terms_slug_str; ?>">

                              <div class="portfolio-image">

                                  <img  src="<?php echo $src; ?>" />

                              </div><!-- end portfolio-image -->

                              <div class="portfolio-hover-desc">

                                  <div class="portfolio-buttons">

                                      <a data-gal="prettyPhoto[product-gallery]" rel="bookmark" href="<?php echo $src; ?>" title=""><i class="fa fa-search"></i></a>

                                  </div><!-- end portfolio-buttons -->

                              </div><!-- end portfolio-hover-desc -->

                          </li><!-- portfolio-item --> 

                      <?php }endif;?>

                 </ul><!-- end portfolio-container -->

            </div> <!-- end portfolio-wrapper -->  

        </div>

	  

     		<?php $portfolio_title = get_the_title( $post->ID );

			$portfolio_name =esc_attr(get_post_meta( get_the_ID(), 'lenard_add_name', true ));

			$portfolio_releasedate =esc_attr(get_post_meta($post->ID, 'lenard_add_releasedate', true ));

			$portfolio_releasedate = strtotime( $portfolio_releasedate );

			$portfolio_url =esc_attr(get_post_meta($post->ID, 'lenard_add_url', true ));	

			$portfolio_twitter_url =esc_attr(get_post_meta($post->ID, 'lenard_add_twitter_url', true ));	

			$portfolio_dribble_url =esc_attr(get_post_meta($post->ID, 'lenard_add_dribble_url', true ));	

			$portfolio_google_url =esc_attr(get_post_meta($post->ID, 'lenard_add_google_url', true ));	

			$portfolio_behance_url =esc_attr(get_post_meta($post->ID, 'lenard_add_behance_url', true ));

			$portfolio_linkedin_url =esc_attr(get_post_meta($post->ID, 'lenard_add_linkedin_url', true ));		

			$portfolio_facebook_url =esc_attr(get_post_meta($post->ID, 'lenard_add_facebook_url', true ));			

			$postContentStr = apply_filters('the_content', strip_shortcodes($post->post_content));?>

            <div id="singleportfolio" class="row portfolio-wrapper text-center clearfix">

            <div class="col-md-8 col-md-offset-2">            

                <div class="center-title text-center">

                    <h3><span class="wow fadeIn"><?php echo $portfolio_name; ?></span></h3>

                    <div class="border-title"></div>

                </div><!-- end title -->    

                <p><?php echo $postContentStr; ?></p>               

                <div class="portfolio-meta">

                    <p><?php echo date( 'F j,Y', $portfolio_releasedate ); ?></p>

                </div>  

                <?php if (!empty($portfolio_twitter_url) || !empty($portfolio_google_url) || !empty($portfolio_behance_url) || !empty($portfolio_facebook_url) || !empty($portfolio_fribble_url)|| !empty($portfolio_linkedin_url) ) : ?>

	                <ul class="social text-center clearfix">

                        <?php if (!empty($portfolio_twitter_url) ): ?>

                        <li><a href="<?php echo $portfolio_twitter_url;?>"><i class="fa fa-twitter"></i></a></li>

                        <?php endif;?>

                        <?php if (!empty($portfolio_behance_url)) : ?>

                        <li><a href="<?php echo $portfolio_behance_url; ?>"><i class="fa fa-behance"></i></a></li>

                        <?php endif;?>

                        <?php if (!empty($portfolio_dribble_url)) : ?>

                        <li><a href="<?php echo $portfolio_dribble_url; ?>"><i class="fa fa-dribbble"></i></a></li>

                        <?php endif;?>

                        <?php if (!empty($portfolio_linkedin_url)) : ?>

                        <li><a href="<?php echo $portfolio_linkedin_url; ?>"><i class="fa fa-linkedin"></i></a></li>

                        <?php endif;?>

                        <?php if (!empty($portfolio_facebook_url)) : ?>

                        <li><a href="<?php echo $portfolio_facebook_url; ?>"><i class="fa fa-facebook"></i></a></li>

                        <?php endif;?>

                        <?php if (!empty($portfolio_google_url)) : ?>

                        <li><a href="<?php echo $portfolio_google_url; ?>"><i class="fa fa-google-plus"></i></a></li>

                        <?php endif;?>                       

                    </ul>

                <?php endif;?>

                <div class="clearfix"></div><br>

                

                <div class="button-wrapper margin-top clearfix text-center">

                    <a href="<?php echo $portfolio_url;?>" class="btn btn-primary btn-lg margin-top"><?php _e('VISIT WEBSITE','lenard')?></a>

                </div><!-- end button -->

            </div><!-- end col -->

        </div>     

     <?php endwhile; else :  get_template_part('partials/nothing-found'); 

	 		endif;?><!-- end portfolio-item -->

    </div><!-- end content -->

</div>

</div>  

        <!-- END: BLOG CONTAINER -->

</div>

    <!--section-container end-->

</section>



<?php get_footer(); ?>