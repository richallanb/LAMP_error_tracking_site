<?php
  //include('/home/action/workspace/protected/constants.php');
  include('header.php');

  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();

  // Token generator
  $passwordToken = generateFormToken('forgotpw');

  if (!empty($_GET) && validateGet()) {
    $recHash = $_GET['v'];
    $myCon = new mysqliInterface;
    $idhash = $myCon->checkPasswordRecHash($recHash);
    if ($idhash == null) { // Bad hash
      header("Location: /");
    }
  } else {
    header("Location: /");
  }

  function generateFormToken($form){
      // generate a token from an unique value
      $token = md5(uniqid(microtime(), true));
      // Write the generated token to the session variable to check it against the hidden field when the form is sent
      $_SESSION[$form.'_token'] = $token;
      return $token;
    }

   function validateGet(){
    return validateArray($_GET, ['v']);
  }


  static $level = -1;
  /* FOR VALIDATION! DO NOT DELETE!! 
  $level = 3;
  $_SESSION['user'] = "testing123";
  $_SESSION['logged'] = TRUE;
  */
  ///*
  if( isset($_SESSION["admin"]) && isset($_SESSION["logged"]) && $_SESSION["logged"] ){
    $level = $_SESSION["admin"];
    header("Location: /");
  }
  //*/
?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">

      <title>Team Nine Password Recovery Page</title>

      <!-- Bootstrap core CSS -->
      <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="/team/style.css" rel="stylesheet">

    </head>
    <body>
    <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar_light.html"); ?>
    <div class="container" style="width:600px;">
      <!-- Jumbotron -->
      <div id="landing" class="jumbotron">
        <h2>Account Recovery</h2>
        <hr>
        <div style="margin:10px">After this, recovery of your account will be complete.<br> Just sign in with your old user name and your new password.</div>
        <hr>
        <p>Please enter in a new password<br></p>
          <form class="form-signup form" id="resetpw" role="form" method="post" action="/team/php/changePassword.php">
           <div class="input-group" style="margin-bottom: 15px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div><input name="Spassword" type="password" oninvalid="setCustomValidity('Passwords must be atleast 8 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern=".{8,}"  class="form-control input-large" placeholder="New Password" required>
      </div>
              <div class="input-group Srepassword" style="margin-bottom: 15px; display:none;">
                <div class="input-group-addon Srepassword"><span class="glyphicon glyphicon-lock"></span></div><input name="Srepassword" type="password" oninput="pwCompare(this,'input[name=Spassword]');" class="form-control input-large" placeholder="Retype Password" required></div> 
           <input type="hidden" name="token" value=<?php echo $passwordToken; ?>>
           <input type="hidden" name="rechash" value=<?php echo $recHash; ?>>
           <button class="btn btn-default btn-block btn-large" type="submit">Change Password</button>
          </form>
        
        </div>
        <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/footer.html"); ?>
      </div> <!-- /container -->
      
      <!-- Scripts -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/team/bootstrap/js/bootstrap.min.js"></script>
    <script src="/team/js/scripts.js"></script>
    </body>
  </html>