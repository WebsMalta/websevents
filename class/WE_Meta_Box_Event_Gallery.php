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
		<!--  Gallery itself -->
		<div id="event_gallery_container">
			<ul class="event_gallery">
				<?php
					if ( metadata_exists( 'post', $post->ID, '_event_gallery' ) ) {
						$event_gallery = get_post_meta( $post->ID, '_event_gallery', true );
					}
					$attachments = array_filter( explode( ',', $event_gallery ) );

					if ( $attachments ) {
						foreach ( $attachments as $attachment_id ) {
							echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><div class="dashicons dashicons-trash delete"></div></li>
								</ul>
							</li>';
						}
					} else {
						echo '<li class=\"no-images\"><h4>'. __('There aren\'t images on this event', 'webs_events') .'</h4></li>';
					}
				?>
			</ul>
			<input type="hidden" id="event_gallery" name="event_gallery" value="<?php echo esc_attr( $event_gallery ); ?>" />
		</div>
		
		<hr>
		
		<!-- Add to gallery button -->
		<p class="we_add_gallery_images hide-if-no-js">
			<a href="#" class="we_upload_gallery_images button" data-title="<?php _e( 'Event gallery', 'webs_events' ) ?>" data-button_text="<?php _e( 'Add selected images', 'webs_events' ) ?>" >
				<span style="line-height: 26px; margin-right: 3px;" class="dashicons dashicons-plus-alt wp-media-buttons-icon"></span><?php _e( 'Add images', 'webs_events' ) ?>
			</a>
		</p>
		
		<?php
		wp_nonce_field( 'we_save_gallery', 'we_gallery_nonce' );
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id )
	{
		// Check the nonce
		if ( empty( $_POST['we_gallery_nonce'] ) || ! wp_verify_nonce( $_POST['we_gallery_nonce'], 'we_save_gallery' ) ) {
			return;
		}
		
		// Array of ids
		$attachment_ids = array_filter( explode( ',', sanitize_text_field( $_POST['event_gallery'] ) ) );

		// String to save it.
		update_post_meta( $post_id, '_event_gallery', implode( ',', $attachment_ids ) );
	}
}