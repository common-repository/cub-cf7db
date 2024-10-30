<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.cubsys.com
 * @since      1.0.0
 *
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 * @author     cubsys <contact@cubsys.com>
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
class CUBCF7DB_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'cubcf7db',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}