<?php
$last_row = floor( ( count($instance['features']) - 1 ) / $instance['per_row'] );

?>
<section class=" section <?php if($instance['section']=='grey-section')echo 'grey-section'; else echo'white-section';?>">
     <div class="<?php if($instance['section']=='grey-section')echo 'white-shape'; else echo'grey-shape';?>">

        <?php if(!empty($instance['heading']['icon'])){
		$icon_styles = array();	
		echo '<div class="icon-container fixed border-radius">';			
		echo siteorigin_widget_get_icon($instance['heading']['icon'], $icon_styles);
		echo '</div>';
		}?>
       </div>
        <div class="section-container">
            <div class="container">
                <div class="big-title">
                    <h3><span><?php echo esc_html($instance['heading']['title']) ?></span></h3>
                    <?php if($instance['heading']['divider']):?>
	                    <div class="border-title"></div>
                    <?php endif;?>
                </div><!-- big-title -->

				<h3 class="light-title"><?php echo esc_html($instance['heading']['sub_title']) ?></h3>

				<div class="teamlist row sow-team_boxes-list <?php if( $instance['responsive'] ) echo 'sow-team_boxes-responsive'; ?>">
                <?php foreach( $instance['team_boxes'] as $i => $team_box ) : ?>

					<?php if( $i % $instance['per_row'] == 0 && $i != 0 ) : ?>
                        <div class="sow-team_boxes-clear"></div>
                    <?php endif; ?>
                    <div class="sow-team_boxes-team_box <?php if(  floor( $i / $instance['per_row'] ) == $last_row ) echo 'sow-team_boxes-team_box-last-row' ?>" style="width: <?php echo round( 100 / $instance['per_row'], 3 ) ?>%">
							<div class="teambox entry">
                            <?php $src = wp_get_attachment_image_src($team_box['image'], 'full');?>
                        	<img src="<?php echo $src[0];?>" alt="" class="img-responsive">                        
                        	<div class="teamdesc">
                            	<h3><?php echo wp_kses_post( $team_box['name'] ) ?></h3>
                                <p><?php echo wp_kses_post( $team_box['cpost'] ) ?></p>
                                <?php if (!empty($team_box['social_address']['facebook']) || !empty($team_box['social_address']['gplus']) || !empty($team_box['social_address']['behance']) || !empty($team_box['social_address']['twitter']) || !empty($team_box['social_address']['dribble'])|| !empty($team_box['social_address']['linkedin']) ) : ?>
	    
                                    <ul class="social text-center">
                                    	<?php if (!empty($team_box['social_address']['twitter'])) : ?>
                                        <li><a href="<?php echo esc_url( $team_box['social_address']['twitter'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php endif;?>
										<?php if (!empty($team_box['social_address']['behance'])) : ?>
                                        <li><a href="<?php echo esc_url( $team_box['social_address']['behance'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-behance"></i></a></li>
                                        <?php endif;?>
										<?php if (!empty($team_box['social_address']['dribble'])) : ?>
                                        <li><a href="<?php echo esc_url( $team_box['social_address']['dribble'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-dribbble"></i></a></li>
                                        <?php endif;?>
										<?php if (!empty($team_box['social_address']['linkedin'])) : ?>
                                        <li><a href="<?php echo esc_url( $team_box['social_address']['linkedin'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-linkedin"></i></a></li>
                                        <?php endif;?>
										<?php if (!empty($team_box['social_address']['facebook'])) : ?>
                                        <li><a href="<?php echo esc_url( $team_box['social_address']['facebook'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-facebook"></i></a></li>
                                        <?php endif;?>
										<?php if (!empty($team_box['social_address']['gplus'])) : ?>
                                        <li><a href="<?php echo esc_url( $team_box['social_address']['gplus'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-google-plus"></i></a></li>
                                  		<?php endif;?>
                                    </ul>
                                 <?php endif;?>
                           	</div><!-- end teamdesc -->
                            <div class="magnifier">
                                <div class="buttons">
                                    <p><?php echo wp_kses_post( $team_box['shortintro'] ) ?></p>
                                    <div class="border-hover"></div>
                                    <div class="teamdesc">
                                        <h3><?php echo wp_kses_post( $team_box['name'] ) ?></h3>
                                		<p><?php echo wp_kses_post( $team_box['cpost'] ) ?></p>
                                       <?php if (!empty($team_box['social_address']['facebook']) || !empty($team_box['social_address']['gplus']) || !empty($team_box['social_address']['behance']) || !empty($team_box['social_address']['twitter']) || !empty($team_box['social_address']['dribble'])|| !empty($team_box['social_address']['linkedin']) ) : ?>
	    
                                            <ul class="social text-center">
                                                <?php if (!empty($team_box['social_address']['twitter'])) : ?>
                                                <li><a href="<?php echo esc_url( $team_box['social_address']['twitter'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-twitter"></i></a></li>
                                                <?php endif;?>
                                                <?php if (!empty($team_box['social_address']['behance'])) : ?>
                                                <li><a href="<?php echo esc_url( $team_box['social_address']['behance'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-behance"></i></a></li>
                                                <?php endif;?>
                                                <?php if (!empty($team_box['social_address']['dribble'])) : ?>
                                                <li><a href="<?php echo esc_url( $team_box['social_address']['dribble'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-dribbble"></i></a></li>
                                                <?php endif;?>
                                                <?php if (!empty($team_box['social_address']['linkedin'])) : ?>
                                                <li><a href="<?php echo esc_url( $team_box['social_address']['linkedin'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-linkedin"></i></a></li>
                                                <?php endif;?>
                                                <?php if (!empty($team_box['social_address']['facebook'])) : ?>
                                                <li><a href="<?php echo esc_url( $team_box['social_address']['facebook'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-facebook"></i></a></li>
                                                <?php endif;?>
                                                <?php if (!empty($team_box['social_address']['gplus'])) : ?>
                                                <li><a href="<?php echo esc_url( $team_box['social_address']['gplus'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) ?>"><i class="fa fa-google-plus"></i></a></li>
                                                <?php endif;?>
                                            </ul>
                                 	<?php endif;?>
                                    </div><!-- end teamdesc -->
                                </div><!-- end buttons -->
                            </div><!-- end magnifier -->
                        </div><!-- end team -->
                    </div>
                    
                 <?php endforeach;?>
           </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section-container -->
</section><!-- end section -->


