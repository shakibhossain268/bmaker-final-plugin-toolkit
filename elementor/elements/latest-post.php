<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\core\Schemes;

class bm_BS_Widget_Latest_Post extends Widget_Base {

	public function get_name() {
		return 'bm_bs_latest_post';
	}

	public function get_title() {
		return esc_html__( 'Latest Post', 'bmaker-toolkit' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'bmkr-kit' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'post_settings',
			[
				'label' => esc_html__( 'Post Settings', 'bmaker-toolkit' )
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

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
        <div class="blog-area">
            <div class="blog-box">
                <div class="row">
                    <div class="col-xl-7 col-lg-7">
						<?php
						$bmaker_fp = new \WP_Query(
							array(
								'post_type'      => 'post',
								'posts_per_page' => 1,
								'offset'         => 0,
								'post_status'    => 'publish'
							)
						);
						while ( $bmaker_fp->have_posts() ) {
							$bmaker_fp->the_post();
							$author     = get_the_author_meta( 'display_name' );
							$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
							?>
                            <div class="main-blog">
                                <div class="blog-img">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-fluid' ) ); ?> </a>

                                </div>
                                <div class="blog-content">
                                    <div class="meta-title d-flex">
                                        <a href="<?php echo esc_url( $author_url ); ?>"><i
                                                    class='flaticon-user'></i><span><?php echo esc_html( 'By ' . $author ); ?></span></a>
                                        <a href="#"><i
                                                    class='flaticon-calendar'></i><span><?php echo get_the_date(); ?></span></a>
                                        <a href="#"><i
                                                    class='flaticon-speech-bubbles-comment-option'></i><span><?php echo wp_kses_post( 'Comment (' . get_comments_number() . ')' ); ?></span></a>
                                    </div>
                                    <h5>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>
                                    <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more ', 'bmaker-toolkit' ) ?>
                                        <i
                                                class='bx bx-chevrons-right'></i></a>

                                </div>
                            </div>
							<?php
						}
						wp_reset_query();

						?>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="sub-blog">
                            <div class="row">
								<?php
								$bmaker_fp = new \WP_Query(
									array(
										'post_type'      => 'post',
										'posts_per_page' => 2,
										'orderby'        => $settings['orderby'],
										'order'          => $settings['order'],
										'offset'         => 1,
										'post_status'    => 'publish'
									)
								);
								while ( $bmaker_fp->have_posts() ) {
									$bmaker_fp->the_post();
									$author     = get_the_author_meta( 'display_name' );
									$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
									?>

                                    <div class="col-xl-12 col-lg-12">
                                        <div class="small-blog">
                                            <div class="small-blog-img">
                                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-fluid' ) ); ?> </a>
                                            </div>
                                            <div class="blog-content">
                                                <div class="meta-title d-flex">
                                                    <a href="<?php echo esc_url( $author_url ); ?>"><i
                                                                class='flaticon-user'></i><span><?php echo esc_html( 'By ' . $author ); ?></span></a>
                                                    <a href="<?php echo get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ); ?>"><i
                                                                class='flaticon-calendar'></i><span><?php echo get_the_date(); ?></span></a>
                                                    <a href="#"><i
                                                                class='flaticon-speech-bubbles-comment-option'></i><span><?php echo wp_kses_post( 'Comment (' . get_comments_number() . ')' ); ?></span></a>
                                                </div>
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <p><?php echo excerpt( 20 ); ?></p>
                                                    <a class="read-more"
                                                       href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more ', 'bmaker-toolkit' ) ?>
                                                        <i class='bx bx-chevrons-right'></i></a>
                                            </div>
                                        </div>
                                    </div>
									<?php
								}
								?>
								<?php wp_reset_query(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new bm_BS_Widget_Latest_Post() );
