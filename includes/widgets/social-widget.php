<?php

//Social custom widget


class bmaker_social_widget extends WP_Widget {

	function __construct() {
		parent::__construct(

// Base ID of our widget
			'social_widget',

// Widget name
			__( 'Bmaker Social Content', 'bmaker_social_widget' ),

// Widget description
			array( 'Social Icon' => __( 'Social icon widget', 'bmaker_social_widget' ), )
		);
	}


// Creating widget front-end

	public function widget( $args, $instance ) {
		$facebook  = apply_filters( 'widget_facebook', $instance['facebook'] );
		$twitter   = apply_filters( 'widget_twitter', $instance['twitter'] );
		$linkedin  = apply_filters( 'widget_linkedin', $instance['linkedin'] );
		$pinterest = apply_filters( 'widget_pinterest', $instance['pinterest'] );
		$skype     = apply_filters( 'widget_skype', $instance['skype'] );
		$github    = apply_filters( 'widget_github', $instance['github'] );
		$youtube   = apply_filters( 'widget_youtube', $instance['youtube'] );
		$flickr    = apply_filters( 'widget_flickr', $instance['flickr'] );


		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		echo '<div class="company-info">';
		echo '<div class="social-icon">';
		if ( ! empty( $facebook && $twitter != '#' ) ) {
			echo '<a href="' . esc_url( $facebook ) . '"><i class="bx bxl-facebook-square"></i></a>';
		}

		if ( ! empty( $twitter && $twitter != '#' ) ) {
			echo '<a href="' . esc_url( $twitter ) . '"><i class="bx bxl-twitter"></i></a>';
		}

		if ( ! empty( $linkedin ) && $linkedin != '#' ) {
			echo '<a href="' . esc_url( $linkedin ) . '"><i class="bx bxl-linkedin-square"></i></a>';
		}

		if ( ! empty( $pinterest ) && $pinterest != '#' ) {
			echo '<a href="' . esc_url( $pinterest ) . '"><i class="bx bxl-pinterest"></i></a>';
		}

		if ( ! empty( $skype ) && $skype != '#' ) {
			echo '<a href="' . esc_url( $skype ) . '"><i class="bx bxl-skype"></i></a>';
		}

		if ( ! empty( $github ) && $github != '#' ) {
			echo '<a href="' . esc_url( $github ) . '"><i class="bx bxl-github"></i></a>';
		}

		if ( ! empty( $youtube ) && $youtube != '#' ) {
			echo '<a href="' . esc_url( $youtube ) . '"><i class="bx bxl-youtube"></i></a>';
		}

		if ( ! empty( $flickr ) && $flickr != '#' ) {
			echo '<a href="' . esc_url( $flickr ) . '"><i class="bx bxl-flickr-square"></i></a>';
		}
		echo '</div>';
		echo '</div>';
		echo $args['after_widget'];
	}


	// Widget Backend
	public function form( $instance ) {
		$facebook  = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter   = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
		$linkedin  = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
		$pinterest = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '';
		$skype     = ! empty( $instance['skype'] ) ? $instance['skype'] : '';
		$github    = ! empty( $instance['github'] ) ? $instance['github'] : '';
		$youtube   = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
		$flickr    = ! empty( $instance['flickr'] ) ? $instance['flickr'] : '';

		// Widget admin form
		?>

        <!--Facebook-->
        <p>
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>"
                   name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text"
                   value="<?php echo esc_url( $facebook );
			       ?>"/>
        </p>

        <!--Twitter-->
        <p>
            <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>"
                   name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text"
                   value="<?php echo esc_url( $twitter ); ?>"/>
        </p>


        <!--Linkedin-->
        <p>
            <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linkedin:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>"
                   name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text"
                   value="<?php echo esc_url( $linkedin ); ?>"/>
        </p>

        <!--Pinterest-->
        <p>
            <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>"
                   name="<?php echo $this->get_field_name( 'pinterest' ); ?>" type="text"
                   value="<?php echo esc_url( $pinterest ); ?>"/>
        </p>


        <!--Skype-->
        <p>
            <label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e( 'Skype:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'skype' ); ?>"
                   name="<?php echo $this->get_field_name( 'skype' ); ?>" type="text"
                   value="<?php echo esc_url( $skype ); ?>"/>
        </p>

        <!--Github-->
        <p>
            <label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e( 'Github:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'github' ); ?>"
                   name="<?php echo $this->get_field_name( 'github' ); ?>" type="text"
                   value="<?php echo esc_url( $github ); ?>"/>
        </p>


        <!--YouTube-->
        <p>
            <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>"
                   name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text"
                   value="<?php echo esc_url( $youtube ); ?>"/>
        </p>

        <!--flickr-->
        <p>
            <label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr:', 'bmaker' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>"
                   name="<?php echo $this->get_field_name( 'flickr' ); ?>" type="text"
                   value="<?php echo esc_url( $flickr ); ?>"/>
        </p>
		<?php
	}


// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance              = array();
		$instance['facebook']  = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['twitter']   = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
		$instance['linkedin']  = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
		$instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
		$instance['skype']     = ( ! empty( $new_instance['skype'] ) ) ? strip_tags( $new_instance['skype'] ) : '';
		$instance['github']    = ( ! empty( $new_instance['github'] ) ) ? strip_tags( $new_instance['github'] ) : '';
		$instance['youtube']   = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
		$instance['flickr']    = ( ! empty( $new_instance['flickr'] ) ) ? strip_tags( $new_instance['flickr'] ) : '';

		return $instance;
	}

}
