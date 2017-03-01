<?php
/*
Widget Name: More Services widget
Description: Displays more block of services with icons.
Author: Greg Priday
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_MoreServices_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-more-services',
			__( 'SiteOrigin More Services', 'siteorigin-widgets' ),
			array(
				'description' => __( 'Displays a list of services.', 'siteorigin-widgets' ),
				
			),
			array(),
			array(
			'icon' => array(
							'type' => 'icon',
							'label' => __('Icon', 'siteorigin-widgets'),
						),
						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'siteorigin-widgets'),
						),
						'subtitle' => array(
							'type' => 'text',
							'label' => __('Sub Title', 'siteorigin-widgets'),
						),
						'divider' => array(
							'type' => 'checkbox',
							'label' => __('Want divider?', 'siteorigin-widgets'),
						),
				'services' => array(
					'type' => 'repeater',
					'label' => __('Services', 'siteorigin-widgets'),
					'item_name' => __('Service', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='services-title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(

						'icon' => array(
							'type' => 'icon',
							'label' => __('Icon', 'siteorigin-widgets'),
						),

						'icon_color' => array(
							'type' => 'color',
							'label' => __('Icon color', 'siteorigin-widgets'),
							'default' => '#FFFFFF',
						),


						'title' => array(
							'type' => 'text',
							'label' => __('Title text', 'siteorigin-widgets'),
						),

						'text' => array(
							'type' => 'text',
							'label' => __('Text', 'siteorigin-widgets')
						),

						

						'more_url' => array(
							'type' => 'text',
							'label' => __('Destination URL', 'siteorigin-widgets'),
							'sanitize' => 'url',
						),
					),
				),

				

				

				'icon_size' => array(
					'type' => 'number',
					'label' => __('Icon size', 'siteorigin-widgets'),
					'default' => 24,
				),

				
				'responsive' => array(
					'type' => 'checkbox',
					'label' => __('Responsive layout', 'siteorigin-widgets'),
					'default' => true,
				),
				'new_window' => array(
					'type' => 'checkbox',
					'label' => __('Open more URL in a new window', 'siteorigin-widgets'),
					'default' => false,
				),
				'section' => array(
						'type' => 'select',
						'label' => __( 'Section', 'siteorigin-widgets' ),							
						'options' => array(								
						'grey-section' => __( 'Grey Section', 'siteorigin-widgets' ),
						'white-section' => __( 'White Section', 'siteorigin-widgets' ),
										
						)
					),
				

			),
			plugin_dir_path(__FILE__).'../'
		);
	}

	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'siteorigin-more-services',
					siteorigin_widget_get_plugin_dir_url( 'more-services' ) . 'css/style.css',
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

siteorigin_widget_register('more-services', __FILE__);