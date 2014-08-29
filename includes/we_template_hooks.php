<?php
/**
 * WebsEvents Template Hooks
 *
 * Action/filter hooks used for WebsEvents functions/templates
 *
 * @author 		WebsEvents
 * @category 	Core
 * @package 	WebsEvents/Templates
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Content Wrappers
 *
 * @see we_output_content_wrapper()
 * @see we_output_content_wrapper_end()
 */
add_action( 'we_before_main_content', 'we_output_content_wrapper', 10 );
add_action( 'we_after_main_content', 'we_output_content_wrapper_end', 10 );

/**
 * Before Single Event Summary Div
 *
 * @see we_show_event_gallery()
 */
add_action( 'we_before_single_event_summary', 'we_show_event_gallery', 20 );

/**
 * Event Summary Box
 *
 * @see we_template_single_title
 * @see we_template_single_happening_date
 * @see we_template_single_excerpt
 */
add_action( 'we_single_event_summary', 'we_template_single_title', 5 );
add_action( 'we_single_event_summary', 'we_template_single_happening_date', 10 );
add_action( 'we_single_event_summary', 'we_template_single_excerpt', 20 );
