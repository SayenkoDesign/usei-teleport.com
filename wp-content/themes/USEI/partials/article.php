<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}  global $flagfooter;?>



<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="post-media">
	   <?php 
            if ( has_post_format('gallery') && get_post_gallery()) :
            $gallery = get_post_gallery_images( $post ); ?>              
                 <div id="owl-slider" class="blog-carousel ">
                <?php foreach( $gallery as $src ) {
                 $src   = wp_get_attachment_url( $id );  ?>
                <a href="<?php echo $src ?>" data-gal="prettyPhoto"><img class="img-responsive" src="<?php echo $src; ?>" /></a>                
                <?php }?></div>
                <div class="icon-container border-radius"> <i class="icon icon-DSLRCamera"></i> </div>       
            <?php   endif;?>

            <?php if (has_post_format('quote')) :  ?>

            <div class="post-quote">

            <blockquote><i class="fa fa-quote-left"></i> <?php echo  the_content(); ?><i class="fa fa-quote-left"></i></blockquote>

            <span class="author-quote"> - <?php echo esc_attr(get_post_meta( $post->ID, 'q_author', true )); ?></span>

            </div>          

            

            <?php else : ?> 

                                 

            <?php if (has_post_thumbnail() && !has_post_format('video') && !has_post_format('quote') && !has_post_format('audio')&&(!is_single() || !is_page())) :

            // Get attached file guid

            $att = get_post_meta(get_the_ID(),'_thumbnail_id',true);

            $thumb = get_post($att);

            if (is_object($thumb)) { $att_ID = $thumb->ID; $att_url = $thumb->guid; }

            else { $att_ID = $post->ID; $att_url = $post->guid; }

            $att_title = (!empty(get_post($att_ID)->post_excerpt)) ? get_post($att_ID)->post_excerpt : get_the_title($att_ID);?>            

            <a href="<?php the_permalink(); ?>" >

            <?php echo get_the_post_thumbnail(get_the_ID(), array(848,400), array('alt'=>'','class'=>"img-responsive",'title'=> '')); ?></a>           

            <div class="icon-container border-radius"><i class="fa fa-image"></i></div>

            <?php endif; ?>           

           

            

            <?php if (has_post_format('video')) : 

            $videoID = get_post_meta( $post->ID, 'video_id', true );?>

           	<a href="<?php the_permalink(); ?>"><?php

            echo wp_oembed_get(  $videoID ); ?> </a>

            <div class="icon-container border-radius"><i class="icon icon-Video"></i></div>           

            <?php endif; ?>

            

            <?php if (has_post_format('audio')) :

            $audioID = get_post_meta( $post->ID, 'audio_id', true );?>           

			<a href="<?php the_permalink(); ?>"> 

            <?php echo wp_oembed_get(  $audioID ); ?> </a>

             <div class="icon-container border-radius"> <i class="fa fa-volume-up"></i></div>

            <?php endif; ?>

            <?php endif; ?>         





</div> 




<?php if(!is_page()) : ?>
<div class="post-top">

            <h3 ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <ul class="list-inline">

              <li><strong><?php _e('Posted by:','lenard')?></strong><a href=" <?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title=""> <?php echo get_the_author() ?></a></li>            

              <li><strong><?php _e('In:','lenard')?></strong>

             <?php	                                        // Tags

			  if (get_the_category()) :

			  ?>			

			  <?php the_category(', ');

			  endif; ?>

              </li>

              <li><strong><?php _e('On:','lenard')?></strong>

              <?php $archive_year  = get_the_time('Y'); 

			  $archive_month = get_the_time('m'); 

			  $archive_day   = get_the_time('d'); 

			  ?>

			  <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date('F j') ?></a></li>              

            </ul><!-- end list-inline -->

</div><!-- end post-top -->             
<?php endif; ?>
<div class="desc">
    <?php if (is_single() OR is_page()) : 
        if(has_post_format('gallery')):
           $postContentStr = apply_filters('the_content', strip_shortcodes($post->post_content));
         echo $postContentStr;
        else:
          the_content();
        endif;   

        wp_link_pages(array(
                'next_or_number' => 'number',
                'nextpagelink' => __('Next page', 'lenard'),
                'previouspagelink' => __('Previous page', 'lenard'),
                'pagelink' => '%',
                'link_before' => '<span class="ft-btn">',
                'link_after' => '</span>',
                'before' => '<div class="clearfix"></div>' . __('Pages:', 'lenard') . ' <div class="ft-article-pages">',
                'after' => '</div>'
                ));
    else :
        if (has_post_format('audio') OR has_post_format('image') OR has_post_format('quote') OR has_post_format('link') OR  has_post_format('video'))
            the_content();
        else
            the_excerpt ();
        endif;
    if ($flagfooter!=1 && !is_page()):?> 
    <a href="<?php echo the_permalink();?>" class="btn btn-primary"><?php _e('MORE...','lenard')?></a>
    <?php endif;?>
</div><!-- end desc -->

<?php  if ($flagfooter==1):?>
<div class="tags">
  <h3><?php _e('TAGS ','lenard');
    if (get_the_tags()) : ?><span>
    <?php the_tags('','',''); ?></span>
    <?php endif; ?>
  </h3>
</div><!-- end tags -->
<?php endif;?>

</div>

 <?php if (is_single()) : ?>
  <?php if (get_next_post_link('&laquo; %link', '%title', 1) OR get_previous_post_link('%link &raquo;', '%title', 1)) : ?>
    <div class="prev-next-btn" style="display:none;">
      <ul class="pager">
        <li class="previous">
        <?php 
        previous_posts_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous feature', 'lenard' ) . '</span> %title' ); ?>
        </li>
        <li class="next">
        <?php 
        next_posts_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next feature', 'lenard' ) . '</span>' ); ?>
        </li>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>

 <?php if (is_single()) : ?>
  <?php if (get_next_post_link('&laquo; %link', '%title', 1) OR get_previous_post_link('%link &raquo;', '%title', 1)) : ?>
    <div class="prev-next-btn">
      <ul class="pager">
        <li class="previous">
        <?php 
        previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous feature', 'lenard' ) . '</span> %title' ); ?>
        </li>
        <li class="next">
        <?php 
        next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next feature', 'lenard' ) . '</span>' ); ?>
        </li>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>

