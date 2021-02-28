<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\core\Schemes;

class bm_BS_Widget_Heading extends Widget_Base {

	public function get_name() {
		return 'bm_bs_heading';
	}

	public function get_title() {
		return esc_html__( 'Heading', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-editor-h2';
	}

	public function get_categories() {
		return [ 'bmkr-kit' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'bm_section_content',
			[
				'label' => esc_html__( 'Bmaker Title', 'bmaker-toolkit' )
			]
		);

		$this->add_control(
			'bm_title',
			[
				'label'       => esc_html__( 'Title', 'elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'elementor' ),
				'default'     => esc_html__( 'This is heading element', 'elementor' ),
			]
		);
		$this->add_control(
			'bm_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'sentobar-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Short description goes here..', 'sentobar-toolkit' ),
				'default'     => '',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bm_title_style',
			[
				'label'     => esc_html__( 'Bmaker Title', 'bmaker-toolkit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'bm_title!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'     => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'      => 'bm_title_typography',
				'scheme'    => Schemes\Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .section-title h2',
				'condition' => [
					'bm_title!' => '',
				],
			]
		);

		$this->add_control(
			'bm_title_color',
			[
				'label'     => esc_html__( 'Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
				],
				'default'   => '#333',
				'condition' => [
					'bm_title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'bm_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'bm_title!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'bm_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'bm_title!' => '',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bm_subtitle_style',
			[
				'label' => esc_html__( 'Bmaker Subtitle', 'bmaker-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_subtitle_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .section-title p',
			]
		);

		$this->add_control(
			'bm_subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-title p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'bm_subtitle_padding',
			[
				'label'      => esc_html__( 'Padding', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bm_subtitle_margin',
			[
				'label'      => esc_html__( 'Margin', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .section-title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'width',
			[
				'label'      => esc_html__( 'Width', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 700,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title p' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		if ( ! empty( $settings['bm_title'] ) ) {
			?>
            <div class="section-title">
                <h2> <?php echo esc_html__( $settings['bm_title'], 'bmaker-toolkit' ) ?> </h2>
				<?php
				if ( ! empty( $settings['bm_subtitle'] ) ) {
					?>
                    <p><?php echo wp_kses_post( $settings['bm_subtitle'] ) ?></p>
					<?php
				}
				?>
            </div>
			<?php
		}
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new bm_BS_Widget_Heading() );

