<?php

$nd_booking_current_page_permalink = get_permalink(get_the_ID());
if ( $nd_booking_current_page_permalink == nd_booking_search_page() ) {

$nd_booking_result .= '
<script type="text/javascript">
  jQuery(document).ready(function() {

    
    jQuery(function ($) {
      
      $( "#nd_booking_search_filter_options a" ).on("click",function() {

        $( "#nd_booking_search_filter_options a" ).removeClass( "nd_booking_search_filter_options_active" );
        $(this).addClass( "nd_booking_search_filter_options_active");

        nd_booking_sorting(1);
      
      });

      $( "#nd_booking_search_filter_layout a" ).on("click",function() {

        $( "#nd_booking_search_filter_layout a" ).removeClass( "nd_booking_search_filter_layout_active" );
        $(this).addClass( "nd_booking_search_filter_layout_active");

        nd_booking_sorting();

      });

      
      $("#nd_booking_search_filter_options li").on("click",function() {
        $("#nd_booking_search_filter_options li").removeClass( "nd_booking_search_filter_options_active_parent" );
        $(this).addClass( "nd_booking_search_filter_options_active_parent");
      });

    });
    

  });
</script>


<style>
.nd_booking_search_filter_options_active { color:#fff !important; }
#nd_booking_search_filter_options li.nd_booking_search_filter_options_active_parent p { color:#fff !important; border-bottom: 2px solid #878787;}

#nd_booking_search_filter_options li:hover .nd_booking_search_filter_options_child { display: block; }

.nd_booking_search_filter_layout_grid { background-image:url('.esc_url(plugins_url('../img/icon-grid-grey.svg', __FILE__ )).'); }
.nd_booking_search_filter_layout_grid.nd_booking_search_filter_layout_active { background-image:url('.esc_url(plugins_url('../img/icon-grid-white.svg', __FILE__ )).'); }

.nd_booking_search_filter_layout_list.nd_booking_search_filter_layout_active { background-image:url('.esc_url(plugins_url('../img/icon-list-white.svg', __FILE__ )).'); }
.nd_booking_search_filter_layout_list { background-image:url('.esc_url(plugins_url('../img/icon-list-grey.svg', __FILE__ )).'); }
</style>


<div id="nd_booking_el_order" class="nd_booking_section">
    <div id="nd_booking_search_results_order_options" class="nd_booking_section nd_booking_padding_10_0 nd_booking_box_sizing_border_box nd_booking_bg_greydark nd_booking_text_align_center">
        <div class="nd_booking_section nd_booking_position_relative nd_booking_line_height_0">


            <ul id="nd_booking_search_filter_options" class="nd_booking_list_style_none nd_booking_display_inline_block nd_booking_padding_0 nd_booking_margin_0">
                
                <li id="nd_booking_el_order_price" class="nd_booking_display_inline_block nd_booking_position_relative nd_booking_padding_20 nd_booking_padding_bottom_15 nd_booking_margin_0 nd_booking_float_left">
                    <p class="nd_booking_font_size_12 nd_booking_padding_bottom_5 nd_booking_letter_spacing_2 nd_booking_text_transform_uppercase nd_booking_float_left nd_options_color_white">'.__('Stay Price','nd-booking').'</p>
                    <img alt="" class="nd_booking_margin_left_10 nd_booking_float_left" width="10" src="'.esc_url(plugins_url('../img/icon-down-arrow-white.svg', __FILE__ )).'">
                    <ul class="nd_booking_padding_top_12 nd_booking_z_index_99 nd_booking_width_160 nd_booking_list_style_none nd_booking_search_filter_options_child nd_booking_position_absolute nd_booking_left_0 nd_booking_top_50 nd_booking_display_none nd_booking_padding_0 nd_booking_margin_0 nd_booking_width_100_percentage">
                        <li class="nd_booking_text_align_left nd_booking_bg_greydark_2 nd_booking_font_size_11 nd_booking_letter_spacing_2 nd_booking_text_transform_uppercase nd_booking_padding_15_20"><a data-meta-key="nd_booking_meta_box_min_price" data-order="ASC" class="nd_booking_cursor_pointer nd_options_color_white">'.__('Lowest Price','nd-booking').'</a></li>
                        <li class="nd_booking_text_align_left nd_booking_bg_greydark nd_booking_font_size_11 nd_booking_letter_spacing_2 nd_booking_text_transform_uppercase nd_booking_padding_15_20"><a data-meta-key="nd_booking_meta_box_min_price" data-order="DESC" class="nd_booking_cursor_pointer nd_options_color_white">'.__('Highest Price','nd-booking').'</a></li>
                    </ul>
                </li>  

                <li id="nd_booking_el_order_size" class="nd_booking_display_inline_block nd_booking_position_relative nd_booking_padding_20 nd_booking_padding_bottom_15 nd_booking_margin_0 nd_booking_float_left">
                    <p class="nd_booking_font_size_12 nd_booking_padding_bottom_5 nd_booking_letter_spacing_2 nd_booking_text_transform_uppercase nd_booking_float_left nd_options_color_white">'.__('Room Size','nd-booking').'</p> 
                    <img alt="" class="nd_booking_margin_left_10 nd_booking_float_left" width="10" src="'.esc_url(plugins_url('../img/icon-down-arrow-white.svg', __FILE__ )).'">
                    <ul class="nd_booking_padding_top_12 nd_booking_z_index_99 nd_booking_width_160 nd_booking_list_style_none nd_booking_search_filter_options_child nd_booking_position_absolute nd_booking_left_0 nd_booking_top_50 nd_booking_display_none nd_booking_padding_0 nd_booking_margin_0 nd_booking_width_100_percentage">
                        <li class="nd_booking_text_align_left nd_booking_bg_greydark_2 nd_booking_font_size_11 nd_booking_letter_spacing_2 nd_booking_text_transform_uppercase nd_booking_padding_15_20"><a data-meta-key="nd_booking_meta_box_room_size" data-order="DESC" class="nd_booking_cursor_pointer nd_options_color_white">'.__('Larger','nd-booking').' <span class="nd_booking_sorting_label_1">'.__('Room','nd-booking').'</span></a></li>
                        <li class="nd_booking_text_align_left nd_booking_bg_greydark nd_booking_font_size_11 nd_booking_letter_spacing_2 nd_booking_text_transform_uppercase nd_booking_padding_15_20"><a data-meta-key="nd_booking_meta_box_room_size" data-order="ASC" class="nd_booking_cursor_pointer nd_options_color_white">'.__('Smallest','nd-booking').' <span class="nd_booking_sorting_label_2">'.__('Room','nd-booking').'</a></li>
                    </ul>
                </li>
            
            </ul> 


            <div id="nd_booking_search_filter_layout" class="nd_booking_display_none_all_iphone">
                <a data-layout="1" class="nd_booking_search_filter_layout_grid nd_booking_cursor_pointer nd_booking_background_size_18 nd_booking_search_filter_layout_active nd_booking_width_18 nd_booking_height_18 nd_booking_position_absolute nd_booking_right_15 nd_booking_top_16"></a>
                <a data-layout="2" class="nd_booking_search_filter_layout_list nd_booking_cursor_pointer nd_booking_background_size_18 nd_booking_width_18 nd_booking_height_18 nd_booking_position_absolute nd_booking_right_53 nd_booking_top_16"></a>
            </div>

        </div>
    </div>
</div>';
 
 }