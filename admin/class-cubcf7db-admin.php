<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.cubsys.com
 * @since      1.0.0
 *
 * @package    Cubcf7db
 * @subpackage Cubcf7db/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cubcf7db
 * @subpackage Cubcf7db/admin
 * @author     cubsys <contact@cubsys.com>
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
class CUBCF7DB_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CUBCF7DB_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CUBCF7DB_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();
		if ( $screen && 'toplevel_page_cubcf7db-page' === $screen->id ) {
			wp_enqueue_style( $this->plugin_name . '-bootstrap', CUBCF7DB_PLUGIN_URL . '/admin/css/bootstrap.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-dataTables-bootstrap4', CUBCF7DB_PLUGIN_URL . '/admin/css/dataTables.bootstrap4.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-rowReorder-bootstrap4-min', CUBCF7DB_PLUGIN_URL . '/admin/css/rowReorder.bootstrap4.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-responsive-bootstrap4-min', CUBCF7DB_PLUGIN_URL . '/admin/css/responsive.bootstrap4.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-buttons-bootstrap4-min', CUBCF7DB_PLUGIN_URL . '/admin/css/buttons.bootstrap4.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-select2', CUBCF7DB_PLUGIN_URL . '/admin/css/select2.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-admin', CUBCF7DB_PLUGIN_URL . '/admin/css/cubcf7db-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-font-awesome', CUBCF7DB_PLUGIN_URL . '/admin/css/font-awesome.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-responsive', CUBCF7DB_PLUGIN_URL . '/admin/css/responsive.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * Enqueue scripts for the specific admin page.
		 *
		 * This function hooks into the 'admin_enqueue_scripts' action,
		 * checks the current screen, and enqueues scripts only if the
		 * screen matches the target admin page.
		 */
		$screen = get_current_screen();
		if ( $screen && 'toplevel_page_cubcf7db-page' === $screen->id ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( $this->plugin_name . '-popper-min', CUBCF7DB_PLUGIN_URL . '/admin/js/popper.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name . '-bootstrap-min', CUBCF7DB_PLUGIN_URL . '/admin/js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-bootstrap-bundle', CUBCF7DB_PLUGIN_URL . '/admin/js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-dataTables-min', CUBCF7DB_PLUGIN_URL . '/admin/js/dataTables.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-dataTables-buttons-min', CUBCF7DB_PLUGIN_URL . '/admin/js/dataTables.buttons.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-buttons-bootstrap4-min', CUBCF7DB_PLUGIN_URL . '/admin/js/buttons.bootstrap4.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-jszip-min', CUBCF7DB_PLUGIN_URL . '/admin/js/jszip.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-pdfmake-min', CUBCF7DB_PLUGIN_URL . '/admin/js/pdfmake.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-vfs_fonts', CUBCF7DB_PLUGIN_URL . '/admin/js/vfs_fonts.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-buttons-html5-min', CUBCF7DB_PLUGIN_URL . '/admin/js/buttons.html5.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-buttons-print-min', CUBCF7DB_PLUGIN_URL . '/admin/js/buttons.print.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-dataTables-bootstrap4', CUBCF7DB_PLUGIN_URL . '/admin/js/dataTables.bootstrap4.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-dataTables-rowReorder-min', CUBCF7DB_PLUGIN_URL . '/admin/js/dataTables.rowReorder.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-rowReorder-bootstrap4-min', CUBCF7DB_PLUGIN_URL . '/admin/js/rowReorder.bootstrap4.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-dataTables-responsive-min', CUBCF7DB_PLUGIN_URL . '/admin/js/dataTables.responsive.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-responsive-bootstrap4-min', CUBCF7DB_PLUGIN_URL . '/admin/js/responsive.bootstrap4.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-select2-min', CUBCF7DB_PLUGIN_URL . '/admin/js/select2.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-admin', CUBCF7DB_PLUGIN_URL . '/admin/js/cubcf7db-admin.js', array( 'jquery', $this->plugin_name . '-select2-min', $this->plugin_name . '-dataTables-min' ), $this->version, true );
			$cubcf7db_ajax_nonce = wp_create_nonce('cubcf7db_ajax_nonce');
			wp_localize_script( $this->plugin_name . '-admin', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => $cubcf7db_ajax_nonce ) );
		}
	}

	/**
	 * Handle actions before sending mail.
	 *
	 * @since 1.0.0
	 * @param array $form_tag get a form data.
	 */
	public function cubcf7db_before_send_mail( $form_tag ) {
		global $wpdb, $wp_filesystem;

		$cfdb              = apply_filters( 'cubcf7db_database', $wpdb );
		$table_name        = $cfdb->prefix . 'cubcf7db_forms';
		$upload_dir        = wp_upload_dir();
		$cubcf7db_dirname = $upload_dir['basedir'] . '/cubcf7db_uploads';
		$bytes             = random_bytes( 5 );
		$time_now          = time() . bin2hex( $bytes );
		$submission        = WPCF7_Submission::get_instance();
		if ( ! $submission ) {
			return;
		}

		$contact_form = $submission->get_contact_form();
		$tags_names   = array();
		$strict_keys  = apply_filters( 'cubcf7db_strict_keys', false );

		$allowed_tags = array();
		$bl           = array( '\"', "\'", '/', '\\', '"', "'" );
		$wl           = array( '&quot;', '&#039;', '&#047;', '&#092;', '&quot;', '&#039;' );

		if ( $strict_keys ) {
			$tags = $contact_form->scan_form_tags();
			foreach ( $tags as $tag ) {
				if ( ! empty( $tag->name ) ) {
					$tags_names[] = $tag->name;
				}
			}
			$allowed_tags = $tags_names;
		}

		$not_allowed_tags = apply_filters( 'cubcf7db_not_allowed_tags', array( 'g-recaptcha-response' ) );
		$allowed_tags     = apply_filters( 'cubcf7db_allowed_tags', $allowed_tags );

		$data           = $submission->get_posted_data();
		$files          = $submission->uploaded_files();
		$uploaded_files = array();

		// Include and initialize the WP_Filesystem
	if (!function_exists('WP_Filesystem')) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}

	WP_Filesystem();

	global $wp_filesystem;

	// Ensure the upload directory exists
	$upload_dir = wp_upload_dir();
	$cubcf7db_dirname = $upload_dir['basedir'] . '/cubcf7db_uploads';
	if (!$wp_filesystem->is_dir($cubcf7db_dirname)) {
		$wp_filesystem->mkdir($cubcf7db_dirname);
	}

	$uploaded_files = [];
	$time_now = current_time('YmdHis'); // Generate a timestamp for file uniqueness

	// Ensure the $files variable contains the files to process
	$files = $_FILES;

	if (isset($files)) {
		foreach ($files as $file_key => $file) {
			array_push($uploaded_files, $file_key);
		}
	}

	foreach ($files as $file_key => $file) {
		// Handle both single and multiple file uploads
		if (is_array($file['tmp_name'])) {
			foreach ($file['tmp_name'] as $index => $tmp_name) {
				if (empty($tmp_name)) {
					continue;
				}
				// Ensure $file_name is a string
				$file_name = wp_basename($file['name'][$index]);
				$safe_file_name = sanitize_file_name($file_key . '-' . $file_name);
				$upload_path = $cubcf7db_dirname . '/' . $time_now . '-' . $safe_file_name;

				// Use WP_Filesystem to move the uploaded file
				if ($wp_filesystem->move($tmp_name, $upload_path, true)) {
					$uploaded_files[] = $upload_path;
				}
			}
		} else {
			if (empty($file['tmp_name'])) {
				continue;
			}
			// Ensure $file_name is a string
			$file_name = wp_basename($file['name']);
			$safe_file_name = sanitize_file_name($file_key . '-' . $file_name);
			$upload_path = $cubcf7db_dirname . '/' . $time_now . '-' . $safe_file_name;

			// Use WP_Filesystem to move the uploaded file
			if ($wp_filesystem->move($file['tmp_name'], $upload_path, true)) {
				$uploaded_files[] = $upload_path;
			}
		}
	}

	$form_data = array();
	$form_data['cubcf7db_status'] = 'unread';

	foreach ($data as $key => $d) {
		// Skip processing if strict keys are enabled and $key is not in $allowed_tags
		if ($strict_keys && !in_array($key, $allowed_tags, true)) {
			continue;
		}

		// Skip processing if $key is in $not_allowed_tags or already in $uploaded_files
		if (!in_array($key, $not_allowed_tags, true) && !in_array($key, $uploaded_files, true)) {
			// Process $d based on whether it's an array or not
			$tmp_d = is_array($d) ? array_map(function ($item) use ($bl, $wl) {
				return str_replace($bl, $wl, $item);
			}, $d) : str_replace($bl, $wl, $d);

			// Sanitize $key and store processed data in $form_data
			$key = sanitize_text_field($key);
			$form_data[$key] = $tmp_d;
		}

		// Process uploaded files and add file names to $form_data with a specific key
		if (in_array($key, $uploaded_files, true)) {
			// Check if the file has been successfully moved before adding it to $form_data
			if (isset($files[$key]) && !empty($files[$key]['name']) && in_array($cubcf7db_dirname . '/' . $time_now . '-' . sanitize_file_name($file_key . '-' . wp_basename($files[$key]['name'])), $uploaded_files)) {
				$file_name = basename($files[$key]['name']);
				$key = sanitize_text_field($key);

				$form_data[$key . 'cubcf7db_file'] = $file_name;
			}
		}
	}		

		/* cubcf7db before save data. */
		$form_data = apply_filters( 'cubcf7db_before_save_data', $form_data );

		do_action( 'cubcf7db_before_save', $form_data );

		$form_post_id = $form_tag->id();
		$form_value   = serialize( $form_data );
		$form_date    = current_time( 'Y-m-d H:i:s' );
		$form_user_id = get_current_user_id();
		$form_status  = 'pending'; // Set the default status to 'pending'.

		// Insert data using Cubcf7db extension.
		$cfdb->insert(
			$table_name,
			array(
				'form_post_id' => $form_post_id,
				'form_value'   => $form_value,
				'form_date'    => $form_date,
				'form_user_id' => $form_user_id,
				'form_status'  => $form_status,
			),
			array(
				'%d',
				'%s',
				'%s',
				'%d',
				'%s',
			)
		);

		/* cubcf7db after save data */
		$insert_id = $cfdb->insert_id;
		do_action( 'cubcf7db_after_save_data', $insert_id );
	}

	/**
     * Add the CF7DB menu page to the admin menu.
     *
     * @since 1.0.0
     */
    public function cubcf7db_add_menu_page() {
        add_menu_page(
            __( 'CF7DB', 'cubcf7db' ),
            __( 'CF7DB', 'cubcf7db' ),
            'manage_options',
            'cubcf7db-page',
            array( $this, 'cubcf7db_menu_callback' ),
            'dashicons-feedback',
            30
        );
    }


	/**
     * Render the CF7DB menu page.
     *
     * @since 1.0.0
     */
    public function cubcf7db_menu_callback() {
        if ( current_user_can( 'manage_options' ) ) {
            include_once 'partials/cubcf7db-display.php';
        }
    }

	/**
	 * Get a list of all Contact Form 7 forms for use in a dropdown.
	 *
	 * @since 1.0.0
	 * @return array|null List of CF7 forms or null if user doesn't have permissions.
	 */
	public function cubcf7db_cf7form_list() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return null;
		}

		$args = array(
			'post_type'      => 'wpcf7_contact_form',
			'orderby'        => 'form_id',
			'post_status'    => 'publish',
			'order'          => 'ASC',
			'posts_per_page' => -1,
		);
		$cf7_forms_data = get_posts( $args );

		return $cf7_forms_data;
	}

	/**
	 * Get a single Contact Form 7 forms Details.
	 *
	 * @since 1.0.0
	 */
	public function cubcf7db_cf7form_single_datalist() {

		// Check nonce for security
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cubcf7db_ajax_nonce')) {
			wp_send_json_error('Invalid nonce');
			return;
		}

		if (!current_user_can('manage_options')) {
			wp_send_json_error(array('message' => 'You do not have sufficient permissions to access this page.'));
		}
		
		if ( isset( $_POST['id'] ) ) {
			global $wpdb;
			$cfdb       = apply_filters( 'cubcf7db_database', $wpdb );
			$id         = sanitize_text_field( wp_unslash( $_POST['id'] ) );
			$table_name = $cfdb->prefix . 'cubcf7db_forms';
			$table_name = esc_sql( $table_name );

			// Execute the prepared query and retrieve results as an associative array.
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT form_id, form_post_id, form_value FROM {$table_name} WHERE form_post_id = %d", $id ), ARRAY_A );

			if ( ! empty( $results ) ) {
				$formatted_results = array();
				$columns           = array();
				$column_titles     = array();

				foreach ( $results as $result ) {
					if ( isset( $result['form_value'] ) ) {
						$form_values = maybe_unserialize( $result['form_value'] );
						if ( is_array( $form_values ) ) {
							$formatted_result = array();
							foreach ( $form_values as $key => $value ) {
								if ( 'cubcf7db_status' !== $key ) { // Exclude the 'cubcf7db_status' column.
									$formatted_result[ $key ] = $value;
									if ( ! in_array( $key, $columns, true ) ) {
										$columns[] = $key; // Add the column to $columns array if it's not already present.

										$column_titles[ $key ] = self::cubcf7db_generate_user_friendly_column_title( $key );
									}
								}
							}

							// Add form_id to the formatted result.
							$formatted_result['form_id'] = $result['form_id'];

							$formatted_results[] = $formatted_result;
						}
					}
				}

				// Limit to the first 5 columns.
				$columns       = array_slice( $columns, 0, 5 );
				$column_titles = array_slice( $column_titles, 0, 5 );

				// Ensure form_id is included in columns and titles.
				if ( ! in_array( 'form_id', $columns, true ) ) {
					$columns[]                = 'form_id';
					$column_titles['form_id'] = 'Form ID';
				}

				// Remove any extra data from formatted_results.
				$formatted_results = array_map(
					function ( $row ) use ( $columns ) {
						return array_intersect_key( $row, array_flip( $columns ) );
					},
					$formatted_results
				);

				wp_send_json_success(
					array(
						'columns'       => $columns,
						'data'          => $formatted_results,
						'column_titles' => $column_titles,
					)
				);
			} else {
				wp_send_json_error( 'No data found for the provided ID' );
			}
		} else {
			wp_send_json_error( 'ID not provided' );
		}
	}

	/**
	 * Get a single Contact Form 7 form's single record.
	 *
	 * @since 1.0.0
	 *
	 * @param int $id The ID of the form record to retrieve.
	 * @return object|null The form record object or null if not found or unauthorized.
	 */
	public function cubcf7db_cf7form_single_recorddetail( $id ) {
		// Check if the current user has the necessary capability.
		if ( ! current_user_can( 'manage_options' ) ) {
			return null; // Return null if user is not authorized.
		}

		global $wpdb;
		$result = null;

		// Validate $id as a positive integer.
		if ( isset( $id ) && is_numeric( $id ) && $id > 0 ) {
			$cfdb       = apply_filters( 'cubcf7db_database', $wpdb );
			$table_name = $cfdb->prefix . 'cubcf7db_forms';

			// Prepare and execute the SQL query.
			$query  = $cfdb->prepare( "SELECT * FROM $table_name WHERE form_id = %d", $id );
			$result = $cfdb->get_row( $query ); // Fetch the result as a single object.
		}

		return $result; // Return the form record object or null if not found or invalid ID.
	}


	/**
	 * Generate a user-friendly column title from a column key.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key The original column key.
	 * @return string The user-friendly column title.
	 */
	public function cubcf7db_generate_user_friendly_column_title( $key ) {

		// Remove specific substrings.
		$key_val = str_replace( array( 'your-', 'cfdb7_file' ), '', $key );

		// Remove trailing numbers.
		$key_val = preg_replace( '/\d+$/', '', $key_val );

		// Remove all numbers.
		$key_val = preg_replace( '/\d/', '', $key_val );

		// Replace underscores and hyphens with spaces.
		$key_val = str_replace( array( '_', '-' ), ' ', $key_val );

		// Capitalize the result and trim any extra spaces.
		$user_friendly_title = ucwords( trim( $key_val ) );

		return $user_friendly_title;
	}

	/**
	 * Delete a single Contact Form 7 form record and redirect to the main page.
	 *
	 * @since 1.0.0
	 */
	public function cubcf7db_delete_record() {

		// Check nonce for security
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cubcf7db_ajax_nonce')) {
			wp_send_json_error('Invalid nonce');
			return;
		}

		if (!current_user_can('manage_options')) {
			wp_send_json_error(array('message' => 'You do not have sufficient permissions to access this page.'));
		}
		
		// Check if the user has sufficient permissions.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => 'You do not have sufficient permissions to delete this record.' ) );
		}

		// Get the ID from the AJAX request data.
		$id = isset( $_POST['form_id'] ) ? absint( $_POST['form_id'] ) : 0;

		// Validate the ID.
		if ( ! $id ) {
			wp_send_json_error( array( 'message' => 'Invalid record ID.' ) );
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'cubcf7db_forms';

		// Execute the delete query.
		$deleted = $wpdb->query( $wpdb->prepare( "DELETE FROM $table_name WHERE form_id = %d", $id ) );

		if ( false !== $deleted ) {
			// Redirect to the main page after successful deletion.
			wp_send_json_success( array( 'message' => 'Record deleted successfully.' ) );
		} else {
			wp_send_json_error( array( 'message' => 'Error deleting record.' ) );
		}
	}
}