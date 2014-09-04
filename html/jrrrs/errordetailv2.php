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
  function error_table_header(){
    // Make sure all width adds up to 100%
    // Method doesn't really make sense for us since it's only JS, so it's always a GET.
    $body = <<< HTML
      <tr>
        <th class="project-error-header" style="width:30%">Error</th>
        <th class="project-error-header" style="width:13%">Date</th> 
        <th class="project-error-header" style="width:10%">Level</th>
        <th class="project-error-header" style="width:19%">Source</th> 
        <th class="project-error-header" style="width:7%">Line</th>
        <th class="project-error-header" style="width:11%">Modify</th> 
        <th class="project-error-header text-center" style="width:10%">More Info</th>
      </tr>
HTML;
    return $body;
  }

//Fills error undertable with additional info
function more_info($Error){
  $comment = $Error->getComment();
  $count = $Error->getCount();
    if( $comment ){
      $title = " - \"$comment\"";
    }else{
      $title = "";
    }
  $body = <<< HTML
    <tr><td><b>User</b>$title</td><td><b>$count</b> Occurrences</td></tr>
HTML;
     return $body; 
}

  // Creates error table row
  function error_table_row($Error, $type){
    // Ajax handling ids + management
    $view_id = $type . $Error->getId();
    $management_td = error_manage($Error, $type);
     
    // Dating format
    date_default_timezone_set('US/Pacific');
    $timestamp = strtotime($Error->getCreateDate());
    $create_date = date('m/d/y H:i:s', $timestamp);
    
    // Severity formatting
    $severity = $Error->getSeverity();
    $severity_td = severity_box($severity);
    $severity_class = severity_class($severity);
    
    // Comment + upload
    $feedback_td = error_modify($Error);
    $more_info = more_info($Error);
    
    $source = $Error->getSource(); 
    
    $body = <<< HTML
      <tr id="$view_id" class="$severity_class">
        $management_td
        <td>$create_date</td>
        $severity_td
        <td title="$source" class="longtext">$source</td>
        <td>{$Error->getLine()}</td>
        $feedback_td
        <td class="text-center"><span onclick="$('#more-info-$view_id').show('fast')" class="glyphicon glyphicon-collapse-down"></span></td>
      </tr>
      <tr>
        <td style="display:none" id="more-info-$view_id" colspan=7>
          <table class="table" style="width=100%">
            <thead><tr><th style="width:85%;margin:0;padding:0;border:none;"></th><th style="width:15%;margin:0;padding:0;border:none;"></th></tr></thead>
            <tbody>$more_info</tbody>
          </table>
        </td>
      </tr>
HTML;
    return $body;
  }

  // Create severity dropdown + handles
  function severity_box($severity){
    // Show default when no severity
    $default_option = NULL;
    if( !$severity ){
      $default_option = <<< HTML
        <option disabled selected style="display:none">Severity</option>
HTML;
    }
    
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
    
    $body = <<< HTML
      <td>
        <select class="form-control" style="padding: 0 0 0 3px">
          $default_option
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
  function severity_class($severity){
    switch($severity){
      case "1":
      case "2":
        return "warning";
      case "3":
        return "danger";
      default:
        return "info";
    }
  }

  // Create error feedback (commenting + uploading) actions
  function error_modify($Error){
    
    $body = <<< HTML
      <td class="dropdown">
        <a class="dropdown-toggle longtext" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil"></span></a>
        <ul class="dropdown-menu" role="menu" style="width: 350px">
          <li role="presentation" class="dropdown-header">Drop a Comment</li>
          <li role="presentation" class="nohover">
            <div style="padding: 0 20px 0 20px">
              <form method="post">
                <textarea class="form-control comment-box" rows="5" placeholder="Leave a Comment">{$Error->getComment()}</textarea>
                <button class="btn btn-default btn-block" style="text-align:left;" type="submit"><span style="margin-top:2px;margin-right:10px;" class="glyphicon glyphicon-pencil pull-left"></span>                       Comment
                </button>
              </form>
            </div>
          </li>
          <li role="presentation" class="divider"></li>
          <li role="presentation" class="dropdown-header">Upload Screen Cap</li>
          <li>
            <a style="cursor:pointer" onclick="">
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
    $text_id = "Rcomment-$type";
    
    $resolution_li = NULL;
    $resolved_comment = $Error->getResolvedComment();
    if( $Error->isResolved() ){
      
      $timestamp = strtotime($Error->getResolvedDate());
      $resolution_date = date('m/d/y H:i:s', $timestamp);
      
      $resolution_li = <<< HTML
        <li role="presentation" class="nohover">
          <div style="padding: 0 20px 0 20px">
            <textarea class="form-control comment-box" rows="5">$resolved_comment</textarea>
            <span style="margin-right:10px;margin-left:8px;" class="glyphicon glyphicon-check"></span> <b>BY</b> {$Error->getResolvedUser()} on $resolution_date
          </div>
        </li>
HTML;
    }else{
      $resolution_li = <<< HTML
        <li role="presentation" class="nohover">
          <div style="padding: 0 20px 0 20px">
            <form method="post" onsubmit="resolveError('$type', '{$Error->getId()}', {$_SESSION['user']})">
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
          <li role="presentation" class="dropdown-header">Resolve + Comment</li>
          $resolution_li
          <li role="presentation" class="divider"></li>
          <li role="presentation" class="dropdown-header">Dismiss or Ignore Error</li>
          <li>
            <a style="cursor:pointer" onclick="">
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
      foreach($Project->getUsers()[$user_idhash]->getErrors() as $Error){        
        $errors_details .= error_table_row($Error, "APE");
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
    $errors_headers = error_table_header();      
    $body = NULL;
    
    // For all projects
    foreach($Projects_list as $Project){
      
      $errors_details = NULL;
      foreach($Project->getUsers() as $User){        
        foreach($User->getErrors() as $Error){
          $errors_details .= error_table_row($Error, "APE");
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