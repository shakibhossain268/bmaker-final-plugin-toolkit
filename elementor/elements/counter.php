<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_counter extends Widget_Base {

	public function get_name() {
		return 'bm_counter';
	}

	public function get_title() {
		return esc_html__( 'Counter', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return [ 'bmkr-kit' ];
	}

	public function get_script_depends() {
		return [ 'jquery-numerator' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_counter',
			[
				'label' => esc_html__( 'Counter', 'bmaker-toolkit' )
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'counter_icon',
			[
				'label'       => esc_html__( 'Icon Class', 'bmaker-toolkit' ),
				'classes'     => Controls_Manager::TEXT,
				'default'     => esc_html__( '', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'number',
			[
				'label'   => esc_html__( 'Number', 'plugin-domain' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100000000,
				'step'    => 5,
				'default' => 10,
			]
		);


		$repeater->add_control(
			'counter_name',
			[
				'label'       => esc_html__( 'Title', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Counter Name', 'bmaker-toolkit' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'counter_item_list',
			[
				'label'       => esc_html__( 'Counter Item', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'counter_icon' => __( 'bx bx-group', 'bmaker-toolkit' ),
						'counter_name' => __( 'Experience Engineer', 'bmaker-toolkit' ),

					],
					[

						'counter_icon' => esc_html__( 'bx bx-home-circle', 'bmaker-toolkit' ),
						'counter_name' => esc_html__( 'Projects Done', 'bmaker-toolkit' ),


					],
					[
						'counter_icon' => esc_html__( 'bx bx-group', 'bmaker-toolkit' ),
						'counter_name' => esc_html__( 'Happy clients', 'bmaker-toolkit' ),

					],
					[
						'counter_icon' => esc_html__( 'bx bx-happy', 'bmaker-toolkit' ),
						'counter_name' => esc_html__( 'Award Won', 'bmaker-toolkit' ),

					],
				],
				'title_field' => '{{{ counter_name }}}',

			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'bg_color_section',
			[
				'label' => esc_html__( 'Background Color', 'plugin-name' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#CB3727',
				'selectors' => [
					'{{WRAPPER}} .counter' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'item_style_section',
			[
				'label' => esc_html__( 'Item Style', 'bmaker-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'bmaker-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .single-counter h2'              => 'color: {{VALUE}};',
					'{{WRAPPER}} .single-counter .counter-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .single-counter p'               => 'color: {{VALUE}};',
					'{{WRAPPER}} .single-counter span'            => 'background: {{VALUE}};',
				],
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
						'min' => 36,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .single-counter .counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Typography', 'bmaker-toolkit' ),
				'name'     => 'bm_counter_content_typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .single-counter p ',
			]
		);
		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		?>
        <div class="counter">
            <div class="row">
				<?php foreach ( $settings['counter_item_list'] as $key => $item ) { ?>
                    <div class="col-lg-3">
                        <div class="single-counter">
                            <div class="counter-icon">
                                <i class='<?php echo $item['counter_icon']; ?>'></i>
                            </div>
                            <h2 id="<?php echo 'number' . ++ $key; ?>"><?php echo $item['number']; ?></h2>
                            <span></span>
                            <p><?php echo wp_kses_post( $item['counter_name'] ); ?></p>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
        </div>

        <script>
            ;(function ($) {
                function animateValue(id, start, end, duration) {
                    var obj = document.getElementById(id);
                    var range = end - start;
                    // no timer shorter than 50ms (not really visible any way)
                    var minTimer = 50;
                    // calc step time to show all interediate values
                    var stepTime = Math.abs(Math.floor(duration / range));
                    // never go below minTimer
                    stepTime = Math.max(stepTime, minTimer);
                    // get current time and calculate desired end time
                    var startTime = new Date().getTime();
                    var endTime = startTime + duration;
                    var timer;

                    function run() {
                        var now = new Date().getTime();
                        var remaining = Math.max((endTime - now) / duration, 0);
                        var value = Math.round(end - (remaining * range));
                        obj.innerHTML = value;
                        if (value == end) {
                            clearInterval(timer);
                        }
                    }

                    timer = setInterval(run, stepTime);
                    run();
                }

				<?php
				foreach ( $settings['counter_item_list'] as $key=> $item ){
				?>
                animateValue("<?php echo 'number' . ++ $key?>", 0, <?php echo $item['number']; ?>, 5000);
				<?php
				}
				?>
            })(jQuery);
        </script>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new bmaker_counter() );