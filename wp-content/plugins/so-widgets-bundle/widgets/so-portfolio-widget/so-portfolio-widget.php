<?php
/*
Widget Name: Portfolio widget
Description: A very simple portfolio widget.
Author: Greg Priday
Author URI: http://siteorigin.com
*/
class SiteOrigin_Widget_Portfolio_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-portfolio',
			__('SiteOrigin Portfolio', 'siteorigin-widgets'),
			array(
				'description' => __('A very simple portfolio widget.', 'siteorigin-widgets'),
				
			),
			array(

			),
			array(	'icon' => array(
							'type' => 'icon',
							'label' => __('Icon', 'siteorigin-widgets'),
						),
						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'siteorigin-widgets'),
						),
						
						'divider' => array(
							'type' => 'checkbox',
							'label' => __('Want divider?', 'siteorigin-widgets'),
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
	function get_template_name($instance) {
		return 'base';
	}
	function get_style_name($instance) {
		return false;
	}

}
siteorigin_widget_register('portfolio', __FILE__);