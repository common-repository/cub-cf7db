<?php
/**
 * Plugin Bootstrap File
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. It includes all dependencies used by the plugin, registers the activation
 * and deactivation functions, and defines a function that initializes the plugin.
 *
 * @link              https://www.cubsys.com
 * @since             1.0.1
 * @package           CubCF7DB
 *
 * @wordpress-plugin
 * Plugin Name:       CUB - CF7DB
 * Plugin URI:        https://www.cubsys.com
 * Description:       CUB - CF7DB is a powerful addon for Contact Form 7 that allows you to save all submitted form data directly to your WordPress database. This plugin provides an easy-to-use interface within the WordPress admin area to view, search, and export form entries, making it a valuable tool for managing and analyzing your form data.
 * Version:           1.0.0
 * Author:            cubsys
 * Author URI:        https://www.cubsys.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cubcf7db
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'CUBCF7DB_VERSION', '1.0.1' );

// Define plugin basename.
define( 'CUBCF7DB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Define plugin directory.
define( 'CUBCF7DB_PLUGIN_DIR', __DIR__ );

// Define plugin URL.
define( 'CUBCF7DB_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

if ( ! function_exists( 'cubcf7db_activate' ) ) {
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-cubcf7db-activator.php
     *
     * @param bool $network_wide Whether the plugin is being activated network-wide.
     */
    function cubcf7db_activate( $network_wide ) {
        require_once CUBCF7DB_PLUGIN_DIR . '/includes/class-cubcf7db-activator.php';
        CUBCF7DB_Activator::activate( $network_wide );
    }
}

if ( ! function_exists( 'cubcf7db_deactivate' ) ) {
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-cubcf7db-deactivator.php
     */
    function cubcf7db_deactivate() {
        require_once CUBCF7DB_PLUGIN_DIR . '/includes/class-cubcf7db-deactivator.php';
        CUBCF7DB_Deactivator::deactivate();
    }
}

register_activation_hook( __FILE__, 'cubcf7db_activate' );
register_deactivation_hook( __FILE__, 'cubcf7db_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once CUBCF7DB_PLUGIN_DIR . '/includes/class-cubcf7db.php';

if ( ! function_exists( 'cubcf7db_upgrade_function' ) ) {
    /**
     * Ensures index.php is present in the upload directory to prevent directory browsing.
     *
     * @param WP_Upgrader $upgrader_object Upgrader instance.
     * @param array       $options Array of bulk item update data.
     */
    function cubcf7db_upgrade_function( $upgrader_object, $options ) {
        global $wp_filesystem;

        // Initialize the WP_Filesystem.
        if ( ! function_exists( 'WP_Filesystem' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        // Initialize the WP_Filesystem.
        WP_Filesystem();

        $upload_dir = wp_upload_dir();
        $cubcf7db_dirname = $upload_dir['basedir'] . '/cubcf7db_uploads';

        // Create the directory if it doesn't exist.
        if ( ! $wp_filesystem->is_dir( $cubcf7db_dirname ) ) {
            $wp_filesystem->mkdir( $cubcf7db_dirname );
        }

        // Create the index.php file if it doesn't exist.
        if ( ! $wp_filesystem->exists( $cubcf7db_dirname . '/index.php' ) ) {
            $index_file_content = "<?php\n// Silence is golden.";
            $wp_filesystem->put_contents( $cubcf7db_dirname . '/index.php', $index_file_content, FS_CHMOD_FILE );
        }
    }
}

add_action( 'upgrader_process_complete', 'cubcf7db_upgrade_function', 10, 2 );

if ( ! function_exists( 'cubcf7db_run' ) ) {
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    function cubcf7db_run() {
        $plugin = new CUBCF7DB();
        $plugin->run();
    }
}

cubcf7db_run();
