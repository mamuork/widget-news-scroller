<?php
/*
Plugin Name: Widget News Scroller
Plugin URI: http://about.me/alessandro.mignogna
Description: A widget to display some news with jquery scroll
Version: 1.0.1
Author: Mamuork
Author URI: http://about.me/alessandro.mignogna
Author Email: mamuork@gmail.com
Text Domain: widget-news-scroller
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2013 (mamuork@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*----------------------------------------------------------------------------*
 * Config file with constants and variables
 *----------------------------------------------------------------------------*/

/*
 *
 */
require_once( plugin_dir_path( __FILE__ ) . '/config.php' );


class Widget_News_Scroller extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'widget_textdomain' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// TODO:	update classname and description
		// TODO:	replace 'widget-name-locale' to be named more plugin specific. Other instances exist throughout the code, too.
		parent::__construct(
			'widget-news-scroller',
			__( 'Widget News Scroller', 'widget-news-scroller' ),
			array(
				'classname'		=>	'widget-name-scroller',
				'description'	=>	__( 'A powerful widget to show news in carousel mode. Supports custom post types.', 'widget-news-scroller' )
			)
		);

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		// TODO:	Here is where you manipulate your widget's values based on their input fields

		include( plugin_dir_path( __FILE__ ) . '/views/widget.php' );

		echo $after_widget;

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The new instance of values to be generated via the update.
	 * @param	array	old_instance	The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance["title"] = strip_tags( $new_instance['title'] );		
		$instance["posttype"] = strip_tags( $new_instance['posttype'] );
		$instance["category"] = strip_tags( $new_instance['category'] );
		$instance["showposts"] = strip_tags( $new_instance['showposts'] );
		$instance["excerptlength"] = strip_tags( $new_instance['excerptlength'] );
		$instance["thumbnail"] = strip_tags( $new_instance['thumbnail'] );
		$instance["thumbnailsize"] = strip_tags( $new_instance['thumbnailsize'] );
		$instance["archiveurl"] = strip_tags( $new_instance['archiveurl'] );

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {
		/* Impostazioni di default del widget */
        $default = array(
        	'title' => '',
			'posttype' => 'post',
			'category' => 1,
			'showposts' => 3,
			'excerptlength' => 50,
			'thumbnail' => 1,
			'thumbnailsize' => 'thumbnail',
			'archiveurl' => ''
		);     
		
		$instance = wp_parse_args( (array) $instance, $default );
		
		if ( empty( $instance['title'] ) ) {
			$instance['title'] = $default['title'];
		}
		if ( empty( $instance['posttype'] ) ) {
			$instance['posttype'] = $default['posttype'];
		}
		if ( empty( $instance['category'] ) ) {
			$instance['category'] = $default['category'];
		}
		if ( empty( $instance['showposts'] ) ) {
			$instance['showposts'] = $default['showposts'];
		}
		if ( empty( $instance['excerptlength'] ) ) {
			$instance['excerptlength'] = $default['excerptlength'];
		}
		if ( empty( $instance['thumbnail'] ) ) {
			$instance['thumbnail'] = $default['thumbnail'];
		}
		if ( empty( $instance['thumbnailsize'] ) ) {
			$instance['thumbnailsize'] = $default['thumbnailsize'];
		}
		if ( empty( $instance['archiveurl'] ) ) {
			$instance['archiveurl'] = $default['archiveurl'];
		}
		
		global $thumbnailsizes;
		global $posttypes;
		global $categories;
		$thumbnailsizes = get_intermediate_image_sizes();
		$posttypes = get_post_types( array('public' => true) , 'names' );
		$catargs = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> 'category',
			'pad_counts'	=> false 
		); 
		$categories = get_categories( $catargs );
		
		// Display the admin form
		include( plugin_dir_path(__FILE__) . '/views/admin.php' );

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function widget_textdomain() {
		
		$domain = 'widget-news-scroller';
		// load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	

	} // end widget_textdomain

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param		boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {
		
	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {
		// TODO define deactivation functionality here
	} // end deactivate

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {

		wp_enqueue_style( 'widget-news-scroller-admin-styles', plugins_url( 'widget-news-scroller/css/admin.css' ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {

		wp_enqueue_script( 'widget-news-scroller-admin-script', plugins_url( 'widget-news-scroller/js/admin.js' ), array('jquery') );

	} // end register_admin_scripts

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {

		wp_enqueue_style( 'widget-news-scroller-widget-styles', plugins_url( 'widget-news-scroller/css/widget.css' ) );

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {

		wp_enqueue_script( 'jquery.carouFredSel-6.2.1-packed', plugins_url( 'widget-news-scroller/js/jquery.carouFredSel-6.2.1-packed.js' ), array('jquery') );
	//	wp_enqueue_script( 'widget-news-scroller-script', plugins_url( 'widget-news-scroller/js/widget.js' ), array('jquery') );
		
		//$params = array('number' => $this->number,);
		//wp_localize_script( 'widget-news-scroller-script', 'scrollerparam', $params );

	} // end register_widget_scripts

} // end class

add_action( 'widgets_init', create_function( '', 'register_widget("Widget_News_Scroller");' ) );
