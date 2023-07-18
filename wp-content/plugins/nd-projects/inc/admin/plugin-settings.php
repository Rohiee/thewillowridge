<?php


/////////////////////////////////////////////////// START MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////
add_action('admin_menu', 'nd_cc_create_menu');
function nd_cc_create_menu() {
  
  add_menu_page('Projects', __('Projects Plugin','nd-projects'), 'manage_options', 'nd-projects-settings', 'nd_cc_settings_page', 'dashicons-admin-generic' );
  add_action( 'admin_init', 'nd_cc_settings' );

  //custom hook
  do_action("nd_cc_add_menu_settings");

}

function nd_cc_settings() {
  register_setting( 'nd_cc_settings_group', 'nd_cc_container' );

  //custom hook
  do_action("nd_cc_add_settings_group");

}

function nd_cc_settings_page() {

?>


<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_cc_settings_group' ); ?>
  <?php do_settings_sections( 'nd_cc_settings_group' ); ?>
  <?php $nd_cc_import_export_url = admin_url('admin.php?page=nd-projects-settings-import-export'); ?>


  <div class="nd_cc_section nd_cc_padding_right_20 nd_cc_padding_left_2 nd_cc_box_sizing_border_box nd_cc_margin_top_25 ">

    

    <div style="background-color:<?php echo esc_attr(nd_cc_get_profile_bg_color(0)); ?>; border-bottom:3px solid <?php echo esc_attr(nd_cc_get_profile_bg_color(2)); ?>;" class="nd_cc_section nd_cc_padding_20 nd_cc_box_sizing_border_box">
      <h2 class="nd_cc_color_ffffff nd_cc_display_inline_block"><?php esc_html_e('ND Projects','nd-projects'); ?></h2><span class="nd_cc_margin_left_10 nd_cc_color_a0a5aa"><?php echo esc_html(nd_cc_get_plugin_version()); ?></span>
    </div>

    

    <div class="nd_cc_section  nd_cc_box_shadow_0_1_1_000_04 nd_cc_background_color_ffffff nd_cc_border_1_solid_e5e5e5 nd_cc_border_top_width_0 nd_cc_border_left_width_0 nd_cc_overflow_hidden nd_cc_position_relative">

      <!--START menu-->
      <div style="background-color:<?php echo esc_attr(nd_cc_get_profile_bg_color(1)); ?>;" class="nd_cc_width_20_percentage nd_cc_float_left nd_cc_box_sizing_border_box nd_cc_min_height_3000 nd_cc_position_absolute">

        <ul class="nd_cc_navigation">
          <li><a style="background-color:<?php echo esc_attr(nd_cc_get_profile_bg_color(2)); ?>;" class="" href="#"><?php esc_html_e('Plugin Settings','nd-projects'); ?></a></li>
          <li><a class="" href="<?php echo esc_url($nd_cc_import_export_url); ?>"><?php esc_html_e('Import Export','nd-projects'); ?></a></li>
        </ul>
      </div>
      <!--END menu-->

      <!--START content-->
      <div class="nd_cc_width_80_percentage nd_cc_margin_left_20_percentage nd_cc_float_left nd_cc_box_sizing_border_box nd_cc_padding_20">


        <!--START-->
        <div class="nd_cc_section">
          <div class="nd_cc_width_40_percentage nd_cc_padding_20 nd_cc_box_sizing_border_box nd_cc_float_left">
            <h2 class="nd_cc_section nd_cc_margin_0"><?php esc_html_e('Plugin Settings','nd-projects'); ?></h2>
            <p class="nd_cc_color_666666 nd_cc_section nd_cc_margin_0 nd_cc_margin_top_10"><?php esc_html_e('Below some important plugin settings.','nd-projects'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_cc_section nd_cc_height_1 nd_cc_background_color_E7E7E7 nd_cc_margin_top_10 nd_cc_margin_bottom_10"></div>


        <?php
          //custom hook
          do_action("nd_cc_add_setting_on_main_page");
        ?>


        <!--START-->
        <div class="nd_cc_section">
          <div class="nd_cc_width_40_percentage nd_cc_padding_20 nd_cc_box_sizing_border_box nd_cc_float_left">
            <h2 class="nd_cc_section nd_cc_margin_0"><?php esc_html_e('Container','nd-projects'); ?></h2>
            <p class="nd_cc_color_666666 nd_cc_section nd_cc_margin_0 nd_cc_margin_top_10"><?php esc_html_e('Remove default container','nd-projects'); ?></p>
          </div>
          <div class="nd_cc_width_60_percentage nd_cc_padding_20 nd_cc_box_sizing_border_box nd_cc_float_left">
            
            <input <?php if( get_option('nd_cc_container') == 1 ) { echo esc_attr('checked="checked"'); } ?> name="nd_cc_container" type="checkbox" value="1">
            <p class="nd_cc_color_666666 nd_cc_section nd_cc_margin_0 nd_cc_margin_top_20"><?php esc_html_e('If your theme does not need the default container of 1200px in template pages you can remove it by flagging the checkbox.','nd-projects'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_cc_section nd_cc_height_1 nd_cc_background_color_E7E7E7 nd_cc_margin_top_10 nd_cc_margin_bottom_10"></div>


        <div class="nd_cc_section nd_cc_padding_left_20 nd_cc_padding_right_20 nd_cc_box_sizing_border_box">
          <?php submit_button(); ?>
        </div>      


      </div>
      <!--END content-->


    </div>

  </div>
</form>

<?php } 
/////////////////////////////////////////////////// END MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////







//include all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once realpath($file);
}

