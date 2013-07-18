<?php
/**
 * Affiliates Pro Zero Notifications
 *
 * @package   affiliates-pro-zero-notifications
 * @author    Brad Vincent <brad@fooplugins.com>
 * @license   GPL-2.0+
 * @link      https://github.com/fooplugins/affiliates-pro-zero-notifications
 * @copyright 2013 FooPlugins LLC
 */

class Affiliates_Pro_Zero_Notifications {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'affiliates-pro-zero-notifications';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		add_action( 'init', 'init_no_zero_notifications' );

		function init_no_zero_notifications() {
			add_action( 'affiliates_referral', 'no_zero_notifications', 9 );
			add_action( 'affiliates_updated_referral', 'no_zero_notifications', 9 );
		}

		function no_zero_notifications( $referral_id ) {
			global $wpdb;
			$referrals_table = _affiliates_get_tablename( 'referrals' );
			$amount = $wpdb->get_var( $wpdb->prepare( "SELECT amount FROM $referrals_table WHERE referral_id = %d", $referral_id ) );
			if ( floatval( $amount ) <= 0 ) {

				//make sure no email is sent to affiliate
				remove_action( 'affiliates_referral', array( 'Affiliates_Notifications', 'affiliates_referral' ) );
				remove_action( 'affiliates_updated_referral', array( 'Affiliates_Notifications', 'affiliates_updated_referral' ) );

				//delete zero referral
				$wpdb->delete( "$referrals_table", array( 'referral_id' => $referral_id ) );
			}
		}
	}
}