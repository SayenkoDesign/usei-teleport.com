<?php
/*
Widget Name: Video widget
Description: A very simple video widget.
Author: Greg Priday
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_Video_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-video',
			__('SiteOrigin Video', 'siteorigin-widgets'),
			array(
				'description' => __('A simple video widget.', 'siteorigin-widgets'),
				
			),
			array(

			),
			array(
			
					'video_url' => array(
					'type' => 'text',
					'label'  => __( 'Video Location', 'siteorigin-widgets' ),
					
					
				 		 ),		),
			plugin_dir_path(__FILE__).'../'
		);
	}

	
	function initialize() {
		
		$this->register_frontend_styles(
			array(
				array(
					'sow-video',
					siteorigin_widget_get_plugin_dir_url( 'video' ) . 'css/style.css',
					array(),
					SOW_BUNDLE_VERSION
				)
			)
		);
	}

	function get_template_name($instance) {
		return 'base';
	}

	function get_style_name($instance) {
		return false;
	}

	function get_less_variables($instance){
		return array();
	}
}

siteorigin_widget_register('video', __FILE__);