<?php

class SistemOtelWidget extends WP_Widget {
	
	// constructor
	function __construct() {
		$widget_ops = array( 
			'classname' => 'sistemotel',
			'description' => __('Sistem Otel Widget', 'istbooking-widget'),
		);
		parent::__construct( false, __('Sistem Otel Widget', 'istbooking-widget'), $widget_ops );
	}
	
	// widget form creation
	function form($instance) {
		
	// Check title
	if( $instance) {
		$title = esc_attr($instance['title']);
	
	} else {
		// Initial title
		$title = __('Availability', 'advanced-booking-calendar');
	}	
		echo "<p>
				<label for=\"".$this->get_field_id('title')."\">".__('Title:', 'advanced-booking-calendar')."</label>
				<input class=\"widefat\" id=\"".$this->get_field_id('title')."\" name=\"".$this->get_field_name('title')."\" type=\"text\" value=\"".$title."\" />
			</p>";
		// Frontend output

			echo "<p>".__('This widgets loads a small booking form. After a user selected the dates and clicked on "Check availabilites", the booking form is loaded.', 'advanced-booking-calendar')."</p>";

	}
	
	// Update function for changes
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	// Display widget
	function widget($args, $instance) {
		global $abcUrl;
		extract( $args );
		$title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		echo $before_widget;
		echo '<div class="widget-text">';
		if(strlen($title)>0){
			echo $before_title . $title . $after_title ;
		}	
		echo '
			<div class="widget-textarea">';
		echo abc_booking_showBookingWidget($args);
		echo '</div></div>';
		echo $after_widget;
	}
}

// Register widget
add_action( 'widgets_init', 'sistem_otel_widget_init' );
function sistem_otel_widget_init() {
	register_widget( 'SistemOtelWidget' );
}
?>
