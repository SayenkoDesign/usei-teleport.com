       <div class="ipad-vide">
			<?php 
            $src1 = wp_get_attachment_image_src($instance['main_image']['image1'],$instance['main_image']['size1']);
            $src2 = wp_get_attachment_image_src($instance['additional_image1']['image2'],$instance['additional_image1']['size2']); 
            $src3 = wp_get_attachment_image_src($instance['additional_image3']['image3'],$instance['additional_image3']['size3']);?>
            <div class="col-1">
            
            	 <img src="<?php echo esc_url($src2[0]);?>" alt="" class="img-responsive wow <?php echo $instance['additional_image1']['animation2']?>">
            </div><!-- end col-1 -->
            <?php if ($instance['style']=='fix-bottom') echo '<div class="relative wow '. $instance['main_image']['animation1'].'">';?>
            		<img src="<?php echo esc_url($src1[0]);?>" alt="" class="<?php if ($instance['style']=='img-responsive') echo $instance['style'] . ' wow ' . $instance['main_image']['animation1']; else echo $instance['style'];?>">
            
             <?php if ($instance['style']=='fix-bottom') echo '</div>';?>      
            <div class="col-2">
                <img src="<?php echo esc_url($src3[0]);?>" alt="" class="img-responsive wow <?php echo $instance['additional_image3']['animation3']?>">                            
            </div><!-- end ipad-vide -->
		</div>
