<?php 
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();
require_once('header.php');
if (isset($_POST['RES']) && validateResPost() && verifyFormToken("resolve-err")) {
    // Sanitize input
    $error_id = $_POST['Rid'];
    $resolved_comment = filter_var($_POST['Rrescmnt'], FILTER_SANITIZE_STRING);
    $resolved_user = $_POST['Rresusr'];
    $myCon = new mysqliInterface;
    $myCon->resolveError($error_id, $resolved_user, $resolved_comment);
    
  } else if (isset($_POST['MOD']) && validateModPost() && verifyFormToken("modify-err")) {
    // Sanitize input
    $error_id = $_POST['Mid'];
    $user_id = $_POST['Musrid'];
    $severity = filter_var($_POST['Msever'], FILTER_SANITIZE_STRING);
    $comment = filter_var($_POST['Mcmnt'], FILTER_SANITIZE_STRING);
    $myCon = new mysqliInterface;
    $myCon->modifyError($error_id, $user_id, $comment, $severity);
  } else if (isset($_POST['DIS']) && validateDisPost() && verifyFormToken("modify-err")) {
    // Sanitize input
    $error_id = $_POST['Did'];
    $user_id = $_POST['Dusrid'];
    $myCon = new mysqliInterface;
     if ($myCon->dismissError($error_id, $user_id) != 0) {
       header('HTTP/1.1 400 Bad Request');
     }
  } else {
    header('HTTP/1.1 400 Bad Request');
  }
function validateResPost(){
  return validateArray($_POST, ['Rid', 'Rrescmnt', 'Rresusr', 'token', 'RES']);
}
function validateModPost(){
  return validateArray($_POST, ['Mid','Msever', 'Musrid', 'Mcmnt', 'token', 'MOD']);
}
function validateDisPost(){
  return validateArray($_POST, ['Did','Dusrid', 'token', 'DIS']);
}
?>