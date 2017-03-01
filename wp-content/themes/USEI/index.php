<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>


 
            <div id="post-wrapper" class="row">
                <div id="content" class="col-md-9 col-sm-9 col-xs-12">    
                
                <?php if (have_posts()) : ?>
                
                <?php while (have_posts()) : the_post(); ?>
                <div class="blog-container wow fadeIn clearfix">
                
                	<?php get_template_part('partials/article'); ?>
                </div>
                
                <?php endwhile; ?>
                
                <?php if ($wp_query->max_num_pages>1) : ?>
                
                <?php lenard_pagination(); ?>
                
                <?php endif; ?>
                
                <?php else : ?>
                
                <?php get_template_part('partials/nothing-found'); ?>
                
                <?php endif; ?>
                
                </div>
                <!-- END journal -->
            
            	<!-- START SIDEBAR -->
                 <div id="sidebar" class="col-md-3 col-sm-3 col-xs-12">
                
                <?php get_sidebar(); ?>
                
                </div>
            </div>
            <!--post wrap end-->
        
        </div>  
        <!-- END: BLOG CONTAINER -->
    </div>
    <!--section-container end-->
</section>



<?php get_footer(); ?>