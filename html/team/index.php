<?php 
session_start();
if(isset($_POST['submit'])){
   
    $user = $_POST['user']; 
    $pw = $_POST['password'];
    
    /*
    if($user == "123@123.com" && $pw == "123"){ 
         //We're logged in
        
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = TRUE;
        header("Location: /team/team.php"); // Modify to go to the page you would like 
        exit; 
    */
        
    if($user == "admin")
    {
      if($pw == "admin")
      {
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = TRUE;
        $_SESSION['admin'] = TRUE;
        header("Location: /team/team.php"); // Modify to go to the page you would like 
        exit; 
      }
      /*
      elseif($pw == "R" || $pw == "RolandoIsAwesome")
      {
        //Someone's tests
        $_SESSION['user'] = "Best Guy";
        $_SESSION['logged'] = TRUE;
        header("Location: /team/debug.php");
        exit;
      }
      */
    }
    else{ 
        header("Location: /team/index.php"); 
        exit; 
    } 
}

if(isset($_SESSION['logged'])) {
  header("Location: /team/team.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>Into Nine</title>

    <!-- Bootstrap core CSS -->
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
      .container{
      max-width: 400px;
      min-width: 200px;
      }
    </style>
  
  </head>

  <body>

    <div class="container">

      <form class="form-signin" name="login" role="form" method="post" action="./">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="user" type="text" class="form-control" placeholder="Username" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

