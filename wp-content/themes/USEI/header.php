<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
<!DOCTYPE html>
<?php
global $lenard_options;
 ?>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />

<meta name="author" content="<?php esc_attr(bloginfo('name')); ?>">
<?php if(isset($lenard_options['meta_author']) && $lenard_options['meta_desc']!='') : ?>
<meta name="description" content="<?php echo esc_attr($lenard_options['meta_desc']); ?>">	
<?php endif; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
<title><?php wp_title();?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if(isset($lenard_options['favicon']['url'])) :  ?>
<link rel="shortcut icon" href="<?php echo esc_url($lenard_options['favicon']['url']); ?>">
<?php endif; ?>

<?php
// WordPress Head
wp_head();
?>
<script type='text/javascript' src='<?php echo get_site_url(); ?>/wp-includes/js/jquery/jquery.js?ver=1.11.3'></script>
<script type='text/javascript' src='<?php echo get_site_url(); ?>/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>

<script>
jQuery(document).ready(function(e) {
    jQuery(".panel-grid").css('margin',0);
	if(jQuery(window).width()<768)
	{
		jQuery("header").css('position','absolute');	
	}
});

</script>

</head> 
<!-- BEGIN BODY -->

<body  <?php body_class(); ?>>
<?php if ( isset($lenard_options['preloader']) &&  $lenard_options['preloader'] == 1 ) : ?> 
<div id="loader">
	<div class="loader-container">
        <?php if(isset($lenard_options['preloader-logo']['url']) && $lenard_options['preloader-logo']['url']!='') : ?>
        <h3 class="loader-back-text"><img src="<?php echo $lenard_options['preloader-logo']['url']; ?>/images/loader-icon.gif" alt="" class="loader"></h3>
        <?php else : ?>
        <h3 class="loader-back-text"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader-icon.gif" alt="" class="loader"></h3>
        <?php endif; ?>
	</div>
</div>
<?php endif ; ?>

 <!--Begin wrapper-->   
<div id="wrapper"> 

<?php
 // Navbar
if (!is_page_template('partials/nothing-found.php') ) :
get_template_part('partials/navbar');
endif;

  if (!is_page_template('partials/nothing-found.php') ) :
  if (!is_page_template('lenard-page-builder.php') ) :	
	get_template_part('partials/breadcrumb');
	
	endif;
endif;

