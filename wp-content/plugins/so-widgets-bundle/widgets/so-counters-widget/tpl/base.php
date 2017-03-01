<?php
$last_row = floor( ( count($instance['counters']) - 1 ) / $instance['per_row'] );
?>
<section  class="section-parallax" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="1">
<div class="white-shape leftalign"></div>
<div class="section-container parallax-wrapper">
<div class="container">
            	<div class="center-title <?php if (!empty($instance['align'])) echo 'text-'.$instance['align'] ;?>">
                	<h<?php echo $instance['size']; ?>><span> <?php if (!empty($instance['title'])) echo $instance['title'] ;?></span></h<?php echo $instance['size']; ?>>
                  <?php if (!empty($instance['subtitle'])): ?> <p class="lead"><?php echo $instance['subtitle'] ;?></p><?php endif;?>
                </div><!-- end title -->
<div class="sow-counters-list <?php if( $instance['responsive'] ) echo 'sow-counters-responsive'; ?>">

	<?php foreach( $instance['counters'] as $i => $counter ) : 
		  if( $i % $instance['per_row'] == 0 && $i != 0 ) : ?>
			<div class="sow-counters-clear"></div>
		<?php endif; ?>
		<div class="sow-counters-counter <?php if( $instance['layout'] ) echo  $instance['layout']; ?> <?php if(  floor( $i / $instance['per_row'] ) == $last_row ) echo 'sow-counters-counter-last-row' ?> stats" style="width: <?php echo round( 100 / $instance['per_row'], 3 ) ?>%">
	
				<?php 				
				$color=$counter['color'];
					
						$icon_styles = array();
						if(!empty($instance['icon_size'])) $icon_styles[] = 'font-size: '.intval($instance['icon_size']).'px';
						if(!empty($counter['icon_color'])) $icon_styles[] = 'color: '.$counter['icon_color'];
						echo '<h4 class="mini-title" style="color:'.$color.'">';
						echo siteorigin_widget_get_icon($counter['icon'], $icon_styles);
						if(!empty($counter['text'])) echo esc_html($counter['text']) ;
						echo '</h4>';
						echo '<div class="border-title fixedleft"></div>';
					?>		
                    	<h3 class="stat-count"><?php echo esc_html($counter['number']) ?></h3>
				
		</div>

	<?php endforeach; ?>

</div>
</div><!-- end container -->
</div><!-- end section-container -->
</section><!-- end section -->
   