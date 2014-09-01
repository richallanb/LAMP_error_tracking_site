<?php
  // REQUIRES echo to show

  // List not made, not logged in
  if(!$personal_profile || $level == -1){
    return;
  }

  date_default_timezone_set('US/Pacific');
  $date_created = date('<b>h:i:s A</b> F j, Y', strtotime($personal_profile->getCreateDate()));
  $date_last_login = date('<b>h:i:s A</b> F j, Y', strtotime($personal_profile->getLastLogin()));

  $html = <<< HTML
    <div id="dashboard" class="tab-pane jumbotron">
    <div class="tab-container tab-jumbo"> <ul class="tabbed-list">
     <li class="tab activeTab" data-action="profile-container"><span class="icon glyphicon glyphicon-dashboard"></span>Profile</li>
     <li class="tab" data-action="error-container" id="show-errors"><span class="icon glyphicon glyphicon-fire"></span>Errors</li>
      
     </div>
    <!--h2>Your Dashboard</h2-->
    <div id="profile-container" class="pane-toggle">
      <h2 style="margin: 10px 0px 0px 0px">{$_SESSION['user']} Profile</h2>
      <span>powered by <strong>JRRRS <span style="color:brown">UX</span></strong></span>
    
      <h4 style="margin-bottom: 0">Basic</h4>
      <table style="width:50%">
        <thead>
          <th style="width:30%"></th>
          <th style="width:70%"></th>
        </thead>
        <tbody>
          <tr>
            <td class="profile-title">Account</td>
            <td>{$personal_profile->getName()}</td>
          </tr>
          <tr>
            <td class="profile-title">Email</td>
            <td>{$personal_profile->getEmail()}</td>
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
     </div>   
     <div id="error-container" class="pane-toggle" style="display:none;">
      <!--Files should be uploaded to errors-->
      <!--h4 style="margin-bottom: 0">Upload Tools</h4>
      <div id="dash-error-tab" style="margin-bottom:10px">
        <button type="button" class="btn btn-default btn-default" onclick="$('#upload-screen').click();">
          Upload Error Screen Cap
        </button>
        <input style="display:none;" type="file" id="upload-screen" name="upload-screen" accept="image/*">
        <button type="button" class="btn btn-default btn-default" onclick="$('#upload-script').click();">
          Upload Script
        </button>
        <input style="display:none;" type="file" id="upload-script" name="upload-script" accept="*">
      </div-->
      
      <!--a id="show-errors" href="#">Show Error Logs <span class="glyphicon glyphicon-chevron-down"></span></a-->
      <div id="errors-toggle">
        <h2 style="margin: 10px 0px 0px 0px">{$_SESSION['user']} Error Log</h2>
        <span>powered by <strong>REngine <span style="color:lightseagreen">9</span></strong></span>
        <div id="userGraph" style="width:100%;"></div>
        $errordetail
      </div>
    </div>
    </div>
HTML;
  echo $html;
?>