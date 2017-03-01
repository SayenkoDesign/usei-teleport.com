
<section class=" section <?php if($instance['section']=='grey-section')echo 'grey-section'; else echo'white-section';?> paddingbottom">
      <div class="<?php if($instance['section']=='grey-section')echo 'white-shape'; else echo'grey-shape';?>">

		  <?php	$icon_styles = array();
          if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';
          //if(!empty($instance['icon_color'])) $icon_styles[] = 'color: '.$instance['icon_color'];
          echo '  <div class="icon-container fixed border-radius">';
          echo siteorigin_widget_get_icon($instance['icon'], $icon_styles);
          echo '</div>';
          
          ?>
		</div>
        <div class="section-container paddingbottom">
            <div class="container">
                <div class="big-title">
                    <h3><span><?php echo  esc_html($instance['title'])  ?></span> </h3>
                    <?php if($instance['border']):
                    echo '<div class="border-title"></div>';
                    endif;?>
                </div><!-- big-title -->
            
                <div class="pricing-wrapper row ow-pt-columns-atom">
                		<?php foreach($instance['columns'] as $i => $column) : ?>
                    <div class="ow-pt-column" style="width: <?php echo round(100/count($instance['columns']), 3) ?>%;float:left;padding:0px 15px;">
                          <div class=" pricing-table <?php if($column['featured']) echo 'premium';?> wow <?php echo $column['animation'];?> <?php echo $this->get_column_classes($column, $i, $instance['columns']) ?>" >
                                  <div class="pricing-header">
                                        <h3><?php echo esc_html( $column['title'] ) ?></h3>
                                        
                                        <div class="pricing-icon-container border-radius">
                                              <p><?php _e('Starting From','siteorigin-widgets')?></p>
                                              <h2><?php echo esc_html($column['price']) ?></h2>
                                              
                                              <?php if( !empty($column['discount'])):?>
                                              <div class="pricing-icon-bubble border-radius">
                                              <p><?php echo esc_html($column['discount']) ?></p>
                                              </div>
                                              <?php endif;?>  
                                        </div><!-- icon -->
                                  </div>
                          <div class="pricing-bottom   ">
                              <ul><?php foreach($column['features'] as $i => $feature) : ?>                          
                             		 <li>	<?php echo wp_kses_post($feature['text']) ?></li>
                              
                              <?php endforeach;?>
                          </ul>
                          <div class="clearfix"></div>
                          		<a href='<?php echo sow_esc_url($column['url']) ?>' class="btn btn-default btn-lg"><?php echo esc_html($column['button']) ?></a>
                          
                          </div><!-- end bottom -->  
                          
                          
                          </div>
                    </div>
                			<?php endforeach; ?>
               			</div>
                </div><!-- end container -->
        </div><!-- end section-container -->
</section><!-- end section -->

