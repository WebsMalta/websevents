<?php
/**
 * Event locator
 *
 * Display the event locator meta box.
 *
 * @author 		Gabriel Gil
 * @category 	Admin
 * @package 	Webs Events
 * @version     0.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WE_Meta_Box_Event_Locator
 */
class WE_Meta_Box_Event_Locator
{
	/**
	 * Output the metabox with the map container and
	 * inputs for holding location data details.
	 */
	public static function output( $post )
	{
		?>
		<div id="map-canvas"></div>
		<input id="pac-input" class="controls" type="text" placeholder="<?php _e( 'Enter the event venue', 'webs_events' ); ?>">
		<input id="we_location_id" type="hidden" >
		<input id="we_location_position" type="hidden" >
		<input id="we_location_name" type="hidden" >
		<input id="we_location_address" type="hidden" >
		<?php;
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id )
	{
		// Check the nonce
		if ( empty( $_POST['we_location_nonce'] ) || ! wp_verify_nonce( $_POST['we_location_nonce'], 'we_save_location' ) ) {
			return;
		}
		
		// Serialized data
		$attachment_ids = array_filter( explode( ',', sanitize_text_field( $_POST['event_location'] ) ) );

		// I'm saving it!
		update_post_meta( $post_id, '_event_gallery', implode( ',', $attachment_ids ) );
	}
}