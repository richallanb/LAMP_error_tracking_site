<?php

?>

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
    <?php // NAVBAR
      include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar_light.html"); 
    ?>
    
    
   <div class="container">
     <div class="jumbotron"> 
   <div id="signUUp" class="signUUp">
          <br><h2>Register</h2><br>
            <form class="form-signup" name="register" id="signup" role="form" method="post">
              <input name="Suser" type="text" class="form-control" placeholder="Username" oninvalid="setCustomValidity('Username must begin with alphanumeric character. It can only contain alphanumeric characters or \'_\'');" onchange="try{setCustomValidity('')}catch(e){}" pattern="^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$" required  style="margin-bottom: 5px">
              <div class="input-group" style="margin-bottom: 5px;">
                <div class="input-group-addon">@</div>
                <input class="form-control" type="email" name="email" placeholder="Enter email" required>
              </div>
              <input name="Spassword" type="password" class="form-control" placeholder="Password" required style="margin-bottom: 5px">     
              <input name="Srepassword" type="password" oninput="pwCompare(this,'input[name=Spassword]');" class="form-control" placeholder="Retype Password" required style="margin-bottom: 10px">               
              <input type="hidden" name="Stoken" value=$signupToken>
              <input type="hidden" name="idhash" value=$idhash>
              <button class="btn btn-default btn-block" name="Ssubmit" type="submit">Sign Up</button>
            </form>
  </div>
   </div>
    <p>&copy; Team Nine 2014</p>
    </div>

    
  </body>
</html>
