<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Core\Schemes;

class bmaker_portfolio extends Widget_Base {

	public function get_name() {
		return 'bm_portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'bmaker-toolkit' );
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
				'default'     => 'show-all',
				'options'     => [
					'show-all' => esc_html__( 'Show All', 'bmaker-toolkit' ),
					'by_name'  => esc_html__( 'Manual Selection', 'bmaker-toolkit' ),
				],
				'label_block' => true,
			]
		);
		$post_categories = get_terms( 'project-cat' );

		$post_options = [];
		foreach ( $post_categories as $post_cat ) {
			$post_options[ $post_cat->slug ] = $post_cat->name;
		}

		$this->add_control(
			'post_categories',
			[
				'label'       => esc_html__( 'Project Categories', 'bmaker-toolkit' ),
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
				'default' => 8
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
				'label'   => esc_html__( 'Order', 'sentobar-toolkit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'asc'  => esc_html__( 'Ascending', 'sentobar-toolkit' ),
					'desc' => esc_html__( 'Descending', 'sentobar-toolkit' )
				],
				'default' => 'desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'bmaker-toolkit' )
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button text', 'bmaker-toolkit' ),
				'type'    => Controls_Manager::TEXT,
				'desc'    => esc_html__( 'This text will be visible in action button', 'bmaker-toolkit' ),
				'default' => esc_html__( 'Project Detials', 'bmaker-toolkit' ),
			]
		);
		$this->end_controls_section();

	}

	public function render_script() {
		$settings = $this->get_settings();
		?>
        <script>
            (function ($) {
                new WOW().init();
                var $grid = $('.portfolio-active').isotope({
                    itemSelector: '.grid-item',
                    percentPosition: true,
                    masonry: {
                        columnWidth: 1
                    }
                })
                $('.portfolio-menu').on('click', 'button', function () {
                    var filterValue = $(this).attr('data-filter');
                    $grid.isotope({filter: filterValue});
                });
            })(jQuery);
        </script>
		<?php
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		global $post;
		$args = array(
			'post_type'      => 'bm-project',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'post_status'    => 'publish'
		);
		if ( $settings['source'] === 'by_name' ) {

			$args['tax_query'][] = array(
				'taxonomy' => 'project-cat',
				'field'    => 'slug',
				'terms'    => $settings['post_categories'],
			);
		}

		$bmaker_project = new \WP_Query( $args );
		$categories     = get_terms( 'project-cat' );
		?>
        <!-- portfolio-area-start -->
        <div class="portfolio-area">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="portfolio-menu button-group">
                            <button class="is-checked" data-filter="*"><?php echo esc_html( 'All' ) ?></button>
							<?php
							if ( ( $settings['source'] === 'show-all' ) ) {
								foreach ( $categories as $cat ) {
									$single    = $cat->name;
									$makeArray = explode( ' ', $single );
									foreach ( $makeArray as $singleItem ) {
										$singleItem = strtolower( $singleItem );
										?>
                                        <button data-filter=".<?php echo esc_attr( $singleItem ); ?>"><?php echo esc_html( $singleItem ); ?></button>
										<?php
									}
								}
							} else {
								foreach ( $settings['post_categories'] as $cat ) {
									?>
                                    <button data-filter=".<?php echo esc_attr( $cat ); ?>"><?php echo esc_html( $cat ); ?></button>
									<?php
								}
							}
							?>
                        </div>
                    </div>
                </div>

                <div class="row portfolio-active">
					<?php
					if ( $bmaker_project->have_posts() ) {
						while ( $bmaker_project->have_posts() ) {
							$bmaker_project->the_post();
							$location = get_post_meta( get_the_ID(), 'meta_client_location', true );

							$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
							$item_class       = '';
							$item_cats        = get_the_terms( $post->ID, 'project-cat' );
							if ( $item_cats ) {
								foreach ( $item_cats as $item_cat ) {
									$item_class .= $item_cat->slug . ' ';
								}
							}
							?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 grid-item <?php echo esc_attr( $item_class ); ?> >">
                                <div class="single-project">
                                    <div class="project-wrapper">
                                        <div class="project-thumb">
                                            <img class="img-fluid"
                                                 src="<?php echo esc_url( $featured_img_url ); ?>"
                                                 alt="img">
                                        </div>
										<?php
										if ( ! empty( $settings['button_text'] ) ) {
											?>
                                            <div class="project-content">
                                                <a href="<?php the_permalink(); ?>"
                                                   class="btn"><?php echo esc_html__( $settings['button_text'], 'bmaker-toolkit' ) ?></a>
                                            </div>
											<?php
										}
										?>
                                    </div>
                                    <div class="card">
                                        <div class="title">
                                            <h4> <?php the_title() ?></h4>
                                            <p class="sub-title"><?php echo esc_html( $location ); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php
						}
					}
					?>
                </div>
            </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new bmaker_portfolio() );