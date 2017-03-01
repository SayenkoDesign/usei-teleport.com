<?php
/*
Widget Name: Tabs Widget
Description: Displays a block of tabs .
Version: trunk
Author: Sunil chaulagain
Author URI: http://tuchuk.com
*/

class SiteOrigin_Widget_Tabs_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-tabs',
			__( 'SiteOrigin Tabs', 'siteorigin-widgets' ),
			array(
				'description' => __( 'Displays a group of tabs.', 'siteorigin-widgets' ),
			),
			array(),
			array(
				'tabs' => array(
					'type' => 'repeater',
					'label' => __('Tabs', 'siteorigin-widgets'),
					'item_name' => __('Tab', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='tabs-title']",
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
							'label' => __('Title Text', 'siteorigin-widgets'),
						),

						'text' => array(
							'type' => 'textarea',
							'label' => __('Text', 'siteorigin-widgets'),
						),

						'active' => array(
							'type' => 'checkbox',
							'label' => __('Is this active tab ? ', 'siteorigin-widgets'),
							'default' => false,
						),

						
					),),
					'animation' => array(
							'type' => 'select',
							'label' => __('Feature icon animation', 'siteorigin-panels'),
							'options' => array(
								'none' => __('none', 'siteorigin-panels'),
								'bounce' => __('bounce', 'siteorigin-panels'),
								'flash' => __('flash', 'siteorigin-panels'),
								'pulse' => __('pulse', 'siteorigin-panels'),
								'rubberBand' => __('rubberBand', 'siteorigin-panels'),
								'shake' => __('shake', 'siteorigin-panels'),
								'swing' => __('swing', 'siteorigin-panels'),
								'tada' => __('tada', 'siteorigin-panels'),
								'wobble' => __('wobble', 'siteorigin-panels'),
								'bounceIn' => __('bounceIn', 'siteorigin-panels'),
								'bounceInDown' => __('bounceInDown', 'siteorigin-panels'),
								'bounceInLeft' => __('bounceInLeft', 'siteorigin-panels'),
								'bounceInRight' => __('bounceInRight', 'siteorigin-panels'),
								'bounceInUp' => __('bounceInUp', 'siteorigin-panels'),								
								'fadeInDown' => __('fadeInDown', 'siteorigin-panels'),
								'fadeInDownBig' => __('fadeInDownBig', 'siteorigin-panels'),
								'fadeInLeft' => __('fadeInLeft', 'siteorigin-panels'),
								'fadeInLeftBig' => __('fadeInLeftBig', 'siteorigin-panels'),
								'fadeInRight' => __('fadeInRight', 'siteorigin-panels'),
								'fadeInRightBig' => __('fadeInRightBig', 'siteorigin-panels'),
								'fadeInUp' => __('fadeInUp', 'siteorigin-panels'),
								'fadeInUpBig' => __('fadeInUpBig', 'siteorigin-panels'),								
								'flipInX' => __('flipInX', 'siteorigin-panels'),
								'flipInY' => __('flipInY', 'siteorigin-panels'),
								'rotateIn' => __('rotateIn', 'siteorigin-panels'),
								'rotateInDownLeft' => __('rotateInDownLeft', 'siteorigin-panels'),
								'rotateInDownRight' => __('rotateInDownRight', 'siteorigin-panels'),
								'rotateInUpLeft' => __('rotateInUpLeft', 'siteorigin-panels'),
								'rotateInUpRight' => __('rotateInUpRight', 'siteorigin-panels'),
								'slidedown' => __('slidedown', 'siteorigin-panels'),
								'slideup' => __('slideup', 'siteorigin-panels'),
								'slide' => __('slide', 'siteorigin-panels'),
								'slidefade' => __('slidefade', 'siteorigin-panels'),
								'flow' => __('flow', 'siteorigin-panels'),
								'turn' => __('turn', 'siteorigin-panels'),
								'pop' => __('pop', 'siteorigin-panels'),
								'flip' => __('flip', 'siteorigin-panels'),
								'fade' => __('fade', 'siteorigin-panels'),
							)
						),
					


					

				'icon_size' => array(
					'type' => 'number',
					'label' => __('Icon size', 'siteorigin-widgets'),
					'default' => 24,
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
					'siteorigin-tabs',
					siteorigin_widget_get_plugin_dir_url( 'tabs' ) . 'css/style.css',
					array(),
					SOW_BUNDLE_VERSION
				)
			)
		);
	}

	
}
siteorigin_widget_register('tabs', __FILE__);