<?php
/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.cubsys.com
 * @since      1.0.0
 *
 * @package    Cubcf7db
 * @subpackage Cubcf7db/admin/partials
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
// Start output buffering to prevent headers already sent issue.
ob_start();

$cubcf7db       = new CUBCF7DB();
$pluginname      = $cubcf7db->get_plugin_name();
$pluginversion   = $cubcf7db->get_version();
$cubcf7db_admin = new CUBCF7DB_Admin( $pluginname, $pluginversion );
$action_param    = isset( $_GET['action'] ) ? sanitize_text_field( wp_unslash( $_GET['action'] ) ) : null;
$formid          = isset( $_GET['formid'] ) ? absint( $_GET['formid'] ) : null;

if ( $action_param && 'view' === $action_param && $formid ) {
	// Get and sanitize the form id.
	$form_id = absint( $_GET['formid'] );

	// Get the single record detail.
	$singlerecord = $cubcf7db_admin->cubcf7db_cf7form_single_recorddetail( $form_id );

	// If record exists.
	if ( $singlerecord ) {
		$formdata = maybe_unserialize( $singlerecord->form_value ); ?>
<div class="wrapper-main">
    <div class="custome-container">
        <div class="page-title add-user">
            <h1><?php echo esc_html( get_the_title( $singlerecord->form_post_id ) ) . ' ' . esc_html__( 'Detail', 'cubcf7db' ); ?>
            </h1>
            <ul class="breadcrumbs">
                <li><a
                        href="<?php echo esc_url( admin_url( 'admin.php?page=cubcf7db-page' ) ); ?>"><?php esc_html_e( 'Contact Forms 7 Data', 'cubcf7db' ); ?></a>
                </li>
                <li><?php echo esc_html( get_the_title( $singlerecord->form_post_id ) ) . ' ' . esc_html__( 'Detail', 'cubcf7db' ); ?>
                </li>
            </ul>
        </div>

        <div class="page-inner">
            <form action="" class="view-inner">
                <div class="row">
                    <?php
						if ( isset( $formdata ) ) {
							foreach ( $formdata as $key => $data ) {
								if ( 'cubcf7db_status' !== $key ) {
									$formtitle = $cubcf7db_admin->cubcf7db_generate_user_friendly_column_title( $key );
									?>
                    <div class="col-sm-6 col-12">
                        <div class="form-group" style="padding-top:0;">
                            <label for="" class="view-label"><?php echo esc_html( $formtitle ); ?>:</label>
                            <h2 class="view-data"><?php echo esc_html( $data ); ?></h2>
                        </div>
                    </div>
                    <?php
								}
							}
						} else {
							?>
                    <div class="col-12">
                        <p><?php echo esc_html_e( 'No data available.', 'cubcf7db' ); ?></p>
                    </div>
                    <?php
						}
						?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=cubcf7db-page' ) ); ?>"
                            class="submit-button"><?php esc_html_e( 'Back', 'cubcf7db' ); ?><i
                                class="fa-solid fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
	}
} else {
	?>
<div class="wrapper-main">
    <div class="custome-container">
        <div class="page-title">
            <h1><?php esc_html_e( 'Contact Forms 7 Data', 'cubcf7db' ); ?></h1>
        </div>

        <div class="page-inner">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select id="cf7form_list_dropdown" class="cf7form_list_dropdown js-states form-control">
                            <?php
						$cf7_form_list = $cubcf7db_admin->cubcf7db_cf7form_list();
						if ( $cf7_form_list ) {
							foreach ( $cf7_form_list as $form ) {
								echo '<option value="' . esc_attr( $form->ID ) . '">' . esc_html( $form->post_title ) . '</option>';
							}
						}
						?>
                        </select>
                    </div>
                </div>
            </div>
            <table id="cubcf7form_listtable" class="table table-striped table-bordered display nowrap"
                style="width:100%">
                <thead>
                    <tr></tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</div>
<?php
}
?>
<div id="toastContainer" aria-live="polite" aria-atomic="true"
    style="position: fixed; top: 20px; right: 20px; z-index: 1000;"></div>
<div class="modal fade delete-popup" id="cubcf7db_delete_data_popup" tabindex="-1" role="dialog"
    aria-labelledby="cubcf7db_delete_data_popup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </button>

            <div class="modal-body">
                <div class="delete-img">
                    <i class="fa fa-trash fa-5x" aria-hidden="true"></i>
                </div>
                <h3><?php echo esc_html_e( 'Are you sure?', 'cubcf7db' ); ?></h3>
                <div class="sort-msg">
                    <p><?php echo esc_html_e( 'Do you really want to delete these records? This process cannot be undone.', 'cubcf7db' ); ?>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel"
                    data-dismiss="modal"><?php echo esc_html_e( 'Cancel', 'cubcf7db' ); ?></button>
                <a href="#" id="cubcf7db_popup_delete_button" data-form-id="" type="button"
                    class="btn delete"><?php echo esc_html_e( 'Delete', 'cubcf7db' ); ?></a>
            </div>
        </div>
    </div>
</div>
<?php ob_end_flush(); ?>