<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>


   
                <div id="post-wrapper" class="row">
                    <div id="content" class="col-md-9 col-sm-9 col-xs-12">
                     <?php if (have_posts()) : ?>

                        <?php while (have_posts()) : the_post(); global $flagfooter; $flagfooter=1;  ?>
							<div class="blog-container wow fadeIn clearfix">
								<?php get_template_part('partials/article'); ?>
                                <?php //if ($lenard_options['article_related'] == 1) get_template_part('partials/article-related'); ?>
                                <?php //if ($lenard_options['article_author'] == 1) get_template_part('partials/article-author'); ?>
                             </div>
                            <?php comments_template( '', true ); ?>

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
                <div class="col-xs-12 col-sm-12 col-md-3 blog-sidebar">
                    
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