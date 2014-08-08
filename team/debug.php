<?php 
  session_start(); 
  if(!$_SESSION['logged']){
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>Debu9</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
    </style>
  
  </head>
  
  <body>
        
    <script> 
    </script>
      
    <div class="container">
      <div class="masthead" style="margin-top:20px;">
     
        
        <!-- Header-->
        <h2 class="text-muted" style="display:table-cell;width:100%;">Nine</h2>
        
        <h6 style="display:table-cell;min-width:300px;text-align:right;">
          Welcome,
          <a href="./php/logout.php">
            <?php echo ($_SESSION['user']); ?>
          </a>
        </h6>
        
        
        <h6 style="text-align:right">
          <a>Not one of us? Sign up. Sign up right now.</a>
        </h6>
      </div> <!-- /masthead -->

      <!-- Jumbotron -->
      <div id="landing" class="jumbotron">
        <h1>
          Our Mission
        </h1>
        <p class="lead">
          We here at Nine take pride in absolutely everything we do from the last screw to the first model. Whether you need something drawn in 3D, or you want a nuts and bolts prototype we are here or you, every step of the way. To find out more about the Anvil advantage please contact us.
        </p>       
      </div>
      
      <div id="tests" class="jumbotron">
        <h1> 
          Tests
        </h1>
        <p class="tests">
          Our tests 
          <a href="../errors/e403.html">
            403
          </a>
          and
          <a href="../errors/e404.html">
            404
          </a>
          .
        </p>
      </div>
      
      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Rolando's' 2014</p>
      </div>

    </div> <!-- /container -->   
  </body>
</html>

