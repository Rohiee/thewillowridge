<?php




//START ICAL
$nd_booking_ical_file_name = "all-reservations.ics";
$nd_booking_ical_myfile = fopen($nd_booking_ical_file_name, "w") or die("Unable to open file!");

//start file content
$nd_booking_ical_txt = "
BEGIN:VCALENDAR
PRODID:Hotel Booking by Nicdark
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:Hotel Booking Reservations
X-WR-TIMEZONE:Europe/Rome
X-WR-CALDESC:This is a calendar with all Hotel Booking Reservation";

//start the cicle
global $wpdb;
$nd_booking_table_name = $wpdb->prefix . 'nd_booking_booking';
$nd_booking_orders_ical_query = $wpdb->prepare( "SELECT * FROM $nd_booking_table_name" );
$nd_booking_orders_ical = $wpdb->get_results( $nd_booking_orders_ical_query ); 

foreach ( $nd_booking_orders_ical as $nd_booking_order ) {

  //convert date from
  $nd_booking_date_from_1 = new DateTime($nd_booking_order->date_from);
  $nd_booking_date_from = date_format($nd_booking_date_from_1, 'Ymd');
  //convert date to
  $nd_booking_date_to_1 = new DateTime($nd_booking_order->date_to);
  $nd_booking_date_to = date_format($nd_booking_date_to_1, 'Ymd');
  //date created
  $nd_booking_date_created = date('Ymd');
  $nd_booking_date_created_h = date('His');

  //get date
  $nd_booking_order_id_post = $nd_booking_order->id_post;
  $nd_booking_order_title_post = $nd_booking_order->title_post;
  $nd_booking_order_guests = $nd_booking_order->guests;
  $nd_booking_order_final_trip_price = $nd_booking_order->final_trip_price;
  $nd_booking_order_extra_services = $nd_booking_order->extra_services;
  $nd_booking_order_paypal_email = $nd_booking_order->paypal_email;
  $nd_booking_order_user_phone = $nd_booking_order->user_phone;
  $nd_booking_order_user_address = $nd_booking_order->user_address;
  $nd_booking_order_user_city = $nd_booking_order->user_city;
  $nd_booking_order_user_country = $nd_booking_order->user_country;
  $nd_booking_order_user_message = $nd_booking_order->user_message;
  $nd_booking_order_user_arrival = $nd_booking_order->user_arrival;
  $nd_booking_order_user_coupon = $nd_booking_order->user_coupon;
  $nd_booking_order_paypal_payment_status = $nd_booking_order->paypal_payment_status;
  $nd_booking_order_paypal_currency = $nd_booking_order->paypal_currency;
  $nd_booking_order_paypal_tx = $nd_booking_order->paypal_tx;
  $nd_booking_order_action_type = $nd_booking_order->action_type;

$nd_booking_ical_txt .= "
BEGIN:VEVENT
DTSTART:".$nd_booking_date_from."T160000Z
DTEND:".$nd_booking_date_to."T100000Z
DTSTAMP:".$nd_booking_date_created."T".$nd_booking_date_created_h."Z
UID:".$nd_booking_order_paypal_tx."
CREATED:".$nd_booking_date_created."T".$nd_booking_date_created_h."Z
DESCRIPTION:".__("ROOM","nd-booking").": ".$nd_booking_order_title_post." ( ".__("ID","nd-booking")." ".$nd_booking_order_id_post." ), ".__("GUESTS","nd-booking").": ".$nd_booking_order_guests.", ".__("TOTAL PRICE","nd-booking").": ".$nd_booking_order_final_trip_price.", ".__("EMAIL","nd-booking").": ".$nd_booking_order_paypal_email.", ".__("PHONE","nd-booking").": ".$nd_booking_order_user_phone.", ".__("ADDRESS","nd-booking").": ".$nd_booking_order_user_address.", ".__("CITY","nd-booking").": ".$nd_booking_order_user_city.", ".__("COUNTRY","nd-booking").": ".$nd_booking_order_user_country.", ".__("MESSAGE","nd-booking").": ".$nd_booking_order_user_message.", ".__("ARRIVAL","nd-booking").": ".$nd_booking_order_user_arrival.", ".__("COUPON","nd-booking").": ".$nd_booking_order_user_coupon.", ".__("COUNTRY","nd-booking").": ".$nd_booking_order_user_country.", ".__("PAYMENT STATUS","nd-booking").": ".$nd_booking_order_paypal_payment_status.", ".__("ID","nd-booking").": ".$nd_booking_order_paypal_tx.", ".__("PAYMENT TYPE","nd-booking").": ".$nd_booking_order_action_type." 
LAST-MODIFIED:".$nd_booking_date_created."T".$nd_booking_date_created_h."Z
LOCATION:".$nd_booking_order->title_post."
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY:".$nd_booking_order->title_post." - ".$nd_booking_order_paypal_currency." ".$nd_booking_order_final_trip_price." - ".$nd_booking_order->user_first_name." ".$nd_booking_order->user_last_name."
TRANSP:TRANSPARENT
END:VEVENT";

}
//end the cicle

$nd_booking_ical_txt .= "
END:VCALENDAR";
//end file content

fwrite($nd_booking_ical_myfile, $nd_booking_ical_txt);
fclose($nd_booking_ical_myfile);
#unlink('all-reservations.ics');
//END ICAL








//pagination
$nd_booking_qnt_orders_pag = 20;
$nd_booking_pag_from = sanitize_text_field($_GET["nd_booking_pag_from"]);
$nd_booking_pag_to = sanitize_text_field($_GET["nd_booking_pag_to"]);
$nd_booking_payment_status = sanitize_text_field($_GET["nd_booking_payment_status"]);
if ( $nd_booking_pag_from == '' ) { $nd_booking_pag_from = 0; }
if ( $nd_booking_pag_to == '' ) { $nd_booking_pag_to = $nd_booking_qnt_orders_pag; }

//START show all orders
global $wpdb;

$nd_booking_result = '';
$nd_booking_order_id = get_the_ID();
$nd_booking_table_name = $wpdb->prefix . 'nd_booking_booking';

//START select for items
if ( $nd_booking_payment_status == '' ) { 

  $nd_booking_orders_query = $wpdb->prepare( "SELECT * FROM $nd_booking_table_name ORDER BY id DESC LIMIT %d, %d", array( $nd_booking_pag_from, $nd_booking_pag_to ) );
  $nd_booking_orders = $wpdb->get_results( $nd_booking_orders_query ); 

}else{

  $nd_booking_orders_query = $wpdb->prepare( "SELECT * FROM $nd_booking_table_name WHERE paypal_payment_status = %s ORDER BY id DESC LIMIT %d, %d", array( $nd_booking_payment_status, $nd_booking_pag_from, $nd_booking_pag_to  ) );
  $nd_booking_orders = $wpdb->get_results( $nd_booking_orders_query ); 

}

$nd_booking_all_orders_query = $wpdb->prepare( "SELECT * FROM $nd_booking_table_name" );
$nd_booking_all_orders = $wpdb->get_results( $nd_booking_all_orders_query ); 

$nd_booking_all_orders_pending_query_term = 'Pending';
$nd_booking_all_orders_pending_query = $wpdb->prepare( "SELECT * FROM $nd_booking_table_name WHERE paypal_payment_status = %s", $nd_booking_all_orders_pending_query_term );
$nd_booking_all_orders_pending = $wpdb->get_results( $nd_booking_all_orders_pending_query ); 

$nd_booking_all_orders_pending_payment_query_term = 'Pending Payment';
$nd_booking_all_orders_pending_payment_query = $wpdb->prepare( "SELECT * FROM $nd_booking_table_name WHERE paypal_payment_status = %s ", $nd_booking_all_orders_pending_payment_query_term );
$nd_booking_all_orders_pending_payment = $wpdb->get_results( $nd_booking_all_orders_pending_payment_query ); 

$nd_booking_all_orders_completed_query_term = 'Completed';
$nd_booking_all_orders_completed_query = $wpdb->prepare( "SELECT * FROM $nd_booking_table_name WHERE paypal_payment_status = %s", $nd_booking_all_orders_completed_query_term );
$nd_booking_all_orders_completed = $wpdb->get_results( $nd_booking_all_orders_completed_query ); 




if ( empty($nd_booking_orders) ) { 

  $nd_booking_result .= '

  <style>
    .update-nag { display:none; } 
  </style>

  <h1 class="nd_booking_margin_0" style="font-size: 23px; font-weight: 400;">'.__('Orders','nd-booking').'</h1>
  <div class="nd_booking_section nd_booking_height_20"></div>
  <div class="nd_booking_position_relative  nd_booking_width_100_percentage nd_booking_box_sizing_border_box nd_booking_display_inline_block">           
    <p class=" nd_booking_margin_0 nd_booking_padding_0">'.__('Still no orders','nd-booking').'</p>
  </div>';              


}else{


  $nd_booking_result .= '
  <h1 class="nd_booking_margin_0" style="font-size: 23px; font-weight: 400;">'.__('Orders','nd-booking').'</h1>

  <ul class="subsubsub">
    <li class=""><a href="admin.php?page=nd-booking-settings-orders&nd_booking_pag_from=0&nd_booking_pag_to='.$nd_booking_qnt_orders_pag.'&nd_booking_payment_status=" class="current">'.__('All','nd-booking').' <span class="count">('.count($nd_booking_all_orders).')</span></a> |</li>
    <li class=""><a href="admin.php?page=nd-booking-settings-orders&nd_booking_pag_from=0&nd_booking_pag_to='.$nd_booking_qnt_orders_pag.'&nd_booking_payment_status=Pending">'.__('Pending','nd-booking').' <span class="count">('.count($nd_booking_all_orders_pending).')</span></a> |</li>
    <li class=""><a href="admin.php?page=nd-booking-settings-orders&nd_booking_pag_from=0&nd_booking_pag_to='.$nd_booking_qnt_orders_pag.'&nd_booking_payment_status=Pending Payment">'.__('Pending Payment','nd-booking').' <span class="count">('.count($nd_booking_all_orders_pending_payment).')</span></a> |</li>
    <li class=""><a href="admin.php?page=nd-booking-settings-orders&nd_booking_pag_from=0&nd_booking_pag_to='.$nd_booking_qnt_orders_pag.'&nd_booking_payment_status=Completed">'.__('Completed','nd-booking').' <span class="count">('.count($nd_booking_all_orders_completed).')</span></a></li>
  </ul>

  <div class="nd_booking_section nd_booking_height_10"></div>

  ';


  //pagination
  $nd_booking_orders_limit = 0;

  if ( $nd_booking_payment_status == '' ) { 
    $nd_booking_number_pages = ceil(count($nd_booking_all_orders)/$nd_booking_qnt_orders_pag); 
  }else{
    
    if ( $nd_booking_payment_status == 'Pending' ){
      $nd_booking_number_pages = ceil(count($nd_booking_all_orders_pending)/$nd_booking_qnt_orders_pag); 
    }elseif ( $nd_booking_payment_status == 'Pending Payment' ){
      $nd_booking_number_pages = ceil(count($nd_booking_all_orders_pending_payment)/$nd_booking_qnt_orders_pag); 
    }else{
      $nd_booking_number_pages = ceil(count($nd_booking_all_orders_completed)/$nd_booking_qnt_orders_pag);  
    }

  }
  
  $nd_booking_result_pag = '';
  $nd_booking_result_pag .= '<div style="margin-top:-37px; float:right; width:50%;" class="nd_booking_section nd_booking_text_align_right">';

  for ($nd_booking_number_page = 1; $nd_booking_number_page <= $nd_booking_number_pages; ++$nd_booking_number_page) {
    
    if ( ceil($nd_booking_pag_from/$nd_booking_qnt_orders_pag)+1 == $nd_booking_number_page ) { $nd_booking_pag_active = 'nd_booking_pag_active'; }else{ $nd_booking_pag_active = ''; }

    $nd_booking_result_pag .= '
      
      <span style="line-height:16px; padding:5px;" class="tablenav-pages-navspan '.$nd_booking_pag_active.' " aria-hidden="true">
        <a style="text-decoration: none; color: #a0a5aa;" href="admin.php?page=nd-booking-settings-orders&nd_booking_pag_from='.$nd_booking_orders_limit.'&nd_booking_pag_to='.$nd_booking_qnt_orders_pag.'&nd_booking_payment_status='.$nd_booking_payment_status.'">'.$nd_booking_number_page.'</a>
      </span>

    ';  
    
    $nd_booking_orders_limit = $nd_booking_orders_limit + $nd_booking_qnt_orders_pag;

  } 

  $nd_booking_result_pag .= '</div>';


  $nd_booking_result .= '

  '.$nd_booking_result_pag.'

  <style>
  .nd_booking_table{
    float:left;
    width:100%;
    background-color:#ccc;
    border-collapse: collapse;
    font-size: 14px;
    line-height: 20px;
    border: 1px solid #e5e5e5;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
    box-sizing:border-box;
  }
  .nd_booking_table tr td{
    padding:12px; 
  }


  .nd_booking_table_thead{
    width:100%;
    background-color:#fff;
    border-bottom:1px solid #e1e1e1;
  }
  .nd_booking_table_thead td, .nd_booking_table_tfoot td{
    /*color:#0073aa;*/
  }

  .nd_booking_table_tfoot{
    border-top:1px solid #e1e1e1;
    border-bottom:0px solid #e1e1e1;
    background-color:#fff;
  }
  
  .nd_booking_table tbody{
    width:100%;
  }
  .nd_booking_table_tbody{
    width: 100%;
    background-color: #777;
  }

  .nd_booking_tr_light { background-color:#fff; }
  .nd_booking_tr_dark { background-color:#f9f9f9; }

  .nd_booking_table_tbody td .nd_booking_edit {
    color: #0073aa;
    cursor: pointer;
    background: none;
    border: 0px;
    font-size: 13px;
    padding: 0px; 
  }
  .nd_booking_table_tbody td .nd_booking_edit:hover {
    color:#00a0d2;  
  }
  .nd_booking_table_tbody td .nd_booking_delete {
    color: #a00;
    cursor: pointer;
    background: none;
    border: 0px;
    font-size: 13px;
    padding: 0px; 
  }

  .update-nag { display:none; } 

  .nd_booking_pag_active { background-color:#00a0d2; border-color:#5b9dd9; }
  .nd_booking_pag_active a { color:#fff !important; }
  
  </style>

  <table class="nd_booking_table">
    <tbody>
      <tr class="nd_booking_table_thead">
        <td width="25%"><span style="text-transform: capitalize;">'.nd_booking_get_slug('singular').'</span></td>
        <td width="20%">'.__('Dates','nd-booking').'</td>
        <td width="7.5%">'.__('Price','nd-booking').'</td>
        <td width="20%">'.__('Name','nd-booking').'</td>
        <td width="10%">'.__('Payment','nd-booking').'</td>
        <td width="17.5%">'.__('Status','nd-booking').'</td>
      </tr>
    ';


  $nd_booking_i = 0;
  foreach ( $nd_booking_orders as $nd_booking_order ) 
  {
    
    //decide status color
    if ( $nd_booking_order->paypal_payment_status == 'Pending Payment' ) { 
      $nd_booking_color_bg_status = '#e64343';
    }elseif ( $nd_booking_order->paypal_payment_status == 'Pending' ){
      $nd_booking_color_bg_status = '#e68843';
    }else{
      $nd_booking_color_bg_status = '#54ce59'; 
    }

    //define action type
    $nd_booking_new_action_type = str_replace("_"," ",$nd_booking_order->action_type);

    //get room image
    $nd_booking_id = $nd_booking_order->id_post;
    $nd_booking_image_id = get_post_thumbnail_id($nd_booking_id);
    $nd_booking_image_attributes = wp_get_attachment_image_src( $nd_booking_image_id, 'thumbnail' );
    $nd_booking_room_img_src = $nd_booking_image_attributes[0];

    //get avatar
    $nd_booking_account_avatar_url_args = array( 'size'   => 100 );
    $nd_booking_account_avatar_url = get_avatar_url($nd_booking_order->paypal_email, $nd_booking_account_avatar_url_args);

    
    if ( $nd_booking_i & 1 ) { $nd_booking_tr_class = 'nd_booking_tr_light'; } else { $nd_booking_tr_class = 'nd_booking_tr_dark'; } 

    $nd_booking_order_id = $nd_booking_order->id_user;

    $nd_booking_result .= '
                               
        <tr class="nd_booking_table_tbody '.$nd_booking_tr_class.'">
          <td>
            <div class="nd_booking_section nd_booking_display_table">
              <div style="width:70px; vertical-align:middle;" class="nd_booking_display_table_cell">
                <img class="nd_booking_float_left" width="60" src="'.$nd_booking_room_img_src.'">
              </div>
              <div style="vertical-align:middle;" class="nd_booking_box_sizing_border_box nd_booking_display_table_cell">
                <span class="nd_booking_section">
                  <span class="nd_booking_section"><strong>'.$nd_booking_order->title_post.'</strong><span class="nd_booking_display_none">( '.$nd_booking_order->id_post.' )</span></span>
                  <span class="nd_booking_section">'.$nd_booking_order->guests.' '.__('Guests','nd-booking').'</span>
                </span>
                <form class="nd_booking_float_left" method="POST">
                  <input type="hidden" name="edit_order_id" value="'.$nd_booking_order->id.'">
                  <input type="submit" class="nd_booking_edit" value="'.__('View','nd-booking').'">
                </form>
                <form class="nd_booking_float_left nd_booking_padding_left_10" method="POST">
                  <input type="hidden" name="delete_order_id" value="'.$nd_booking_order->id.'">
                  <input type="submit" class="nd_booking_delete" value="'.__('Delete','nd-booking').'">
                </form>
              </div>
            </div>
          </td>
          <td>
            <span class="nd_booking_section"><u>'.__('From','nd-booking').'</u> : '.$nd_booking_order->date_from.'</span>
            <span class="nd_booking_section"><u>'.__('To','nd-booking').'</u> : '.$nd_booking_order->date_to.'</span>
          </td>
          <td>'.$nd_booking_order->final_trip_price.' '.nd_booking_get_currency().'</td>
          <td>
            <div style="width:50px;" class="nd_booking_float_left">
              <img width="40" src="'.$nd_booking_account_avatar_url.'">
            </div>
            <div class="nd_booking_float_left">
              <span class="nd_booking_section">'.$nd_booking_order->user_first_name.' '.$nd_booking_order->user_last_name.'</span>
              <span class="nd_booking_section"><a style="background-color: #23282d;color: #fff; text-decoration:none; font-size: 10px;padding: 3px;float: left;line-height: 10px;margin-top: 2px;" href="mailto:'.$nd_booking_order->paypal_email.'">'.__('EMAIL ME','nd-booking').'</a></span>
            </div>
          </td>
          <td><span class="nd_booking_text_transform_capitalize">'.$nd_booking_new_action_type.'</span></td>
          <td><span style="background-color:'.$nd_booking_color_bg_status.';" class="nd_booking_padding_5 nd_booking_color_ffffff nd_booking_font_size_12 nd_booking_text_transform_uppercase">'.$nd_booking_order->paypal_payment_status.'</span></td>
        </tr>

    ';

    $nd_booking_i = $nd_booking_i + 1;


  }


  $nd_booking_result .= '
    <tr class="nd_booking_table_tfoot">
      <td><span style="text-transform: capitalize;">'.nd_booking_get_slug('singular').'</span></td>
      <td>'.__('Dates','nd-booking').'</td>
      <td>'.__('Price','nd-booking').'</td>
      <td>'.__('Name','nd-booking').'</td>
      <td>'.__('Payment','nd-booking').'</td>
      <td>'.__('Status','nd-booking').'</td>
    </tr>
    </tbody>
  </table>

  <div class="nd_booking_section nd_booking_height_50"></div>

  '.$nd_booking_result_pag.'

  ';


  //export ical
  $nd_booking_result .= '<a class="button button-primary nd_booking_float_left" href="'.$nd_booking_ical_file_name.'" download="'.$nd_booking_ical_file_name.'">'.__('Export All Reservations','nd-booking').'.ical</a>';


}
//END show all orders
  
  
  