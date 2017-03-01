<?php
/**
 * Lenard Child functions file.
 */


function lenard_parent_styles() {

	// Enqueue the parent stylesheet
	wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css','settings' );
	wp_enqueue_style( 'main-child', get_stylesheet_uri() ,'main' );


}
add_action( 'wp_enqueue_scripts', 'lenard_parent_styles',11 );
?>
