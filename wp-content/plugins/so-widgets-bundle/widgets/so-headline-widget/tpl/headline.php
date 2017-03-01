<?php if ( !empty( $headline ) ) : ?>
<div class="<?php if($instance['style']=='left')echo 'features-widget';?> big-title fixed<?php echo $instance['style']?> text-<?php echo $instance['headline']['align'];?>">
	
	<h3 ><span><?php echo $headline ?></span></h3>
    
	
	<?php if($instance['divider']['divider_checkbox']):
	if ( $has_divider ) : ?>
	<div class="border-title fix<?php echo $instance['style']?>border">
		<div class="decoration-inside"></div>
	</div>
	<?php endif ;endif; ?>
</div>
<?php endif; ?>
<?php if ( !empty( $sub_headline ) ) : ?>
 <p class="lead" style="text-align:<?php echo $instance['sub_headline']['align'] ?>"><?php echo $sub_headline ?></p>
<?php endif; ?>
