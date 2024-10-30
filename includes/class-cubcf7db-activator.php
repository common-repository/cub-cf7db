<?php
/**
 * Fired during plugin activation
 *
 * @link       https://www.cubsys.com
 * @since      1.0.0
 *
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
class CUBCF7DB_Activator {

	/**
	 * Activate the plugin.
	 *
	 * @since 1.0.0
	 * @param int $network_wide Check if multisite or not.
	 */
	public static function activate( $network_wide ) {
		if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
			self::show_admin_notice();
			deactivate_plugins( plugin_basename( __FILE__ ) );
			return;
		}

		global $wpdb;

		if ( is_multisite() && $network_wide ) {
			// Get all blogs in the network and activate plugin on each one.
			$blog_ids = wp_cache_get( 'blog_ids', 'cubcf7db' );
		
			if ( false === $blog_ids ) {
				$blog_ids = get_transient( 'cubcf7db_blog_ids_transient' );
				if ( false === $blog_ids ) {
					$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
					set_transient( 'cubcf7db_blog_ids_transient', $blog_ids, DAY_IN_SECONDS );
				}
			}
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				self::cubcf7db_create_table();
				restore_current_blog();
			}
		} else {
			self::cubcf7db_create_table();
		}		
		// Add custom capability.
		$role = get_role( 'administrator' );
		if ( $role ) {
			$role->add_cap( 'cubcf7db_access' );
		}
	}

	/**
	 * Show admin notice if Contact Form 7 is not active.
	 *
	 * @since 1.0.0
	 */
	private static function show_admin_notice() {
		add_action(
			'admin_notices',
			function () {
				echo '<div class="error"><p>' . esc_html__( 'Cubcf7db requires Contact Form 7 to be installed and active.', 'cubcf7db' ) . '</p></div>';
			}
		);
	}

	/**
	 * Create the database table for storing form submissions.
	 *
	 * @since 1.0.0
	 */
	private static function cubcf7db_create_table() {
		global $wpdb, $wp_filesystem;

		$table_name     = $wpdb->prefix . 'cubcf7db_forms';
		$existing_table = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table_name ) );

		// Check if the table already exists.
		if ( $existing_table !== $table_name ) {
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE $table_name (
				form_id bigint(20) NOT NULL AUTO_INCREMENT,
				form_post_id bigint(20) NOT NULL,
				form_user_id bigint(20) DEFAULT NULL,
				form_value longtext NOT NULL,
				form_status varchar(20) DEFAULT 'pending' NOT NULL,
				form_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				PRIMARY KEY  (form_id)
			) $charset_collate;";

			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			dbDelta( $sql );
		}

		WP_Filesystem();

		// Create the uploads directory if it doesn't exist.
		$upload_dir    = wp_upload_dir();
		$cfdb7_dirname = $upload_dir['basedir'] . '/cubcf7db_uploads';
		if ( ! $wp_filesystem->is_dir( $cfdb7_dirname ) ) {
			$wp_filesystem->mkdir( $cfdb7_dirname );
		}
	
		// Create the index.php file if it doesn't exist.
		if ( ! $wp_filesystem->exists( $cfdb7_dirname . '/index.php' ) ) {
			$index_file_content = "<?php\n\t // Silence is golden.";
			$wp_filesystem->put_contents( $cfdb7_dirname . '/index.php', $index_file_content, FS_CHMOD_FILE );
		}

		// Add an option to store installation date.
		add_option( 'cubcf7db_view_install_date', current_time( 'mysql' ), '', 'yes' );
	}
}