<?php
// Enqueue Style
function bmaker_toolkit_admin_ocdi_styles() {

	wp_enqueue_style( 'bmaker-one-click-scripts', BMAKER_ACC_URL . 'assets/admin/css/importer.css' );

}

add_action( 'admin_enqueue_scripts', 'bmaker_toolkit_admin_ocdi_styles' );

/**
 * One Click Install
 * @return Import Demos - Needed Import Demo's
 */
function bmaker_toolkit_import_files() {
	return array(
		array(
			'import_file_name'           => 'bmaker',
			'import_file_url'            => trailingslashit( BMAKER_ACC_URL ) . 'includes/demo/contents.xml',
			'import_widget_file_url'     => trailingslashit( BMAKER_ACC_URL ) . 'includes/demo/widgets.wie',
			'import_customizer_file_url' => trailingslashit( BMAKER_ACC_URL ) . 'includes/demo/customizer.dat',
			'import_notice'              => __( 'Import process may take 3-5 minutes, please be patient. It\'s really based on your network speed.', 'bmaker-toolkit' ),
			'preview_url'                => 'http://epilogtheme.com',
		),
	);
}

add_filter( 'pt-ocdi/import_files', 'bmaker_toolkit_import_files' );

/**
 * Front Page, Post Page & Menu Set
 */
function bmaker_toolkit_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Header menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'header_menu' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home default' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}

add_action( 'pt-ocdi/after_import', 'bmaker_toolkit_after_import_setup' );

// Install Demos Menu - Menu Edited
function bmaker_toolkit_core_one_click_page( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Import Demo', 'bmaker-toolkit' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo', 'bmaker-toolkit' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'import_demos';

	return $default_settings;
}

add_filter( 'pt-ocdi/plugin_page_setup', 'bmaker_toolkit_core_one_click_page' );

// Model Popup - Width Increased
function bmaker_toolkit_ocdi_confirmation_dialog_options( $options ) {
	return array_merge( $options, array(
		'width'       => 600,
		'dialogClass' => 'wp-dialog',
		'resizable'   => false,
		'height'      => 'auto',
		'modal'       => true,
	) );
}

add_filter( 'pt-ocdi/confirmation_dialog_options', 'bmaker_toolkit_ocdi_confirmation_dialog_options', 10, 1 );

// Disable the branding notice - ProteusThemes
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function ocdi_plugin_intro_text( $default_text ) {
	$default_text .= '<h1>Import Bmaker Demo</h1>
    <div class="bmaker_toolkit_intro-text dl-demo-one-click">
    <div id="poststuff">

      <div class="postbox important-notes">
        <h3><span>Important notes:</span></h3>
        <div class="inside">
          <ol>
            <li>Please note, this import process will take time. So, please be patient.</li>
			<li>Please make sure you\'ve installed recommended plugins before you import this content.</li>
            <li>All images are demo purposes only. So, images may repeat in your site content.</li>
          </ol>
        </div>
      </div>
    </div>
  </div>';

	return $default_text;
}

add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );