<?php
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();
require_once('header.php');
$site_path = SITE_PATH;
if (!empty($_POST)){
  $user = $_POST['Fuser']; 
  $email = $_POST['Femail'];
  $myCon = new mysqliInterface;
  
  $err = printError($myCon, $user, $email);
  
  if (!(strlen($err) > 0) && validateInput($user, $email) && verifyFormToken("forgotpw") && validatePost()) {
   
      if (strlen($recHash = $myCon->passwordRecoveryGen($user, $email)) > 0) {

        sendEmail($email, $user, $recHash);
        echo printSuccess($email);
      } else{
        header('HTTP/1.1 400 Bad Request');
        echo printFailure();
      }
    }
    else {
      header('HTTP/1.1 400 Bad Request');
      echo $err;
    }
  
    exit;
  
}

function printSuccess($email) {
  $body = <<< HTML
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Account Recovery Successful!</strong><br> We have sent an email to you at "<b>$email</b>" with instructions for recovering your account.<br>
    <b>Make sure to check your Spam folder!</b>
  </div>
HTML;
return $body;
}

function printFailure() {
  $body = <<< HTML
    <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Something Went Wrong!</strong><br> We were unable to complete your request for account recovery. Please make sure you do not have a previous account recovery request.

  </div>
HTML;
return $body;
}

// Print errors (related to MySQL Queries)
// Note : All simple text based error printing should be removed
function printError($myCon, $user, $email){
  $body = '';
   $valid = filter_var($email, FILTER_VALIDATE_EMAIL) && 
     $myCon->checkEmail($email) && 
     preg_match('/^[a-zA-Z](([a-zA-Z0-9]+)|_([a-zA-Z0-9]+)){5,21}$/', $user) &&
     $myCon->checkUser($user);
  
    if (!$valid) {
      $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Not a valid email or username!</strong><br> "<b>$email</b>" or "<b>$user</b>" is not a valid! Please try again.
      </div>    
HTML;
    }
  return $body;
}

function validatePost(){
  return validateArray($_POST, ['Fuser', 'Femail', 'token']);
}

// Validate user input
// Only simple text based checking for redundancy. Errors should be displayed entirely by JS
function validateInput($user, $email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) ||
     !preg_match(USER_REGEX, $user)
     ) {
    return false;
  }
  return true;
}

function sendEmail($email, $user, $idhash) {
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
<h1 class="heading">Account Recovery Request</h1>
    <p class="link">An account recovery attempt has been created for your account. If you feel this was done in error, <b>Disregard this E-mail</b>.</p>

    In order to recover your account please <b><a href="$site_path/team/php/reset.php?v=$idhash">click here</a></b> to finish the process.<br>
    You will be asked to fill in a new password for your account.
  
    <p><b>Note:</b> If you feel this is a malicious attempt to gain access to your account <b>Contact your project manager or a site administrator</b></p>
    </div>
</body>
</html>

Browse to this URL if you are unable to view HTML: $site_path/team/php/reset.php?v=$idhash
HTML;
  

// subject
$subject = "Password Recovery Request for $user";

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