<?php

/**
 * Return event images ids
 *
 * @return string
*/
function get_event_images_ids ()
{
	return explode( ',', get_post_meta( get_the_ID(), '_event_gallery', true ) );
}