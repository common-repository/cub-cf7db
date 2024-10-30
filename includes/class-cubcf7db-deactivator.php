<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://www.cubsys.com
 * @since      1.0.0
 *
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 * @author     cubsys <contact@cubsys.com>
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
class CUBCF7DB_Deactivator {

	/**
	 * Method to run during plugin deactivation.
	 *
	 * Removes the custom capability 'cubcf7db_access' from all roles.
	 *
	 * @since 1.0.0
	 */
	public static function deactivate() {
		if ( ! empty( $GLOBALS['wp_roles'] ) && is_a( $GLOBALS['wp_roles'], 'WP_Roles' ) ) {
			global $wp_roles;

			foreach ( array_keys( $wp_roles->roles ) as $role_name ) {
				$role = get_role( $role_name );
				if ( $role && $role->has_cap( 'cubcf7db_access' ) ) {
					$role->remove_cap( 'cubcf7db_access' );
				}
			}
		}
	}
}