<?php
/*
    Bmaker Custom Widgets
*/

// About Widget
require_once( BMAKER_ACC_PATH . '/includes/widgets/social-widget.php' );
require_once( BMAKER_ACC_PATH . '/includes/widgets/recent-post-widgets.php' );
require_once( BMAKER_ACC_PATH . '/includes/widgets/project.php' );
require_once( BMAKER_ACC_PATH . '/includes/widgets/services.php' );


// Register Custom Widget
function bmaker_toolkit_register_custom_widget() {

    register_widget( 'bmaker_social_widget' );
    register_widget( 'bmaker_recent_post_widget' );

}
add_action( 'widgets_init', 'bmaker_toolkit_register_custom_widget' );