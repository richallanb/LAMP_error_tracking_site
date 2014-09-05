<?php
  // REQUIRES echo to show

  // List not made, not logged in
  if(!$Myself || $level == -1){
    header("Location: /errors/error9");
    return;
  }

  date_default_timezone_set('US/Pacific');
  $date_created = date('<b>h:i:s A</b> F j, Y', strtotime($Myself->getCreateDate()));
  $date_last_login = date('<b>h:i:s A</b> F j, Y', strtotime($Myself->getLastLogin()));

  // User error
  $dashboard_error_table = user_error_table($Projects_list, $Myself->getIdHash());

  $html = <<< HTML
    <div id="dashboard" class="tab-pane jumbotron">
      <h2 style="margin: 10px 0px 0px 0px">{$_SESSION['user']} Profile</h2>
      <div style="margin-bottom: 20px">
        <span>powered by <strong>JRRRS <span style="color:brown">UX</span></strong></span>
      </div>
    
      <h4 style="margin-bottom: 0">Basic</h4>
      <table style="width:50%">
        <thead>
          <th style="width:30%"></th>
          <th style="width:70%"></th>
        </thead>
        <tbody>
          <tr>
            <td class="profile-title">Account</td>
            <td>{$Myself->getName()}</td>
          </tr>
          <tr>
            <td class="profile-title">Email</td>
            <td>{$Myself->getEmail()}</td>
          </tr>
          <tr>
            <td class="profile-title">Created On</td>
            <td>$date_created</td>
          </tr>
          <tr>
            <td class="profile-title">Last Login</td>
            <td>$date_last_login</td>
          </tr> 
        </tbody>
      </table>
      <h4 style="margin-bottom: 4px">Admin Tools</h4>
      <div id="dash-admin-tab" style="margin-bottom:10px">
        <a href="/#projects">
          <button type="button" class="btn btn-default btn-default">
            Manage Projects
          </button>
        </a>
      </div>
   
      <div style="margin-top:20px">
        <h2>Personal Errors</h2>
        <div style="margin-bottom: 20px">
          <span>powered by <strong>REngine <span style="color:lightseagreen">9</span></strong></span>
        </div>
        $dashboard_error_table 
      </div>
    </div>
HTML;
  echo $html;
?>