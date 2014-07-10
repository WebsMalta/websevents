<?php
/**
 * Event gallery
 *
 * Display the event gallery meta box.
 *
 * @author 		Gabriel Gil
 * @category 	Admin
 * @package 	Webs Events
 * @version     0.5
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WE_Meta_Box_Event_Gallery
 */
class WE_Meta_Box_Event_Gallery
{
	/**
	 * Output the metabox
	 */
	public static function output( $post )
	{
		?>
		<!-- Add to tgallery button -->
		<p class="we_add_gallery_images hide-if-no-js">
			<a href="#" class="we_upload_gallery_images button" data-title="<?php _e( 'Event gallery', 'webs_events' ) ?>" data-button_text="<?php _e( 'Add selected images', 'webs_events' ) ?>" >
				<?php _e( 'Add images', 'webs_events' ) ?>
			</a>
		</p>
		
		<?php
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {
		$attachment_ids = array_filter( explode( ',', wc_clean( $_POST['product_image_gallery'] ) ) );

		update_post_meta( $post_id, '_product_image_gallery', implode( ',', $attachment_ids ) );
	}
}