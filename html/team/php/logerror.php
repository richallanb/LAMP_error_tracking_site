<?php
header('Access-Control-Allow-Origin: *');
require_once('header.php');

if (!empty($_POST)){
  if (isset($_POST['ADD']) && validateAddPost()){
    // Sanitize input
    $error = filter_var($_POST['Aerr'], FILTER_SANITIZE_STRING);
    $line = filter_var($_POST['Aline'], FILTER_SANITIZE_STRING);
    $source = filter_var($_POST['Asrc'], FILTER_SANITIZE_STRING);
    $severity = filter_var($_POST['Asever'], FILTER_SANITIZE_STRING);
    $method = filter_var($_POST['Ameth'], FILTER_SANITIZE_STRING);
    $user = filter_var($_POST['Ausr'], FILTER_SANITIZE_STRING);
    $proj = filter_var($_POST['Aprj'], FILTER_SANITIZE_STRING);
    $userId = filter_var($_POST['Ausrid'], FILTER_SANITIZE_STRING);
    $myCon = new mysqliInterface;
    $myCon->addError($error, $line, $source, $method, $user, $userId, $proj, $severity);
  } else if (isset($_POST['RES']) && validateResPost()) {
    // Sanitize input
    $error_id = filter_var($_POST['Rid'], FILTER_SANITIZE_STRING);
    $resolved = filter_var($_POST['Rres'], FILTER_SANITIZE_STRING);
    $resolved_comment = filter_var($_POST['Rrescmnt'], FILTER_SANITIZE_STRING);
    $resolved_date = filter_var($_POST['Rresdate'], FILTER_SANITIZE_STRING);
    $resolved_user = filter_var($_POST['Rresusr'], FILTER_SANITIZE_STRING);
    
  } else if (isset($_POST['MOD']) && validateModPost()) {
    // Sanitize input
    $error_id = filter_var($_POST['Mid'], FILTER_SANITIZE_STRING);
    $severity = filter_var($_POST['Msever'], FILTER_SANITIZE_STRING);
    $comment = filter_var($_POST['Mcmnt'], FILTER_SANITIZE_STRING);
  } else {
    echo 'failure';
  }
}

function validateAddPost(){
  return validateArray($_POST, ['Aerr', 'Aline', 'Asrc', 'Asever', 'Ameth', 'Ausr', 'Ausrid' ,'Aprj', 'ADD']);
}
function validateResPost(){
  return validateArray($_POST, ['Rid','Rres', 'Rrescmnt', 'Rresdate', 'Rresusr', 'RES']);
}
function validateModPost(){
  return validateArray($_POST, ['Mid','Msever', 'Mcmnt', 'MOD']);
}
?>