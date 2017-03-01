
 <section class=" section <?php if($instance['section']=='grey-section')echo 'grey-section'; else echo'white-section';?> paddingbottom">
            <div class="<?php if($instance['section']=='grey-section')echo 'white-shape'; else echo'grey-shape';?>">
        	 <?php if(!empty($instance['icon'])){
			  $icon_styles = array();	
			  echo '<div class="icon-container fixed border-radius">';			
			  echo siteorigin_widget_get_icon($instance['icon'], $icon_styles);
			  echo '</div>';
			  }?>
              </div>
        <div class="section-container paddingbottom">
            <div class="container">
                <div class="big-title">
                    <h3><span><?php echo wp_kses_post( $instance['title'] ) ?></span></h3>
                    <?php if($instance['divider']) echo '<div class="border-title"></div>';?>
                </div><!-- big-title -->
            </div>
			<?php            
            $shortcode_attr = array();
                    foreach($instance as $k => $v){
                        if(empty($v)) continue;
                        $shortcode_attr[] = $k.'="'.esc_attr($v).'"';
                    }
            
                    echo do_shortcode('[portfolio '.implode(' ', $shortcode_attr).']');?>


