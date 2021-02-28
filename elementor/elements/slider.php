<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_slider extends Widget_Base {

	public function get_name() {
		return 'bm_slider';
	}

	public function get_title() {
		return esc_html__( 'Slider', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'bmkr-kit' ];
	}

	public function get_script_depends() {
		return [
			'owl-carousel'
		];
	}

	protected function _register_controls() {


		$this->start_controls_section(
			'section_general',
			[
				'label' => esc_html__( 'General', 'bmaker-toolkit' )
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Slider Title', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'sub-title',
			[
				'label'       => esc_html__( 'Sub Title', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Slider Subtitle', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_content',
			[
				'label'      => esc_html__( 'Content', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::TEXTAREA,
				'default'    => esc_html__( 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it ', 'bmaker-toolkit' ),
				'show_label' => true,
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'plugin-name' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'View Project', 'bmaker-toolkit' ),
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label'         => esc_html__( 'Button Link', 'bmaker-toolkit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'bmaker-toolkit' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				]
			]
		);


		$this->add_control(
			'list',
			[
				'label'   => esc_html__( 'Slider Item', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'title'          => esc_html__( 'item #1', 'bmaker-toolkit' ),
						'slider_content' => esc_html__( 'item content. Click the edit button to change this text.', 'bmaker-toolkit' ),
					],
					[
						'title'          => esc_html__( 'item #2', 'bmaker-toolkit' ),
						'slider_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'bmaker-toolkit' ),
					],
				],

			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Slider Content', 'bmaker-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .banner-info .banner-content h1 .text-wrapper .letters' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .banner-info .banner-content h1 .text-wrapper .letters',

			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .banner-info .banner-content h2 ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .banner-info .banner-content h2',

			]
		);
		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Content Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .banner .banner-info .dark-overlay .banner-content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .banner .banner-info .dark-overlay .banner-content p',

			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Slider Button', 'bmaker-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_text_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .banner-content a .btn, {{WRAPPER}} .btn',

			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'bmaker-toolkit' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}}  .banner .banner-info .dark-overlay .banner-content a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label'     => esc_html__( 'Button Background', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#CB3727',
				'selectors' => [
					'{{WRAPPER}} .banner .banner-info .dark-overlay .banner-content .btn' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'bmaker-toolkit' ),
			]
		);
		$this->add_control(
			'button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}}  .banner .banner-info .dark-overlay .banner-content a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'value'     => Schemes\Color::COLOR_1,
				'default'   => '#ffa500',
				'selectors' => [
					'{{WRAPPER}} .banner .banner-info .dark-overlay .banner-content .btn:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
	}


	protected function render() {

		$settings = $this->get_settings_for_display();
		if ( is_admin() ) {
			?>
            <script>
                ;(function ($) {
                    $('.home-slider').owlCarousel({
                        loop: true,
                        nav: true,
                        dots: false,
                        autoplayHoverPause: true,
                        autoplay: true,
                        autoHeight: true,
                        animateOut: 'fadeOut',
                        animateIn: 'fadeIn',
                        navText: ["<i class='bx bx-chevron-left'></i>", "<i class='bx bx-chevron-right'></i>"],
                        items: 1,
                        smartSpeed: 1500,
                    });
                })(jQuery);
            </script>
			<?php
		}
		?>
        <!-- Banner -->

        <div class="home-slider owl-carousel owl-theme">
			<?php foreach ( $settings['list'] as $item ) :
				$target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
                <div class="item">
                    <div class="banner">
						<?php if ( ! empty( $item['image'] ) ) : ?>
                        <div class="banner-info"
                             style="background-image: url(<?php echo esc_url( $item['image']['url'] ); ?>);">
							<?php endif; ?>
                            <div class="dark-overlay">
                                <div class="banner-content">
                                    <h3 class="ml7 animated">
                                    <span class="text-wrapper">
                                      <?php if ( ! empty( $item['title'] ) ) : ?>
                                          <span class="letters"><?php echo wp_kses_post($item['title']); ?></span>
                                      <?php endif; ?>
                                    </span>
                                    </h3>
									<?php if ( ! empty( $item['sub-title'] ) ) : ?>
                                        <h2><?php echo wp_kses_post( $item['sub-title']); ?></h2>
									<?php endif; ?>

									<?php if ( ! empty( $item['slider_content'] ) ) : ?>
                                        <p><?php echo wp_kses_post( $item['slider_content']); ?></p>
									<?php endif; ?>
									<?php echo '<a class="btn" href="' . esc_url( $item['button_link']['url'] ) . '" ' . $target . $nofollow . '>' . $item['button_text'] . '</a>'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<?php
			endforeach;
			?>
        </div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new bmaker_slider() );
