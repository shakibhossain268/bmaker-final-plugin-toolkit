<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_contact extends Widget_Base {

	public function get_name() {
		return 'bm_contact';
	}

	public function get_title() {
		return esc_html__( 'Contact Card', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-tel-field';
	}

	public function get_categories() {
		return [ 'bmkr-kit' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'bm_section_content',
			[
				'label' => esc_html__( 'Content', 'bmaker-toolkit' )
			]
		);
		$this->add_control(
			'bm_contact_title',
			[
				'label'       => esc_html__( 'Title', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'bmaker-toolkit' ),
				'default'     => esc_html__( 'Email', 'bmaker-toolkit' ),
			]
		);
		$this->add_control(
			'bm_contact_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your subtitle', 'bmaker-toolkit' ),
				'default'     => esc_html__( 'info@example.com', 'bmaker-toolkit' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bm_section_icon',
			[
				'label' => esc_html__( 'Icon', 'bmaker-toolkit' )
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Icon type', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'iconclass',
				'options' => [
					'iconclass' => esc_html__( 'Icon Class', 'bmaker-toolkit' ),
					'image'     => esc_html__( 'Image', 'bmaker-toolkit' ),
				],
			]
		);

		$this->add_control(
			'service_icon',
			[
				'label'       => esc_html__( 'Icon Class', 'bmaker-toolkit' ),
				'classes'     => Controls_Manager::TEXT,
				'description' => esc_html__( 'Use icon from the link ', 'bmaker-toolkit' ) . '<a href="//boxicons.com/" target="_blank">boxicons.com</a>',
				'default'     => esc_attr( 'flaticon-email' ),
				'label_block' => true,
				'condition'   => [
					'icon_type' => 'iconclass',
				],
			]

		);
		$this->add_control(
			'service_image',
			[
				'label'     => esc_html__( 'Choose Image', 'plugin-domain' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <div class="contact-box-area">
            <div class="single-contact-box text-center">
                <div class="mete-title">
					<?php if ( $settings['icon_type'] == 'iconclass' ) : ?>
                        <i class="<?php echo $settings['service_icon']; ?>"></i>
					<?php endif; ?>
					<?php if ( $settings['icon_type'] == 'image' ) : ?>
                        <img class="img-fluid" src="<?php echo esc_url( $settings['service_image']['url'] ); ?>">
					<?php endif; ?>
                    <h2><?php echo wp_kses_post( $settings['bm_contact_title'] ); ?></h2>
                </div>
                <div class="meta-content">
                    <p><?php echo wp_kses_post( $settings['bm_contact_subtitle'] ); ?></p>
                </div>
            </div>
        </div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new bmaker_contact() );
