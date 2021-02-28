<?php

//recent post custom widget

class bmaker_recent_post_widget extends WP_Widget {

	function __construct() {
		parent::__construct(

// Base ID of our widget
			'recent_post',

// Widget name
			__( 'Bmaker Recent Post', 'bmaker_recent_post_widget' ),

// Widget description
			array( 'description' => __( 'LATEST POST', 'bmaker_recent_post_widget' ), )
		);
	}

	public function widget( $args, $instance ) {
		echo '<div class="sidebar-widget-area">';
		echo $args['before_widget'];
		echo '<h3 class="widget-title">' . esc_attr( __( "Latest posts", "bmaker" ) ) . '</h3>';

		echo '<div class="small-post-wrapper">';

		$bmakerRecentPosts = new WP_Query( array(
			'posts_per_page'      => 6,
			'orderby'             => "asc"
		) );

		while ( $bmakerRecentPosts->have_posts() ) {
			$bmakerRecentPosts->the_post();
			//print_r($bmakerRecentPosts);
			?>
            <div class="small-post-wrapper">
                <div class="small-post-item d-flex">
					<?php
					if ( has_post_thumbnail() ) {
						?>
                        <div class="small-post-item-image">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'img-fluid' ) ); ?> </a>
                        </div>
						<?php
					}
					?>
                    <div class="small-post-item-content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span><?php echo get_the_date(); ?></span>
                    </div>
                </div>
            </div>

			<?php
		}

		echo '</div>';
		echo '</div>';

		echo $args['after_widget'];

	}

}