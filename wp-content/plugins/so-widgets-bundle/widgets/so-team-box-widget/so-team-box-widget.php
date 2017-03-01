<?php
/*
Widget Name: Team Box widget
Description: Displays a team memeber box.
Author: Greg Priday
Author URI: http://siteorigin.com
*/
class SiteOrigin_Widget_TeamBox_Widget extends SiteOrigin_Widget {
	function __construct() {
		parent::__construct(
			'sow-team-box',
			__( 'SiteOrigin Team Box', 'siteorigin-widgets' ),
			array(
				'description' => __('Displays a team member box', 'siteorigin-widgets' ),
				
			),
			array(),
			array(
			'heading' => array(
					'type' => 'section',
					'label'  => __( 'Topic', 'siteorigin-widgets' ),
					'hide'   => true,
					'fields' => array(
						'icon' => array(
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
						'sub_title' => array(
							'type' => 'text',
							'label' => __('Sub Title', 'siteorigin-widgets'),
						),
					
					),
					),
					'team_boxes' => array(
					'type' => 'repeater',
					'label' => __('Teams', 'siteorigin-widgets'),
					'item_name' => __('Team', 'siteorigin-widgets'),
					'item_label' => array(
						'selector' => "[id*='team_boxes-name']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'name' => array(
							'type' => 'text',
							'label' => __('Name', 'siteorigin-widgets'),
						),
						'image' => array(
						'type' => 'media',
						'label' => __('Image', 'siteorigin-widgets'),
						),
						'cpost' => array(
							'type' => 'text',
							'label' => __('Post in company', 'siteorigin-widgets'),
						),
						'shortintro' => array(
						  'type' => 'textarea',
						  'label' => __('Shot Intro', 'siteorigin-widgets'),
						  'description' => __('Enter the short introduction.', 'siteorigin-widgets'),
					  ),
					'social_address' => array(
					'type' => 'section',
					'label'  => __( 'Social Addresses', 'siteorigin-widgets' ),
					'hide'   => true,
					'fields' => array(
										
							'facebook' => array(
								'type' => 'text',
								'label' => __('Facebook personal address.', 'siteorigin-widgets'),
							),
							'twitter' => array(
								'type' => 'text',
								'label' => __('Twitter personal address.', 'siteorigin-widgets'),
							),
							
							'linkedin' => array(
								'type' => 'text',
								'label' => __('Linkedin personal address.', 'siteorigin-widgets'),
							),
			
							'gplus' => array(
								'type' => 'text',
								'label' => __('Google Plus personal address.', 'siteorigin-widgets'),
							),
			
			
							'behance' => array(
								'type' => 'text',
								'label' => __('Behance personal address.', 'siteorigin-widgets'),
							),
							'dribble' => array(
								'type' => 'text',
								'label' => __('Dribble personal address.', 'siteorigin-widgets'),
							),
								
					),),
					
					),
					),
				
				'per_row' => array(
					'type' => 'number',
					'label' => __('Items per row', 'siteorigin-widgets'),
					'default' => 3,
				),
				
				'new_window' => array(
					'type' => 'checkbox',
					'label' => __('Open In New Window', 'siteorigin-widgets'),
				),
				
				'responsive' => array(
					'type' => 'checkbox',
					'label' => __('Responsive layout', 'siteorigin-widgets'),
					'default' => true,
				),	'section' => array(
						'type' => 'select',
						'label' => __( 'Section', 'siteorigin-widgets' ),							
						'options' => array(								
						'grey-section' => __( 'Grey Section', 'siteorigin-widgets' ),
						'white-section' => __( 'White Section', 'siteorigin-widgets' ),
										
						)
					),
			)
		);	
	}

	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'siteorigin-team-box',
					siteorigin_widget_get_plugin_dir_url( 'team-box' ) . 'css/style.css',
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
siteorigin_widget_register('team-box', __FILE__);