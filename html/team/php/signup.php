<?php 
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();
require_once('header.php');


if(!empty($_POST) && verifyFormToken("signup")){  
//    $user = filter_var($_POST['Suser'], FILTER_SANITIZE_STRING);
  
    $user = filter_var($_POST['Suser'], FILTER_SANITIZE_STRING); 
    $email = filter_var($_POST['Semail'], FILTER_SANITIZE_STRING);
    $pw = $_POST['Spassword'];
    $samepw = $_POST['Srepassword'];
    $refer = null;
    $projid = null;
    if (isset($_POST['Sprojectid']))
      $projid = $_POST['Sprojectid'];
    if (isset($_POST['Sreferal']))
      $refer = $_POST['Sreferal'];
  
    $myCon = new mysqliInterface;
  
    $err = printError($myCon, $user, $email, $pw, $samepw, $refer, $projid);
    if (!(strlen($err) > 0) && validateInput($user, $email, $pw, $samepw) && validatePost()) {
   
      $pwhash = passwordToHash($pw);
      if (strlen($idhash = $myCon->signUp($user, $pwhash, $email, null)) > 0) {
        
        
        if ($refer == null && $projid ==null) {
          sendEmail($email, $user, $idhash);
          echo printSuccess($email);
        } else {
          if ($myCon->activateUser($idhash) == 0) {
           if ($myCon->addUserToProject($email, $projid, $refer) == 0) {
            echo printSuccess2();
           }
          }
        }
        
      } else{
        header('HTTP/1.1 400 Bad Request');
      }
    }
    else {
      header('HTTP/1.1 400 Bad Request');
      echo $err;
    }
  
    exit;
}

function validatePost(){
  return validateArray($_POST, ['Suser', 'Semail', 'Spassword', 'Srepassword', 'token']) ||
    validateArray($_POST, ['Suser', 'Semail', 'Spassword', 'Srepassword', 'token', 'Sreferal', 'Sprojectid']);
}

// Validate user input
// Only simple text based checking for redundancy. Errors should be displayed entirely by JS
function validateInput($user, $email, $pw, $samepw) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) ||
     !preg_match(USER_REGEX, $user) ||
      $pw != $samepw ||
      !preg_match(PASS_REGEX, $pw)
     ) {
    return false;
  }
  return true;
}

function printSuccess($email) {
  $body = <<< HTML
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Account Successfully Created!</strong><br> Your account was created! We have sent you an email to "<b>$email</b>" with instructions for activating your account.<br>
    <b>Make sure to check your Spam folder!</b>
  </div>
HTML;
return $body;
}
function printSuccess2() {
  $body = <<< HTML
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Account Successfully Created!</strong><br> Your account was created and you were successfully added to the project!<br>
    Login and start making errors!
  </div>
HTML;
return $body;
}

// Print errors (related to MySQL Queries)
// Note : All simple text based error printing should be removed
function printError($myCon, $user, $email, $pw, $samepw, $refer, $projid){
  $body = '';
   // Bad email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Not a valid email!</strong><br> "<b>$email</b>" is not a valid email address.
      </div>    
HTML;
    } else if ($myCon->checkEmail($email)){
    $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Email address in use!</strong><br> "<b>$email</b>" is already in use by another user.
      </div>    
HTML;
  }
    
    // Bad user name
    if (!preg_match('/^[a-zA-Z](([a-zA-Z0-9]+)|_([a-zA-Z0-9]+)){5,21}$/', $user)){
      $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Not a valid username!</strong><br> "<b>$user</b>" is not a valid username. Please pick a new one. <br>It must <b>start with a letter</b>. It must <b>consist of numbers, letters or '_'</b>.
      </div>    
HTML;
    } else if ($myCon->checkUser($user)){
    $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Username already taken!</strong><br> "<b>$user</b>" is already in use by another user.
      </div>    
HTML;
  }
  
   if ($pw != $samepw){
     $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Passwords do not match!</strong><br> Both entered passwords must be the same.
      </div>    
HTML;
   }
  
  if ($refer && $projid){
    if (!$myCon->checkProject($projid, $refer)) {
      $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Could not add you to the project!</strong><br> You could not be added to the project, please check the Referral ID and Project ID.
      </div>    
HTML;
    }
  }
  return $body;
}

function sendEmail($email, $user, $idhash) {
  $site_path = SITE_PATH;
  $msg = <<< HTML
<!DOCTYPE html>
<html>
<head>
<style>
body{
    font-family: Sans-serif;
}
h1 {
    font-size: 40px;
}

h2 {
    font-size: 30px;
}

p {
    font-size: 14px;
}
.heading{
    margin-top:3px;
}
a{
    color: #428BCA;
    text-decoration:none;
}
a:hover{
    color: #2A6496;
    text-decoration:underline;
}
.container{
    background-color: #EEE;

    border-radius:10px;
    padding: 16px;
}
.link {
    margin-bottom: 30px;
}
</style>
</head>
<body>
<div class="container">
<h1 class="heading">Welcome to Team Nine!</h1>
<h2>You're almost up and running</h2>
    <p class="link">In order to finish setting up your account with us you must <b><a href="$site_path/team/php/activate.php?hash=$idhash">click here</a></b> to activate.</p>

    <p><b>Note:</b> If you feel you've received this email in error, please delete it and disregard its contents.</p>
    </div>
</body>
</html>

      Browse to this URL if you are unable to view HTML: $site_path/team/php/activate.php?hash=$idhash
HTML;
  

// subject
$subject = "Welcome to Team Nine $user!";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= "To: $user <$email>" . "\r\n";
$headers .= 'From: Automated TeamNine Response <AutomatedResponse@team.ninth.biz>' . "\r\n";

// Mail it
mail($email, $subject, $msg, $headers);
}
?>