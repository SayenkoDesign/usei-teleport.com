
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
    <?php foreach( $instance['tabs'] as $i => $tab ) { ?>
        <li class=" <?php if( $tab['active'] ) echo 'active'; ?> wow <?php echo esc_attr($instance['animation'])?>">
        <a href="#<?php echo $i;?>" data-toggle="tab">
              
               <?php
              if( !empty($tab['icon_image']) ) {
                  $attachment = wp_get_attachment_image_src($tab['icon_image']);
                  if(!empty($attachment)) {
                      $icon_styles[] = 'background-image: url(' . sow_esc_url($attachment[0]) . ')';
                      if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';

                      ?><div class="sow-icon-image" style="<?php echo implode('; ', $icon_styles) ?>"></div><?php
                  }
              }
              else {
                  $icon_styles = array();
                  if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';
                  if(!empty($tab['icon_color'])) $icon_styles[] = 'color: '.$tab['icon_color'];
                  echo siteorigin_widget_get_icon($tab['icon'], $icon_styles);
                  }
              ?>                      
        </a></li>
           <?php } ?>
    </ul>
    <div class="tab-content">
    <?php foreach( $instance['tabs'] as $i => $tab ) : ?>
        <div class="tab-pane  <?php if( $tab['active'] ) echo 'active'; ?>" id="<?php echo $i;?>">
            <h3><span><?php echo ++$i.'.'; echo $tab['title'];?></span></h3>
            <p><i class="fa fa-quote-right"></i><?php echo wp_kses_post( $tab['text'] );?></p>
        </div>
       
    
    <?php endforeach; ?>
    </div><!-- end tab-content -->
</div><!-- end tabbble -->



