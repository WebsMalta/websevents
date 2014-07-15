jQuery(document).ready(function( $ ) {

	// Uploading files
	var file_frame;
	var $event_gallery_ids = $('#event_gallery');
	var $event_gallery_images = $('#event_gallery_container ul.event_gallery');
	
	console.log( $event_gallery_images );
 
	jQuery('.we_upload_gallery_images').on('click', function( event ){
		
		var attachment_ids = $event_gallery_ids.val();
		
		event.preventDefault();
	
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
	
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'title' ),
			button: {
				text: jQuery( this ).data( 'button_text' ),
			},
			multiple: true  // Set to true to allow multiple files to be selected
		});
		
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			
			var selection = file_frame.state().get('selection');
 
			selection.map( function( attachment ) {
			
				attachment = attachment.toJSON();
				
				// Do something with attachment.id and/or attachment.url here
				if ( attachment.id ) {
					attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

					$event_gallery_images.append('\
						<li class="image" data-attachment_id="' + attachment.id + '">\
							<img src="' + attachment.url + '" />\
							<ul class="actions">\
								<li><div class="dashicons dashicons-trash"></div></li>\
							</ul>\
						</li>');
				}
				
				// Save ids at the input field
				$event_gallery_ids.val( attachment_ids );
				
			});
			
		});
		
		// Finally, open the modal
		file_frame.open();
	});

});