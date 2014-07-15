<?php

/**
 * Meta Boxes Manager
 *
 * Register, fill the content and holds the saving
 * process of all the plugin metaboxes.
 *
 * @author 		Gabriel Gil
 * @category 	Admin
 * @package 	Webs Events
 * @version     0.5
 */
class WE_Meta_Boxes
{

	/**
	 * Constructor function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct ()
	{
		// Actions for registering meta boxes
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		
		// Save metaboxes data
		// add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );
	}
	
	public function add_meta_boxes ()
	{
		// Event Location by Google Maps
		add_meta_box( 'we_locator_meta_box', __( 'Event location', 'webs_events' ), array( 'WE_Meta_Box_Event_Locator', 'output' ), 'webs_event', 'normal' );
		
		// Event Gallery
		add_meta_box( 'we_gallery_meta_box', __( 'Event Gallery', 'webs_events' ), array( 'WE_Meta_Box_Event_Gallery', 'output'), 'webs_event', 'normal' );
	}
	
	public function save_meta_boxes ()
	{
		
	}
}