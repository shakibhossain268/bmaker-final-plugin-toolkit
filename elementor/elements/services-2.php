<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_services_two extends Widget_Base {

	public function get_name() {
		return 'bm_services_2';
	}

	public function get_title() {
		return esc_html__( 'Services-2', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'bmkr-kit' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_gallery',
			[
				'label' => esc_html__( 'Gallery Settings', 'bmaker-toolkit' )
			]
		);
		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'Posts Query Control', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'show_all',
				'options'     => [
					'show_all' => esc_html__( 'Show All', 'bmaker-toolkit' ),
					'by_name'  => esc_html__( 'Manual Selection', 'bmaker-toolkit' ),
				],
				'label_block' => true,
			]
		);
		$post_categories = get_terms( 'service-cat' );

		$post_options = [];
		foreach ( $post_categories as $post_cat ) {
			$post_options[ $post_cat->slug ] = $post_cat->name;
		}

		$this->add_control(
			'post_categories',
			[
				'label'       => esc_html__( 'Service Categories', 'bmaker-toolkit' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $post_options,
				'default'     => [],
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'source' => 'by_name',
				],
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label'   => esc_html__( 'Number of Posts', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::NUMBER,
				'desc'    => esc_html__( 'Choose number of posts you want to show.', 'bmaker-toolkit' ),
				'default' => 6
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'ID'         => esc_html__( 'Post Id', 'bmaker-toolkit' ),
					'author'     => esc_html__( 'Post Author', 'bmaker-toolkit' ),
					'title'      => esc_html__( 'Title', 'bmaker-toolkit' ),
					'date'       => esc_html__( 'Date', 'bmaker-toolkit' ),
					'rand'       => esc_html__( 'Random', 'bmaker-toolkit' ),
					'menu_order' => esc_html__( 'Menu Order', 'bmaker-toolkit' ),
				],
			]
		);
		$this->add_control(
			'order',
			[
				'label'    => esc_html__( 'Order', 'sentobar-toolkit' ),
				'type'     => Controls_Manager::SELECT,
				'options'  => [
					'asc'  => esc_html__( 'Ascending', 'sentobar-toolkit' ),
					'desc' => esc_html__( 'Descending', 'sentobar-toolkit' )
				],
				'default' => 'desc',
			]
		);

		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		global $post;
		$args = array(
			'post_type'      => 'bm-service',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'post_status'    => 'publish'
		);
		if ( $settings['source'] === 'by_name' ) {

			$args['tax_query'][] = array(
				'taxonomy' => 'service-cat',
				'field'    => 'slug',
				'terms'    => $settings['post_categories'],
			);
		}

		$bmaker_service = new \WP_Query( $args );
		?>
        <div class="service-wrapper">
            <div class="row">
				<?php
				if ( $bmaker_service->have_posts() ) {
					while ( $bmaker_service->have_posts() ) {
						$bmaker_service->the_post();
						$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						$icon_class       = get_post_meta( get_the_ID(), 'service_icon_class', true );
						?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="services-item">
                                <div class="services-img">
                                    <img class="img-fluid" src="<?php echo esc_url( $featured_img_url ); ?>"
                                         alt="Services">
                                    <span class="<?php echo esc_attr( $icon_class ) ?>"></span>
                                </div>
                                <div class="services-description">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>
                                    <a class="read-more"
                                       href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More ', 'bmaker-toolkit' ) ?>
                                        <i class='bx bx-right-arrow-alt'></i></a>
                                </div>
                            </div>
                        </div>
						<?php
					}
				}
				wp_reset_query();
				?>
            </div>
        </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new bmaker_services_two() );