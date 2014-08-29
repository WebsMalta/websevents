<?php
/**
 * Single Event Gallery
 *
 * @author      Gabriel Gil
 * @package 	WebsEvents/Templates
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


?>
<div class="images">
	
	<?php
		// A unique ID for the event gallery
		$gallery_id = 'gallery' . get_the_ID();
	?>
	
	<ul id="<?php echo $gallery_id ?>" class="lightgall" >
	
	<?php foreach ( get_event_images_ids() as $id ) : ?>
			
			<?php
				// Get large images and thumbnails.
				$image = wp_get_attachment_image_src( $id, 'large' );
				$thumb = wp_get_attachment_image_src( $id, 'thumbnail' );
			?>
			
			<li id="<?php echo $id ?>" data-src="<?php echo $image[0] ?>">
				<img itemprop="image" src="<?php echo $thumb[0] ?>" width="<?php echo $thumb[1] ?>" height="<?php echo $thumb[2] ?>" />
			</li>
			
	<?php endforeach; ?>
	
	</ul>
	
	<!-- Gallery Style -->
	<style>
		.lightgall {
			list-style: none;
			margin: 0;
			padding: 0;
		}
		.lightgall li {
			max-width: 29%;
			float: left;
			margin-left: 1%;
		}
		.lightgall img {
			max-width: 100%;
		}
	</style>
	
	<script type="text/javascript">
		jQuery(function ($) {
			/* You can safely use $ in this code block to reference jQuery */
			$(document).ready(function() {
				$("#<?php echo $gallery_id ?>").lightGallery();
			});
		});
	</script>
	
</div>
