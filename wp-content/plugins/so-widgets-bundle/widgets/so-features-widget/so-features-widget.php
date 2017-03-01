<?php
/*
Widget Name: Features widget
Description: Displays a block of features with icons.
Author: Greg Priday
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_Features_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-features',
			__( 'SiteOrigin Features', 'siteorigin-widgets' ),
			array(
				'description' => __( 'Displays a list of features.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/features-widget-documentation/'
			),
			array(),
			array(
					'icon_main' => array(
							'type' => 'icon',
							'label' => __('Icon', 'siteorigin-widgets'),
						),

						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'siteorigin-widgets'),
							  ),
					  'subtitle' => array(
						  'type' => 'text',
						  'label' => __('Subtile', 'siteorigin-widgets'),
					  ),
					  'description' => array(
						  'type' => 'textarea',
						  'label' => __('Description', 'siteorigin-widgets'),
					  ),
				'features' => array(
					'type' => 'repeater',
					'label' => __('Features', 'siteorigin-widgets'),
					'item_name' => __('Feature', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='features-title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(

						'icon' => array(
							'type' => 'icon',
							'label' => __('Icon', 'siteorigin-widgets'),
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
							'label' => __('More link URL', 'siteorigin-widgets'),
							'sanitize' => 'url',
						),
					),
				),

				
				
				'icon_size' => array(
					'type' => 'number',
					'label' => __('Icon size', 'siteorigin-widgets'),
					'default' => 24,
				),

				'per_row' => array(
					'type' => 'number',
					'label' => __('Items per row', 'siteorigin-widgets'),
					'default' => 3,
				),
				'animation' => array(
							'type' => 'select',
							'label' => __('Feature icon animation', 'siteorigin-widgets'),
							'options' => array(
								'none' => __('none', 'siteorigin-widgets'),
								'bounce' => __('bounce', 'siteorigin-widgets'),
								'flash' => __('flash', 'siteorigin-widgets'),
								'pulse' => __('pulse', 'siteorigin-widgets'),
								'rubberBand' => __('rubberBand', 'siteorigin-widgets'),
								'shake' => __('shake', 'siteorigin-widgets'),
								'swing' => __('swing', 'siteorigin-widgets'),
								'tada' => __('tada', 'siteorigin-widgets'),
								'wobble' => __('wobble', 'siteorigin-widgets'),
								'bounceIn' => __('bounceIn', 'siteorigin-widgets'),
								'bounceInDown' => __('bounceInDown', 'siteorigin-widgets'),
								'bounceInLeft' => __('bounceInLeft', 'siteorigin-widgets'),
								'bounceInRight' => __('bounceInRight', 'siteorigin-widgets'),
								'bounceInUp' => __('bounceInUp', 'siteorigin-widgets'),								
								'fadeInDown' => __('fadeInDown', 'siteorigin-widgets'),
								'fadeInDownBig' => __('fadeInDownBig', 'siteorigin-widgets'),
								'fadeInLeft' => __('fadeInLeft', 'siteorigin-widgets'),
								'fadeInLeftBig' => __('fadeInLeftBig', 'siteorigin-widgets'),
								'fadeInRight' => __('fadeInRight', 'siteorigin-widgets'),
								'fadeInRightBig' => __('fadeInRightBig', 'siteorigin-widgets'),
								'fadeInUp' => __('fadeInUp', 'siteorigin-widgets'),
								'fadeInUpBig' => __('fadeInUpBig', 'siteorigin-widgets'),								
								'flipInX' => __('flipInX', 'siteorigin-widgets'),
								'flipInY' => __('flipInY', 'siteorigin-widgets'),
								'rotateIn' => __('rotateIn', 'siteorigin-widgets'),
								'rotateInDownLeft' => __('rotateInDownLeft', 'siteorigin-widgets'),
								'rotateInDownRight' => __('rotateInDownRight', 'siteorigin-widgets'),
								'rotateInUpLeft' => __('rotateInUpLeft', 'siteorigin-widgets'),
								'rotateInUpRight' => __('rotateInUpRight', 'siteorigin-widgets'),
								'slidedown' => __('slidedown', 'siteorigin-widgets'),
								'slideup' => __('slideup', 'siteorigin-widgets'),
								'slide' => __('slide', 'siteorigin-widgets'),
								'slidefade' => __('slidefade', 'siteorigin-widgets'),
								'flow' => __('flow', 'siteorigin-widgets'),
								'turn' => __('turn', 'siteorigin-widgets'),
								'pop' => __('pop', 'siteorigin-widgets'),
								'flip' => __('flip', 'siteorigin-widgets'),
								'fade' => __('fade', 'siteorigin-widgets'),
							)
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
					'siteorigin-features',
					siteorigin_widget_get_plugin_dir_url( 'features' ) . 'css/style.css',
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

siteorigin_widget_register('features', __FILE__);