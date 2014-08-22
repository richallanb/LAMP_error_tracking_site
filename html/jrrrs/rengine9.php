<?php
  // REQUIRES echo to show

  // DASHBOARD, enabled for DEVDEV+
  $admin_tools_text = "Manage Users";

  // Not DEV+
  if($level <= DEVDEV){
    $admin_tools_text = <<< HTML
      Get <strong>REngine <span style="color:lightseagreen">9 </span>PRO</strong>
HTML;
    $admin_tools_behavior = <<< HTML
      onclick="#" style="background-color:black; color:white"
HTML;
  }else{
    $admin_tools_behavior = <<< HTML
      onclick="$('.jumbotron').hide();$('#usrmgt').show()"
HTML;
  }

$admin_tools = <<< HTML
  <b>Admin Tools</b>
  <div id="dash-admin-tab" style="margin-bottom:10px">
    <button type="button" class="btn btn-default btn-default" $admin_tools_behavior>
      $admin_tools_text
    </button>
  </div>
HTML;

  if($level >= USER){
    date_default_timezone_set('US/Pacific');
    $date = date('m/d/Y G:i:s a', time());
    $title = title();
    $html = <<< HTML
      <div id="dash" class="jumbotron"><h2>Your Dashboard</h2>
        <b>Account: </b>{$_SESSION['user']}<br>
        <b>Access time: </b>$date<br>
        <b>Permissions: </b>$title<br>
        <br>  
        <b>Upload Tools</b>
        <div id="dash-error-tab" style="margin-bottom:10px">
          <button type="button" class="btn btn-default btn-default" onclick="$('#upload-screen').click();">
            Upload Error Screen Cap
          </button>
          <input style="display:none;" type="file" id="upload-screen" name="upload-screen" accept="image/*">
          <button type="button" class="btn btn-default btn-default" onclick="$('#upload-script').click();">
            Upload Script
          </button>
          <input style="display:none;" type="file" id="upload-script" name="upload-script" accept="*">
        </div>
        $admin_tools  
        <a id="show-errors" href="#">Show Error Logs <span class="glyphicon glyphicon-chevron-down"></span></a>
        <div id="errors-toggle" style="display: none">
          <h2 style="margin: 10px 0px 0px 0px">{$_SESSION['user']} Error Log</h2>
          <span style="font-family:verdana">powered by <strong>REngine <span style="color:lightseagreen">9</span></strong></span>
          <div id="userGraph" style="width:100%;"></div>
          $errordetail
        </div>
      </div>
HTML;
    echo $html;
  }     
?>