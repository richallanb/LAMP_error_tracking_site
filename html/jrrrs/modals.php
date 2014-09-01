<!--Forgot password modal-->
<?php if (!($level >= USER)) {
  $fgpw = <<< HTML
    <div class="modal fade" id="modal-forgotpw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Account Retrieval</h4>
        <div style="margin-top:5px;text-align:center;">Please type in the username and email of your account.<br><small>We will email you instructions on how to recover your account.</small></div>
      </div>
      <div class="modal-body">
      
      </div>
      <div id="forgotpw-resp" style="margin: 0 40px 0 40px;"></div>
      <form name="forgotpw" id="forgotpw" role="form">
      <div style="margin: 0 40px 30px 40px;">
              <div>Account Username:</div>
              <input name="Fuser" type="text" class="form-control" placeholder="Username" pattern="^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$" required autofocus style="margin-bottom: 20px">
              <div>Account E-mail:</div>
              <div class="input-group">
                <div class="input-group-addon">@</div>
                <input class="form-control" type="email" name="Femail" placeholder="Enter email" required>
              </div>
                <input type="hidden" name="Ftoken" value=$fgToken>
      </div>
          
      <div class="modal-footer">
        <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button-->
        <button name="submit" type="submit" class="btn btn-primary">Send  &nbsp;<span class="glyphicon glyphicon-send"></span></button>
      </div>
      </form>
          
    </div>
  </div>
</div>
HTML;
  echo $fgpw;
}?>
<!--End Forgot password modal-->

<!--Sign Up Modal !-->
<?php
$signup = <<< HTML
<div class="modal fade" id="modal-signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin:0;padding:0;">
  <div class="module modal-dialog">
   <div class="tab-container"> <ul>
     <li class="tab activeTab" data-action="single-signup-container"><span class="icon glyphicon glyphicon-user"></span></li>
     <li class="tab" data-action="proj-signup-container"><span class="icon glyphicon glyphicon-link"></span></li>
      
     </ul><!--button type="button" class="close" style="margin-top:15px;margin-right:15px;float:right;" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button--></div>
    <div id="signup-response"></div>
    <div id="single-signup-container" class="signup-pane">
    <h4 class="form-heading" id="myModalLabel">Single User Sign-Up</h4><p class="form-msg">Signing up a single user account only takes a few seconds!<br><small>Register an account and check your email to activate.</small></p>
    <hr>
    
    <form class="form-signup form" name="register" id="signup" role="form" method="post">
      <div class="input-group" style="margin-bottom: 15px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
      <input name="Suser" type="text" class="form-control input-large" placeholder="Username" oninvalid="setCustomValidity('Username must begin with alphanumeric character. It can only contain alphanumeric characters or \'_\' and between 6 and 21 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern="^[a-zA-Z](([a-zA-Z0-9]+)|_([a-zA-Z0-9]+)){5,21}$" required autofocus></div>
              <div class="input-group" style="margin-bottom: 15px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <input class="form-control input-large" type="email" name="Semail" placeholder="Enter email" required>
              </div>
              <div class="input-group" style="margin-bottom: 15px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div><input name="Spassword" type="password" oninvalid="setCustomValidity('Passwords must be atleast 8 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern=".{8,}"  class="form-control input-large" placeholder="Password" required>
      </div>
              <div class="input-group Srepassword" style="margin-bottom: 15px; display:none;">
                <div class="input-group-addon Srepassword"><span class="glyphicon glyphicon-lock"></span></div><input name="Srepassword" type="password" oninput="pwCompare(this,'input[name=Spassword]');" class="form-control input-large" placeholder="Retype Password" required></div>
              <input type="hidden" name="Stoken" value=$signupToken>
              <button class="btn btn-default btn-block btn-large" type="submit">Sign Up</button>
    </form>
    </div>
    <div id="proj-signup-container" class="signup-pane">
    <h4 class="form-heading" id="myModalLabel">Project User Sign-Up</h4><p class="form-msg">Simply paste in the Refer's ID and Project ID you wish to join.<br><small>And that's it! No activation required!</small></p>
    <hr>
    
    <form class="form-signup form" name="proj-register" id="proj-signup" role="form" method="post">
      <input name="Preferid" type="text" class="form-control input-large" placeholder="Refer's ID" required autofocus style="margin-bottom: 15px;">
      <input name="Pprojid" type="text" class="form-control input-large" placeholder="Project ID" required autofocus style="margin-bottom: 15px;">
      <div class="input-group" style="margin-bottom: 15px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
      <input name="Puser" type="text" class="form-control input-large" placeholder="Username" oninvalid="setCustomValidity('Username must begin with alphanumeric character. It can only contain alphanumeric characters or \'_\' and between 6 and 21 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern="^[a-zA-Z](([a-zA-Z0-9]+)|_([a-zA-Z0-9]+)){5,21}$" required autofocus></div>
              <div class="input-group" style="margin-bottom: 15px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <input class="form-control input-large" type="email" name="Pemail" placeholder="Enter email" required>
              </div>
              <div class="input-group" style="margin-bottom: 15px;">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div><input name="Ppassword" type="password" oninvalid="setCustomValidity('Passwords must be atleast 8 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern=".{8,}"  class="form-control input-large" placeholder="Password" required>
      </div>
              <div class="input-group Prepassword" style="margin-bottom: 15px; display:none;">
                <div class="input-group-addon Prepassword"><span class="glyphicon glyphicon-lock"></span></div><input name="Prepassword" type="password" oninput="pwCompare(this,'input[name=Ppassword]');" class="form-control input-large" placeholder="Retype Password" required></div>
              <input type="hidden" name="Ptoken" value=$signupToken>
              
              <button class="btn btn-default btn-block btn-large" type="submit">Sign Up</button>
    </form>
    </div>
  </div>
</div>
HTML;
echo $signup;
?>

