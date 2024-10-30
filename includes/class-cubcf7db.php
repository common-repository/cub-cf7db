<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.cubsys.com
 * @since      1.0.0
 *
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Cubcf7db
 * @subpackage Cubcf7db/includes
 * @author     cubsys <contact@cubsys.com>
 */
class CUBCF7DB {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      CUBCF7DB_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->version = defined( 'CUBCF7DB_VERSION' ) ? CUBCF7DB_VERSION : '1.0.0';
		$this->plugin_name = 'cubcf7db';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CUBCF7DB_Loader. Orchestrates the hooks of the plugin.
	 * - CUBCF7DB_I18n. Defines internationalization functionality.
	 * - CUBCF7DB_Admin. Defines all hooks for the admin area.
	 * - CUBCD7DB_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-cubcf7db-loader.php';
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-cubcf7db-i18n.php';
		require_once plugin_dir_path( __DIR__ ) . 'admin/class-cubcf7db-admin.php';
		require_once plugin_dir_path( __DIR__ ) . 'public/class-cubcf7db-public.php';

		$this->loader = new CUBCF7DB_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CUBCF7DB_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new CUBCF7DB_I18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new CUBCF7DB_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_ajax_cubcf7db_delete_record', $plugin_admin, 'cubcf7db_delete_record' );
		$this->loader->add_action( 'wp_ajax_nopriv_cubcf7db_delete_record', $plugin_admin, 'cubcf7db_delete_record' );
		$this->loader->add_action( 'wp_ajax_cubcf7db_cf7form_single_datalist', $plugin_admin, 'cubcf7db_cf7form_single_datalist' );
		$this->loader->add_action( 'wp_ajax_nopriv_cubcf7db_cf7form_single_datalist', $plugin_admin, 'cubcf7db_cf7form_single_datalist' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'cubcf7db_add_menu_page' );
		$this->loader->add_action( 'wpcf7_before_send_mail', $plugin_admin, 'cubcf7db_before_send_mail' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new CUBCD7DB_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    CUBCF7DB_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}