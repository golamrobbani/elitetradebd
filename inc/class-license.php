<?php

/**
 * Class Chardynamix_License
 * The way this class will works
 * 1. Tap license check args if any item missing from custom requirements return invalid
 * 2.
 */
class Chardynamix_License {

	/**
	 * Chardynamix_License constructor.
	 */
	public function __construct() {
		add_filter( 'edd_sl_pre_check_license_args', array( $this, 'check_license_args' ) );
		add_filter( 'edd_sl_pre_activate_license_args', array( $this, 'check_license_args' ) );
		add_action( 'edd_sl_check_license', array( $this, 'save_activation_log' ), 10, 2 );
		add_action( 'edd_sl_activate_license', array( $this, 'save_activation_log' ), 10, 2 );
	}

	/**
	 * Check license Activation args
	 * if custom args are not set return invalid
	 * if set platform then convert hat to url for internal use
	 *
	 * @since 1.0.0
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	public function check_license_args( $args ) {
		$args = wp_parse_args( $args, array(
			'machine_id'       => empty( $_REQUEST['machine_id'] ) ? '' : esc_attr( $_REQUEST['machine_id'] ),
			'platform_id'      => empty( $_REQUEST['platform_id'] ) ? '' : esc_attr( $_REQUEST['platform_id'] ),
			'platform_version' => empty( $_REQUEST['platform_version'] ) ? '' : esc_attr( $_REQUEST['platform_version'] ),
			'software_version' => empty( $_REQUEST['software_version'] ) ? '' : esc_attr( $_REQUEST['software_version'] ),
			'host_id'          => empty( $_REQUEST['host_id'] ) ? '' : esc_attr( $_REQUEST['host_id'] ),
		) );

		if ( empty( $args['machine_id'] ) || empty( $args['platform_id'] )
		     || empty( $args['platform_version'] ) || empty( $args['software_version'] ) ) {

			$args['key'] = '';
		}

		//edd does not work without website url
		//so we are making a hash and use as url
		$fake_url    = serialize( array(
			'machine_id'       => $args['machine_id'],
			'platform_id'      => $args['platform_id'],
			'platform_version' => $args['platform_version'],
			'host_id'          => $args['host_id'],
		) );
		$args['url'] = md5( $fake_url );

		return $args;
	}


	public function save_activation_log( $license_id, $download_id ) {
		if ( is_array( $_REQUEST ) && ! empty( $_REQUEST ) ) {
			global $wpdb;

			$args = array(
				'license_id'       => $license_id,
				'machine_id'       => empty( $_REQUEST['machine_id'] ) ? '' : esc_attr( $_REQUEST['machine_id'] ),
				'platform_id'      => empty( $_REQUEST['platform_id'] ) ? '' : esc_attr( $_REQUEST['platform_id'] ),
				'platform_version' => empty( $_REQUEST['platform_version'] ) ? '' : esc_attr( $_REQUEST['platform_version'] ),
				'software_version' => empty( $_REQUEST['software_version'] ) ? '' : esc_attr( $_REQUEST['software_version'] ),
				'host_id'          => empty( $_REQUEST['host_id'] ) ? '' : esc_attr( $_REQUEST['host_id'] ),
			);

			$fake_url = serialize( array(
				'machine_id'       => $args['machine_id'],
				'platform_id'      => $args['platform_id'],
				'platform_version' => $args['platform_version'],
				'host_id'          => $args['host_id'],
			) );

			$hash = md5( $fake_url );

			$result = $wpdb->get_row( $wpdb->prepare( "select * from {$wpdb->prefix}edd_license_activations where site_name like %s AND license_id=%s", "$hash%", $license_id ) );

			$hash   = rtrim( $result->site_name, '/' );
			$action = 'activate';
			if ( $wpdb->get_row( $wpdb->prepare( "select * from {$wpdb->prefix}license_log where hash=%s", $hash ) ) ) {
				$action = 'check_license';
			}


			if ( $result ) {
				$wpdb->insert(
					$wpdb->prefix . 'license_log',
					array(
						'site_id'          => $result->site_id,
						'license_id'       => $license_id,
						'action'           => $action,
						'machine_id'       => $args['machine_id'],
						'platform_id'      => $args['platform_id'],
						'platform_version' => $args['platform_version'],
						'software_version' => $args['software_version'],
						'host_id'          => $args['host_id'],
						'hash'             => rtrim( $result->site_name, '/' ),
						'ip'               => edd_get_ip(),
					),
					array(
						'%d',
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
					)
				);
			}

		}
	}

}

new Chardynamix_License();


add_action( 'after_setup_theme', 'create_license_handler_table' );

function create_license_handler_table() {
	global $wpdb;
	$table = $wpdb->prefix . 'license_log';
	$exist = ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE '%s'", $table ) ) == $table );

	if ( ! $exist ) {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$sql = "CREATE TABLE " . $table . " (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `site_id` bigint(20) NOT NULL,
		  `license_id` bigint(20) NOT NULL,
		  `action` varchar(128) NOT NULL,
		  `machine_id` varchar(128) NOT NULL DEFAULT '',
		  `platform_id` varchar(128) NOT NULL DEFAULT '',
		  `platform_version` varchar(128) NOT NULL,
		  `software_version` varchar(128) NOT NULL DEFAULT '',
		  `host_id` varchar(128) NOT NULL DEFAULT '',
		  `hash` varchar(128) NOT NULL,
		  `ip` varchar(128) NOT NULL,
		  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;";

		dbDelta( $sql );
	}
}
