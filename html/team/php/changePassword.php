<?php
include('header.php');
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

if (!empty($_POST)) {
  $pw = $_POST['Spassword'];
  $samepw = $_POST['Srepassword'];
  $recHash = $_POST['rechash'];
  
  $myCon = new mysqliInterface;
  
  if (validatePassword($pw,$samepw) && verifyFormToken("forgotpw") && validatePost()) {
    $pwhash = passwordToHash($pw);
    if ($myCon->changePassword($recHash, $pwhash)){
      header("Location: /team/resp/passwordSuccess");
    }
    else {
      header("Location: /errors/error403");
    }
  }
  else
    header("Location: /");
  
  exit;
}

function validatePost(){
  return validateArray($_POST, ['Spassword', 'Srepassword', 'rechash', 'token']);
}

function validatePassword ($pw, $samepw) {
  if (($pw != $samepw) && (strlen($pw) > 7)) {
    return false;
  } else {
    return true;
  }
}

  

?>