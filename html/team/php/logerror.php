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
    $proj = $_POST['Aprj'];
    $userId = $_POST['Ausrid'];
    $myCon = new mysqliInterface;
    $myCon->addError($error, $line, $source, $method, $user, $userId, $proj, $severity);
  }  else {
    echo 'failure';
  }
}

function validateAddPost(){
  return validateArray($_POST, ['Aerr', 'Aline', 'Asrc', 'Asever', 'Ameth', 'Ausr', 'Ausrid' ,'Aprj', 'ADD']);
}
?>