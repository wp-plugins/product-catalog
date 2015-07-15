<?php

if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die('Access Denied');
    }
if (!function_exists('current_user_can')) {
    die('Access Denied');
}
function show_general_options(){
    global $wpdb;
    $query = "SELECT *  FROM " . $wpdb->prefix . "huge_it_catalog_general_params";
    $rows = $wpdb->get_results($query);
    $param_values = array();
    foreach ($rows as $row) {
        $key = $row->name;
        $value = $row->value;
        $param_values[$key] = $value;
    }
    return html_show_general_options($param_values);
}

function save_styles_options()
{
    global $wpdb;
    if (isset($_POST['params'])) {
      $params = $_POST['params'];
//      var_dump($params);exit;
      foreach ($params as $key => $value) {
          $wpdb->update($wpdb->prefix . 'huge_it_catalog_general_params',
              array('value' => $value),
              array('name' => $key),
              array('%s')
          );
      }
      
      $adminMessage = stripslashes($_POST['adminmessage']);
      $userMessage = stripslashes($_POST['usermessage']);     //    var_dump($adminMessage);    var_dump($userMessage);
//      exit;
      
      $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_general_params SET  value='%s'  WHERE name = 'ht_catalog_general_admin_email_message' ", $adminMessage));
      $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_general_params SET  value='%s'  WHERE name = 'ht_catalog_general_user_message' ", $userMessage));
      
      ?>
      <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
      <?php
    }
    
}