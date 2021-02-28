<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_logo_carousel extends Widget_Base {
	
	public function get_name() {
		return 'bm_logo_carousel';
	}
	
	public function get_title() {
		return esc_html__( 'Logo Carousel', 'bmaker-toolkit' );
	}
	
	public function get_icon() {
		return 'eicon-logo';
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
			'section_logo',
			[
				'label' => esc_html__( 'logo Item', 'bmaker-toolkit' )
			]
		);
		
        $repeater = new Repeater();
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'placeholder' =>esc_html__( 'www.example.com', 'bmaker-toolkit' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Item List', 'plugin-domain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
                    [
						'image' =>esc_html__( 'item #1', 'bmaker-toolkit' ),
					],
					[
                         'image' => esc_html__( 'item #1', 'plugin-domain' ),
					],
				],

			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'bm_logo-style',
			[
				'label' => esc_html__( 'Logo Item', 'bmaker-toolkit' ),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);
		
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'logo Size', 'bmaker-toolkit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .brand-area .box-brand .brand-active .single-brand a img ' => 'width: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->end_controls_section();

}


	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if (is_admin()) :
		?>
			<script>
				
				;(function($) {
					$('.brand-active').owlCarousel({
						loop: true,
						nav:false,
						dots:true,
						autoplay: false,
						responsive: {
							0: {
								items: 1,
								nav: false
							},
							500: {
								items: 2,
							},
							767: {
								items: 3,
							},
							1000: {
								items: 4,
							},
							1201: {
								items: 5,
							}
						}
					});
				})(jQuery);
			</script>
        <?php
		 endif;
		?>

		<div class="brand-area">
            <div class="box-brand">
                <div class="brand-active owl-carousel">
				<?php foreach($settings['list'] as $item) : ?>
                    <div class="single-brand">
                        <a href="#"><img src="<?php echo esc_url($item['image']['url'] ); ?>" alt=""></a>
					</div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
 <?php



	}

}



Plugin::instance()->widgets_manager->register_widget_type( new bmaker_logo_carousel() );