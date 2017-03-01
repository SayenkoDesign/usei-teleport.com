
<div class="contact-list">
	<?php if(!empty($instance['address'])): ?>
    <h3><?php _e('ADDRESS:','siteorigin-widgets')?></h3>
    <p><?php echo esc_html($instance['address']);?> </p>
    <?php endif; ?>
    <div class="border-normal"></div>
    <?php if(!empty($instance['phone'])): ?>
    <h3><?php _e('Phone: ','siteorigin-widgets')?><span><?php echo esc_html($instance['phone']);?></span></h3>
    <?php endif; ?>
   	<?php if(!empty($instance['email'])): ?>
    <h3><?php _e('Email: ','siteorigin-widgets')?><span><?php echo esc_html($instance['email']);?></span></h3>
    <?php endif; ?>
    <div class="border-normal"></div>
    <?php if(!empty($instance['hours'])): ?>
    <h3><?php _e('Working Hours','siteorigin-widgets')?></h3>
    <p><?php echo esc_html($instance['hours']);?></p>
    <?php endif; ?>
</div><!-- end contact-list -->