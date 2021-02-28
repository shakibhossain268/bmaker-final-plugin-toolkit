<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_team extends Widget_Base {

	public function get_name() {
		return 'bm_team';
	}

	public function get_title() {
		return esc_html__( 'Team', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-person';
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
			'bm_section_team',
			[
				'label' => esc_html__( 'Team Item', 'bmaker-toolkit' )
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'member_img',
			[
				'label'   => esc_html__( 'Choose Image', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'team_member_name', [
				'label'       => esc_html__( 'Name', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Member Name', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'team_member_designation', [
				'label'       => esc_html__( 'Position', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Designation', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'fb_link',
			[
				'label'         => esc_html__( 'Facebook Link', 'bmaker-toolkit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'bmaker-toolkit' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);
		$repeater->add_control(
			'twitter_link',
			[
				'label'         => esc_html__( 'Twitter Link', 'bmaker-toolkit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'bmaker-toolkit' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$repeater->add_control(
			'instra_link',
			[
				'label'         => esc_html__( 'Instagram Link', 'bmaker-toolkit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'bmaker-toolkit' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);
		$repeater->add_control(
			'linked_in_link',
			[
				'label'         => esc_html__( 'linkedIn Link', 'bmaker-toolkit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__('https://your-link.com', 'bmaker-toolkit' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);
		$repeater->add_control(
			'team_member_content',
			[
				'label'       => esc_html__( 'Content', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your Content', 'bmaker-toolkit' ),
				'default'     => esc_html__( 'Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature', 'bmaker-toolkit' ),
			]
		);

		$this->add_control(
			'team_item_list',
			[
				'label'   => esc_html__('Team Member ', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'team_member_name'     => esc_html__( 'item #1', 'bmaker-toolkit' ),
						'team_member_position' => esc_html__('Designation', 'bmaker-toolkit' ),
					],
					[
						'team_member_name'     => esc_html__('item #1', 'bmaker-toolkit' ),
						'team_member_position' => esc_html__('Designation', 'bmaker-toolkit' ),
					],
				],

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
				'selector' => '{{WRAPPER}} .team-area .section-title h2',

			]
		);

		$this->add_control(
			'bm_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .section-title h2' => 'color: {{VALUE}};',
				],
				'default'   => '#353535',

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_subtitle_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .team-area .section-title p',

			]
		);

		$this->add_control(
			'bm_subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .section-title p' => 'color: {{VALUE}};',
				],
				'default'   => '#7e7e7e',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'bm_team_member_style',
			[
				'label' => esc_html__( 'Team Item', 'bmaker-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'plugin-name' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_member_name_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .team-area .team-box-area .single-team .team-content .title h4',

			]
		);

		$this->add_control(
			'bm_member_name_color',
			[
				'label'     => esc_html__( 'Name Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .team-box-area .single-team .team-content .title h4' => 'color: {{VALUE}};',
				],
				'default'   => '#353535',

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_member_desg_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .team-area .team-box-area .single-team .team-content .title h6',

			]
		);

		$this->add_control(
			'bm_member_desg_color',
			[
				'label'     => esc_html__( 'Designation Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .team-box-area .single-team .team-content .title h6 ' => 'color: {{VALUE}};',
				],
				'default'   => '#353535',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'plugin-name' ),
			]
		);
		$this->add_control(
			'bm_icon_color',
			[
				'label'     => esc_html__( 'Icon Color Normal', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .team-box-area .single-team .team-img .team-info .social-icon i' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',
			]
		);
		$this->add_control(
			'bm_icon_hover_color',
			[
				'label'     => esc_html__( 'Icon Color Hover', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .team-box-area .single-team .team-img .team-info .social-icon i:hover' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',
			]
		);
		$this->add_control(
			'bm_icon_bg_color',
			[
				'label'     => esc_html__( 'Icon Background Color Normal', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .team-box-area .single-team .team-img .team-info .social-icon i' => 'background: {{VALUE}};',
				],
				'default'   => '#FFFFFF00',
			]
		);
		$this->add_control(
			'bm_icon_bg_hover_color',
			[
				'label'     => esc_html__( 'Icon Background Color  Hover', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .team-box-area .single-team .team-img .team-info .social-icon i:hover' => 'background: {{VALUE}};',
				],
				'default'   => '#CB3727',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'    => esc_html__( 'Icon Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .team-area .team-box-area .single-team .team-img .team-info .social-icon i',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_member_content_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .team-area .team-box-area .single-team .team-img .team-info p',

			]
		);

		$this->add_control(
			'bm_member_content_color',
			[
				'label'     => esc_html__( 'Content Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-area .team-box-area .single-team .team-img .team-info p ' => 'color: {{VALUE}};',
				],
				'default'   => '#fff',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( is_admin() ) {

			?>
            <script>
                ;
                (function ($) {
                    $('.team-box-area').owlCarousel({
                        loop: true,
                        nav: false,
                        dots: true,
                        autoplay: false,
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
        <div class="team-area">
                <div class="team-box-area team-slider owl-carousel">
                    <div class="row">
						<?php
						foreach ( $settings['team_item_list'] as $item ) {
							$target_fb      = $item['fb_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow_fb     = $item['fb_link']['nofollow'] ? ' rel="nofollow"' : '';
							$target_twitter   = $item['twitter_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow_twitter = $item['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';
							$target_insta   = $item['instra_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow_insta = $item['instra_link']['nofollow'] ? ' rel="nofollow"' : '';
							$target_linked   = $item['linked_in_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow_linked = $item['linked_in_link']['nofollow'] ? ' rel="nofollow"' : '';
							?>
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="single-team">
                                    <div class="team-img">
										<?php if ( ! empty( $item['member_img']['url'] ) ) : ?>
                                            <img class="img-fluid"
                                                 src="<?php echo esc_url( $item['member_img']['url'] ); ?>">
										<?php endif; ?>
                                        <div class="team-info">
                                            <div class="social-icon">
                                                <a href="<?php echo esc_url($item['fb_link']['url']); ?>"<?php echo esc_attr($target_fb . $nofollow_fb) ?>><i class='bx bxl-facebook'></i></a>
                                                <a href="<?php echo esc_url($item['twitter_link']['url']); ?>"<?php echo esc_attr($target_twitter . $nofollow_twitter) ?>><i class='bx bxl-twitter'></i></a>
                                                <a href="<?php echo esc_url($item['instra_link']['url']); ?>"<?php echo esc_attr($target_insta . $nofollow_insta) ?>><i class='bx bxl-instagram'></i></a>
                                                <a href="<?php echo esc_url($item['linked_in_link']['url']); ?>"<?php echo esc_attr($target_linked . $nofollow_linked) ?>><i class='bx bxl-linkedin'></i></a>
                                            </div>
                                            <p><?php echo $item['team_member_content']; ?></p>
                                        </div>
                                    </div>
                                    <div class="team-content text-center">
                                        <div class="title">
											<?php if ( ! empty( $item['team_member_name'] ) ) : ?>
                                                <h4><?php echo wp_kses_post( $item['team_member_name']); ?></h4>
											<?php endif; ?>

											<?php if ( ! empty( $item['team_member_designation'] ) ) : ?>
                                                <h6><?php echo wp_kses_post( $item['team_member_designation']); ?></h6>
											<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
		<?php

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new bmaker_team() );
