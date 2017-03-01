<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h3>'; exit();} 
global $lenard_options;

$pageid=get_the_ID();

$page_setting_activate=get_post_meta( $pageid, 'lenard_pagetitle_activate',true);?>
<section class="section white-section">
    <div class="grey-shape"><div class="icon-container fixed border-radius"><?php if(get_post_type()=='portfolio') echo '<i class="icon icon-DSLRCamera"></i>'; else echo'<i class="icon icon-Blog"></i>';?> </div></div>
        <!--section-container start-->
        <div class="section-container"> 
        <div class="container">  <?php
            if(isset($page_setting_activate) && $page_setting_activate=='on') :      
                
                $page_title_text=get_post_meta($pageid,'lenard_pagetitle_text',true);
            ?>
 
          
            <div class="big-title">
                        
                    <?php if (is_home()) :?>
                    <h3><span><?php _e('BLOG', 'lenard'); ?></span></h3>
                    <?php elseif (is_single()) :?>
                    <h3><span><?php echo get_the_title(); ?></span></h3>
                    <?php elseif (is_page()) : ?>
                    <h3><span><?php echo $page_title_text; ?></span></h3>
                    <?php elseif (is_author()) : ?>
                   <h3><span><?php _e('AUTHOR', 'lenard'); ?></span></h3>
                    <?php elseif (is_search()) : ?>
                    <h3><span><?php _e('SEARCH', 'lenard'); ?></span></h3>
                    <?php elseif (is_category()) : ?>
                    <h3><span><?php _e('CATEGORY', 'lenard'); ?></span></h3>
                    <?php elseif (is_tag()) : ?>
                    <h3><span><?php _e('TAG', 'lenard'); ?></span></h3>
                    <?php elseif (is_archive()) : ?>
                    <?php if (get_post_type() == 'portfolio') : ?>
                    <h3><span><?php _e('SINGLE PORTFOLIO', 'lenard'); ?></span></h3>
                    <?php else: ?>
                    <h3><span><?php _e('ARCHIVE', 'lenard'); ?></span></h3>
                    <?php endif; ?>
                   
                    <?php else : ?>
                    <h3><span><?php _e('PAGE NOT FOUND', 'lenard'); ?></span></h3>
                    <?php endif; ?>
                    <ol class="breadcrumb pull-right">
                   <?php if (function_exists('lenard_breadcrumbs')) lenard_breadcrumbs();  ?>
                    </ol>                   
                      <div class="singlepage"></div> 
                </div>
               
                  
            
<?php
else :
?>
         
        <div class="big-title">
               <?php if (is_home()) :?>
                   <h3><span><?php _e('BLOG', 'lenard'); ?></span></h3>
                    <?php elseif (is_single() && get_post_type() != 'portfolio' ) :?>
                   <h3><span><?php _e('SINGLE POST', 'lenard'); ?></span></h3>
                    <?php elseif ( get_post_type() == 'portfolio' ) :?>
                    <h3><span><?php _e('SINGLE PORTFOLIO', 'lenard'); ?></span></h3>                  
                    <?php elseif (is_page()) : ?>
                   <h3><span><?php echo get_the_title(); ?></span></h3>
                    <?php elseif (is_author()) : ?>
                   <h3><span><?php _e('AUTHOR', 'lenard'); ?></span></h3>
                    <?php elseif (is_search()) : ?>
                   <h3><span><?php _e('SEARCH', 'lenard'); ?></span></h3>
                    <?php elseif (is_category()) : ?>
                   <h3><span><?php _e('CATEGORY', 'lenard'); ?></span></h3>
                    <?php elseif (is_tag()) : ?>
                    <h3><span><?php _e('TAG', 'lenard'); ?></span></h3>
                    <?php elseif (is_date()) : ?>
                    <h3><span><?php _e('DATE', 'lenard'); ?></span></h3>
                    <?php elseif (is_archive()) : ?>
                    <?php if (get_post_type() == 'product') : ?>
                   <h3><span><?php _e('PRODUCT', 'lenard'); ?></span></h3>
                    <?php else: ?>
                    <h3><span><?php //_e('ARCHIVE', 'lenard'); ?></span></h3>
                    <?php endif; ?>                    
                    <?php else : ?>
                    <h3><span><?php _e('PAGE NOT FOUND', 'lenard'); ?></span></h3>
                    <?php endif; ?>                  
                    <ol class="breadcrumb pull-right">
                   <?php if (function_exists('lenard_breadcrumbs')) lenard_breadcrumbs();  ?>
                    </ol>
                   
                    <div class="singlepage"></div>               
                    
            </div>
       
<?php endif; ?> 
