<?php
$count=count($instance['features']);
 if( !empty($instance['title']) || !empty($instance['subtitle'])|| !empty($instance['description']) )
 $count++;

$last_row = floor( ($count - 1 ) / $instance['per_row'] );
$total=75;
?>
<section class=" section <?php if($instance['section']=='grey-section')echo 'grey-section'; else echo'white-section';?>">     
  <div class="<?php if($instance['section']=='grey-shape')echo 'white-section'; else echo'grey-shape';?>">
      <?php if(!empty($instance['icon_main'])){       
          $icon_styles = array();
          if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';
          
          echo '  <div class="icon-container fixed border-radius">';
          echo siteorigin_widget_get_icon($instance['icon_main'], $icon_styles);
          echo '</div>';}       
        ?>
      </div>
  <div class="section-container">
    <div class="container">
      <div class="row">
                      <div class="sow-features-list <?php if( $instance['responsive'] ) echo 'sow-features-responsive'; ?>">
                        <?php if( !empty($instance['title']) || !empty($instance['subtitle'])|| !empty($instance['description']) ):?>
                            <div class=" sow-features-feature main-title" >                         
                                <div class="service-text">
                                    <div class="mini-title wow fadeIn text-right">
                                        <?php if( !empty($instance['title'])):?>
                                        <p class="lead"><?php echo $instance['title'] ;?></p>
                                        <?php endif;?>
                                        <?php if( !empty($instance['subtitle'])):?>
                                        <h3 class="color-red"><?php echo $instance['subtitle'] ;?></h3>
                                        <?php endif;?>
                                        <?php if( !empty($instance['description'])):?>
                                        <p><?php echo $instance['description'] ;?></p>
                                        <?php endif;?>
                                    </div><!-- end mini-title -->
                                    <div class="border-title fixleftborder-features"></div>
                                </div><!-- end service-box -->
                            </div><!-- end col -->
                           <?php 
               else: $total=100;
               endif;
               ?>
                      
                          <?php foreach( $instance['features'] as $i => $feature ) : ?>
                      
                              <?php if( $i % $instance['per_row'] == 0 && $i != 0 ) : ?>
                                  <div class="sow-features-clear"></div>
                              <?php endif; ?>
                      
                          <div class=" sow-features-feature <?php if(  floor( $i / $instance['per_row'] ) == $last_row ) echo 'sow-features-feature-last-row' ?>" style="width: <?php echo round( $total/ $instance['per_row'], 3 ) ?>%">
                              <a href="<?php if( !empty( $feature['more_url'] ) ) echo  sow_esc_url( $feature['more_url'] ) .'"' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>" title="">
                               <div class="service-box">
                              
                                  <div class="mini-title text-center">
                                  <div class="icon-container border-radius  wow <?php echo esc_attr($instance['animation'])?>" >
                                      <?php
                                          $icon_styles = array();
                                          if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';
                                          if(!empty($feature['icon_color'])) $icon_styles[] = 'color: '.$feature['icon_color'];                                          
                                          echo siteorigin_widget_get_icon($feature['icon'], $icon_styles);
                                        
                                      ?>
                                  </div>
                              
                                  
                                      <?php if(!empty($feature['title'])) : ?>
                                          <h3>
                                          
                                              <?php echo wp_kses_post( $feature['title'] ) ?>
                                              
                                          </h3>
                                      <?php endif; ?>
                      
                                      <?php if(!empty($feature['text'])) : ?>
                                          <p><?php echo wp_kses_post( $feature['text'] ) ?></p>
                                      <?php endif; ?>
                      
                                      
                                  </div>
                                         
                              </div><!--service-box-->
                               </a>
                       
                          </div>
                          <?php endforeach; ?>
                      
                      </div>
      </div><!-- end row -->
    </div><!-- end container -->
  </div><!-- end section-container -->
</section><!-- end section -->
 