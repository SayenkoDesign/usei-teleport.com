
 <section class=" section <?php if($instance['section']=='grey-section')echo 'grey-section'; else echo'white-section';?>">
            <div class="<?php if($instance['section']=='grey-section')echo 'white-shape'; else echo'grey-shape';?>">
        	 <?php if(!empty($instance['icon'])){
			  $icon_styles = array();	
			  echo '<div class="icon-container fixed border-radius">';			
			  echo siteorigin_widget_get_icon($instance['icon'], $icon_styles);
			  echo '</div>';
			  }?>
              </div>
        <div class="section-container">
            <div class="container">
                <div class="big-title">
                    <h3><span><?php echo wp_kses_post( $instance['title'] ) ?></span></h3>
                    <?php if($instance['divider']) echo '<div class="border-title"></div>';?>
                </div><!-- big-title -->
                <h3 class="light-title"><?php  echo wp_kses_post( $instance['subtitle'] );?></h3>

                <div id="owl-services" class="margin-top" >
                <?php foreach( $instance['services'] as $i => $service ) : ?>
		
                   	<div class="owl-service">	        	 
					
						<a href="<?php if( !empty( $service['more_url'] ) ) echo  sow_esc_url( $service['more_url'] ) .'"' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>" title="">
                        <div class="service-box fixleft noborder">
                            <div class="mini-title text-left">
                                <div class="icon-container border-radius fixleft ">
								  <?php
                                     $icon_styles = array();
                                      if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';
                                        if(!empty($service['icon_color'])) $icon_styles[] = 'color: '.$service['icon_color'];                                                             
                                      echo siteorigin_widget_get_icon($service['icon'], $icon_styles);
                                      ?>
                                     
                                  </div>
                                 	<h3><?php echo wp_kses_post( $service['title'] ) ?></h3>
                                	<p><?php echo wp_kses_post( $service['text'] ) ?></p>
                            </div><!-- end mini-title -->
                        </div><!-- end service-box -->
                        </a>
                     </div><!-- end col -->
                   	
                    <?php endforeach;?> 
                          
                </div>
            </div><!-- end container -->
        </div><!-- end section-container -->
    </section><!-- end section -->
