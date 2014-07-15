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
		<!--  Galley itself -->
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
									<li><a href="#" class="delete tips" data-tip="' . __( 'Delete image', 'woocommerce' ) . '">' . __( 'Delete', 'woocommerce' ) . '</a></li>
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
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id ) {
		$attachment_ids = array_filter( explode( ',', sanitize_text_field( $_POST['product_image_gallery'] ) ) );

		update_post_meta( $post_id, '_product_image_gallery', implode( ',', $attachment_ids ) );
	}
}