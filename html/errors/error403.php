<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>403!</title>

    <!-- Bootstrap core CSS -->
    <link href="../team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
    </style>
  
  </head>

  <body>
    
    <script>
    </script>
    
    <div class="container">
      <div class="masthead" style="margin-top:20px;">
     
        <!-- Header-->
        <h2 class="text-muted" style="display:table-cell;width:100%;">Team Nine</h2>
        <h6 style="display:table-cell;min-width:300px;text-align:right;">
          <?php
            if(isset($_SESSION['logged'])){
              print ('Welcome ' . '<a href="./php/logout.php">' . $_SESSION["user"] . '</a>');            
            }else{
              print ('<a href="./index.php">Sign in</a>');
            }
          ?>
        </h6>
      </div> <!-- /masthead -->

      <!-- Jumbotron -->
      <div id="landing" class="jumbotron">
        <h1>
          Four Hundred and Three
        </h1>
        <p class="lead">
          You shall not pass! Please
          <a href="../">go</a> 
          away!
        </p>       
      </div>
         
      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Nine 2014</p>
      </div>

    </div> <!-- /container -->
  </body>
</html>