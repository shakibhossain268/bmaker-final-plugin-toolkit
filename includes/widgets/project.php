<?php
/*
* Project Post Types
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

// Recent project Custom Post and Taxonomy
function bmaker_project_register() {
	$project_labels = array(
		'name'          => esc_html__( 'Project-Gallery', 'bmaker-toolkit' ),
		'singular_name' => esc_html__( 'Project Item', 'bmaker-toolkit' ),
		'search_items'  => esc_html__( 'Search Project Item', 'bmaker-toolkit' ),
		'all_items'     => esc_html__( 'All Project', 'bmaker-toolkit' ),
		'parent_item'   => esc_html__( 'Parent Project Item', 'bmaker-toolkit' ),
		'edit_item'     => esc_html__( 'Edit Project Item', 'bmaker-toolkit' ),
		'update_item'   => esc_html__( 'Update Project Item', 'bmaker-toolkit' ),
		'add_new_item'  => esc_html__( 'Add New Project Item', 'bmaker-toolkit' )
	);
	$args           = array(
		'labels'             => $project_labels,
		'rewrite'            => array( 'slug' => 'our-projects', 'with_front' => true ),
		'singular_label'     => esc_html__( 'Project', 'bmaker-toolkit' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'hierarchical'       => true,
		'menu_position'      => 5,
		'has_archive'        => true,
		'menu_icon'          => 'dashicons-format-gallery',
		'show_in_rest'       => true,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'bm-project', $args );
	$project_cat_labels = array(
		'name'          => esc_html__( 'Project Category', 'bmaker-toolkit' ),
		'singular_name' => esc_html__( 'Project Category', 'bmaker-toolkit' ),
		'search_items'  => esc_html__( 'Search Project Category', 'bmaker-toolkit' ),
		'all_items'     => esc_html__( 'All Project Category', 'bmaker-toolkit' ),
		'parent_item'   => esc_html__( 'Parent Project Category', 'bmaker-toolkit' ),
		'edit_item'     => esc_html__( 'Edit Project Category', 'bmaker-toolkit' ),
		'update_item'   => esc_html__( 'Update Project Category', 'bmaker-toolkit' ),
		'add_new_item'  => esc_html__( 'Add New Project Category', 'bmaker-toolkit' ),
		'menu_name'     => esc_html__( 'Project Categories', 'bmaker-toolkit' )
	);
	register_taxonomy( 'project-cat',
		array( 'bm-project' ),
		array(
			'hierarchical'      => true,
			'labels'            => $project_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'project-cat' )

		)
	);

}

add_action( 'init', 'bmaker_project_register' );


//custom meta box 

function project_custom_meta() {
	add_meta_box( 'project_meta', __( 'Project Details', 'bmaker-toolkit' ), 'project_meta_callback', 'bm-project' );

}

add_action( 'add_meta_boxes', 'project_custom_meta' );
//field
function project_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'project_nonce' );
	$project_stored_meta = get_post_meta( $post->ID );
	?>
    <input type="text" name="meta_client_name" id="meta-text"
           value="<?php if ( isset( $project_stored_meta['meta_client_name'] ) ) {
		       echo $project_stored_meta['meta_client_name'][0];
	       } ?>" style="width:50%;font-size:16px; margin-bottom:20px;" placeholder="Client Name">
    <input type="text" name="meta_duration" id="meta-text"
           value="<?php if ( isset( $project_stored_meta['meta_duration'] ) ) {
		       echo $project_stored_meta['meta_duration'][0];
	       } ?>" style="width:50%;font-size:16px; margin-bottom:20px;" placeholder="Project Duration Time-15 Days">
    <input type="text" name="meta_client_location" id="meta-text"
           value="<?php if ( isset( $project_stored_meta['meta_client_location'] ) ) {
		       echo $project_stored_meta['meta_client_location'][0];
	       } ?>" style="width:50%;font-size:16px;margin-bottom:20px; " placeholder="Location-New York, California">
    <input type="date" name="meta_starting_date" id="meta-text"
           value="<?php if ( isset( $project_stored_meta['meta_starting_date'] ) ) {
		       echo $project_stored_meta['meta_starting_date'][0];
	       } ?>" style="width:50%;font-size:16px;>

<?php
}

//Save field Value
function project_save_meta( $post_id ) {
	// check save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	// Exit script depending check status
	if ( $is_autosave && $is_revision ) {
		return;
	}
	// check for input sanitize /saves is needed
	if ( isset( $_POST['meta_client_name'] ) ) {
		update_post_meta( $post_id, 'meta_client_name', sanitize_text_field( $_POST['meta_client_name'] ) );
	}
	if ( isset( $_POST['meta_duration'] ) ) {
		update_post_meta( $post_id, 'meta_duration', sanitize_text_field( $_POST['meta_duration'] ) );
	}
	if ( isset( $_POST['meta_client_location'] ) ) {
		update_post_meta( $post_id, 'meta_client_location', sanitize_text_field( $_POST['meta_client_location'] ) );
	}

	if ( isset( $_POST['meta_starting_date'] ) ) {
		update_post_meta( $post_id, 'meta_starting_date', sanitize_text_field( $_POST['meta_starting_date'] ) );
	}
}

add_action( 'save_post', 'project_save_meta' );