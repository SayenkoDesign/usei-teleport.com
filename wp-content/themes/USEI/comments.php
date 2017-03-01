<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
<div class="clearfix"></div>
<?php if (comments_open()) : ?>
 <div id="comments-wrapper">
		  <?php if ( post_password_required() ) { ?>
          <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','lenard')?></p>
          <?php
          return;
          }$ncom = get_comments_number();
          ?>
          <?php if ( have_comments() ) : ?>
           <div class="widget-title">
                                <h3><?php _e('Comments ','lenard');?><span> <?php echo '(';echo sprintf (__('%s','lenard'), $ncom);echo ')';?></span></h3>
                                <div class="border-normal"></div>
                            </div><!-- end title -->
                                 
         <?php if ($ncom >= get_option('comments_per_page') && get_option('page_comments')) : ?>
                <nav id="comment-nav-above">
                    <?php paginate_comments_links(); ?>
                </nav>
            <?php endif; ?>
           
           <div class="comments margin-top">
            <ul class="media-list">
           <?php	  $args = array (
					  'paged' => true,
					  'avatar_size'       => 90,
					  'style'             => 'ul',
					  'callback'=> 'lenard_comment',
					  'end-callback'  => 'lenard_comment_end',
					  'per_page' =>'8',
					 	 ); 
				  wp_list_comments($args);
				?>
                                
            </ul>                              
           </div>
           
         <?php if ($ncom >= get_option('comments_per_page') && get_option( 'page_comments' ) ) : ?>
                <nav id="comment-nav-below">
                    <?php paginate_comments_links(); ?>
                </nav>
            <?php endif; ?>
          <?php else : // this is displayed if there are no comments so far ?>
           
          <?php if ('open' == $post->comment_status) : ?>
          <!-- If comments are open, but there are no comments. -->
           
          <?php else : // comments are closed ?>
          <!-- If comments are closed. -->
          <p class="nocomments">Comments are closed.</p>
           
          <?php endif; ?>
          <?php endif; ?>
           
          <?php if ('open' == $post->comment_status) : ?>
           
  </div>	      
           
         <!--  <div class="comments-form" id="respond">-->
         <div class="comments-form">
                    <div id="contact_form" class="contact_form"> 
                        <?php
                          // Comment Form
                          $aria_req = ( $req ? " aria-required='true'" : '' );
                          $fields =  array(
                               
                              'author' => '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><input id="author" name="author" class="form-control" placeholder="Name *" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />',
                              'email'  => '<input id="email" class="form-control" name="email" type="email" placeholder="Email *" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />',
                              'website'=>'<input type="text" name="name" id="website" class="form-control" placeholder="Website"   tabindex="3" /></div> '
                          );
                          $args = array (
                              'id_submit' => 'comment-submit',
                              'comment_field' =>  ' <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><textarea name="comment"  placeholder="" class="form-control" title="comments-form-comments" id="comment"  rows="6" >' .
                      '</textarea></div>',
                      'comment_notes_after' => '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><button name="submit" class="btn btn-primary" type="submit" id="submit" value="SEND">'.__('Send Comment').'</button></div>' ,
                              'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                              'logged_in_as' => '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','dikka'), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink($post->ID) ) ) ) . '</div>',
                              
                          );?>
                        <div class="margin-top row">
                          <?php comment_form($args);?>
                          </div>


                          

                        
                      
                          </div>
          </div>
         
           
          <?php endif; ?>
 
<?php endif;?>