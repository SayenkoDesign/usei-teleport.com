<div class="makepadding">
<div class="box " style="background-color:<?php echo $instance['color']?>;border-color:<?php echo $instance['border_color']?>;">
	<?php $icon_styles = array();
	if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';
	if(!empty($instance['text_color'])) $icon_styles[] = 'color: '.$instance['text_color'];
	echo siteorigin_widget_get_icon($instance['icon'], $icon_styles);?> 
      
    <h3 >
     <a  class="<?php if($instance['color']!='#ffffff') echo 'color'; else echo 'white';?>" href="<?php if( !empty( $instance['url'] ) ) echo  sow_esc_url( $instance['url'] ) .'"' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"  >                           
    <?php echo $instance['text']?></a>
    </h3>
    <style>
    	.box .color{
    		color:<?php echo $instance['color'];?>;
    	}
		
	</style>
</div><!-- end box -->
</div>