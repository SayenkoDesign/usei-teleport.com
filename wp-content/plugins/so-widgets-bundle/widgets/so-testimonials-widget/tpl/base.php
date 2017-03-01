<section  class="section-parallax" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
    	<div class="white-shape rightbottomalign"></div>
    	<div class="parallax-wrapper" style="color: <?php echo $instance['color']; ?>">
        	<div class="container">
            	<div class="center-title text-<?php echo $instance['align'];?>" >
                	<h3><i class="fa fa-quote-right" style="color: <?php echo $instance['color']; ?>"></i>
					<span class="wow fadeIn" style="color: <?php echo $instance['color']; ?>"><?php echo $instance['heading'];?></span></h3>
                    <div class="border-title"></div>
                </div><!-- end title -->
                <div id="testimonials">
                <?php foreach( $instance['testimonials'] as $i => $testimonial ) : ?>
                     <div id="testimonial<?php echo $i;?>" class="testimonial <?php if($testimonial['active']) echo 'active'; ?>">
                            <p class="lead"><?php echo $testimonial['body'];?></p>
                            <h3 style="color: <?php echo $instance['color']; ?>"><?php echo $testimonial['name'];?></h3>
                            <p><?php echo $testimonial['post'];?></p>
                        </div>
                
                <?php endforeach;?>
                    
                                    
                    <div class="clearfix"></div>
                                    
                    <div class="clearfix">
                        <ul class="testimonial-nav">
                         <?php foreach( $instance['testimonials'] as $i => $testimonial ) : 
                         	$src = wp_get_attachment_image_src($testimonial['client_image'], 'full');?>
                            <li><a href="#testimonial<?php echo $i;?>"><img src="<?php echo $src[0];?>"  alt=""></a></li>
                           
                          <?php endforeach;?>
                        </ul>
                    </div><!-- end testimonials nav wrapper -->
                </div><!-- end testimonials -->
        	</div><!-- end container -->
		</div><!-- end section-container -->
    </section><!-- end section -->


