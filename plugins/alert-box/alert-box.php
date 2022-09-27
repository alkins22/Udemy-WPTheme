<?php
/**
 * Plugin Name:       Alert Box
 * Description:       Adds an alert box to output information to the reader.
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Jake Alkins
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       alert-box
 *
 * @package           u-plus
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function u_plus_alert_box_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'u_plus_alert_box_block_init' );
