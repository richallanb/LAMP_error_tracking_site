<?php
  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();

  $passwordToken = generateFormToken('newPassword');

  if (!empty($_GET) && validateGet()) {
    $idhash = $_GET['hash'];
  }
  else {
    header("Location: /team/resp/noAccess");
  }

  function generateFormToken($form){
      // generate a token from an unique value
      $token = md5(uniqid(microtime(), true));  
      // Write the generated token to the session variable to check it against the hidden field when the form is sent
      $_SESSION[$form.'_token'] = $token; 
      return $token;
    }

   function validateGet(){
    return validateArray($_GET, ['hash']);
  }

$body = <<< HTML
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">

      <title>Team Nine</title>

      <!-- Bootstrap core CSS -->
      <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="/team/style.css" rel="stylesheet">

    </head>
    <body>
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
  
    <div class="navbar-header">
            <span class="navbar-brand">Team Nine</span>
          </div>
        </div>
      </nav>


     <div class="container">
       <div class="jumbotron">
        <h2>Reset Password</h2><br>
          <form class="form-resetPassword" name="resetPassword" id="newPassword" role="form" method="post" action="/team/php/resetPassword.php">
           <input name="newPassword" type="password" class="form-control" placeholder="New Password" required style="margin-bottom: 5px">     
           <input name="reNewPassword" type="password" oninput="pwCompare(this,'input[name=Spassword]');" class="form-control" placeholder="Retype Password" required style="margin-bottom: 10px">               
           <input type="hidden" name="forgotpw" value=$passwordToken>
           <input type="hidden" name="idhash" value=$idhash>
           <button class="btn btn-default btn-block" name="change" type="submit">Reset Password</button>
          </form>
        </div>
      <p>&copy; Team Nine 2014</p>
      </div>
    </body>
  </html>
HTML;

echo $body;
?>