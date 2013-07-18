<?php
/**
 * Affiliates Pro Zero Notifications
 *
 * Stop sending notifications to affiliates for referrals that have a subtotal of zero
 *
 * @package   affiliates-pro-zero-notifications
 * @author    Brad Vincent <brad@fooplugins.com>
 * @license   GPL-2.0+
 * @link      https://github.com/fooplugins/affiliates-pro-zero-notifications
 * @copyright 2013 FooPlugins LLC
 *
 * @wordpress-plugin
 * Plugin Name: Affiliates Pro Zero Notifications
 * Plugin URI:  https://github.com/fooplugins/affiliates-pro-zero-notifications
 * Description: Stop sending notifications to affiliates for referrals that have a subtotal of zero
 * Version:     1.0.0
 * Author:      bradvin
 * Author URI:  http://fooplugins.com
 * Text Domain: foobox
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//include plugin class
require_once( plugin_dir_path( __FILE__ ) . 'class-affiliates-pro-zero-notifications.php' );

//run it baby!
Affiliates_Pro_Zero_Notifications::get_instance();