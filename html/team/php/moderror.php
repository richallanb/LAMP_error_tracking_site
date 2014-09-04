<?php 
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();
require_once('header.php');
if (isset($_POST['RES']) && validateResPost() && verifyFormToken("resolve-err")) {
    // Sanitize input
    $error_id = filter_var($_POST['Rid'], FILTER_SANITIZE_STRING);
    $resolved_comment = filter_var($_POST['Rrescmnt'], FILTER_SANITIZE_STRING);
    $resolved_user = filter_var($_POST['Rresusr'], FILTER_SANITIZE_STRING);
    $myCon = new mysqliInterface;
    $myCon->resolveError($error_id, $resolved_user, $resolved_comment);
    
  } else if (isset($_POST['MOD']) && validateModPost() && verifyFormToken("modify-err")) {
    // Sanitize input
    $error_id = filter_var($_POST['Mid'], FILTER_SANITIZE_STRING);
    $user_id = filter_var($_POST['Musrid'], FILTER_SANITIZE_STRING);
    $severity = filter_var($_POST['Msever'], FILTER_SANITIZE_STRING);
    $comment = filter_var($_POST['Mcmnt'], FILTER_SANITIZE_STRING);
    $myCon = new mysqliInterface;
    $myCon->modifyError($error_id, $user_id, $comment, $severity);
  } else {
    header('HTTP/1.1 400 Bad Request');
  }
function validateResPost(){
  return validateArray($_POST, ['Rid', 'Rrescmnt', 'Rresusr', 'token', 'RES']);
}
function validateModPost(){
  return validateArray($_POST, ['Mid','Msever', 'Musrid', 'Mcmnt', 'token', 'MOD']);
}
?>