<?php

class Webs_Events {
	
	
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
		$this->register_events_post_type ();
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
					'name'                => _x( 'Events', 'Post Type General Name', 'webs_events' ),
					'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'webs_events' ),
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
					'slug'                => 'event',
					'with_front'          => true,
					'pages'               => true,
					'feeds'               => true,
				);
				$args = array(
					'label'               => __( 'webs_event', 'webs_events' ),
					'description'         => __( 'Events for being displayed on the site', 'webs_events' ),
					'labels'              => $labels,
					'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields' ),
					'taxonomies'          => array( 'category' ),
					'hierarchical'        => false,
					'public'              => true,
					'show_ui'             => true,
					'show_in_menu'        => true,
					'show_in_nav_menus'   => true,
					'show_in_admin_bar'   => true,
					'menu_position'       => 10,
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
	
}