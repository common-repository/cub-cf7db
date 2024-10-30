<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future versions of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://www.cubsys.com
 * @since      1.0.0
 *
 * @package    CubCf7db
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

if ( ! function_exists( 'cubcf7db_delete_plugin_data' ) ) {
    /**
     * Delete plugin options and custom tables.
     */
    function cubcf7db_delete_plugin_data() {
        global $wpdb;

        // Delete plugin options.
        delete_option( 'cubcf7db_options' );

        // For multisite, delete options from each blog.
        if ( is_multisite() ) {
            $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
            foreach ( $blog_ids as $blog_id ) {
                switch_to_blog( $blog_id );
                delete_option( 'cubcf7db_options' );
                restore_current_blog();
            }
        }

        // Drop custom tables.
        $table_name = $wpdb->prefix . 'cubcf7db_entries';
        $sql = "DROP TABLE IF EXISTS $table_name";
        // $wpdb->query( $sql );
    }
}

// Execute the function to delete plugin data.
// if ( function_exists( 'cubcf7db_delete_plugin_data' ) ) {
//     cubcf7db_delete_plugin_data();
// }