<?php
namespace Elementor;

function bmaker_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'bmkr-kit',
        [
            'title'  => esc_html__( 'Bmaker Toolkit', 'bmaker-toolkit'),
            'icon' => 'fa fa-th-list'
        ]
    );
}
add_action('elementor/init','Elementor\bmaker_elementor_init');