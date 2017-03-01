<?php
/*
Widget Name: Adress widget
Description: Displays a contact address.
Author: Greg Priday
Author URI: http://siteorigin.com
*/
class SiteOrigin_Widget_Address_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-address',
			__( 'SiteOrigin Address', 'siteorigin-widgets' ),
			array(
				'description' => __('Displays an contact address', 'siteorigin-widgets' ),
				
			),
			array(),
			array(
			    
			    
				'address' => array(
					'type' => 'text',
					'label' => __('Street Address', 'siteorigin-widgets'),
				),
				'phone' => array(
					'type' => 'text',
					'label' => __('Phone number', 'siteorigin-widgets'),
				),
				
				'email' => array(
					'type' => 'text',
					'label' => __('Email address', 'siteorigin-widgets'),
				),
				'hours' => array(
					'type' => 'text',
					'label' => __('Working hours', 'siteorigin-widgets'),
					'descriptino'=>__('Monday - Friday : 9:00 AM to 5:30 PM', 'siteorigin-widgets'),
				),
				

				

			)
		);	
	}

function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'siteorigin-address',
					siteorigin_widget_get_plugin_dir_url( 'address' ) . 'css/style.css',
					array(),
					SOW_BUNDLE_VERSION
				)
			)
		);
	}

	function get_style_name($instance){
		return false;
	}

	function get_template_name($instance){
		return 'base';
	}

	
}
siteorigin_widget_register('address', __FILE__);