<?php
/*
Widget Name: Text widget
Description: A simple text box.
Author: Sunil Chaulagain

*/

class SiteOrigin_Widget_Text_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'sow-text',
			__('SiteOrigin Text', 'siteorigin-widgets'),
			array(
				'description' => __('A simple text widget.', 'siteorigin-widgets'),
				
			),
			array(

			),
			array(
				
				'text' => array(
					'type' => 'text',
					'label' => __('Title', 'siteorigin-widgets'),
				),
				
				

				'description' => array(
					'type' => 'textarea',
					
					'label' => __('Description', 'siteorigin-widgets'),
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
	
			),
			plugin_dir_path(__FILE__)
		);

	}

	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'sow-text',
					siteorigin_widget_get_plugin_dir_url( 'text' ) . 'css/style.css',
					array(),
					SOW_BUNDLE_VERSION
				),
			)
		);
	}

	function get_template_name($instance) {
		return 'base';
	}

	function get_style_name($instance) {
		return false;
	}

	
	
}

siteorigin_widget_register('text', __FILE__);