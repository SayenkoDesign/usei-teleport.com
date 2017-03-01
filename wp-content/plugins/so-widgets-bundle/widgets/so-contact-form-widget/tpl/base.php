 <section class="section white-section">
        <div class="grey-shape"><div class="icon-container fixed border-radius"><i class="fa fa-map-marker"></i></div></div>
        <div class="section-container">
            <div class="container">
                <div class="big-title">
                    <h3><span><?php echo $instance['maintitle'];?></h3>
                    <div class="border-title"></div>
                </div><!-- big-title -->
                <div class="row contact-wrapper">
                	<div class="col-md-9 col-sm-9 col-xs-12">
                        <div id="contact_form" class="contact_form row">
                            <div class="col-md-12">
                            <h3><?php echo $instance['formtitle'];?></h3>
                            </div>
                            <div id="message"></div>
                           <?php

								$shortcode_attr = array();
								foreach($instance as $k => $v){
									if(empty($v)) continue;
									$shortcode_attr[] = $k.'="'.esc_attr($v).'"';
								}
								echo do_shortcode('[contact-form-7 '.implode(' ', $shortcode_attr).']');
								?> 
                        </div><!-- end contact-form -->
                    </div><!-- end col -->
                
                	<div class="col-md-3 col-sm-3 col-xs-12">
                    	<div class="contact-list">
							<?php if(!empty($instance['address'])): ?>
						    <h3><?php _e('ADDRESS:','siteorigin-widgets')?></h3>
						    <p><?php echo esc_html($instance['address']);?> </p>
						    <?php endif; ?>
						    <div class="border-normal"></div>
						    <?php if(!empty($instance['phone'])): ?>
						    <h3><?php _e('Phone: ','siteorigin-widgets')?><span><?php echo esc_html($instance['phone']);?></span></h3>
						    <?php endif; ?>
						   	<?php if(!empty($instance['email'])): ?>
						    <h3><?php _e('Email: ','siteorigin-widgets')?><span><?php echo esc_html($instance['email']);?></span></h3>
						    <?php endif; ?>
						    <div class="border-normal"></div>
						    <?php if(!empty($instance['workinghours'])): ?>
						    <h3><?php _e('Working Hours','siteorigin-widgets')?></h3>
						    <p><?php echo esc_html($instance['workinghours']);?></p>
						    <?php endif; ?>
						</div><!-- end contact-list -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end section-container -->
    </section><!-- end section -->





