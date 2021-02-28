<?php
/**
 * Elementor Addon Elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

require_once( BMAKER_ACC_PATH . '/elementor/elementor-helper.php' );

function bmaker_add_new_elements() {

	// load elements
	require_once BMAKER_ACC_PATH . '/elementor/elements/counter.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/heading.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/logo-carousel.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/recent-project.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/contact.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/services-1.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/services-2.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/services-3.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/slider.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/team.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/testimonial.php';
	require_once BMAKER_ACC_PATH . '/elementor/elements/latest-post.php';


}

add_action( 'elementor/widgets/widgets_registered', 'bmaker_add_new_elements' );
