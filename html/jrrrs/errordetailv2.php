<?php

  // MAIN FUNCTIONS prototypes
  // User and Project specific errors
  // user_project_error_table() 

  // Entire Project's error
  // project_error_table()

  // User's only all Project's error
  // all_projects_error_table()

  // UNIVERSAL FUNCTIONS
  // Put here for easier maintenance
  function error_table_header($list_users = FALSE){
    // Make sure all width adds up to 100%
    
    if($list_users == TRUE){
      $body = <<< HTML
        <tr>
          <th class="project-error-header" style="width:30%">Error</th>
          <th class="project-error-header" style="width:13%">Date</th> 
          <th class="project-error-header" style="width:10%">Level</th>
          <th class="project-error-header" style="width:16%">Source</th> 
          <th class="project-error-header" style="width:5%">Line</th>
          <th class="project-error-header" style="10%">User</th>
          <th class="project-error-header text-center" style="width:7%">Comment</th> 
          <th class="project-error-header text-center" style="width:8%">More Info</th>
        </tr>
HTML;
    }else{
      $body = <<< HTML
        <tr>
          <th class="project-error-header" style="width:30%">Error</th>
          <th class="project-error-header" style="width:13%">Date</th> 
          <th class="project-error-header" style="width:10%">Level</th>
          <th class="project-error-header" style="width:27%">Source</th> 
          <th class="project-error-header" style="width:5%">Line</th>
          <th class="project-error-header text-center" style="width:7%">Comment</th> 
          <th class="project-error-header text-center" style="width:8%">More Info</th>
        </tr>
HTML;
    }
    return $body;
  }

  //Fills error undertable with additional info
  function more_info($Error, $User, $view_id){
    $comment = $Error->getComment();
    if( $comment == NULL ){
      $comment = <<< HTML
        <span style="color:lightgray; font-size:80%; font-weight:bold">NONE</span>   
HTML;
    }
    
    $count = $Error->getCount();
    
    $line = <<< HTML
      <span style="font-size:80%; font-weight:bold; color:firebrick">AT LINE {$Error->getLine()}, &nbsp;$count TIME(S)</span> 
HTML;
    
    $resolved_tr = NULL;
    if( $Error->isResolved() ){
      $date = strtotime($Error->getResolvedDate());
      if( date('Y') == date('Y', $date) ){
        $mdy = date('M d', $date);
      }else{
        $mdy = date('M d Y', $date);
      }
      $hms = date(' H:i:s', $date);
    
      $resolved_date = <<< HTML
        <span style="font-weight:bold; text-transform:uppercase; font-size:85%">$mdy</span> $hms
HTML;
      
      $resolved_tr = <<< HTML
        <tr>
          <td class="details-title">RESOLVED BY</td>
          <td>{$Error->getResolvedUser()} $resolved_date</td>
        </tr>
        <tr>
          <td class="details-title">MESSAGE</td>
          <td>{$Error->getResolvedComment()}</td>
        </tr>
HTML;
    }

    $details= <<< HTML
      <table style="width:100%">
        <thead>
          <th style="width:10%"></th>
          <th style="width:90%"></th>
        </thead>
        <tbody>
          <tr>
            <td class="details-title">Full Error</td>
            <td>{$Error->getName()} $line</td>
          </tr>
          <tr>
            <td class="details-title">Source</td>
            <td>{$Error->getSource()}</td>
          </tr>
          <tr>
            <td class="details-title">Comment</td>
            <td>$comment</td>
          </tr>
          $resolved_tr
        </tbody>
      </table> 
HTML;
    
    $body = <<< HTML
      <tr>
        <td style="display:none" id="more-info-$view_id" colspan=8>
          $details
        </td>
      </tr>
HTML;
    return $body; 
}

  // Creates error table row
  function error_table_row($User, $Error, $type, $list_users = FALSE){
    // Ajax handling ids + management
    $view_id = $type . $Error->getId();
    $management_td = error_manage($Error, $type);
     
    // Dating format
    date_default_timezone_set('US/Pacific');
    $timestamp = strtotime($Error->getCreateDate());
    $create_date = date('m/d/y H:i:s', $timestamp);
    
    // Severity formatting
    $severity_td = severity_box($Error, $type);
    $severity_class = severity_class($Error);
    
    // Comment + upload
    $feedback_td = error_modify($Error, $type);
    $more_info_tr = more_info($Error, $User, $view_id);
    
    $source = $Error->getSource(); 
    
    // List user
    $user_td = NULL;
    if( $list_users == TRUE){
      $username = $User->getName();
      $user_td = <<< HTML
        <td class="longtext" title="$username">$username</td>
HTML;
    }
    
    $body = <<< HTML
      <tr id="$view_id" class="$severity_class">
        $management_td
        <td>$create_date</td>
        $severity_td
        <td title="$source" class="longtext">$source</td>
        <td>{$Error->getLine()}</td>
        $user_td
        $feedback_td
        <td class="text-center"><span onclick="$('#more-info-$view_id').toggle('fast')" style="font-size:16px;cursor:pointer;color:#28BED6;" class="glyphicon glyphicon-collapse-down"></span></td>
      </tr>
      $more_info_tr
HTML;
    return $body;
  }

  // Create severity dropdown + handles
  function severity_box($Error, $type){
    $severity = $Error->getSeverity();
    
    // <span style="font-weight:bold; text-transform:uppercase; font-size:85%">
    
    // Selects option
    $options = NULL;
    for($i = 0; $i < 4; ++$i){
      $string = rating_string($i);
      
      if( $severity == $i ){
        $options .= <<< HTML
          <option value="$i" selected>$string</option>
HTML;
      }else{
        $options .= <<< HTML
          <option value="$i">$string</option>
HTML;
      }
    }
    
    $my_id = $_SESSION['idhash'];
    $error_idHash = $Error->getIdHash();
    $error_id = $Error->getId();
    $form_id = "$type-$error_id";
    $body = <<< HTML
      <td>
        <select class="form-control" style="padding: 0 0 0 3px" onchange="modifySeverity('$form_id', '$error_idHash', $(this).val(), '$my_id', event)">
          $options
        </select>
      </td>
HTML;
    return $body;
  }

  // Converts severity level to string
  function rating_string($severity){
    switch($severity){
      case "1":
        return "Warning";
      case "2":
        return "Error";
      case "3": 
        return "Severe";
      default:
        return "Info";
    }
  }

  // Converts severity level to view class
  function severity_class($Error){
    if($Error->isResolved()){
      return "success";
    }

    switch($Error->getSeverity()){
      case "1":
      case "2":
        return "warning";
      case "3":
        return "danger";
      default:
        return "default";
    }
  }

  // Create error feedback (commenting + uploading) actions
  function error_modify($Error, $type){
    if($Error->isResolved()){
      $body = <<< HTML
        <td class="project-header-like">RESOLVED</td>
HTML;
      return $body;
    }
    
    $error_id = $Error->getId();
    $error_idHash = $Error->getIdHash();
    $my_id = $_SESSION['idhash'];
    $form_id = "$type-$error_id";
    $text_id = "Mcomment-$form_id";
    
    $comment = $Error->getComment();
    if( $comment != NULL ){
      $dropdown_message = <<< HTML
        <span style="font-size:80%; font-weight:bold">COMMENTED</span>
HTML;
    }else{
      $dropdown_message = <<< HTML
        <span class="glyphicon glyphicon-pencil"></span></a>
HTML;
    }
    
    $body = <<< HTML
      <td class="dropdown text-center">
        <a class="dropdown-toggle longtext" data-toggle="dropdown">$dropdown_message
        <ul class="dropdown-menu" role="menu" style="width: 350px">
          <li role="presentation" class="dropdown-header">Drop a Comment</li>
          <li role="presentation" class="nohover">
            <div style="padding: 0 20px 0 20px">
              <form method="post" onsubmit="modifyErrorComment('$form_id', '$error_idHash', '$my_id', event)">
                <textarea name="$text_id" class="form-control comment-box" rows="5" placeholder="Leave a Comment" required>$comment</textarea>
                <button class="btn btn-default btn-block" style="text-align:left;" type="submit"><span style="margin-top:2px;margin-right:10px;" class="glyphicon glyphicon-pencil pull-left"></span>                       Comment
                </button>
              </form>
            </div>
          </li>
          <li role="presentation" class="divider"></li>
          <li role="presentation" class="dropdown-header">Upload Screen Cap</li>
          <li>
            <a style="cursor:pointer" title="COMING SOON(TM)">
              <span style="margin-top:2px;margin-right:10px;margin-left:14px;" class="glyphicon glyphicon-picture pull-left"></span>Upload
            </a>
          </li>
        </ul>
      </td>
HTML;
    return $body;
  }

  // Creates error management action
  function error_manage($Error, $type){
    
    $name = $Error->getName();
    $error_id = $Error->getId();
    $form_id = "$type-$error_id";
    $text_id = "Rcomment-$form_id";
    $view_id = $type . $Error->getId();
    $my_id = $_SESSION['idhash'];
    
    $resolution_li = NULL;
    $resolved_comment = $Error->getResolvedComment();
    if( $Error->isResolved() ){
      
      $timestamp = strtotime($Error->getResolvedDate());
      $resolution_date = date('m/d/y H:i:s', $timestamp);
      
      $resolution_li = <<< HTML
        <li role="presentation" class="dropdown-header">Resolved on $resolution_date</li>
        <li role="presentation" class="nohover">
          <div style="padding: 0 20px 0 20px">
            <textarea class="form-control comment-box" rows="5">$resolved_comment</textarea>
            <span style="margin-top:2px;margin-right:10px;margin-left:14px;" class="glyphicon glyphicon-check pull-left"></span><b>BY</b> {$Error->getResolvedUser()}
          </div>
        </li>
HTML;
    }else{
      $resolution_li = <<< HTML
        <li role="presentation" class="dropdown-header">Resolve & Comment</li>
        <li role="presentation" class="nohover">
          <div style="padding: 0 20px 0 20px">
            <form method="post" onsubmit="resolveError('$form_id', '{$Error->getIdHash()}', '{$_SESSION['user']}', event)">
              <textarea class="form-control comment-box" name="$text_id" rows="5" placeholder="Leave a Resolution Comment" required></textarea>
              <button class="btn btn-default btn-block" style="text-align:left;" type="submit"><span style="margin-top:2px;margin-right:10px;" class="glyphicon glyphicon-check pull-left"></span>                         Resolve
              </button>
            </form>
          </div>
        </li>
HTML;
    }

    $body = <<< HTML
      <td class="dropdown" title="$name">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <p class="longtext" style="font-size: inherit; margin:0">
            <span class="badge">{$Error->getCount()}</span> $name
          </p>
        </a>
        <ul class="dropdown-menu" role="menu" style="width: 350px">
          $resolution_li
          <li role="presentation" class="divider"></li>
          <li role="presentation" class="dropdown-header">Dismiss or Ignore Error</li>
          <li>
            <a style="cursor:pointer" onclick="dismissError('{$Error->getIdHash()}', '$my_id', '#$view_id')">
              <span style="margin-top:2px;margin-right:10px;margin-left:14px;" class="glyphicon glyphicon-eye-close pull-left"></span>Dismiss
            </a>
          </li>
        </ul>
      </td>
HTML;
    return $body;
  }

  // USER PROJECT ERROR functions
  // Creates specific Project's User table
  function user_error_table($Projects_list, $user_idhash){
    // Get headers
    $errors_headers = error_table_header();      
    $body = NULL;
    
    // For all projects
    foreach($Projects_list as $Project){
      
      $errors_details = NULL;
      $User = $Project->getUsers()[$user_idhash];
      foreach($User->getErrors() as $Error){        
        $errors_details .= error_table_row($User, $Error, "UPE");
      }
              
      $body .= <<< HTML
        <div>
          <div class="error-resp"></div>
          <div class="project-title">
            <h4>{$Project->getName()} <small>by {$Project->getOwner()->getName()}</small></h4>
          </div>
          <div class="table-responsive">
            <table class="table" style="width=100%; table-layout:fixed">
              <thead>
                $errors_headers
              </thead>
              <tbody>
                $errors_details
              </tbody>
            </table>   
          </div>
        </div>
HTML;
    }
    return $body;
  }

  // ALL PROJECT ERROR functions
  // Creates User's all Project error table
  function projects_error_table($Projects_list){
    // Get headers
    $errors_headers = error_table_header(TRUE);      
    $body = NULL;
    
    // For all projects
    foreach($Projects_list as $Project){
      
      $errors_details = NULL;
      foreach($Project->getUsers() as $User){        
        foreach($User->getErrors() as $Error){
          $errors_details .= error_table_row($User, $Error, "APE", TRUE);
        }
      }
              
      $body .= <<< HTML
        <div>
          <div class="error-resp"></div>
          <div class="project-title">
            <h4>{$Project->getName()} <small>by {$Project->getOwner()->getName()}</small></h4>
          </div>
          <div class="table-responsive">
            <table class="table" style="width=100%; table-layout:fixed">
              <thead>
                $errors_headers
              </thead>
              <tbody>
                $errors_details
              </tbody>
            </table>   
          </div>
        </div>
HTML;
    }
    return $body;
  }

?>