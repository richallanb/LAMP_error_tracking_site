<?php
  
  /* SUPPORT */
  
  // Show dashboard, USER+

  $standard_li = <<< HTML
    <li><a href="#documentation" data-toggle="tab">Documentation</a></li>
    <li><a href="#about" data-toggle="tab">About Us</a></li>
HTML;

  $logged_li = "";
  if($level != -1){
    $logged_li = <<< HTML
      <li><a href="#dashboard" data-toggle="tab">Dashboard</a></li>
      <li><a href="#projects" data-toggle="tab">Projects</a></li>
HTML;
  }

  // Site Management dropdown, ADMIN only
  $site_li = "";
  if($level == 3) {
    $site_li = <<< HTML
      <li class="dropdown"><a href="" class="dropdown-toggle admin-link" data-toggle="dropdown">Site Management <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="/team/php/phpinfo">PHP Info</a></li>
          <li><a href="/awstats/awstats.pl" data-rel="tooltip" data-placement="right" title="Our apache usage logs">Log Report</a></li>
          <li><a href="/team/php/deploy" data-rel="tooltip" data-placement="right" title="This is going to pull any pushed changes from git">Deploy Git Updates to Server</a></li>
          <li><a id="ad-show-users" href="#" data-rel="tooltip" data-placement="right" title="Display all users and manage their accounts">Manage Users</a></li>
        </ul>
      </li>       
HTML;
  }
    
  // NAVBAR RIGHT, checks whether user is logged in

  $left_li = "";
  $right_li = "";
  // LOGGED IN
  if(isset($_SESSION['logged'])){
    // Username
    $left_li = <<< HTML
     <li class="welcome-link">
       <p class="navbar-text"><a href="/#dashboard">{$_SESSION['user']}</a>&nbsp; <span class="glyphicon glyphicon-leaf"></span></p>
     </li>
HTML;
    //Logout
    $right_li = <<< HTML
      <li><a href="/team/php/logout.php">Logout</a></li>
HTML;
  // LOGGED OFF
  }else{
    // Replace action with register script
    // Register
    $left_li = <<< HTML
      <li class="dropdown"><!--a href="#" class="dropdown-toggle" data-toggle="dropdown"--><a href="#" class="signup-link" data-toggle="modal" data-target="#modal-signup">Sign Up &nbsp;<span class="glyphicon glyphicon-leaf"></span></a>
        <!--ul class="dropdown-menu signin sign-dd" role="menu" style="width:300px" >
          <li><h4>Register</h4></li>
          <li>
            <form class="form-signup" name="register" id="signup" role="form" method="post">
              <input name="Suser" type="text" class="form-control" placeholder="Username" oninvalid="setCustomValidity('Username must begin with alphanumeric character. It can only contain alphanumeric characters or \'_\' and between 6 and 21 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern="^[a-zA-Z](([a-zA-Z0-9]+)|_([a-zA-Z0-9]+)){5,21}$" required autofocus style="margin-bottom: 5px">
              <div class="input-group" style="margin-bottom: 5px;">
                <div class="input-group-addon">@</div>
                <input class="form-control" type="email" name="Semail" placeholder="Enter email" required>
              </div>
              <input name="Spassword" type="password" oninvalid="setCustomValidity('Passwords must be atleast 8 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern=".{8,}"  class="form-control" placeholder="Password" required style="margin-bottom: 5px">     
              <input name="Srepassword" type="password" oninput="pwCompare(this,'input[name=Spassword]');" class="form-control" placeholder="Retype Password" required style="margin-bottom: 10px">               
              <input type="hidden" name="Stoken" value=$signupToken>
              <button class="btn btn-default btn-block" name="Ssubmit" type="submit">Sign Up</button>
            </form>
          </li>
        </ul-->
      </li>
HTML;
    // Replace password recovery with appropriate link
    // Log in
    $right_li = <<< HTML
      <li class="dropdown"><a href="#" id="signin-menu" class="dropdown-toggle" data-toggle="dropdown">Sign In <span class="caret"></span></a>
        <ul class="dropdown-menu signin sign-dd" role="menu" style="width: 265px">
          <li><h4>Sign In</h4>
            <div id="signin-response"></div>
            <form class="form-signin" name="login" id="signin" role="form">
              <input name="user" type="text" class="form-control" placeholder="Username" oninvalid="setCustomValidity('Username must begin with alphanumeric character. It can only contain alphanumeric characters or \'_\' and between 6 and 21 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern="^[a-zA-Z](([a-zA-Z0-9]+)|_([a-zA-Z0-9]+)){5,21}$" required autofocus style="margin-bottom: 5px">
              <input name="password" type="password" class="form-control" oninvalid="setCustomValidity('Passwords must be atleast 8 characters long');" onchange="try{setCustomValidity('')}catch(e){}" pattern=".{8,}" placeholder="Password" required style="margin-bottom: 10px">
              <input type="hidden" name="token" value=$newToken>
              <button class="btn btn-default btn-block" name="submit" type="submit">Sign in</button>
            </form>
          </li>
          <li><a href="#" data-toggle="modal" data-target="#modal-forgotpw">Forgot password?</a></li>
        </ul>
      </li>
HTML;
  }
    
  /* MAIN MAIN MAIN MAIN MAIN */
  $body = <<< HTML
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <span class="navbar-brand-def">Team Nine</span>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">       

          <!-- LEFTSIDE MENU NAVIGATION -->        
          <ul id="the-navbar" class="nav navbar-nav navbar-left">
            <li><a href="#home" data-toggle="tab">Home</a></li>
            $logged_li
            $standard_li
          </ul>
          <ul class="nav navbar-nav navbar-left">
            $site_li
          </ul>

          <!-- RIGHTSIDE MENU NAVIGATION -->         
          <ul class="nav navbar-nav navbar-right">
            $left_li
            $right_li
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
HTML;
  echo $body;
?>