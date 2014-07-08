<?php

/**
 * Plugin Name: Webs Events
 * Plugin URI: http://webs.com.mt
 * Description: Save and show events on the site. Simple yet powerful event management system.
 * Version: 0.1
 * Author: Webs.com.mt
 * Author URI: http://webs.com.mt
 * License: GPL2
 */


/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Plugin Workflow
 *    1. Create plugin global variables
 *    2. Require dependancies
 *        a. webs-events class - events saving options and creating
 *        b. options class - builds settings page
 *    3. Registering Settings Page and Options
 *    4. Assign plugin settings
 *    5. Instantiate webs_events object
 *    6. Handle Errors
 *    7. Enqueue Styles
 */


/*
 * 1. PLUGIN GLOBAL VARIABLES
 */

// No invaders!
defined('ABSPATH') or die("No script kiddies please!");

if (!defined('WEBS_EVENTS_PLUGIN_NAME'))
	define('WEBS_EVENTS_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('WEBS_EVENTS_PLUGIN_DIR'))
	define('WEBS_EVENTS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . WEBS_EVENTS_PLUGIN_NAME);

if (!defined('WEBS_EVENTS_PLUGIN_URL'))
	define('WEBS_EVENTS_PLUGIN_URL', WP_PLUGIN_URL . '/' . WEBS_EVENTS_PLUGIN_NAME);

/*
 * 2. REQUIRE DEPENDANCIES
 *
 *    class-wp-scss
 *    options.php - settings for plugin page
 */
include_once WEBS_EVENTS_PLUGIN_DIR . '/class/webs_events.php'; // Events Manager


/**
 * 3. Register Scripts and Styles
 */
add_action( 'admin_enqueue_scripts', $webs_events->register_styles() );
add_action( 'admin_enqueue_scripts', $webs_events->register_scripts() );
