<?php

add_action('admin_menu','nd_rst_add_settings_menu_orders');
function nd_rst_add_settings_menu_orders(){

  add_submenu_page( 'nd-restaurant-reservations-settings','Orders', __('All Orders','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-settings-orders', 'nd_rst_settings_menu_orders' );

  //custom hook
  do_action("nd_rst_add_menu_page_after_order");

}


function nd_rst_settings_menu_orders() {

?>

  
  <div class="nd_rst_section nd_rst_padding_right_20 nd_rst_padding_left_2 nd_rst_box_sizing_border_box nd_rst_margin_top_25 ">

    <?php nd_rst_get_table_orders(); ?> 

  </div>

<?php } 




function nd_rst_get_table_orders(){

  //START if
  if ( isset($_POST['edit_order_id']) OR isset($_POST['nd_rst_order_id'])  ) {
     
    include "include/edit.php"; 

  }elseif ( isset($_POST['delete_order_id']) OR isset($_POST['nd_rst_delete_order_id']) ){

    include "include/delete.php";
  
  }else{

    include "include/orders.php";

  }
  //END if

  echo $nd_rst_result;

}

include "include/add.php";

