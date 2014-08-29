<?php
/**
 * Get template part (for templates like the content-single).
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 * @return void
 */
function we_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/webs-events/slug-name.php
	if ( $name ) {
		$template = locate_template( array( "{$slug}-{$name}.php", get_template_directory() . "/{$slug}-{$name}.php" ) );
	}

	// Get default slug-name.php
	if ( ! $template && $name && file_exists( WEBS_EVENTS_TEMPLATES_DIR . "/{$slug}-{$name}.php" ) ) {
		$template = WEBS_EVENTS_TEMPLATES_DIR . "/{$slug}-{$name}.php";
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php
	if ( ! $template ) {
		$template = locate_template( array( "{$slug}.php", get_template_directory() . "{$slug}.php" ) );
	}

	// Allow 3rd party plugin filter template file from their plugin
	//$template = apply_filters( 'we_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}