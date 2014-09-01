<?php 
require_once('header.php');
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

if(!empty($_POST)){  
    $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
  
    //$user = $_POST['user']; 
    $pw = $_POST['password'];

    $myCon = new mysqliInterface;
    list($servHash, $admin) = $myCon->queryUser($user);
    
   
    if (checkPasswordAgainstHash($pw, $servHash) && verifyFormToken("signin") && validatePost()) {
      $_SESSION['user'] = $user;
      $_SESSION['logged'] = TRUE;
      $_SESSION['admin'] = $admin;
      $myCon->lastLogin($user);
      
      header('Location: ' . $_SERVER['HTTP_REFERER'] . "#dashboard");
      exit;
      
    }else{
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit;
    }
}

function validatePost(){
  return validateArray($_POST, ['user', 'submit', 'password', 'token']);
}
/*
function echoError(){
  $body = '';
  $body .= <<< HTML
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Bad username OR password !</strong> Try Again Bro!
    </div>    
HTML;
  echo $body;
}*/
  
?>