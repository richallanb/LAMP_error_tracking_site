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
    $body = <<< HTML
      <tr>
        <th class="project-error-header" style="width:15%">Error</th>
        <th class="project-error-header" style="width:15%">Date</th> 
        <th class="project-error-header" style="width:5%">Severity</th>
        <th class="project-error-header" style="width:20%">Source</th> 
        <th class="project-error-header" style="width:5%">Method</th>
        <th class="project-error-header" style="width:5%">Line</th> 
        <th class="project-error-header" style="width:20%">Comment</th> 
        <th class="project-error-header" style="width:10%">Manage</th>
      </tr>
HTML;
    return $body;
  }

  // Creates error table row
  function error_table_row($Error, $type){
    $error_id = $Error->getId();
    $view_id = $type . $error_id;   
    $management_td = error_manage($error_id);
     
    date_default_timezone_set('US/Pacific');
    $timestamp = strtotime($Error->getCreateDate());
    $create_date = date('m/d/y H:i:s', $timestamp);
    
    $severity = error_severity($Error->getSeverity());
    
    $body = <<< HTML
      <tr id="$view_id">
        <td>{$Error->getName()}</td>
        <td>$create_date</td>
        <td>$severity</td>
        <td>{$Error->getSource()}</td>
        <td>{$Error->getMethod()}</td>
        <td>{$Error->getLine()}</td>
        <td>
          <textarea style="resize: vertical; width: 100% !important" rows="1" placeholder="Leave a Comment">{$Error->getComment()}</textarea>
        </td>
        $management_td
      </tr>
HTML;
    return $body;
  }

  // Create severity dropdown + handles
  function error_severity($severity){
    
    // Show default when no severity
    $default_option = NULL;
    if( !$severity ){
      $default_option = <<< HTML
        <option disabled selected style="display:none">Severity</option>
HTML;
    }
    
    $body = <<< HTML
      <div>
        <select class="btn-sm">
          $default_option
          <option value="0">User</option>
          <option value="1">Designer</option>
        </select>
      </div>
HTML;
    return $body;
  }

  // Creates error management action
  function error_manage($error_id){
    // Options: upload screen cap, resolve, dismiss
    
    $body = <<< HTML
      <td>
        <a href="/#projects">Modifty</a>
      </td>
HTML;
    return $body;
  }

  // USER PROJECT ERROR functions
  // Creates specific Project's User table
  function user_project_error_table($Errors_list){
    // Get headers
    $errors_headers = error_table_header();      
    $errors_details = NULL;
    
    // For all errors
    foreach($Errors_list as $Error){     
      $error_details .= error_table_row($Error, "UPE");
    }
    
    $body = <<< HTML
      <div>
        <div class="table-responsive">
          <table class="table" style="width=100%">
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
    return $body;
  }

  // SPECIFIC PROJECT ERROR functions
  // Creates entire Project's error table
  function project_error_table($Project){
    // Get headers
    $errors_headers = error_table_header();    
    $errors_details = NULL;
    
    // For all users inside this project
    foreach($Project->getUsers() as $User){
   
      // For all errors inside this user
      foreach($User->getErrors() as $Error){
        $error_details .= error_table_row($Error, "SPE");
      }
    }
    
    $body = <<< HTML
      <div>
        <div class="table-responsive">
          <table class="table" style="width=100%">
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
    return $body;
  }

  // ALL PROJECT ERROR functions
  // Creates User's all Project error table
  function all_project_error_table($Projects_list){
    // Get headers
    $errors_headers = error_table_header();      
    $errors_details = NULL;
    
    // For all projects
    foreach($Projects_list as $Project){
      
      // For all errors in my projects
      foreach($Project->getUsers()[MYSELF]->getErrors() as $Error){        
        $error_details .= error_table_row($Error, "APE");
      }
    }
    
    $body = <<< HTML
      <div>
        <div class="table-responsive">
          <table class="table" style="width=100%">
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
    return $body;
  }

?>