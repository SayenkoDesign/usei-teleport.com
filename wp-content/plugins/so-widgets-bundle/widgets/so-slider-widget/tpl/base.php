<?php

if( empty($instance['frames']) ) return;

?>

	<article id="homepage" class="slider-wrapper">
		<div class="tp-banner-container">
			<div class="tp-banner">
            
				<ul>
                <?php foreach($instance['frames'] as $frame) : ?>
                <?php if( empty($frame['background_image']) ) $background_image = false;
					else $background_image = wp_get_attachment_image_src($frame['background_image'], 'full');
					if(!empty($background_image)) {?>                    
					<li data-transition="<?php if(!empty($instance['animation']) && $instance['animation']!='none') : echo $instance['animation']; endif; ?>" alt="<?php echo esc_attr($instance['animation']);?>" data-slotamount="3" data-masterspeed="<?php echo $instance['speed']?>" data-thumb="<?php echo esc_url($background_image[0]); ?>"  data-saveperformance="off"  data-title="WordPress Version">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/dummy.png"  alt="" data-lazyload="<?php echo esc_url($background_image[0]); ?>" data-bgposition="center top" data-bgfit="<?php echo $frame['background_image_type'] ?>" data-bgrepeat="no-repeat">
                        <div class="tp-caption slider_01 skewfromright randomrotateout tp-resizeme rs-parallaxlevel-2"
                            data-x="left"
                            data-y="350" 
                            data-speed="1000"
                            data-start="1200"
                            data-easing="Power3.easeInOut"
                            data-splitin="none"
                            data-splitout="none"
                            data-elementdelay="0.1"
                            data-endelementdelay="0.1"
                            data-endspeed="1000"
                            style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;"><?php echo nl2br($frame['layertitle']); ?>
                        </div>
                        <div class="tp-caption slider_02 skewfromright randomrotateout tp-resizeme rs-parallaxlevel-2"
                            data-x="left"
                            data-y="310" 
                            data-speed="1000"
                            data-start="1600"
                            data-easing="Power3.easeInOut"
                            data-splitin="none"
                            data-splitout="none"
                            data-elementdelay="0.1"
                            data-endelementdelay="0.1"
                            data-endspeed="1000"
                            style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;"><?php echo esc_attr($frame['layersubtitle']); ?> 
                        </div>
                        
                        <div class="tp-caption skewfromright  randomrotateout tp-resizeme rs-parallaxlevel-2"
                            data-x="left"
                            data-y="510" 
                            data-speed="1000"
                            data-start="2000"
                            data-easing="Power3.easeInOut"
                            data-splitin="none"
                            data-splitout="none"
                            data-elementdelay="0.1"
                            data-endelementdelay="0.1"
                            data-endspeed="1000"
                            style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
							<?php if( !empty( $frame['moreurl'] ) ) echo '<a data-scroll href="' . esc_url( $frame['moreurl'] ) . '" ' . ( $frame['new_window'] ? 'target="_blank"' : '' ) . ' class="btn btn-primary btn-lg" >'; ?>
                            <?php echo wp_kses_post( $frame['moretext'] ) ?>
                            <?php if( !empty( $frame['moreurl'] ) ) echo '</a>'; ?>
                            
                            <?php if( !empty( $frame['purchasenowurl'] ) ) echo '<a href="' . esc_url( $frame['purchasenowurl'] ) . '" ' . ( $frame['new_window1'] ? 'target="_blank"' : '' ) . ' class="btn btn-default btn-lg" >'; ?>
                            <?php echo wp_kses_post( $frame['purchasenowtext'] ) ?>
                            <?php if( !empty( $frame['purchasenowurl'] ) ) echo '</a>'; ?>
							    </div>  
					</li>
                    <?php }
				?>
		<?php endforeach; ?>  
				</ul> 
                
			</div>
		</div>  
	</article>


	


