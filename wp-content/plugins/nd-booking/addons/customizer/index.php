<?php



add_action('customize_register','nd_booking_customizer_nd_donations');
function nd_booking_customizer_nd_donations( $wp_customize ) {
  

	//ADD panel
	$wp_customize->add_panel( 'nd_booking_customizer_donations', array(
	  'title' => __( 'ND Booking' ),
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '',
	  'description' => __( 'Plugin Settings' ), //  html tags such as <p>.
	  'priority' => 320, // Mixed with top-level-section hierarchy.
	) );


}



//all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once realpath($file);
}
