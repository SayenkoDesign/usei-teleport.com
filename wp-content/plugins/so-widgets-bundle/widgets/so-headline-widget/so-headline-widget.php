<?php

/*
Widget Name: Headline widget
Description: A headline to headline all headlines.
Author: SiteOrigin
Author URI: http://siteorigin.com
*/

class SiteOrigin_Widget_Headline_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'sow-headline',
			__( 'SiteOrigin Headline', 'siteorigin-widgets' ),
			array(
				'description' => __( 'A headline widget.', 'siteorigin-widgets' ),
				'help'        => 'http://siteorigin.com/widgets-bundle/headline-widget-documentation/'
			),
			array(),
			array(
				
				'headline' => array(
					'type' => 'section',
					'label'  => __( 'Headline', 'siteorigin-widgets' ),
					'hide'   => false,
					'fields' => array(
					
						'text' => array(
							'type' => 'text',
							'label' => __( 'Text', 'siteorigin-wdigets' ),
						),
						
						'color' => array(
							'type' => 'color',
							'label' => __('Color', 'siteorigin-widgets'),
							'default' => '#000000'
						),
						'align' => array(
							'type' => 'select',
							'label' => __( 'Align', 'siteorigin-widgets' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'siteorigin-widgets' ),
								'left' => __( 'Left', 'siteorigin-widgets' ),
								'right' => __( 'Right', 'siteorigin-widgets' ),
								'justify' => __( 'Justify', 'siteorigin-widgets' )
							)
						)
					)
				),
				'sub_headline' => array(
					'type' => 'section',
					'label'  => __( 'Sub headline', 'siteorigin-widgets' ),
					'hide'   => true,
					'fields' => array(
						'text' => array(
							'type' => 'text',
							'label' => __('Text', 'siteorigin-wdigets')
						),
						
						'color' => array(
							'type' => 'color',
							'label' => __('Color', 'siteorigin-widgets'),
							'default' => '#000000'
						),
						'align' => array(
							'type' => 'select',
							'label' => __( 'Align', 'siteorigin-widgets' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'siteorigin-widgets' ),
								'left' => __( 'Left', 'siteorigin-widgets' ),
								'right' => __( 'Right', 'siteorigin-widgets' ),
								'justify' => __( 'Justify', 'siteorigin-widgets' )
							)
						)
					)
				),
				'divider' => array(
					'type' => 'section',
					'label' => __( 'Divider', 'siteorigin-widgets' ),
					'hide' => true,
					'fields' => array(
					'divider_checkbox' => array(
							'type' => 'checkbox',
							'label' => __( 'Want Divider?', 'siteorigin-widgets' ),
							'default' => true,
							
						),							
						
					)
				),
				'style' => array(
							'type' => 'select',
							'label' => __( 'Style', 'siteorigin-widgets' ),							
							'options' => array(								
								'left' => __( 'Lenard simple left', 'siteorigin-widgets' ),
								'none' => __( 'Normal', 'siteorigin-widgets' ),
												
							)
						),
				
			)
		);
	}

	function get_style_name( $instance ) {
		return 'sow-headline';
	}

	function get_less_variables( $instance ) {
		$less_vars = array();

		if ( ! empty( $instance['headline'] ) ) {
			$headline_styles = $instance['headline'];
			if ( ! empty( $headline_styles['align'] ) ) {
				$less_vars['headline_align'] = $headline_styles['align'];
			}
			if ( ! empty( $headline_styles['color'] ) ) {
				$less_vars['headline_color'] = $headline_styles['color'];
			}
			
		}

		if ( ! empty( $instance['sub_headline'] ) ) {
			$sub_headline_styles = $instance['sub_headline'];
			if ( ! empty( $sub_headline_styles['align'] ) ) {
				$less_vars['sub_headline_align'] = $sub_headline_styles['align'];
			}
			if ( ! empty( $sub_headline_styles['color'] ) ) {
				$less_vars['sub_headline_color'] = $sub_headline_styles['color'];
			}
			
		}

		

		return $less_vars;
	}

	

	function get_template_name( $instance ) {
		return 'headline';
	}

	function get_template_variables( $instance, $args ) {
		if( empty( $instance ) ) return array();

		return array(
			'headline' => $instance['headline']['text'],
			'sub_headline' => $instance['sub_headline']['text'],
			'has_divider' => ! empty( $instance['divider'] ) 
		);
	}
}

siteorigin_widget_register('headline', __FILE__);