<?php $count=count($instance['progressbar']);?>
<div class="row margin-top sow-progress_bars-list sow-progress_bars-responsive">
  <?php foreach( $instance['progressbar'] as $i => $progressbar ) : 
  		if($count==5) $total=10;?>
        
		<div class="sow-progress_bars-progress_bar" style="width: <?php echo round( 100 / $count, 3 ) ?>%">
					         
                    	<div id="circle<?php echo ++$i;?>" class="circle-stat" data-circle="<?php  echo esc_html(($progressbar['percent'])/100);?>" data-color="<?php echo $progressbar['color']; ?>" >
                        	<p><?php  echo esc_html($progressbar['percent']); _e('%','siteorigin-widgets');?></p>
                            <div class="stat-details">
                                <h3>
                               <?php  $icon_styles = array();					
								echo siteorigin_widget_get_icon($progressbar['icon'], $icon_styles);?>                                
                                </h3>
                                <h4><?php echo wp_kses_post($progressbar['title']); ?></h4>
                            </div>
                        </div><!-- end circle-stat -->
                    </div><!-- end col -->
     <?php endforeach;?>             
                	
</div>


  