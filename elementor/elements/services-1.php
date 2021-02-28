<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_service extends Widget_Base {

	public function get_name() {
		return 'bm_service_1';
	}

	public function get_title() {
		return esc_html__( 'Services-1', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-tools';
	}

	public function get_categories() {
		return [ 'bmkr-kit' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'section_service',
			[
				'label' => esc_html__( 'Service Item', 'bmaker-toolkit' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
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

		$repeater->add_control(
			'service_image',
			[
				'label'   => esc_html__( 'Choose Image', 'plugin-domain' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'service_icon',
			[
				'label'       => esc_html__( 'Icon Class', 'bmaker-toolkit' ),
				'classes'     => Controls_Manager::TEXT,
				'description' => esc_html__( 'Use icon from the link ', 'bmaker-toolkit' ) . '<a href="//boxicons.com/" target="_blank">boxicons.com</a>',
				'default'     => esc_attr( 'flaticon-architect' ),
				'label_block' => true,
				'condition'   => [
					'icon_type' => 'iconclass',
				],
			]

		);
		$repeater->add_control(
			'service_name',
			[
				'label'       => esc_html__( 'Name', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Service Name', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'service_desc',
			[
				'label'       => esc_html__('Description', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Service Description', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'service_item_list',
			[
				'label'   => esc_html__('Service Item', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'member_name'  => esc_html__( 'item #1', 'bmaker-toolkit' ),
						'service_desc' => esc_html__( 'Designation', 'bmaker-toolkit' ),
					],
					[
						'team_member_name'     => esc_html__( 'item #2', 'bmaker-toolkit' ),
						'team_member_position' => esc_html__( 'Designation', 'bmaker-toolkit' ),
					],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bm_service_style',
			[
				'label' => esc_html__( 'Services Item', 'bmaker-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'service_color_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .services-area .service-content .single-service h4',

			]
		);

		$this->add_control(
			'bm_service_name_color',
			[
				'label'     => esc_html__( 'Service Name Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-area .service-content .single-service h4' => 'color: {{VALUE}};',
				],
				'default'   => '#353535',

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'service_desc_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .services-area .service-content .single-service p',

			]
		);

		$this->add_control(
			'bm_service_desc_color',
			[
				'label'     => esc_html__( 'Service Description Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-area .service-content .single-service p' => 'color: {{VALUE}};',
				],
				'default'   => '#767676',

			]
		);
		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>
        <!-- services-area-start -->
        <div class="services-area">
                <div class="service-content">
                    <div class="row text-center">
						<?php foreach ( $settings['service_item_list'] as $item ) : ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="single-service">
									<?php if ( $item['icon_type'] == 'iconclass' ) : ?>
                                        <i class="<?php echo $item['service_icon']; ?>"></i>
									<?php endif; ?>

                                    <?php if ( $item['icon_type'] == 'image' ) : ?>
                                    <img class="img-fluid" src="<?php echo esc_url($item['service_image']['url'] ); ?>">
									<?php endif; ?>
									<?php if ( ! empty( $item['service_name'] ) ) : ?>
                                        <h4><?php echo wp_kses_post( $item['service_name']); ?></h4>
									<?php endif; ?>

									<?php if ( ! empty( $item['service_desc'] ) ) : ?>
										<p><?php echo wp_kses_post( $item['service_desc']); ?></p>
									<?php endif; ?>
                                </div>
                            </div>
						<?php endforeach; ?>
                    </div>
                </div>
            </div>
        <!-- services-area-end -->
		<?php

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new bmaker_service() );
