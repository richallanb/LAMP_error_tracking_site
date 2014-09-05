<?php

  // Validation
  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();
  require_once('header.php');

  // Checks for session
  if(isset($_SESSION['admin']) && isset($_SESSION['logged']) && $_SESSION['logged'] && isset($_SESSION['user']) && $_SESSION['user']  && isset($_SESSION['idhash']) && $_SESSION['idhash']){
    
    // Checks for POST validity
    if( !empty($_POST) && empty($_GET) && validatePost() ){
      
      // Connection is defined only here
      $connection = new mysqliInterface;
      //$session_id = $connection->getIdHash($_SESSION['user']);
      
      // Sends corresponding idhash for one last check
      action($connection);
    }
  }

  function validatePost(){
    return validateArray($_POST, ['CPFprojectname', 'CPFmyname', 'CPFmyid']);
  }

  // Main 
  function action($connection){
    
    // CPF - Create Project Form
    $project = preg_filter("/((?![\w\d ]).)+/",'', $_POST['CPFprojectname']);
    $caller = $_POST['CPFmyname'];
    $caller_id = $_SESSION['idhash'];
      
    // One last check!
   // if( ($session_id == $caller_id) ){
      
      // connection variable should've been defined by pj_validator
      if($connection->createProject($project, $caller, $caller_id) != 0){
        // Error happened
        echo $_POST['CPFprojectname'];
        header('HTTP/1.1 400 Bad Request');
        exit;
        
      }else{
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '#projects');
        exit;
      }
   // }
    
    // Session does not match!?
    header('HTTP/1.1 400 Bad Request');
    exit;
    
    // Add something drastic
  }

?>