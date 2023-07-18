<?php



add_action('admin_menu','nd_rst_add_settings_menu_add_exceptions');
function nd_rst_add_settings_menu_add_exceptions(){

  add_submenu_page( 'nd-restaurant-reservations-settings','Add Exceptions', __('Add Exceptions','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-add-exception', 'nd_rst_settings_menu_add_exception' );
  add_action( 'admin_init', 'nd_rst_exceptions_settings' );

}



function nd_rst_exceptions_settings() {

  $nd_rst_exceptions_qnt = get_option('nd_rst_exceptions_qnt');

  for ($nd_rst_i = 1; $nd_rst_i <= $nd_rst_exceptions_qnt; $nd_rst_i++) {
      
    register_setting( 'nd_booking_exception_settings_group', 'nd_rst_exception_date_'.$nd_rst_i );
    register_setting( 'nd_booking_exception_settings_group', 'nd_rst_exception_close_'.$nd_rst_i );
    register_setting( 'nd_booking_exception_settings_group', 'nd_rst_exception_start_'.$nd_rst_i );
    register_setting( 'nd_booking_exception_settings_group', 'nd_rst_exception_end_'.$nd_rst_i );  

  }

  

}



function nd_rst_settings_menu_add_exception() {

?>

  

  <form method="post" action="options.php">

    <?php settings_fields( 'nd_booking_exception_settings_group' ); ?>
    <?php do_settings_sections( 'nd_booking_exception_settings_group' ); ?>
  
  <div class="nd_rst_section nd_rst_padding_right_20 nd_rst_padding_left_2 nd_rst_box_sizing_border_box nd_rst_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_rst_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_rst_get_profile_bg_color(2); ?>;" class="nd_rst_section nd_rst_padding_20 nd_rst_box_sizing_border_box">
      <h2 class="nd_rst_color_ffffff nd_rst_display_inline_block"><?php _e('ND Restaurant','nd-restaurant-reservations'); ?></h2><span class="nd_rst_margin_left_10 nd_rst_color_a0a5aa"><?php echo nd_rst_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_rst_section  nd_rst_box_shadow_0_1_1_000_04 nd_rst_background_color_ffffff nd_rst_border_1_solid_e5e5e5 nd_rst_border_top_width_0 nd_rst_border_left_width_0 nd_rst_overflow_hidden nd_rst_position_relative">

      <!--START menu-->
      <div style="background-color:<?php echo nd_rst_get_profile_bg_color(1); ?>;" class="nd_rst_width_20_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_min_height_3000 nd_rst_position_absolute">

        <ul class="nd_rst_navigation">
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-restaurant-reservations-settings'); ?>"><?php _e('Plugin Settings','nd-restaurant-reservations'); ?></a></li>    
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-restaurant-reservations-add-timing'); ?>"><?php _e('Timing','nd-restaurant-reservations'); ?></a></li>
          <li><a style="background-color:<?php echo nd_rst_get_profile_bg_color(2); ?>;"class="" href="#"><?php _e('Exceptions','nd-restaurant-reservations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-restaurant-reservations-reservation-settings'); ?>"><?php _e('Reservation Settings','nd-restaurant-reservations'); ?></a></li>
          <li class="nd_rst_admin_menu_stripe"><a class="" href="<?php echo admin_url('admin.php?page=nd-restaurant-reservations-stripe'); ?>"><?php _e('Stripe','nd-restaurant-reservations'); ?></a></li>
          <li class="nd_rst_admin_menu_paypal"><a class="" href="<?php echo admin_url('admin.php?page=nd-restaurant-reservations-paypal'); ?>"><?php _e('Paypal','nd-restaurant-reservations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-restaurant-reservations-settings-import-export'); ?>"><?php _e('Import Export','nd-restaurant-reservations'); ?></a></li>
          <li><a target="_blank" class="" href="http://documentations.nicdark.com/restaurant/"><?php _e('Documentation','nd-restaurant-reservations'); ?></a></li>
        
          <?php 

            if ( get_option('nicdark_theme_author') != 1 ){ ?>

              <li><a style="background-color:<?php echo nd_rst_get_profile_bg_color(2); ?>;" class="" href="<?php echo admin_url('admin.php?page=nd-restaurant-reservations-settings-premium-addons'); ?>" ><?php _e('Premium Addons','nd-restaurant-reservations'); ?></a></li>

            <?php }
            
            ?>

        </ul>
      </div>
      <!--END menu-->

      <!--START content-->
      <div class="nd_rst_width_80_percentage nd_rst_margin_left_20_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_20">


        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_100_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Exceptions','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Insert the date and check the checkbox for block the reservations and set the timing for a different working hours.','nd-restaurant-reservations'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>

      



        <!--START container-->
        <div id="nd_rst_all_timing" class="nd_rst_section">


          <?php $nd_rst_exceptions_qnt = get_option('nd_rst_exceptions_qnt'); ?>
          <?php for ( $nd_rst_i = 1; $nd_rst_i <= $nd_rst_exceptions_qnt; $nd_rst_i++ ) { ?>


          <!--START-->
          <div id="nd_rst_timing_<?php echo $nd_rst_i; ?>" class="nd_rst_section ">
            

            <div class="nd_rst_width_50_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">

              <input class="nd_rst_width_100_percentage" type="text" name="nd_rst_exception_date_<?php echo $nd_rst_i; ?>" value="<?php echo esc_attr( get_option('nd_rst_exception_date_'.$nd_rst_i) ); ?>" />
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_14"><?php _e('Insert the date ( YYYY-MM-DD ) Eg: 2019-01-30','nd-restaurant-reservations'); ?></p>

            </div>


            <div class="nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_float_left">
            <div class="nd_rst_width_33_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              
              <div class="nd_rst_section">

                <div class="nd_rst_section nd_rst_box_sizing_border_box nd_rst_float_left nd_rst_text_align_center">
                  <input class=" nd_rst_margin_top_6_important nd_rst_margin_0_important" <?php if( get_option('nd_rst_exception_close_'.$nd_rst_i) == 1 ) { echo 'checked="checked"'; } ?> name="nd_rst_exception_close_<?php echo $nd_rst_i; ?>" type="checkbox" value="1">
                  <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_18"><?php _e('Closing','nd-restaurant-reservations'); ?></p>
                </div> 
                 
              </div>

            </div>
            
            <div class="nd_rst_width_33_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              
              <select class="nd_rst_width_100_percentage" name="nd_rst_exception_start_<?php echo $nd_rst_i; ?>">
                <?php $nd_rst_exception_sols = array('00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30'); ?>
                <?php foreach ($nd_rst_exception_sols as $nd_rst_exceptions_sol) : ?>
                    <option 

                    <?php 
                      if( get_option('nd_rst_exception_start_'.$nd_rst_i) == $nd_rst_exceptions_sol ) { 
                        echo 'selected="selected"';
                      } 
                    ?>

                    value="<?php echo $nd_rst_exceptions_sol; ?>">
                        <?php echo $nd_rst_exceptions_sol; ?>
                    </option>
                <?php endforeach; ?>
              </select>

              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_11"><?php _e('Start','nd-restaurant-reservations'); ?></p>

            </div>

            <div class="nd_rst_width_33_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              
              <select class="nd_rst_width_100_percentage" name="nd_rst_exception_end_<?php echo $nd_rst_i; ?>">
                <?php $nd_rst_exception_sols = array('00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30'); ?>
                <?php foreach ($nd_rst_exception_sols as $nd_rst_exceptions_sol) : ?>
                    <option 

                    <?php 
                      if( get_option('nd_rst_exception_end_'.$nd_rst_i) == $nd_rst_exceptions_sol ) { 
                        echo 'selected="selected"';
                      } 
                    ?>

                    value="<?php echo $nd_rst_exceptions_sol; ?>">
                        <?php echo $nd_rst_exceptions_sol; ?>
                    </option>
                <?php endforeach; ?>
              </select>

              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_11"><?php _e('End','nd-restaurant-reservations'); ?></p>

            </div>
            </div>

          </div>
          
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--END-->



          <?php } ?>





      </div>
      <!--END container-->



      <div class="nd_rst_section nd_rst_padding_left_20 nd_rst_padding_right_20 nd_rst_box_sizing_border_box">
        <?php submit_button(); ?>
      </div>      


      </div>
      <!--END content-->


    </div>

  </div>
</form>

  

<?php } 






