<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {


            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            +
            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'lenard'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'lenard'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'lenard'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'lenard'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'lenard'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'lenard') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'lenard'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('General Options', 'lenard'),
                'icon'      => 'el-icon-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(

                    array(
                        'id'        => 'logo',
                        'type'      => 'media',
                        'title'     => __('Logo Normal', 'lenard'),
                        'compiler'  => 'true',
                        'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => __('Upload header logo for your website', 'lenard'),
                        
                    ),
                    
                    array( 
                        'id'       => 'custom_color',
                        'type'     => 'color',
                        'title'    => __('Your Custom Color', 'lenard'),
                        'subtitle' => __('Select an custom color scheme.', 'lenard'),
                    ),
                    
                   
                    array(
                        'id'        => 'blog_title',
                        'type'      => 'switch',
                        'title'     => __('Logo Text', 'lenard'),
                        'subtitle'  => __('Display Site Title from WP General Settings', 'lenard'),
                        'default'   => '1',
                    ),


                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'title'     => __('Favicon', 'lenard'),
                        'compiler'  => 'true',
                        'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => __('Upload favicon for your website', 'lenard'),
                        
                    ),
                    
                    array(
                        'id'        => 'preloader',
                        'type'      => 'switch',
                        'title'     => __('Activate preloader', 'lenard'),
                        'subtitle'  => __('Smooth page loader for your site', 'lenard'),
                        'default'   => '1',
                    ),

                    array(
                        'id'        => 'preloader-logo',
                        'type'      => 'media',
                        'title'     => __('Logo in the Preloader', 'lenard'),
                        'compiler'  => 'true',
                        'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => __('Upload logo to be displayed on prelaoder', 'lenard'),
                        
                    ),

                ),
            );
            
            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Menu Options', 'lenard'),
                'fields'    => array(
                    
                    
                     array(
                        'id'        => 'search',
                        'type'      => 'switch',
                        'title'     => __('Show Search', 'lenard'),
                        'subtitle'  => __('Show serach button on the header', 'lenard'),
                        'default'   => '1',
                    ),

                    array(
                        'id'        => 'topbar',
                        'type'      => 'switch',
                        'title'     => __('Show Topbar', 'lenard'),
                        'subtitle'  => __('Show top bar on the header ', 'lenard'),
                        'default'   => '0',
                    ),
                    
                    array(
                        'id'        => 'topbar-socialicons',
                        'type'      => 'switch',
                        'title'     => __('Show Social icons ', 'lenard'),
                        'subtitle'  => __('Show social icons top bar on the header ', 'lenard'),
                        'default'   => '1',
                    ),
                    
                   
                   
                   
                     array(
                        'id'        => 'background-image',
                        'type'      => 'media',
                        'title'     => __('Menu background image', 'lenard'),
                        'compiler'  => 'true',
                        'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => __('Upload image to be displayed on menubar', 'lenard'),
                        
                    ),
                   
                    
                )
            );
            
            $this->sections[] = array(
                'icon'      => 'el-icon-th',
                'title'     => __('Footer Options', 'lenard'),
                'fields'    => array(

                     array(
                        'id'        => 'background-image-footer',
                        'type'      => 'media',
                        'title'     => __('Footer background image', 'lenard'),
                        'compiler'  => 'true',
                        'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle'  => __('Upload image to be displayed on footer', 'lenard'),
                        
                    ),
                   


                    array(
                        'id'        => 'footer_text',
                        'type'      => 'editor',
                        'title'     => __('Footer Text', 'lenard'),
                        'subtitle'  => __('The text written here will be display in footer', 'lenard'),
                        'default'   => 'Copyright 2014, ',
                    ),

                    array(
                        'id'        => 'footer-social',
                        'type'      => 'switch',
                        'title'     => __('Social Icons', 'lenard'),
                        'subtitle'  => __('Display social icons on footer', 'lenard'),
                        'default'   => '1',
                    ),
                     array(
                        'id'        => 'footer-social-number',
                        'type'      => 'text',
                        'title'     => __('Number of Icons', 'lenard'),
                        'subtitle'  => __('Display number of social icons in footer(max 6)', 'lenard'),
                        'default'   => '6',
                    ),
                      array(
                        'id'        => 'footer-map',
                        'type'      => 'switch',
                        'title'     => __('Map', 'lenard'),
                        'subtitle'  => __('Display map on footer', 'lenard'),
                        'default'   => '1',
                    ),
                     array(
                        'id'        => 'footer-map-location',
                        'type'      => 'text',
                        'title'     => __('Location', 'lenard'),
                        'subtitle'  => __('Display location in map', 'lenard'),
                        'default'   =>'Boston,USA',
                    ),
                    
                    array(
                        'id'        => 'footer-style2',
                        'type'      => 'switch',
                        'title'     => __('Footer Style 2', 'lenard'),
                        'subtitle'  => __('Try our alternative footer style?', 'lenard'),
                        'default'   => '1',
                    ),


                    array(
                        'id'        => 'footer-layout',
                        'type'      => 'image_select',
                        'title'     => __('Option for Footer Layout', 'lenard'),
                        
                        //Must provide key => value(array:title|img) pairs for radio options
                        'options'   => array(
                            '1' => array('alt' => '1 Column',        'img' => ReduxFramework::$_url . 'assets/img/ft-1cl.png'),
                            '2' => array('alt' => '2 Column',        'img' => ReduxFramework::$_url . 'assets/img/ft-2cl.png'),
                            '3' => array('alt' => '2 Column Left',   'img' => ReduxFramework::$_url . 'assets/img/ft-2cl2.png'),
                            '4' => array('alt' => '2 Column Right',  'img' => ReduxFramework::$_url . 'assets/img/ft-2cl3.png'),
                            '5' => array('alt' => '2 Column Middle', 'img' => ReduxFramework::$_url . 'assets/img/ft-2cl4.png'),
                            '6' => array('alt' => '3 Column       ', 'img' => ReduxFramework::$_url . 'assets/img/ft-3cl.png'),
                            '7' => array('alt' => '3 Column Left',   'img' => ReduxFramework::$_url . 'assets/img/ft-3cl2.png'),
                            '8' => array('alt' => '3 Column Right',  'img' => ReduxFramework::$_url . 'assets/img/ft-3cl3.png'),
                            '9' => array('alt' => '3 Column middle','img' => ReduxFramework::$_url . 'assets/img/ft-3cl4.png'),
                            '10' => array('alt' => '4 Column      ',  'img' => ReduxFramework::$_url . 'assets/img/ft-4cl.png')
                        ), 
                        'default' => '2'
                    ),
                    
                    array(
                        'id'        => 'footer-on',
                        'type'      => 'switch',
                        'title'     => __('Display Footer', 'lenard'),
                        'subtitle'  => __('You can hide/show footer.', 'lenard'),
                        'default'   => '1',
                    ),
                    
                     array(
                        'id'        => 'secondfooter-on',
                        'type'      => 'switch',
                        'title'     => __('Display Secondary Footer', 'lenard'),
                        'subtitle'  => __('You can hide/show secondary footer.', 'lenard'),
                        'default'   => '1',
                    ),
                     array(
                        'id'        => 'footer-title',
                        'type'      => 'text',
                        'title'     => __('Footer Title', 'lenard'),
                        'subtitle'  => __('The title written here will be displayed in footer', 'lenard'),
                    ),
                     array(
                        'id'        => 'footer-subtitle',
                        'type'      => 'text',
                        'title'     => __('Footer Subtitle', 'lenard'),
                        'subtitle'  => __('The subtitle written here will be displayed in footer', 'lenard'),
                    ),
                    
                )
            );
            
            
           

           


            $this->sections[] = array(
                'icon'      => 'el-icon-bullhorn',
                'title'     => __('Social Icons', 'lenard'),
                'desc'      => __('<p class="description">You need to provide social details to display the social icons on footer.</p>', 'lenard'),
                'fields'    => array(
                    array(
                        'id'        => 'social_facebook',
                        'type'      => 'text',
                        'title'     => __('Facebook URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_twitter',
                        'type'      => 'text',
                        'title'     => __('Twitter URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_googlep',
                        'type'      => 'text',
                        'title'     => __('Google Plus URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_linkedin',
                        'type'      => 'text',
                        'title'     => __('LinkedIn URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_pinterest',
                        'type'      => 'text',
                        'title'     => __('Pinterest URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_skype',
                        'type'      => 'text',
                        'title'     => __('Skype URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_dribbble',
                        'type'      => 'text',
                        'title'     => __('Dribbble URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'social_instagram',
                        'type'      => 'text',
                        'title'     => __('Instagram URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_tumblr',
                        'type'      => 'text',
                        'title'     => __('Tumblr URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_youtube',
                        'type'      => 'text',
                        'title'     => __('Youtube URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social_vimeo',
                        'type'      => 'text',
                        'title'     => __('Vimeo URL', 'lenard'),
                        'validate'  => 'url',
                    ), array(
                        'id'        => 'social_behance',
                        'type'      => 'text',
                        'title'     => __('Behance URL', 'lenard'),
                        'validate'  => 'url',
                    ),
                )
            );

            


            $this->sections[] = array(
                'icon'      => 'el-icon-check',
                'title'     => __('Custom CSS', 'lenard'),
                'desc'      => __('<p class="description">You can add custom CSS to override existing theme design.</p>', 'lenard'),
                'fields'    => array(
                   array(
                        'id'        => 'extra-css',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'lenard'),
                        'subtitle'  => __('Paste your CSS code here.', 'lenard'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                    ),
                 

                )
            );
            
        
           

            $this->sections[] = array(
                'title'     => __('Import / Export', 'lenard'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'lenard'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     

            

        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'lenard'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'lenard')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'lenard'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'lenard')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'lenard');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'lenard_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => 'LENARD',     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'lenard'),
                'page_title'        => __('Theme Options', 'lenard'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                 'footer_credit'     => ' Theme Optional Panel',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );


            // Add content after the form.
            $this->args['footer_text'] = __('<p>Please get to us if you have any suggestions.</p>', 'lenard');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}
