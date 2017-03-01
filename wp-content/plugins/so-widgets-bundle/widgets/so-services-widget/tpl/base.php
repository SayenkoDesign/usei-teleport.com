<?php
$last_row = floor( ( count($instance['services']) - 1 ) / $instance['per_row'] );?>

	<section class=" section <?php if($instance['section']=='grey-section')echo 'grey-section'; else echo'white-section';?>">
            <div class="<?php if($instance['section']=='grey-section')echo 'white-shape'; else echo'grey-shape';?>">
                    <?php if(!empty($instance['icon'])){				
                            $icon_styles = array();
                            if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';                            
                            echo '  <div class="icon-container fixed border-radius">';
                            echo siteorigin_widget_get_icon($instance['icon'], $icon_styles);
                            echo '</div>';}				
                        ?>
              </div>      
        <div class="section-container">
            <div class="container">
                <div class="big-title">
                    <h3><span><?php echo wp_kses_post( $instance['title'] ) ?></span></h3>
                    <?php if($instance['divider']) echo '<div class="border-title"></div>';?>
                </div><!-- big-title -->
                <div class="row margin-top sow-services-list <?php if( $instance['responsive'] ) echo 'sow-services-responsive'; ?>" >
                <?php foreach( $instance['services'] as $i => $service ) : ?>
					<?php if( $i % $instance['per_row'] == 0 && $i != 0 ) : ?>
                   	 <div class="sow-services-clear"></div>
                    <?php endif; ?>         
						
                   	 <div class="sow-services-service <?php if(  floor( $i / $instance['per_row'] ) == $last_row ) echo 'sow-services-service-last-row' ?>" style="width: <?php echo round( 100 / $instance['per_row'], 3 ) ?>%">
					
						<a href="<?php if( !empty( $service['more_url'] ) ) echo  sow_esc_url( $service['more_url'] ) .'"' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>" title="">
                        <div class="service-box  noborder">
                            <div class="mini-title text-center">
                                <div class="icon-container border-radius wow <?php echo esc_attr($service['animation'])?> ">
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
                </div>
            </div><!-- end container -->
</section><!-- end section -->


