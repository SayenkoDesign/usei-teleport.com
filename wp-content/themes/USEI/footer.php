<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
       
<?php  global $lenard_options; 
        $total=12;
        $span1=3;
        $span2=2;
if (!is_page_template('lenard-page-builder.php') ) :
    if(isset($lenard_options['footer-map']) && $lenard_options['footer-map']!=0):?>
            <article id="contact" class="map-section">
                <div id="map" class="wow slideInUp"></div>
            </article><!-- end section -->
            <?php
    $logo=get_template_directory_uri().'/assets/images/marker.png';
endif;
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
   <script type="text/javascript">
      var geocoder;
      var map;
      var address ="<?php echo esc_attr($lenard_options['footer-map-location']); ?>";

        function mapinitialize() {

            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var myOptions = {
                zoom: 14,
                center: latlng,
                scrollwheel: false,
                scaleControl: false,
                disableDefaultUI: false,
                panControl:true,
                zoomControl:true,
                mapTypeControl:true,
                scaleControl:true,
                streetViewControl:true,
                overviewMapControl:true,
                rotateControl:true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map"), myOptions);

            if (geocoder) {
              geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                  map.setCenter(results[0].geometry.location);

                   
                    var image = "<?php echo $logo;?>";
                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map, 
                        title:address,
                        icon: image,
                    }); 
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map,marker);
                    });

                  } else {
                    alert("No results found");
                  }
                } else {
                  alert("Geocode was not successful for the following reason: " + status);
                }
              });
            }
        }
        mapinitialize();
    </script> 
        
<?php endif;
if (isset($lenard_options['background-image-footer']) && $lenard_options['background-image-footer']['url']!='' ): ?>
    <section id="parallax4" class="section-parallax" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="1" style="background:url('<?php echo esc_url($lenard_options['background-image-footer']['url']); ?>');">
   <?php else :?>
<section id="parallax4" class="section-parallax" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="1">
<?php endif;?>
        <div class="parallax-wrapper">
            <div class="container">
            
       <?php if(isset($lenard_options['footer-on']) && $lenard_options['footer-on']==1){?>
           
           
             <!-- BEGIN NO WIDGET FOOTER -->
           <div class="center-title text-center">
                <?php if(isset($lenard_options['footer-title']) && $lenard_options['footer-title']!='') :  ?> 
                <h3><span><?php echo esc_attr($lenard_options['footer-title']); ?></span></h3> 
                <?php endif; ?>
                <?php if(isset($lenard_options['footer-subtitle']) && $lenard_options['footer-subtitle']!='') :  ?> 
                <p class="lead"><?php echo esc_attr($lenard_options['footer-subtitle']); ?></p>
                <?php endif; ?>
            </div><!-- end title -->
             <!-- BEGIN Icon FOOTER -->
           <?php if (isset($lenard_options['footer-social'])&& $lenard_options['footer-social']==1) { 
                if(isset($lenard_options['footer-social-number']) && $lenard_options['footer-social-number']!='' && $lenard_options['footer-social-number']<=6) {
                
                $number=  esc_attr($lenard_options['footer-social-number']); 
                $number=$total/$number;?>
           <div class="row footer-social-icons">
                    
                        <?php if (!empty($lenard_options['social_facebook'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']==5): echo $span1; else: echo $number; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_facebook']); ?>"><div class="icon-container border-radius"><i class="fa fa-facebook"></i></div><div class="border-hover"></div> <h3><?php _e('Facebook','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_twitter'])) : ?>

<div class="col-md-2 col-sm-4 col-xs-6"></div>
<div class="col-md-2 col-sm-4 col-xs-6"></div>

                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span1; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_twitter']); ?>"><div class="icon-container border-radius"><i class="fa fa-twitter"></i></div> <h3><?php _e('Twitter','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_googlep'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_googlep']); ?>"><div class="icon-container border-radius"><i class="fa fa-google-plus"></i></div><div class="border-hover"></div> <h3><?php _e('Google+','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_youtube'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_youtube']); ?>"><div class="icon-container border-radius"><i class="fa fa-youtube"></i></div><div class="border-hover"></div> <h3><?php _e('Youtube','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_linkedin'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_linkedin']); ?>"><div class="icon-container border-radius"><i class="fa fa-linkedin"></i></div> <h3><?php _e('Linkedin','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_pinterest'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a href="<?php  echo esc_url($lenard_options['social_pinterest']); ?>"><div class="icon-container border-radius"><i class="fa fa-pinterest"></i></div><div class="border-hover"></div> <h3><?php _e('Pinterest','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_dribbble'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a href="<?php  echo esc_url($lenard_options['social_dribbble']); ?>"><div class="icon-container border-radius"><i class="fa fa-dribbble"></i></div><div class="border-hover"></div> <h3><?php _e('Dribbble','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_skype'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_skype']); ?>"><div class="icon-container border-radius"><i class="fa fa-skype"></i></div><div class="border-hover"></div> <h3><?php _e('Skype','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_vimeo'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a href="<?php  echo esc_url($lenard_options['social_vimeo']); ?>"><div class="icon-container border-radius"><i class="fa fa-vimeo-square"></i></div><div class="border-hover"></div> <h3><?php _e('Vimeo','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_tumblr'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_tumblr']); ?>"><div class="icon-container border-radius"><i class="fa fa-tumblr"></i></div><div class="border-hover"></div> <h3><?php _e('Tumblr','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?> <?php if (!empty($lenard_options['social_instagram'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_instagram']); ?>"><div class="icon-container border-radius"><i class="fa fa-instagram"></i></div><div class="border-hover"></div> <h3><?php _e('Instagram','lenard')?></h3></a>
                        </div>
                        </div>
                        <?php endif; ?><?php if (!empty($lenard_options['social_behance'])) : ?>
                        <div class="col-md-<?php if($lenard_options['footer-social-number']!=5): echo $number; else: echo $span2; endif;?> col-sm-4 col-xs-6">
                        <div class="footer-social wow wobble">
                        <a  href="<?php  echo esc_url($lenard_options['social_behance']); ?>"><div class="icon-container border-radius"><i class="fa fa-behance"></i></div><div class="border-hover"></div> <h3><?php _e('Behance','lenard')?></h3></a>
                        
                        </div>
                        </div><?php endif; ?>
                
                    
              </div>    
           
           <?php }}?>  <!-- end Icon FOOTER -->
                  
       <?php  }?>
       
       <?php if(isset($lenard_options['secondfooter-on']) && $lenard_options['secondfooter-on']==1){?>  
                
                 
                <?php if(isset($lenard_options['footer_text'])) :  ?> 
                    <!-- BEGIN: COPYRIGHTS -->
                     
                   <div class="row copyrights">
                        <h3><?php  echo wp_kses_post($lenard_options['footer_text']); ?></h3>
                    </div>
                <?php endif; ?>
            
           
        <?php }?>
        
        
    </div><!--container end-->
  </div><!--parallax wrapper-->
 </section>    
</div>
<!--wrapper end-->
   
    <?php wp_footer(); ?>
    </body>
</html>