<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
<?php  
    global $lenard_options;
    global $post;
    if(is_home()){
        $pageid=get_option('page_for_posts');
    } else {
        $pageid=get_the_ID();
    }
    
    if($menu=get_post_meta( $pageid, 'lenard_menu_select',true)){
    $menu_object = get_term_by('term_taxonomy_id',$menu[0] , 'nav_menu');
    }
    

?>

<div id="opensearch" class="collapse myform">
    <div class="container">
        <form role="search" action="<?php echo home_url( '/' ); ?>" class="search_form_top" method="get">
            <input type="text" placeholder="What are you looking for?" name="s" class="form-control" autocomplete="off">
        </form>
    </div>
</div>

<header class="header">
<!--main div-->

             <?php if (!empty($lenard_options['topbar']) && $lenard_options['topbar']==1) : ?>
        
              <div class="topbar">
                <div class="container">
                    
                        <?php if (!empty($lenard_options['topbar-socialicons']) && $lenard_options['topbar-socialicons']==1) : ?>
                              
                               <ul class="social text-right">
                                 <?php if (!empty($lenard_options['social_facebook'])) : ?>
                                <li><a  href="<?php  echo esc_url($lenard_options['social_facebook']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-facebook"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_twitter'])) : ?>
                                <li><a class="twitter" href="<?php  echo esc_url($lenard_options['social_twitter']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-twitter"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_googlep'])) : ?>
                                <li><a class="google" href="<?php  echo esc_url($lenard_options['social_googlep']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-google"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_youtube'])) : ?>
                                <li><a class="youtube" href="<?php  echo esc_url($lenard_options['social_youtube']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-youtube"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_linkedin'])) : ?>
                                <li><a class="linkedin" href="<?php  echo esc_url($lenard_options['social_linkedin']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-linkedin"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_pinterest'])) : ?>
                                <li><a class="pinterest" href="<?php  echo esc_url($lenard_options['social_pinterest']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-pinterest"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_dribbble'])) : ?>
                                <li><a class="dribbble" href="<?php  echo esc_url($lenard_options['social_dribbble']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-dribbble"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_skype'])) : ?>
                                <li><a class="skype" href="<?php  echo esc_url($lenard_options['social_skype']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-skype"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_vimeo'])) : ?>
                                <li><a class="vimeo" href="<?php  echo esc_url($lenard_options['social_vimeo']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-vimeo-square"></i></a></li>
                                <?php endif; ?>
                                <?php if (!empty($lenard_options['social_tumblr'])) : ?>
                                <li><a class="tumblr" href="<?php  echo esc_url($lenard_options['social_tumblr']); ?>" target="_blank" data-original-title="" title=""><i class="fa fa-tumblr"></i></a></li>
                                <?php endif; ?>
                                 <?php if (!empty($lenard_options['social_behance'])) : ?>
                                <li><a  href="<?php  echo esc_url($lenard_options['social_behance']); ?>"target="_blank" data-original-title="" title=""><i class="fa fa-behance"></i></a></li>
                                <?php endif; ?> 
                                </ul>   
                          
                <?php endif; ?>
                        
                </div>
                
               <!-- <a href="#" class="down-button"><i class="fa fa-angle-down"></i></a> this appear on small devices -->
                
            </div>
        
            <?php endif; ?>

            <!-- BEGIN: NAV-CONTAINER -->
          <nav class="navbar navbar-default">
          <!--container-->
            <div class="container">
            <!--nav header start-->
                <div class="navbar-header">                        
                    
                    <!-- BEGIN: TOGGLE BUTTON (RESPONSIVE)-->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php __( 'Toggle navigation', 'lenard' ); ?></span>
                    <i class="fa fa-bars"></i>
                    </button>
                    
                    <!-- BEGIN: LOGO -->
                    
                    
                    <?php 
                    if (isset($lenard_options['logo']) && $lenard_options['logo']['url']!='') {
                    ?>
                    <a class="navbar-brand" href="<?php echo esc_url(site_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <img src="<?php echo esc_url($lenard_options['logo']['url']); ?>"  alt="" />
                    </a>
                    
                    <?php } else { ?>
                    <a class="navbar-brand" href="<?php echo esc_url(site_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <?php echo esc_attr(get_bloginfo('name')); ?><br>     
                    </a>         
                    <?php } ?>
                    
                    
                    <!-- BEGIN: WPML MENU -->     
                    <?php do_action('icl_language_selector'); ?> 
                    
                  
                </div><!--nav header-->
       

               
                <?php if (isset($lenard_options['search']) && $lenard_options['search'] == 1){

                    
                    if(isset($menu_object) && is_object($menu_object))
                     {
                        $args = array(
                        'menu'            => $menu_object->slug,
                        'items_wrap' => '<div id="navbar" class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-right">%3$s<li><a title="Search" href="#" data-toggle="collapse" data-target="#opensearch"><i class="fa fa-search"></i></a></li>  </ul></div>',
                        'echo'            => true,
                        'fallback_cb'     => 'lenard_custom_menu',
                        'walker'  => new description_walker()
                    );
                    } else {

                        $args = array(
                        'theme_location' => 'primary',
                        'items_wrap' => '<div id="navbar" class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-right">%3$s<li><a title="Search" href="#" data-toggle="collapse" data-target="#opensearch"><i class="fa fa-search"></i></a></li>  </ul></div>',
                        'echo'            => true,
                        'fallback_cb'     => 'lenard_custom_menu',                        
                        'walker'  => new description_walker()
                    );

                    }
                }
                    else{
                     if(isset($menu_object) && is_object($menu_object))
                     {
                        $args = array(
                        'menu'            => $menu_object->slug,
                        'items_wrap' => '<div id="navbar" class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-right">%3$s  </ul></div>',
                        'echo'            => true,
                        'fallback_cb'     => 'lenard_custom_menu',
                        'walker'  => new description_walker()
                    );
                    } else {

                        $args = array(
                        'theme_location' => 'primary',
                        'items_wrap' => '<div id="navbar" class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-right">%3$s</ul></div>',
                        'echo'            => true,
                        'fallback_cb'     => 'lenard_custom_menu',                      
                        'walker'  => new description_walker()
                    );

                    }
                    }
                    wp_nav_menu($args);
                   ?>
                         
               </div>
                <!-- END: MENU container -->
            </nav>
            
          
        
<!--main div end-->
</header>
<?php
$pageid=get_the_ID();
$page_setting_activate=get_post_meta( $pageid, 'lenard_pagetitle_activate',true);
if(isset($page_setting_activate) && $page_setting_activate=='on' ) :
  $page_setting_image=get_post_meta( $pageid, 'lenard_pagetitle_image',true);
    if(!empty($page_setting_image)): ?>

    <section id="parallax5" class="page-header-section" style="background:url('<?php echo esc_url($page_setting_image); ?>');">
    </section>

  <?php  endif; 

elseif (isset($lenard_options['background-image']) && $lenard_options['background-image']['url']!='' ): ?>
    <section id="parallax5" class="page-header-section" style="background:url('<?php echo esc_url($lenard_options['background-image']['url']); ?>');">
    </section>
    
<?php else :?>

     <section id="parallax5" class="page-header-section" >
    </section>

<?php endif; ?>

