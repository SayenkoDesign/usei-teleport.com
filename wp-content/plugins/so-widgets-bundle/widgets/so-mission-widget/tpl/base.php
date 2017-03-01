        <div class="row-fluid">               
                <div class="row">
                        <div class="section-container nopadding">
                            <div class="textrotate">
                                <ul class="bxslider">
                                  <?php foreach( $instance['descriptions'] as $i => $description ) : ?>
                                   <li>
                                        <div class="big-title">
                                            <p class="lead"><?php echo $description['heading']?></p>
                                            <h3><span><?php echo $description['title']?></span> </h3>
                                            <div class="border-title"></div>
                                        </div><!-- big-title -->
                                        <p><?php echo $description['text']?></p>
                                        <a href="<?php if( !empty( $description['url'] ) ) echo  sow_esc_url( $description['url'] ) .'"' . ( $description['new_window'] ? 'target="_blank"' : '' ) ?>" class="btn btn-primary btn-transparent btn-lg">
                                         <?php echo $description['button_text']?></a>
                                    </li>
                                  <?php endforeach;?>
                                   
                                   
                                </ul>
                            </div><!-- end textrotate -->
                        </div>
                    
                </div><!--end of row-->
           
        </div><!-- end row fluid -->