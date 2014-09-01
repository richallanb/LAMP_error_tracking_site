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
        <th class="project-error-header" style="width:35%">Error</th>
        <th class="project-error-header" style="width:10%">Date</th> 
        <th class="project-error-header" style="width:10%">Severity</th>
        <th class="project-error-header" style="width:30%">Comment</th> 
        <th class="project-error-header" style="width:15%">Manage</th> 
      </tr>
HTML;
    return $body;
  }

  // Creates error table row
  function error_table_row($Error, $row_id){
    $management_td = error_manage($row_id);
        
    $body = <<< HTML
      <tr id="$error_id">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        $management_td
      </tr>
HTML;
    return $body;
  }

  // Creates error management action
  function error_manage($row_id){
    // Options: upload screen cap, resolve, dismiss
    
    $body = <<< HTML
      
HTML;
    return $body;
  }

  // USER PROJECT ERROR functions
  // Creates specific Project's User table
  function user_project_error_table($Errors_list, $div_id){
    // Get headers
    $errors_headers = error_table_header();    
    
    $errors_details = NULL;
    $error_number = 1;
    
    // Get errors
    foreach($Errors_list as $Error){
      $row_id = $div_id . "UPE" . $error_number;
      $error_number++;
      
      $error_details .= error_table_row($Error, $row_id);
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
    }
    return $body;
  }

  // PROJECT ERROR functions
  // Creates entire Project's error table
  function project_error_table($Project){
   // Get headers
    $errors_headers = error_table_header();    
    
    $errors_details = NULL;
    $user_number = 1;
    
    // Get errors
    foreach($Project->getUsers() as $User){
      $row_id = "PEUSER" . $user_number;
      $user_number++;
      
      $error_number = 1;
      foreach($User->getErrors() as $Error){
        $row_id = $div_id . "PE" . $error_number;
        $error_number++;
        
        $error_details .= error_table_row($Error, $row_id);
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
    }
    return $body;
  }

  // ALL PROJECT ERROR functions
  // Creates User's all Project error table
  function all_project_error_table($Projects_list){
    // Get headers
    $errors_headers = error_table_header();    
    
    $errors_details = NULL;
    $project_number = 1;
    
    // Get errors
    foreach($Projects_list as $Project){
      $row_id = "APEPROJ" . $project_number;
      $project_number++;
      
      $error_number = 1;
      foreach($Project->getUsers()[MYSELF]->getErrors() as $Error){
        $row_id = $div_id . "APE" . $error_number;
        $error_number++;
        
        $error_details .= error_table_row($Error, $row_id);
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
    }
    return $body;
  }

?>