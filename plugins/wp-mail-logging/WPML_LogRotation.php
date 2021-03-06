<?php

namespace No3x\WPML;

use No3x\WPML\Model\WPML_Mail as Mail;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Log rotation for database.
 * @author No3x
 * @since 1.4
 */
class WPML_LogRotation {

	const WPML_LOGROTATION_SCHEDULE_HOOK = 'wpml_log_rotation';
	const WPML_LOGROTATION_SCHEDULE_ACTION = 'LogRotationSchedule';
	private $plugin_meta;

	function __construct( $plugin_meta ) {
		$this->plugin_meta = $plugin_meta;
	}

	/**
	 * Add actions and filters for this module.
	 * @since 1.6.0
	 */
	public function addActionsAndFilters() {
		add_action( 'plugins_loaded', array( $this, 'init') );
		add_action( self::WPML_LOGROTATION_SCHEDULE_HOOK , array( __CLASS__, self::WPML_LOGROTATION_SCHEDULE_ACTION) );
		register_deactivation_hook( plugin_dir_path( __FILE__ ) . $this->plugin_meta['main_file'], array( $this, 'unschedule' ) );
	}

	/**
	 * Init this module.
	 * @since 1.6.0
	 */
	public function init() {
		global $wpml_settings;

		if ( isset( $wpml_settings ) ) {
			if ( $wpml_settings['log-rotation-limit-amout'] == true || $wpml_settings['log-rotation-delete-time'] == true ) {
				$this->schedule();
			} else {
				$this->unschedule();
			}
		}
	}

	/**
	 * Schedules an event.
	 * @since 1.4
	 */
	function schedule() {
		if ( ! wp_next_scheduled( self::WPML_LOGROTATION_SCHEDULE_HOOK ) ) {
			wp_schedule_event( time(), 'hourly', self::WPML_LOGROTATION_SCHEDULE_HOOK );
		}
	}

	/**
	 * Unschedules an event.
	 * @since 1.4
	 */
	function unschedule() {
		wp_clear_scheduled_hook( self::WPML_LOGROTATION_SCHEDULE_HOOK );
	}

	/**
	 * The LogRotation supports the limitation of stored mails by amount.
	 * @since 1.6.0
	 */
	static function limitNumberOfMailsByAmount() {
		global $wpml_settings, $wpdb;
		$tableName = WPML_Plugin::getTablename( 'mails' );
		
		if ( $wpml_settings['log-rotation-limit-amout'] == true) {
			$keep = $wpml_settings['log-rotation-limit-amout-keep'];
			if ( $keep > 0 ) {
				$wpdb->query(
						"DELETE p
						FROM
						$tableName AS p
						JOIN
						( SELECT mail_id
						FROM $tableName
						ORDER BY mail_id DESC
						LIMIT 1 OFFSET $keep
				) AS lim
						ON p.mail_id <= lim.mail_id;"
				);
			}
		}
	}

	/**
	 * The LogRotation supports the limitation of stored mails by date.
	 * @since 1.6.0
	 */
	static function limitNumberOfMailsByTime() {
		global $wpml_settings, $wpdb;
		$tableName = WPML_Plugin::getTablename( 'mails' );

		if ( $wpml_settings['log-rotation-delete-time'] == true) {
			$days = $wpml_settings['log-rotation-delete-time-days'];
			if ( $days > 0 ) {
				$wpdb->query( "DELETE FROM `$tableName` WHERE DATEDIFF( NOW(), `timestamp` ) >= $days" );
			}
		}
	}

	/**
	 * Executes log rotation periodically.
	 * @since 1.4
	 */
	static function LogRotationSchedule() {
		self::limitNumberOfMailsByAmount();
		self::limitNumberOfMailsByTime();
	}
}