<?php

/**
 * WebsEvents Template
 *
 * Functions for the templating system.
 *
 * @author 		Gabriel Gil
 * @category 	Core
 * @package 	WebsEvents/Functions
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'we_output_content_wrapper' ) )
{
	/**
	 * Output the start of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function we_output_content_wrapper() {
		echo '<div id="webs-events" class="start">';
	}
}
if ( ! function_exists( 'we_output_content_wrapper_end' ) )
{
	/**
	 * Output the end of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function we_output_content_wrapper_end() {
		echo '</div>';
	}
}
if ( ! function_exists( 'we_get_event_schema' ) )
{
	/**
	 * Get an event Schema
	 * @return string
	 */
	function we_get_event_schema()
	{	
		$schema = "Event";
		return 'http://schema.org/' . $schema;
	}
}

/** Single Event ********************************************************/

if ( ! function_exists( 'we_show_event_gallery' ) ) {

	/**
	 * Output the event gallery before the single event summary.
	 *
	 * @access public
	 * @subpackage	Event
	 * @return void
	 */
	function we_show_event_gallery() {
		we_get_template_part( 'single-event/event', 'gallery' );
	}
}
if ( ! function_exists( 'we_template_single_title' ) )
{
	/**
	 * Output the event title.
	 *
	 * @access public
	 * @subpackage	Event
	 * @return void
	 */
	function we_template_single_title ()
	{
		$title = get_the_title();
		echo "<h1 itemprop=\"name\" >$title</h1>";
	}
}
if ( ! function_exists( 'we_template_single_happening_date' ) )
{
	/**
	 * Output the event starting date.
	 *
	 * @access public
	 * @subpackage	Event
	 * @return void
	 */
	function we_template_single_happening_date ()
	{
		// PENDING
	}
}

if ( ! function_exists( 'we_template_single_excerpt' ) )
{
	/**
	 * Output the event custom excerpt if it was filled.
	 *
	 * @access public
	 * @subpackage	Event
	 * @return void
	 */
	function we_template_single_excerpt ()
	{
		if ( has_excerpt() ) {
			echo '<div class="event-excerpt" itemprop="description">';
			the_excerpt();
			echo '</div>';
		}
	}
}