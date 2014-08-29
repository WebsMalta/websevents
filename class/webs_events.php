<?php

class Webs_Events {
	
	/**
	 * Webs_Events singleton instance
	 * 
	 * (default value: null)
	 * 
	 * @var Webs_Events instance
	 * @access private
	 * @static
	 */
	private static $instance = null;
	
	
	/**
	 * Creates or returns a new instance of the plugin manager
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function get_instance()
	{
		if ( self::$instance == null ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	

	/**
	 * Generates a new instance of the plugin Manager
	 * 
	 * @access private
	 * @return void
	 */
	private function __construct ()
	{
		$this->register_events_post_type();
		$this->register_events_taxonomies();
		$this->load_events_templates();
		
		$we_meta_boxes = new WE_Meta_Boxes();
	}

	/**
	 * Register the Events custom post type.
	 * 
	 * @access private
	 * @return void
	 */
	private function register_events_post_type ()
	{	
		if ( ! function_exists('webs_events_registrar') ) {

			// Register Custom Post Type
			function webs_events_registrar() {
			
				$labels = array(
					'name'                => _x( 'Events', 'Events General Name', 'webs_events' ),
					'singular_name'       => _x( 'Event', 'Events Singular Name', 'webs_events' ),
					'menu_name'           => __( 'Events', 'webs_events' ),
					'all_items'           => __( 'All Events', 'webs_events' ),
					'view_item'           => __( 'View Event', 'webs_events' ),
					'add_new_item'        => __( 'Add New Event', 'webs_events' ),
					'add_new'             => __( 'Add New', 'webs_events' ),
					'edit_item'           => __( 'Edit Event', 'webs_events' ),
					'update_item'         => __( 'Update Event', 'webs_events' ),
					'search_items'        => __( 'Search Event', 'webs_events' ),
					'not_found'           => __( 'Event not found', 'webs_events' ),
					'not_found_in_trash'  => __( 'Event not found in Trash', 'webs_events' ),
				);
				$rewrite = array(
					'slug'                => 'events',
					'with_front'          => true,
					'pages'               => true,
					'feeds'               => true,
				);
				$args = array(
					'label'               => __( 'webs_event', 'webs_events' ),
					'description'         => __( 'Events for being displayed on the site', 'webs_events' ),
					'labels'              => $labels,
					'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields' ),
					//'taxonomies'          => array( 'webs_events_category' ),
					'hierarchical'        => false,
					'public'              => true,
					'show_ui'             => true,
					'show_in_menu'        => true,
					'show_in_nav_menus'   => true,
					'show_in_admin_bar'   => true,
					'menu_position'       => 5,
					'menu_icon'           => 'dashicons-calendar',
					'can_export'          => true,
					'has_archive'         => true,
					'exclude_from_search' => false,
					'publicly_queryable'  => true,
					'rewrite'             => $rewrite,
					'capability_type'     => 'post',
				);
				register_post_type( 'webs_event', $args );
			
			}
			
			// Hook into the 'init' action
			add_action( 'init', 'webs_events_registrar', 0 );
		}
	}
	
	/**
	 * Register the Events taxonomies
	 * 
	 * @access private
	 * @return void
	 */
	private function register_events_taxonomies ()
	{
		function webs_events_category_registrar ()
		{
			$args = array(
				'hierarchical' => true,
			);
			register_taxonomy( 'webs_events_category', 'webs_event', $args );
		}
		add_action( 'init', 'webs_events_category_registrar' );
	}
	
	private function load_events_templates ()
	{
		// Single event template
		function webs_events_single_template ( $single )
		{
			global $wp_query, $post;
			/* Checks for single template by post type */
			if ( $post->post_type == "webs_event" )
			{
				if( file_exists(get_template_directory(). '/webs-events/single-event.php') )
				{
					return get_template_directory(). '/webs-events/single-event.php';
				}
				elseif ( file_exists(WEBS_EVENTS_TEMPLATES_DIR. '/single-event.php') )
				{
					return WEBS_EVENTS_TEMPLATES_DIR . '/single-event.php';
				}
			}
			return $single;
		}
		add_filter('single_template', 'webs_events_single_template');
		
		
		// Archvive events template
		function webs_events_archive_template ( $archive )
		{
			global $wp_query, $post;
			/* Checks for single template by post type */
			if ( $post->post_type == "webs_event" )
			{
				if( file_exists(get_template_directory(). '/webs-events/archive-events.php') )
				{
					return get_template_directory(). '/webs-events/archive-events.php';
				}
				elseif ( file_exists(WEBS_EVENTS_TEMPLATES_DIR. '/archive-events.php') )
				{
					return WEBS_EVENTS_TEMPLATES_DIR . '/archive-events.php';
				}
			}
			return $archive;
		}
		add_filter('archive_template', 'webs_events_archive_template');
	}
	
	/**
	 * Enqueue the scripts required at the admin area by the plugin.
	 * 
	 * @access public
	 * @hook admin_enqueue_scripts
	 * @return void
	 */
	public function enqueue_admin_scripts ()
	{	
		// Google Maps Javascript API v3
		wp_enqueue_script( 'google_maps_places_v3', '//maps.googleapis.com/maps/api/js?libraries=places', false, '3' );
		wp_enqueue_script( 'webs_events_google_maps', WEBS_EVENTS_PLUGIN_URL . '/js/google_maps.js', array('google_maps_places_v3'), '1' );
		// Meta boxes
		wp_enqueue_script( 'webs_events_meta_boxes', WEBS_EVENTS_PLUGIN_URL . '/js/meta_boxes.js', false, '1' );
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
	
	/**
	 * Enqueue the scripts required by the plugin.
	 * 
	 * @access public
	 * @hook wp_enqueue_scripts
	 * @return void
	 */
	public function enqueue_scripts ()
	{
		// Light Gallery
		wp_enqueue_script( 'sachinchoolur-lightgallery-js', WEBS_EVENTS_PLUGIN_URL . '/vendor/lightGallery/js/lightGallery.min.js', 'jquery', '1.1.2' );
	}
	
	/**
	 * Enqueue the styles required by the plugin in the admin area.
	 * 
	 * @access public
	 * @hook admin_enqueue_scripts
	 * @return void
	 */
	public function enqueue_admin_styles ()
	{
		wp_enqueue_style( 'webs_events_styles', WEBS_EVENTS_PLUGIN_URL . '/css/app.css' );
	}
	
	/**
	 * Enqueue the styles required by the plugin.
	 * 
	 * @access public
	 * @hook wp_enqueue_scripts
	 * @return void
	 */
	public function enqueue_styles ()
	{
		wp_enqueue_style( 'sachinchoolur-lightGallery-css', WEBS_EVENTS_PLUGIN_URL . '/vendor/lightGallery/css/lightGallery.css', false, '1.1.2' );
	}
	
	/**
	 * Check if we're saving, the trigger an action based on the post type
	 *
	 * @param  int $post_id
	 * @param  object $post
	 */
	public function save_meta_boxes( $post_id, $post )
	{
		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) ) {
			return;
		}

		// Dont' save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}
		
		// Check the nonce
		if ( empty( $_POST['woocommerce_meta_nonce'] ) || ! wp_verify_nonce( $_POST['woocommerce_meta_nonce'], 'woocommerce_save_data' ) ) {
			return;
		} 

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check the post type
		if ( ! in_array( $post->post_type, array( 'product', 'shop_order', 'shop_coupon' ) ) ) {
			return;
		}

		do_action( 'woocommerce_process_' . $post->post_type . '_meta', $post_id, $post );
	}
}