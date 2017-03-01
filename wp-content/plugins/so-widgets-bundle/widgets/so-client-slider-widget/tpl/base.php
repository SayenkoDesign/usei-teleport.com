
<div id="owl-clients" class="clients">
 <?php foreach( $instance['images'] as $i => $image ) : 
 $src = wp_get_attachment_image_src($image['client_image'], 'full');?>
 	<div class="client-item wow swing">    
                <a href="<?php if( !empty( $image['url'] ) ) echo  sow_esc_url( $image['url'] ) .'"' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><img src="<?php echo $src[0];?>" alt=""></a>
    </div><!-- end client-item -->
 <?php endforeach;?>
    
   
</div>
