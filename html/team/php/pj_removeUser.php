<?php

  // Validation
  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();
  require_once('header.php');

  // Checks for session
  if( isset($_SESSION['admin']) && isset($_SESSION['logged']) && $_SESSION['logged'] && isset($_SESSION['user']) && $_SESSION['user'] ){
    
    echo "SET";
    
    // Checks for POST validity
    if( !empty($_POST) && empty($_GET) && validatePost() ){
      
      echo "VALID";
      
      // Connection is defined only here
      $connection = new mysqliInterface;
      $session_id = $connection->getIdHash($_SESSION['user']);
      
      // Sends corresponding idhash for one last check
      action($session_id, $connection);
    }
  }

  function validatePost(){
    return validateArray($_POST, ['RPUFmyid', 'RPUFuserid', 'RPUFprojectid']);
  }

  // Main 
  function action($session_id, $connection){
 
    // RPUF - Remove Project User Form
    $caller_id = $_POST['RPUFmyid'];
    $target_id = $_POST['RPUFuserid'];
    $project_id = $_POST['RPUFprojectid'];
      
    // One last check!
    if( ($session_id == $caller_id) ){
      
      // connection variable should've been defined by pj_validator
      if($connection->removeUserFromProject($caller_id, $target_id, $project_id)){
        // Error happened
        header('HTTP/1.1 400 Bad Request');
      }else{
        exit;
      }
    }
    
    // Session does not match!?
    header('HTTP/1.1 400 Bad Request');
    
    // Add something drastic
  }

?>