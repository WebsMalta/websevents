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
		
		// Preprocess metaboxes data
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );
		
		// Now, each metabox
		add_action( 'webs_process_event_meta', 'WE_Meta_Box_Event_Locator::save', 10, 2 );
		add_action( 'webs_process_event_meta', 'WE_Meta_Box_Event_Gallery::save', 20, 2 );
        
       
	}
	
	public function add_meta_boxes ()
	{
		// Event Location by Google Maps
		add_meta_box( 'we_locator_meta_box', __( 'Event location', 'webs_events' ), array( 'WE_Meta_Box_Event_Locator', 'output' ), 'webs_event', 'normal' );
		
		// Event Gallery
		add_meta_box( 'we_gallery_meta_box', __( 'Event Gallery', 'webs_events' ), array( 'WE_Meta_Box_Event_Gallery', 'output'), 'webs_event', 'normal' );


	}
	
	public function save_meta_boxes ( $post_id, $post )
	{
		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) ) {
			return;
		}

		// Dont' save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
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
		if ( ! in_array( $post->post_type, array( 'webs_event' ) ) ) {
			return;
		}
		
		do_action( 'webs_process_event_meta', $post_id );
	}
}