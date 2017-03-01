<?php
/*
Widget Name: Counters Widget
Description: Displays a block of counters with icons.
Version: trunk
Author: Sunil Chaulagain
Author URI: http://tuchuk.com
*/

class SiteOrigin_Widget_Counters_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-counters',
			__( 'SiteOrigin Counters ', 'siteorigin-widgets' ),
			array(
				'description' => __( 'Displays a list of counters.', 'siteorigin-widgets' ),
			),
			array(),
			array(
			'title' => array(
					'type' => 'text',
					'label' => __('Title', 'siteorigin-widgets'),
				),

				'align' => array(
					'type' => 'select',
					'label' => __('Title Alignment', 'siteorigin-widgets'),
					'options' => array(
						'left' => __('Left', 'siteorigin-widgets'),
						'right' => __('Right', 'siteorigin-widgets'),
						'center' => __('Center', 'siteorigin-widgets'),
					)
				),

				'size' => array(
					'type' => 'select',
					'label' => __('Title Size', 'siteorigin-widgets'),
					'options' => array(
						'1' => __('H1', 'siteorigin-widgets'),
						'2' => __('H2', 'siteorigin-widgets'),
						'3' => __('H3', 'siteorigin-widgets'),
						'4' => __('H4', 'siteorigin-widgets'),
						'5' => __('H5', 'siteorigin-widgets'),
						'6' => __('H6', 'siteorigin-widgets'),
						
					)
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Sub-Title', 'siteorigin-widgets'),
				),
				'counters' => array(
					'type' => 'repeater',
					'label' => __('Counters', 'siteorigin-widgets'),
					'item_name' => __('Counter', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='counters-text']",
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
							'label' => __('Icon Color', 'siteorigin-widgets'),
							'default' => '#FFFFFF',
						),

						'text' => array(
							'type' => 'text',
							'label' => __('Text', 'siteorigin-widgets'),
						),

						'number' => array(
							'type' => 'text',
							'label' => __('Number', 'siteorigin-widgets'),
						),
						'color' => array(
							'type' => 'color',
							'label' => __('Color', 'siteorigin-widgets'),
							'default' => '#FFFFFF',
						),
						
					),
				),

				'icon_size' => array(
					'type' => 'number',
					'label' => __('Icon Size', 'siteorigin-widgets'),
					'default' => 24,
				),

				'per_row' => array(
					'type' => 'number',
					'label' => __('Features Per Row', 'siteorigin-widgets'),
					'default' => 3,
				),

				

				'responsive' => array(
					'type' => 'checkbox',
					'label' => __('Responsive Layout', 'siteorigin-widgets'),
					'default' => true,
				),


			),
			plugin_dir_path(__FILE__).'../'
		);
	}

	function get_style_name($instance){
		return false;
	}

	function get_template_name($instance){
		return 'base';
	}

	function initialize() {
		
		$this->register_frontend_styles(
			array(
				array(
					'sow-counters',
					siteorigin_widget_get_plugin_dir_url( 'counters' ) . 'css/style.css',
					array(),
					SOW_BUNDLE_VERSION
				)
			)
		);
	}

	
}

siteorigin_widget_register('counters', __FILE__);