<?php
include('header.php');
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

if (!empty($_POST)) {
  $pw = $_POST['Srepassword'];
  $samepw = $_POST['Spassword'];
  $idhash = $_POST['idhash'];
  
  $myCon = new mysqliInterface;
  
  $err = printError($pw, $samepw);
  
  if (!(strlen($err) > 0) && validatePassword($pw,$samepw) && verifyFormToken("forgotpw") && validateArray()) {
    $pwhash = passwordToHash($pw);
    
    if ($myCon->changePassword($pwhash, $idhash)){
      header("Location: /team/resp/passwordSuccess");
    }
    else {
      header("Location: /team/resp/noAccess");
    }
  }
  else
    echo $err;
  
  exit;
}

function validatePost(){
  return validateArray($_POST, ['Spassword', 'Srepassword']);
}

function validatePassword ($pw, $samepw) {
  if (($pw != $samepw) && (strlen($pw) > 7)) {
    return FALSE;
  } else {
    return TRUE;
  }
}

function printError ($pw, $samepw) {
  if ($pw != $samepw) {
    $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Passwords do not match!</strong> Both entered passwords must be the same.
      </div>    
HTML;
   }
  return $body;
  }

  

?>