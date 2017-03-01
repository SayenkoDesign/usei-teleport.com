<?php
/*
Widget Name: Padding Box widget
Description: A simple padding box.
Author: Greg Priday
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_PaddingBox_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'sow-padding-box',
			__('SiteOrigin Padding Box', 'siteorigin-widgets'),
			array(
				'description' => __('A customizable padding box widget.', 'siteorigin-widgets'),
				
			),
			array(

			),
			array(
				'icon' => array(
					'type' => 'icon',
					'label' => __('Box icon', 'siteorigin-widgets'),
				),
				'icon_size' => array(
					'type' => 'text',
					'label' => __('Box icon size', 'siteorigin-widgets'),
				),
				'text' => array(
					'type' => 'text',
					'label' => __('Box text', 'siteorigin-widgets'),
				),
				'color' => array(
							'type' => 'color',
							'label' => __('Box color', 'siteorigin-widgets'),
						),
				'border_color' => array(
					'type' => 'color',
					'label' => __('Border color', 'siteorigin-widgets'),
				),
				'text_color' => array(
							'type' => 'color',
							'label' => __('Text color', 'siteorigin-widgets'),
							
						),
				'url' => array(
					'type' => 'text',
					'sanitize' => 'url',
					'label' => __('Destination URL', 'siteorigin-widgets'),
				),

				'new_window' => array(
					'type' => 'checkbox',
					'default' => false,
					'label' => __('Open in a new window', 'siteorigin-widgets'),
				),
	
			),
			plugin_dir_path(__FILE__)
		);

	}

	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'sow-padding-box',
					siteorigin_widget_get_plugin_dir_url( 'padding-box' ) . 'css/style.css',
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

siteorigin_widget_register('padding-box', __FILE__);