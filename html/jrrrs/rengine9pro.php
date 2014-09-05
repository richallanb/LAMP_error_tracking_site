<?php 
  // REQUIRES echo to show

  // List not made, not logged in
  if(!$Myself || $level == -1){
    header("Location: /errors/error9");
    return;
  }

  // Form security
  $refToken = generateFormToken('referral');
  $modToken = generateFormToken('modify-err');
  $resToken = generateFormToken('resolve-err');
  $projToken = generateFormToken('projtoken');
  $projCPFToken = generateFormToken('CPF');
  echo "<input type=\"hidden\" name=\"restoken\" value=$resToken>";
  echo "<input type=\"hidden\" name=\"modtoken\" value=$modToken>"; 
  echo "<input type=\"hidden\" name=\"reftoken\" value=$refToken>";
  echo "<input type=\"hidden\" name=\"projtoken\" value=$projToken>";
  // Put up here for easier maintenance 
  function table_header(){
    $body = <<< HTML
      <tr>
        <th class="project-user-header" style="width:23%">Username</th>
      
        <!--
        <th class="project-user-header" style="width:15%">Errors</th>
        -->
      
        <th class="project-user-header" style="width:23%">Created on</th>
        <th class="project-user-header" style="width:23%">Last Login</th>
        <th class="project-user-header" style="width:15%">Manage</th>     
      </tr>
HTML;
    return $body;
  }

  // Creates table rows
  function table_row($User, $project_id, $ownership, $row_id) {    
    global $Myself;
    $my_id = $Myself->getIdHash();  
    $user_id = $User->getIdHash();
    
    if( $ownership && ($user_id != $my_id) ){
      $management_td = <<< HTML
        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-chevron-down"></span>&nbsp;Modify 
            </button>
            <ul class="dropdown-menu" role="menu">
              <li>
               <a style="cursor:pointer" onclick="removeUserFromProject('$my_id', '$user_id', '$project_id', '$row_id');"><span style="margin-top:2px;margin-right:10px;" class="glyphicon glyphicon-minus-sign pull-left"></span> Remove User</a>
              </li>
            </ul>
          </div>
        </td>
HTML;
    }else if($user_id == $my_id){
      $management_td = <<< HTML
        <td class="project-header-like">YOU ({$User->getName()})</td>
HTML;
    }else{
      $management_td = <<< HTML
        <td class="project-header-like">MANAGER ONLY</td>
HTML;
    }
    
    date_default_timezone_set('US/Pacific');
    $date_created = format_date($User->getCreateDate());
    $date_last_login = format_date($User->getLastLogin());

    $body = <<< HTML
      <tr id="$row_id">
        <td title="{$User->getEmail()}">{$User->getName()}</td>
        <td>$date_created</td>
        <td>$date_last_login</td>
        $management_td
      </tr>
HTML;
    return $body;
  }

  // Formats timestamp
  function format_date($timestamp){
    if($timestamp == 0) {
      $body = <<< HTML
      <span style="font-weight:bold; font-size:85%">NEVER</span>
HTML;
      return $body;
    }
    
    $date = strtotime($timestamp);
    $hms = date('h:ia', $date);
    
    if( date('Y') == date('Y', $date) ){
      $mdy = date('M d', $date);
    }else{
      $mdy = date('M d Y', $date);
    }
    
    $body = <<< HTML
      <span style="font-weight:bold; text-transform:uppercase; font-size:85%">$mdy</span> $hms
HTML;
    return $body;
  }

  // Creates project management actions
  function manage($project_name, $project_id, $ownership, $div_id){
    global $Myself;
    $my_id = $Myself->getIdHash();
    
    if($ownership){
      $body = <<< HTML
        <li role="presentation" class="dropdown-header">Ask Users to Join</li>
        <li class="nohover">
            <form method="post" class="proj-invite" onsubmit="projSender('$div_id', '$project_id', '$my_id');">
              <div class="input-group" style="margin-bottom: 5px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
              <input name="RIemail-$div_id" class="form-control" type="email" placeholder="Enter Email" required></div>
              <button class="btn btn-default btn-block" style="text-align:left;" type="submit"><span style="margin-top:2px;margin-right:10px;" class="glyphicon glyphicon-plus-sign pull-left"></span>                     Invite Developers
              </button>
            </form>
        </li>
        <li role="presentation" class="dropdown-header">Track errors</li>
        <li>
          <a style="cursor:pointer;" onclick="displayScript('$my_id', '$project_id');">
            <span style="margin-right:10px;margin-left:8px;" class="glyphicon glyphicon-cloud-download"></span>Generate Deployable Script
          </a>
        </li>
        <li role="presentation" class="divider"></li>
        <li>
          <a style="cursor:pointer" onclick="deleteProject('$my_id', '$project_id', '$div_id');"><span style="margin-top:2px;margin-right:10px;margin-left:8px;" class="glyphicon glyphicon-remove-sign pull-left"></span> Delete Project</a>
        </li>
HTML;
    }else{
      $body = <<< HTML
        <li role="presentation" class="dropdown-header">Track errors</li>
        <li>
          <a style="cursor:pointer" onclick="displayScript('$my_id', '$project_id');">
            <span style="margin-right:10px;margin-left:8px;" class="glyphicon glyphicon-cloud-download"></span>Generate Deployable Script
          </a>
        </li>
        <li role="presentation" class="divider"></li>
        <li>
          <a style="cursor:pointer" onclick="leaveProject('$my_id', '$project_id', '$div_id');"><span style="margin-top:2px;margin-right:10px;margin-left:8px;" class="glyphicon glyphicon-minus-sign pull-left"></span> Leave Project</a>
        </li>
HTML;
    }
    return $body;
  }

  // Creates table body from array list, skips first element
  function table_body($Project, $ownership, $div_id){
    
    $body = "";
    
    $user_number = 1;
    foreach($Project->getUsers() as $User){
      $row_id = $div_id . "USER" . $user_number;
      $user_number++;
      
      $body .= table_row($User, $Project->getIdHash(), $ownership, $row_id);
    }
    return $body;
  }

  // Creates table, takes list of projects
  function table(array $Projects_list){    
    $users_headers = table_header();
    $body = "";
    
    $project_number = 1;
    foreach($Projects_list as $Project){
      
      // Check if user manages project
      $ownership = 0;
      if($Project->getOwner()->getName() == $_SESSION['user']){
        $ownership = 1;
      }
      
      // Creates row for each user in project
      $div_id = "PROJ" . $project_number;
      $users_profile = table_body($Project, $ownership, $div_id);
      $project_number++;
      
      // Project info
      $project_name = $Project->getName();
      $project_owner = $Project->getOwner()->getName();
      $project_manage_li = manage(
        $project_name, 
        $Project->getIdHash(), 
        $ownership, 
        $div_id
      );
      
      // Creates table
      $body .= <<< HTML
        <div id="$div_id">
        <div class="proj-resp" id="proj-resp-$div_id"></div>
          <div class="project-title">
            <div class="dropdown" title="Manage $project_name">
              <h4>
                <a class="dropdown-toggle" data-toggle="dropdown">$project_name <span class="caret"></span></a>
                <small>by $project_owner</small>
              </h4>
              <ul class="dropdown-menu" role="menu" style="width:300px">
                $project_manage_li
              </ul>
            </div>    
          </div>
          <div class="table-responsive">
            <table class="table" style="width=100%">
              <thead>
                $users_headers
              </thead>
              <tbody>
                $users_profile
              </tbody>
            </table>   
          </div>
        </div>
HTML;
    }
    return $body;
  }

  // MAIN
  $users_table = table($Projects_list);
  $errors_table = projects_error_table($Projects_list);

  // JUMBOTRON, Projects Management
  $html = <<< HTML
    <div class="tab-pane jumbotron" id="projects">
      <div class="tab-container tab-jumbo"> 
        <ul class="tabbed-list">
          <li class="tab activeTab" data-action="project-container"><span class="icon glyphicon glyphicon-list-alt"></span>Projects</li>
          <li class="tab" data-action="project-error-container" id="show-project-errors"><span class="icon glyphicon glyphicon-fire"></span>Errors</li>
        </ul>
      </div>
     
      <div id="project-container" class="pane-toggle">
        <h2 style="margin:20px 0px 3px 0px">{$_SESSION['user']} Projects</h2><span></span>
        <span>powered by <strong>JRRRS <span style="color:brown">UX</span></strong></span>

        <div class="row" style="margin: 20px 0 20px 0">
          <div class="col-md-6">
            <h4>Start a Project</h4>
            <form method="post" role="form" action="/team/php/pj_createProject.php">
              <div class="input-group" style="margin-bottom: 5px; width:100%">
                <div class="input-group-addon"><span class="glyphicon glyphicon-leaf"></span></div>
                <input class="form-control" name="CPFprojectname" placeholder="Project Name" required></div>
                <input type="hidden" name="CPFmyname" value="{$_SESSION['user']}">
                <input type="hidden" name="CPFmyid" value="{$Myself->getIdHash()}">
                <input type="hidden" name="token" value="$projCPFToken">
              <div style="vertical-align:middle !important">
                Create a project with <strong>REngine <span style="color:lightseagreen">9</span> PRO</strong>
                <button class="btn btn-default btn-block" style="max-width:200px;float:right;" type="submit">Create</button>
              </div>
            </form>
          </div>

          <div class="col-md-6">
            <h4>Invite a Friend</h4>
            <form method="post" role="form" id="referal">
              <div class="input-group" style="margin-bottom: 5px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <input class="form-control" name="RFemail" placeholder="Enter email" required>
              </div>
              <div style="vertical-align:middle !important">
                Refer your friends to <strong>REngine <span style="color:lightseagreen">9</span></strong>
                <button class="btn btn-default btn-block" style="max-width:200px;float:right;" type="submit">Invite</button>
              </div>
            </form>
          </div>
        </div>
        $users_table
      </div>
    
      <div id="project-error-container" class="pane-toggle" style="display:none">
        <h2 style="margin:20px 0px 3px 0px">Project Errors</h2><span></span>
        <span>powered by <strong>REngine <span style="color:lightseagreen">9</span> PRO</strong></span>
        <div style="margin-top: 20px">
          $errors_table
        </div>
      </div>
    </div>
    
      <!--
        <div class="panel panel-default">
          <div class="panel-heading"  style="display:inline-block; width:100%" id="adduser-btn">
            <h3 class="panel-title" style="float:left;">Add User</h3>
            <span style="float:right;" class="glyphicon glyphicon-circle-arrow-down"></span>
          </div>
        </div>
      
      <div class="panel-body" id="adduser-container">
        <form class="form-adduser" name="adduser" id="adduser" role="form" method="post" action="#">
          <div><input name="Suser" type="text" class="form-control" placeholder="Username" required autofocus style="margin:0"></div>
          <div>
            <select name="Spriv" id="Spriv" class="form-control" required>
              <option value="" disabled selected style="display:none;">Access</option>
              <option value="0">User</option>
              <option value="1">Designer</option>
            </select>
          </div>
          <div>
            <div class="input-group" style="margin-bottom: 5px;">
              <div class="input-group-addon">@</div>
              <input class="form-control" type="email" name="Semail" placeholder="Enter email" required>
            </div>
          </div>
          <div><input name="Spassword" type="password" class="form-control" placeholder="Password" required style="margin:0"></div>     
          <div><input name="Srepassword" type="password" class="form-control" placeholder="Retype Password" required style="margin:0"></div>    
          <div><button class="btn btn-default btn-block" name="Ssubmit" type="submit">Add User</button></div>
        </form>
      </div>

      
      <ul class="pager">
        <li><a href="#">Previous</a></li>
        <li><a href="#">Next</a></li>
      </ul>
    </div>
    -->
HTML;
  echo $html;
?>