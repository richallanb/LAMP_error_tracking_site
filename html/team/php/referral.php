<?php 
require_once('header.php');
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();
if(!empty($_POST)){  
  // Invite request
  if (isset($_POST['INV']) && validatePost() && verifyFormToken("referral")){
    $email = $_POST['RFemail'];
    if (validateInput($email)){
      $myCon = new mysqliInterface;
      if($myCon->checkEmail($email)) {
        echo existedEmail($email); // Account already exists
        exit;
      } else {
        sendRegisterEmail($email); // No account invite them
        echo inviteSucceed($email);
        exit;
      }
    }
    
  // Referal request
  } else if (isset($_POST['PROJREF']) && validatePost() && verifyFormToken("referral")) {

    $myCon = new mysqliInterface;
    $email = $_POST['RIemail'];
    $projectid = $_POST['RIprojid'];
    $referralid = $_POST['RImyid']; 
    if (validateInput($email)){
      $myCon = new mysqliInterface;

      if($myCon->checkEmail($email)) {
          if ($myCon->addUserToProject($email, $projectid, $referralid) == 0) { // Email exists, just add them
            echo addSucceed($email);
            exit;   
          } else {
            echo addFailed($email);
            exit;
          } 
      } else {
        sendReferralEmail($email,$projectid,$referralid); // No account exists, refer them to the project
        echo inviteSucceed($email);
        exit;
      }
    }
  } else {
    header('HTTP/1.1 400 Bad Request');
  }
  
  exit;
}


function validatePost(){
  return validateArray($_POST, ['RIemail', 'RIprojid','RImyid', 'token', 'PROJREF']) || validateArray($_POST, ['RFemail', 'token', 'INV']);
}

function validateInput($email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }
  return true;
}

function existedEmail($email){
  $body = '';
   // existed email address
      $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>User could not be invited.</strong><br> "<b>$email</b>" is already registered.
      </div>    
HTML;
  return $body;
}

function addFailed($email){
  $body = '';
   // existed email address
      $body .= <<< HTML
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>User could not be added to project.</strong><br> "<b>$email</b>" is likely already added. Please check.
      </div>    
HTML;
  return $body;
}

function addSucceed($email){
  $body = '';
   // existed email address
      $body .= <<< HTML
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>"$email" was added to the project.</strong><br> <b><a onclick="location.reload();">Refresh the page</a></b> and the new user will be listed in the project.
      </div>    
HTML;
  return $body;
}

function inviteSucceed($email){
  $body = '';
   // existed email address
      $body .= <<< HTML
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>An invitation email has been sent to "$email".</strong><br> This is the true test of your friendship.
      </div>    
HTML;
  return $body;
}




function sendReferralEmail($email,$projectid,$referralid) {
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
<h1 class="heading">Come join Team Nine!</h1>
<h2>Your friend wants to invite you to join!</h2>
    <p class="link">To set up an account please <b><a href="$site_path">click here</a></b> to sign up and register with Refer ID and Project ID.</p><br>
  
    <p>Your Refer ID is: $referralid</p><br>
    <p>Your Project ID is: $projectid</p>

    <p><b>Note:</b> If you feel you received this email in error, please delete it and disregard its contents.</p>
    </div>
</body>
</html>

Browse to this URL if you are unable to view HTML: $site_path
HTML;

// subject
$subject = "Your friend has sent you an invitation to work on a project!";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: Automated TeamNine Response <AutomatedResponse@team.ninth.biz>' . "\r\n";

  
// Mail it
 return mail($email, $subject, $msg, $headers);
}


function sendRegisterEmail($email) {
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
<h1 class="heading">Come join Team Nine!</h1>
<h2>Your friend wants to invite you to join!</h2>
    <p class="link">To set up an account please <b><a href="$site_path">click here</a></b> to sign up.</p>

    <p><b>Note:</b> If you feel you received this email in error, please delete it and disregard its contents.</p>
    </div>
</body>
</html>

Browse to this URL if you are unable to view HTML: $site_path
HTML;

// subject
$subject = "Your friend has sent you an invitation!";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: Automated TeamNine Response <AutomatedResponse@team.ninth.biz>' . "\r\n";
  
// Mail it
 return mail($email, $subject, $msg, $headers);
}

?>