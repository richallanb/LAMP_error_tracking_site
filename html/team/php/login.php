<?php 
require_once('header.php');
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

if(!empty($_POST)){  
    $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
    $pw = $_POST['password'];

    
    
   
    if (verifyFormToken("signin") && validatePost() && validateInput($user, $pw)) {
      $myCon = new mysqliInterface;
      list($servHash, $admin, $idhash) = $myCon->queryUser($user);
      if (checkPasswordAgainstHash($pw, $servHash)) {
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = TRUE;
        $_SESSION['admin'] = $admin;
        $_SESSION['idhash'] = $idhash;
        $myCon->lastLogin($user);

        echo "OK";
        exit;
      } else {
        echo loginError();
        header('HTTP/1.1 400 Bad Request');
        exit();
      }
    }else{
      header('HTTP/1.1 400 Bad Request');
      exit;
    }
}

function validatePost(){
  return validateArray($_POST, ['user', 'password', 'token']);
}

function validateInput($user, $pw) {
  if (!preg_match(USER_REGEX, $user) ||
      !preg_match(PASS_REGEX, $pw)
     ) {
    return false;
  }
  return true;
}

function loginError(){
  $body = '';
  $body .= <<< HTML
        <span style="margin: 5px 0 5px 0; color:red;">Bad username or password!</span>
HTML;
  return $body;
}
  
?>