<?php
/*
Widget Name: Testimonials widget
Description: Displays testimonials with client image.
Author: Greg Priday
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_Testimonials_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-testimonials',
			__( 'SiteOrigin Testimonials', 'siteorigin-widgets' ),
			array(
				'description' => __( 'Displays feedback from client.', 'siteorigin-widgets' ),
				
			),
			array(),
			array(
					'heading' => array(
							'type' => 'text',
							'label' => __('Heading', 'siteorigin-widgets'),
						),
						'align' => array(
							'type' => 'select',
							'label' => __( 'Align', 'siteorigin-widgets' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'siteorigin-widgets' ),
								'left' => __( 'Left', 'siteorigin-widgets' ),
								'right' => __( 'Right', 'siteorigin-widgets' ),
								
							)
						),
				'testimonials' => array(
					'type' => 'repeater',
					'label' => __('Testimonials', 'siteorigin-widgets'),
					'item_name' => __('Testimonial', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='testimonials-name']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'client_image' => array(
							'type' => 'media',
							'library' => 'image',
							'label' => __('Client Image', 'siteorigin-widgets'),
							),					

						'name' => array(
							'type' => 'text',
							'label' => __('Client Name', 'siteorigin-widgets'),
						),

						'post' => array(
							'type' => 'text',
							'label' => __('Client Post', 'siteorigin-widgets')
						),

						'body' => array(
							'type' => 'text',
							'label' => __('Client Text', 'siteorigin-widgets'),
						),
						'active' => array(
							'type' => 'checkbox',
							'label' => __('Active Testimonial?', 'siteorigin-widgets'),
							'default'=>true,
						),
						
					),
				),

				'color' => array(
					'type' => 'color',
					'label' => __('Text Color', 'siteorigin-widgets'),
					'default' => '#000000'
				),

				
			),
			plugin_dir_path(__FILE__).'../'
		);
	}

	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'siteorigin-testimonials',
					siteorigin_widget_get_plugin_dir_url( 'testimonials' ) . 'css/style.css',
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

siteorigin_widget_register('testimonials', __FILE__);