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
		//$attachment_ids = array_filter( explode( ',', sanitize_text_field( $_POST['product_image_gallery'] ) ) );
		//update_post_meta( $post_id, '_product_image_gallery', implode( ',', $attachment_ids ) );
	}
}