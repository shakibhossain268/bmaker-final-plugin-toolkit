<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_testimonial extends Widget_Base {

	public function get_name() {
		return 'bm_testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
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
			'section_background_image',
			[
				'label' => esc_html__( 'Background Image', 'bmaker-toolkit' )
			]
		);


		$this->add_control(
			'background_image',
			[
				'label'   => esc_html__( 'Chose Image', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bm_section_content',
			[
				'label' => esc_html__( 'Bmaker Heading', 'bmaker-toolkit' )
			]
		);

		$this->add_control(
			'bm_title',
			[
				'label'       => esc_html__( 'Title', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'bmaker-toolkit' ),
				'default'     => esc_html__( 'Testimonial', 'bmaker-toolkit' ),
			]
		);
		$this->add_control(
			'bm_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'sentobar-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your subtitle.', 'bmaker-toolkit' ),
				'default'     => esc_html__( 'What Our Client Say', 'bmaker-toolkit' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__( 'Testimonial', 'bmaker-toolkit' )
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
			'rating',
			[
				'label'   => esc_html__( 'Client Rating', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'4'         => 5,
					'3'         => 4,
					'2'         => 3,
					'1'         => 2,
					'0'         => 1,
					'no-rating' => 'No rating',
				],
				'default' => '4',


			]
		);
		$repeater->add_control(
			'review',
			[
				'label'       => esc_html__( 'Review', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => esc_html__( 'Lorem Ipsum is not simply random text. It roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, Latin professor at Hampden-Sydney
				                College in Virginia, looked up one of the more obscure Latin words, consectetur', 'bmaker-toolkit' ),
				'placeholder' => esc_html__( 'Type your review content here', 'bmaker-toolkit' ),
			]
		);
		$repeater->add_control(
			'client_name',
			[
				'label'       => esc_html__( 'Name', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Client Name', 'bmaker-toolkit' ),
				'placeholder' => esc_html__( 'Type your Name', 'bmaker-toolkit' ),
			]
		);
		$repeater->add_control(
			'client_address',
			[
				'label'       => esc_html__( 'Address', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Client Address', 'bmaker-toolkit' ),
				'placeholder' => esc_html__( 'Type your Address', 'bmaker-toolkit' ),
			]
		);
		$this->add_control(
			'list',
			[
				'label'       => esc_html__( 'Item List', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'client_name'    => esc_html__( 'item #1', 'bmaker-toolkit' ),
						'client_address' => esc_html__( 'UAE', 'bmaker-toolkit' ),
					],
					[
						'client_name'    => esc_html__( 'item #1', 'bmaker-toolkit' ),
						'client_address' => esc_html__( 'USA', 'bmaker-toolkit' ),
					],
				],
				'title_field' => '{{{ client_name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'bm_title-style',
			[
				'label' => esc_html__( 'Bmaker Heading', 'bmaker-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_title_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .section-title h2',

			]
		);

		$this->add_control(
			'bm_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .section-title h2' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_subtitle_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .sub-title h4',

			]
		);

		$this->add_control(
			'bm_subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .sub-title h4' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'testi_bg_color_section',
			[
				'label' => esc_html__( 'Background Color', 'plugin-name' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'testi_background_color',
			[
				'label'     => esc_html__( 'Testimonial Background', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#cb3727db',
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'testi_client_img_section',
			[
				'label' => esc_html__( 'Client Image', 'plugin-name' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'      => esc_html__( 'Image Size', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 110,
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .img-area img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .img-area img',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [ '50px', '50%' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .img-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'client_ratting',
			[
				'label' => esc_html__( 'Client Ratting', 'plugin-name' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'controler_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'sentobar-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .icon-area i ' => 'color: {{VALUE}};',
				],
				'default'   => '#FFA500',
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .icon-area i ' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_space',
			[
				'label'      => esc_html__( 'Icon Space', 'bmaker-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .icon-area i ' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'client_review',
			[
				'label' => esc_html__( 'Client Review', 'plugin-name' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_client_review_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .texti-area p',
			]
		);

		$this->add_control(
			'bm_review_color',
			[
				'label'     => esc_html__( 'Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .texti-area p' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',

			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'client_info',
			[
				'label' => esc_html__( 'Client Information', 'plugin-name' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography ', 'bmaker-toolkit' ),
				'name'     => 'bm_client_name_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .texti-area h4',
			]
		);

		$this->add_control(
			'bm_client_name_color',
			[
				'label'     => esc_html__( 'Name Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .texti-area h4' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_client_address_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .texti-area span',
			]
		);

		$this->add_control(
			'bm_client_address_color',
			[
				'label'     => esc_html__( 'Address Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .testimonial-info .dark-overlay .testimonial-content .slider-area .single-testimonial .testimonial-back .texti-area span' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',

			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( is_admin() ) {
			?>
            <script>
                ;
                (function ($) {
                    $('.testimonial-carousel').owlCarousel({
                        loop: true,
                        nav: true,
                        dots: false,
                        autoplay: false,
                        navText: ["<i class='bx bx-chevron-left'></i>", "<i class='bx bx-chevron-right'></i>"],
                        navClass: ['owl-prev', 'owl-next'],
                        responsive: {
                            0: {
                                items: 1,
                                nav: false
                            },
                            767: {
                                items: 1,
                            },
                            1000: {
                                items: 1,
                            }
                        }
                    });
                })(jQuery);
            </script>

			<?php
		}
		?>
        <div class="testimonial-area">
            <div class="testimonial-info"
                 style="background-image: url(<?php echo esc_url( $settings['background_image']['url'] ); ?>);">
                <div class="dark-overlay">
                    <div class="container testimonial-content">
                        <div class="section-title">
                            <h2 class=""><?php echo $settings['bm_title'] ?></h2>
                        </div>
                        <div class="sub-title text-center">
                            <h4><?php echo $settings['bm_subtitle'] ?></h4>
                        </div>
                        <div class="slider-area text-center">
                            <div class="testimonial-carousel owl-carousel">
								<?php
								foreach ( $settings['list'] as $item ) :
									?>
                                    <div class="item">
                                        <div class="single-testimonial">
                                            <div class="img-area">
												<?php if ( ! empty( $item['image']['url'] ) ) : ?>
                                                    <img src="<?php echo esc_url( $item['image']['url'] ); ?>"
                                                         class="img-fluid" alt="">
												<?php endif; ?>
                                            </div>
                                            <div class="testimonial-back">
												<?php if ( $item['rating'] != 'no-rating' ) : ?>
                                                    <div class="icon-area">
														<?php
														$stringRating = $item['rating'];
														$intRating    = (int) $stringRating;
														for ( $i = $intRating; $i >= 0; $i -- ) {
															echo '<i class="' . esc_attr( "bx bxs-star" ) . '"></i>';
														}
														?>
                                                    </div>
												<?php endif; ?>

                                                <div class="texti-area">
													<?php if ( ! empty( $item['review'] ) ) : ?>
                                                        <p><?php echo wp_kses_post( $item['review']); ?></p>														
													<?php endif; ?>

													<?php if ( ! empty( $item['client_name'] ) ) : ?>
                                                        <h4></h4>

													<?php endif; ?>

													<?php if ( ! empty( $item['client_address'] ) ) : ?>
                                                        <span><?php echo wp_kses_post( $item['client_address']); ?></span>
													<?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new bmaker_testimonial() );