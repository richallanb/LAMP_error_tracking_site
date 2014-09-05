<?php
  require_once('header.php');
  //include('../../protected/constants.php');
  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();

  if (!empty($_GET) && validateGet()) {
    $idhash = $_GET['hash'];

    $myCon = new mysqliInterface;

    if ($myCon->activateUser($idhash) == 0) {
      header("Location: /team/resp/activation");
    }
    else {
      //echo 'Account does not exist, or is already activated!'; // remove later!
    }
    
    exit;
  } else{
   header("Location: /team/resp/noAccess");
  }

  function validateGet(){
    return validateArray($_GET, ['hash']);
  }
?>