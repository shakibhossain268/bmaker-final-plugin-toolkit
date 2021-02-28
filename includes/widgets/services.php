<?php
/*
* Services Post Types
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

// Services Custom Post and Taxonomy
function bmaker_service_register() {
	$service_labels = array(
		'name'          => esc_html__( 'Services', 'bmaker-toolkit' ),
		'singular_name' => esc_html__( 'Service', 'bmaker-toolkit' ),
		'search_items'  => esc_html__( 'Search services', 'bmaker-toolkit' ),
		'all_items'     => esc_html__( 'All Services', 'bmaker-toolkit' ),
		'parent_item'   => esc_html__( 'Parent Service Item', 'bmaker-toolkit' ),
		'edit_item'     => esc_html__( 'Edit Service Item', 'bmaker-toolkit' ),
		'update_item'   => esc_html__( 'Update Service Item', 'bmaker-toolkit' ),
		'add_new_item'  => esc_html__( 'Add New Service Item', 'bmaker-toolkit' )
	);
	$args           = array(
		'labels'             => $service_labels,
		'rewrite'            => array( 'slug' => 'our-services', 'with_front' => true ),
		'singular_label'     => esc_html__( 'Service', 'bmaker-toolkit' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'hierarchical'       => true,
		'has_archive'        => true,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-admin-multisite',
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'bm-service', $args );
	$service_cat_labels = array(
		'name'          => esc_html__( 'Service Category', 'bmaker-toolkit' ),
		'singular_name' => esc_html__( 'Service Category', 'bmaker-toolkit' ),
		'search_items'  => esc_html__( 'Search Services Category', 'bmaker-toolkit' ),
		'all_items'     => esc_html__( 'All Service Category', 'bmaker-toolkit' ),
		'parent_item'   => esc_html__( 'Parent Service Category', 'bmaker-toolkit' ),
		'edit_item'     => esc_html__( 'Edit Service Category', 'bmaker-toolkit' ),
		'update_item'   => esc_html__( 'Update Service Category', 'bmaker-toolkit' ),
		'add_new_item'  => esc_html__( 'Add New Service Category', 'bmaker-toolkit' ),
		'menu_name'     => esc_html__( 'Service Categories', 'bmaker-toolkit' )
	);
	register_taxonomy( 'service-cat',
		array( 'bm-service' ),
		array(
			'hierarchical'      => true,
			'labels'            => $service_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'service-cat' )

		)
	);

}

add_action( 'init', 'bmaker_service_register' );

function service_custom_meta() {
	add_meta_box( 'service_meta', __( 'Icon Class', 'bmaker-toolkit' ), 'service_meta_callback', 'bm-service' );
}

add_action( 'add_meta_boxes', 'service_custom_meta' );

function service_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'service_nonce' );
	$service_stored_meta = get_post_meta( $post->ID );
	?>
    <input type="text" name="service_icon_class" id="meta-text"
           value="<?php if ( isset( $service_stored_meta['service_icon_class'] ) ) {
		       echo $service_stored_meta['service_icon_class'][0];
	       } ?>" style="width:50%;font-size:16px; margin-bottom:20px" placeholder="bx bx-right-arrow-alt">
	<?php
}

//Save field Value
function service_save_meta( $post_id ) {
	// check save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	// Exit script depending check status
	if ( $is_autosave && $is_revision ) {
		return;
	}
	// check for input sanitize /saves is needed
	if ( isset( $_POST['service_icon_class'] ) ) {
		update_post_meta( $post_id, 'service_icon_class', sanitize_text_field( $_POST['service_icon_class'] ) );
	}
}

add_action( 'save_post', 'service_save_meta' );