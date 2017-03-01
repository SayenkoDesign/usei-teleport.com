<?php
/*
Widget Name: Slider widget
Description: A very simple slider widget.
Author: Greg Priday
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_Slider_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-slider',
			__('SiteOrigin Slider', 'siteorigin-widgets'),
			array(
				'description' => __('A responsive slider widget that supports images and video.', 'siteorigin-widgets'),
				'help' => 'http://siteorigin.com/widgets-bundle/slider-widget-documentation/',
				'panels_title' => false,
			),
			array(

			),
			array(

				'frames' => array(
					'type' => 'repeater',
					'label' => __('Slider frames', 'siteorigin-widgets'),
					'item_name' => __('Frame', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='frames-url']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						
					

						'background_image' => array(
							'type' => 'media',
							'library' => 'image',
							'label' => __('Background image', 'siteorigin-widgets'),
						),

						'background_image_type' => array(
							'type' => 'select',
							'label' => __('Background image type', 'siteorigin-widgets'),
							'options' => array(
								'cover' => __('Cover', 'siteorigin-widgets'),
								'tile' => __('Tile', 'siteorigin-widgets'),
							),
							'default' => 'cover',
						),


						
						'layertitle' => array(
							'type' => 'textarea',
							'label' => __('Layer title', 'siteorigin-widgets'),
						),

						'layersubtitle' => array(
							'type' => 'text',
							'label' => __('Layer subtitle', 'siteorigin-widgets'),
						),
						'purchasenowtext' => array(
							'type' => 'text',
							'label' => __('Purchase Now Text', 'siteorigin-widgets'),
							
						),
						'purchasenowurl' => array(
							'type' => 'text',
							'label' => __('Purchase Now URL', 'siteorigin-widgets'),
							
						),
						'new_window1' => array(
						'type' => 'checkbox',
						'label' => __('Open More URL in New Window', 'siteorigin-widgets'),
						'default' => false,
						),
						
						'moretext' => array(
							'type' => 'text',
							'label' => __('More Link Text', 'siteorigin-widgets'),
							
						),
						'moreurl' => array(
							'type' => 'text',
							'label' => __('More Link URL', 'siteorigin-widgets'),
						
						),
						'new_window' => array(
						'type' => 'checkbox',
						'label' => __('Open Purchase URL in New Window', 'siteorigin-widgets'),
						'default' => false,
						),
					),
				),

				'speed' => array(
					'type' => 'number',
					'label' => __('Animation speed', 'siteorigin-widgets'),
					'description' => __('Animation speed in milliseconds.', 'siteorigin-widgets'),
					'default' => 800,
				),
				'animation' => array(
							'type' => 'select',
							'label' => __('Animation', 'siteorigin-widgets'),
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

				

			),
			plugin_dir_path(__FILE__).'../'
		);
	}

	function initialize() {

		$frontend_scripts = array();
		$frontend_scripts[] = array(
			'sow-slider-slider-cycle2',
			siteorigin_widget_get_plugin_dir_url( 'slider' ) . 'js/jquery.cycle' . SOW_BUNDLE_JS_SUFFIX . '.js',
			array( 'jquery' ),
			SOW_BUNDLE_VERSION
		);
		if( wp_is_mobile() ) {
			$frontend_scripts[] = array(
				'sow-slider-slider-cycle2-swipe',
				siteorigin_widget_get_plugin_dir_url( 'slider' ) . 'js/jquery.cycle.swipe' . SOW_BUNDLE_JS_SUFFIX . '.js',
				array( 'jquery' ),
				SOW_BUNDLE_VERSION
			);
		}
		$frontend_scripts[] = array(
			'sow-slider-slider',
			siteorigin_widget_get_plugin_dir_url( 'slider' ) . 'js/slider' . SOW_BUNDLE_JS_SUFFIX . '.js',
			array( 'jquery' ),
			SOW_BUNDLE_VERSION
		);

		$this->register_frontend_scripts( $frontend_scripts );
		$this->register_frontend_styles(
			array(
				array(
					'sow-slider-slider',
					siteorigin_widget_get_plugin_dir_url( 'slider' ) . 'css/slider.css',
					array(),
					SOW_BUNDLE_VERSION
				)
			)
		);
	}

	

	/**
	 * Creates an instance from a gallery shortcode.
	 *
	 * @param $shortcode
	 */
	static function instance_from_gallery($shortcode){

	}

	function get_style_name($instance){
		return 'base';
	}

	function get_template_name($instance){
		return 'base';
	}

	

}

siteorigin_widget_register('slider', __FILE__);
