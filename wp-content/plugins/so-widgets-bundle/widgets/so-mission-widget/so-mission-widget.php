<?php
/*
Widget Name: Mission widget
Description: Displays motive and mission with targets
Author: Greg Priday
Author URI: http://siteorigin.com
*/
class SiteOrigin_Widget_Mission_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'sow-mission',
			__('SiteOrigin Mission', 'siteorigin-widgets'),
			array(
				'description' => __('A customizable mission widget.', 'siteorigin-widgets'),
				'help' => 'http://siteorigin.com/widgets-bundle/button-widget-documentation/'
			),
			array(
				),
			array(
					'descriptions' => array(
					'type' => 'repeater',
					'label' => __('Descriptions', 'siteorigin-widgets'),
					'item_name' => __('Discription', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='descriptions-title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						  'heading' => array(
						  'type' => 'text',
						  'label' => __('Heading', 'siteorigin-widgets'),
					 	 ), 
						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'siteorigin-widgets'),
						),
						'text' => array(
							'type' => 'textarea',
							'label' => __('Description', 'siteorigin-widgets'),
						),
						'button_text' => array(
							'type' => 'text',
							'label' => __('Button Text', 'siteorigin-widgets'),
						),
						'url' => array(
						'type' => 'text',
						'sanitize' => 'url',
						'label' => __('Button URL', 'siteorigin-widgets'),
					),
						'new_window' => array(
						'type' => 'checkbox',
						'default' => false,
						'label' => __('Open in a new window', 'siteorigin-widgets'),
					),
					
					),
					),		

			),
			plugin_dir_path(__FILE__).'../'
		);
	}
	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'siteorigin-widgets',
					siteorigin_widget_get_plugin_dir_url( 'mission' ) . 'css/style.css',
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

siteorigin_widget_register('mission', __FILE__);